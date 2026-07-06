<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'dob',
        'religion',
        'caste',
        'marital_status',
        'mother_tongue',
        'phone',
        'district',
        'mblno',
        'user_ID',
        'role',
        'broker_approval_status',
        'user_payment_percentage',
        'target_value',
        'earned_amt',
        'payment_req_data',
        'earned_amt_status',
        'amt_paid_data',
    ];

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class);
    }

    /**
     * Get the user's profile image dynamically.
     */
    public function profileImage()
    {
        // 1. Try UserDetail model (often populated by Seeder/Reg)
        if ($this->userDetail && $this->userDetail->photo_path) {
            $path = $this->userDetail->photo_path;
            if (str_starts_with($path, 'assets/') || str_starts_with($path, 'http')) {
                return asset($path);
            }
            return asset('uploads/' . $path);
        }

        // 2. Try the separate images table (populated by dashboard)
        $imageData = \Illuminate\Support\Facades\DB::table('images')
            ->where('varanid', $this->user_ID)
            ->where('image_status', 'Main')
            ->first();

        if ($imageData && isset($imageData->image_name)) {
            return asset('uploads/' . $imageData->image_name);
        }

        // 3. Gender-based fallbacks
        if ($this->gender === 'Female') {
            return asset('assets/images/matri/women1.png');
        }
        return asset('assets/images/matri/men.png');
    }

    public function educationJob()
    {
        return $this->hasOne(EducationJob::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function familyDetail()
    {
        return $this->hasOne(FamilyDetail::class);
    }

    public function horoscopeDetail()
    {
        return $this->hasOne(HoroscopeDetail::class);
    }

    public function interests()
    {
        return $this->belongsToMany(MasterInterest::class, 'user_interests', 'user_id', 'master_interest_id');
    }

    public function partnerPreference()
    {
        return $this->hasOne(PartnerPreference::class);
    }

    public function sentInterests()
    {
        return $this->hasMany(InterestRequest::class, 'sender_id');
    }

    public function receivedInterests()
    {
        return $this->hasMany(InterestRequest::class, 'receiver_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getReligionNameAttribute()
    {
        return \Illuminate\Support\Facades\DB::table('regli_tb')->where('id', $this->religion)->value('religion_name') ?? $this->religion;
    }

    public function getCasteNameAttribute()
    {
        return \Illuminate\Support\Facades\DB::table('castes')->where('id', $this->caste)->value('Caste_name') ?? $this->caste;
    }

    public function getEducationNameAttribute()
    {
        if ($this->educationJob && $this->educationJob->education) {
            return \Illuminate\Support\Facades\DB::table('eductiondetails_tb')->where('id', $this->educationJob->education)->value('name') ?? $this->educationJob->education;
        }
        return 'Degree Holder';
    }

    public function getDistrictNameAttribute()
    {
        if ($this->address && $this->address->district) {
            return \Illuminate\Support\Facades\DB::table('cities')->where('city_id', $this->address->district)->value('city_name') ?? $this->address->district;
        }
        return $this->address->city ?? 'Not Set';
    }

    public function getStateNameAttribute()
    {
        if ($this->address && $this->address->state) {
            return \Illuminate\Support\Facades\DB::table('states')->where('id', $this->address->state)->value('state_name') ?? $this->address->state;
        }
        return 'TN';
    }
}
