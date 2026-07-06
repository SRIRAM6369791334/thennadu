<?php

namespace App\Services;

use App\Models\User;
use App\Models\PartnerPreference;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MatchmakingService
{
    /**
     * Get potential matches for a given user.
     */
    public function getPotentialMatches(User $user, $options = [])
    {
        $includeHoroscope = $options['include_horoscope'] ?? true;
        $minIntensity = $options['intensity'] ?? 50;
        $hasPhotos = $options['has_photos'] ?? false;
        $isVerified = $options['is_verified'] ?? false;

        $preference = $user->partnerPreference;

        // 1. Initial Filtering (Gender & Basic Preferences)
        $overrideGender = $options['gender'] ?? null;
        if ($overrideGender) {
            $oppositeGender = (strtolower($overrideGender) === 'bride' || strtolower($overrideGender) === 'female') ? 'Female' : 'Male';
        } else {
            $oppositeGender = ($user->gender === 'Male') ? 'Female' : 'Male';
        }
        
        $showAll = $options['show_all'] ?? false;
        
        $query = User::with([
            'userDetail', 'educationJob', 'address', 'familyDetail', 'horoscopeDetail', 'interests', 'partnerPreference'
        ])
        ->where('id', '!=', $user->id)
        ->where('gender', $oppositeGender);

        if (!$showAll) {
            $query->where('status', 1);
            
            // Apply basic preferred filters (Options take precedence over static preferences)
            $targetReligion = $options['religion'] ?? ($preference->religion ?? null);
            if ($targetReligion && $targetReligion !== 'Any') {
                $query->where('religion', $targetReligion);
            }
        }

        if ($hasPhotos) {
            $query->where(function($q) {
                $q->whereHas('userDetail', function($sq) { $sq->whereNotNull('photo_path'); })
                ->orWhereExists(function ($sq) {
                    $sq->select(DB::raw(1))->from('images')->whereColumn('images.varanid', 'users.user_ID');
                });
            });
        }
        
        // Age Filtering
        $minAge = $options['min_age'] ?? 20;
        $maxAge = $options['max_age'] ?? 70;
        $query->whereRaw("TIMESTAMPDIFF(YEAR, dob, CURDATE()) >= ?", [$minAge]);
        $query->whereRaw("TIMESTAMPDIFF(YEAR, dob, CURDATE()) <= ?", [$maxAge]);

        // Strict Traditional Default (Only if no custom age range provided AND not show_all)
        if (!$showAll && !isset($options['min_age']) && !isset($options['max_age']) && $user->dob) {
            $userAge = Carbon::parse($user->dob)->age;
            if ($user->gender === 'Male') {
                 $query->whereRaw("TIMESTAMPDIFF(YEAR, dob, CURDATE()) < ?", [$userAge]); 
            } else {
                 $query->whereRaw("TIMESTAMPDIFF(YEAR, dob, CURDATE()) > ?", [$userAge]);
            }
        }
        $candidates = $query->limit(500)->get();

        $matches = collect();

        foreach ($candidates as $candidate) {
            /** @var User $candidate */
            
            // If showing all, we skip mutual preference checks and intensity filters
            if ($showAll || $this->checkMutualPreference($user, $candidate)) {
                $score = $this->calculateScore($user, $candidate, $includeHoroscope);
                
                if ($showAll || $score >= $minIntensity) {
                    $candidate->match_score = $score;
                    
                    if ($includeHoroscope) {
                        $candidate->horoscope_match = $this->getHoroscopeMatch($user, $candidate);
                    }

                    $matches->push($candidate);
                }
            }
        }

        return $matches->sortByDesc('match_score');
    }

    /**
     * Calculate compatibility score.
     * @param bool $includeHoroscope Whether to include horoscope match score (extra 15%)
     */
    public function calculateScore(User $user, User $candidate, $includeHoroscope = false)
    {
        $score = 0;
        $pref = $user->partnerPreference;

        // --- A. MUST MATCH (50 points) ---
        
        // Age Match
        if ($candidate->dob) {
            $age = Carbon::parse($candidate->dob)->age;
            if ($age >= ($pref->age_from ?? 20) && $age <= ($pref->age_to ?? 50)) {
                $score += 10;
            }
        }

        // Religion Match
        if ($candidate->religion === ($pref->religion ?? $user->religion)) {
            $score += 10;
        }

        // Marital Status
        if ($candidate->marital_status === ($pref->marital_status ?? $user->marital_status)) {
            $score += 10;
        }

        // Caste Match
        if ($candidate->caste === ($pref->caste ?? $user->caste)) {
            $score += 10;
        }
        
        // Gender is already filtered, giving points for it to make up 50
        $score += 10; 

        // --- B. IMPORTANT MATCH (30 points) ---
        
        // Education
        if ($candidate->educationJob && $candidate->educationJob->education === ($pref->education ?? null)) {
            $score += 10;
        }

        // Location
        if ($candidate->address && ($candidate->address->district === ($pref->location ?? null) || $candidate->address->state === ($pref->location ?? null))) {
            $score += 10;
        }

        // Mother Tongue
        if ($candidate->mother_tongue === $user->mother_tongue) {
            $score += 10;
        }

        // --- C. OPTIONAL MATCH (20 points) ---

        // Interests (Common Interests Count)
        if ($user->interests && $candidate->interests) {
            $commonInterests = $user->interests->pluck('id')->intersect($candidate->interests->pluck('id'));
            if ($commonInterests->count() > 0) {
                $score += 10;
            }
        }

        // Eating Habits
        if ($user->userDetail && $candidate->userDetail && $user->userDetail->eating_habit === $candidate->userDetail->eating_habit) {
            $score += 5;
        }

        // --- D. CULTURAL ALIGNMENT (Bonus 10 points) ---
        
        // Traditional Age Preference: Male older than Female
        if ($user->dob && $candidate->dob) {
            $userAge = Carbon::parse($user->dob)->age;
            $candidateAge = Carbon::parse($candidate->dob)->age;
            
            if ($user->gender === 'Male' && $candidate->gender === 'Female') {
                if ($candidateAge < $userAge) {
                    $score += 10;
                }
            } elseif ($user->gender === 'Female' && $candidate->gender === 'Male') {
                if ($candidateAge > $userAge) {
                    $score += 10;
                }
            }
        }

        // --- E. HOROSCOPE OPTION (Extra 15 points) ---
        if ($includeHoroscope) {
            $horoScore = $this->calculateHoroscopeScore($user, $candidate);
            $score += $horoScore;
        }

        return min(100, $score); // Cap at 100%
    }

    /**
     * Calculate Horoscope Score based on horomacth_tb (Extra 15 points)
     */
    public function calculateHoroscopeScore(User $user, User $candidate)
    {
        $match = $this->getHoroscopeMatch($user, $candidate);
        
        if ($match && strtolower($match->Status) === 'ok') {
            // Give partial points based on no_matches or full 15 points for 'Ok'
            // The user said "extra 15%", so we'll add 15 points if Status is 'Ok'
            return 15;
        }
        
        return 0;
    }

    /**
     * Get horoscope match details from the database table horomacth_tb.
     */
    public function getHoroscopeMatch(User $user, User $candidate)
    {
        $uHoro = $user->horoscopeDetail;
        $cHoro = $candidate->horoscopeDetail;

        if (!$uHoro || !$cHoro || !$uHoro->rasi || !$uHoro->star || !$cHoro->rasi || !$cHoro->star) {
            // Fallback to Profile model (registers table)
            $uProfile = \App\Models\Profile::where('varan_id', $user->user_ID)->orWhere('email_id', $user->email)->first();
            $cProfile = \App\Models\Profile::where('varan_id', $candidate->user_ID)->orWhere('email_id', $candidate->email)->first();
            
            if ($uProfile && $cProfile && $uProfile->rasi && $uProfile->stars && $cProfile->rasi && $cProfile->stars) {
                $uHoro = (object)['rasi' => $uProfile->rasi, 'star' => $uProfile->stars];
                $cHoro = (object)['rasi' => $cProfile->rasi, 'star' => $cProfile->stars];
            } else {
                return null;
            }
        }

        $male = ($user->gender === 'Male') ? $uHoro : $cHoro;
        $female = ($user->gender === 'Female') ? $uHoro : $cHoro;

        $mRasi = $this->resolveToId($male->rasi, 'rasi_tb');
        $mStar = $this->resolveToId($male->star, 'star');
        $fRasi = $this->resolveToId($female->rasi, 'rasi_tb');
        $fStar = $this->resolveToId($female->star, 'star');

        if (!$mRasi || !$mStar || !$fRasi || !$fStar) return null;

        return \Illuminate\Support\Facades\DB::table('horomacth_tb')
            ->where('male_rasi', $mRasi)
            ->where('male_star', $mStar)
            ->where('female_rasi', $fRasi)
            ->where('female_star', $fStar)
            ->first();
    }

    /**
     * Resolve string name to ID from a given table.
     */
    protected function resolveToId($value, $table)
    {
        if (is_numeric($value)) return $value;
        if (empty($value)) return null;

        $slug = strtolower(trim($value));
        // Remove common suffixes and handle 'sh' vs 's' variations
        $normalized = str_replace(['ham', 'bam', 'mam', 'sh', 'am'], ['', '', '', 's', ''], $slug);

        $rows = \Illuminate\Support\Facades\DB::table($table)->get();
        foreach ($rows as $row) {
            $rowSlug = strtolower(trim($row->name));
            $rowNormalized = str_replace(['ham', 'bam', 'mam', 'sh', 'am'], ['', '', '', 's', ''], $rowSlug);
            
            if ($slug === $rowSlug || $normalized === $rowNormalized || str_contains($rowSlug, $slug) || str_contains($slug, $rowSlug)) {
                return $row->id;
            }
        }
        
        return null;
    }

    /**
     * Ensure both users match each other's basic preferences.
     */
    public function checkMutualPreference(User $user, User $candidate)
    {
        $userPref = $user->partnerPreference;
        $candidatePref = $candidate->partnerPreference;

        if (!$userPref || !$candidatePref) return true; // Default to true if preferences aren't set

        // Check if candidate matches User's preference
        $userAgeMatch = true;
        if ($candidate->dob) {
            $age = Carbon::parse($candidate->dob)->age;
            $userAgeMatch = ($age >= ($userPref->age_from ?? 20) && $age <= ($userPref->age_to ?? 50));
        }

        // Check if user matches Candidate's preference
        $candidateAgeMatch = true;
        if ($user->dob) {
            $uage = Carbon::parse($user->dob)->age;
            $candidateAgeMatch = ($uage >= ($candidatePref->age_from ?? 20) && $uage <= ($candidatePref->age_to ?? 50));
        }

        // Check religion (most critical)
        $religionMatch = true;
        if ($userPref->religion && $candidate->religion) {
            $religionMatch = ($candidate->religion === $userPref->religion);
        }

        return $userAgeMatch && $candidateAgeMatch && $religionMatch;
    }
}
