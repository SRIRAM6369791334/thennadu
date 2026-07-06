@extends('layout.default')

@section('content')
<div class="profile-main-container py-5" style="background: #f8f9fa;">
    <div class="container">
        <!-- 🔷 1. Profile Header Section -->
        <div class="profile-header-card wow fadeInUp bg-white rounded-4 shadow-sm overflow-hidden border-0 mb-4">
            <div class="row g-0">
                <div class="col-lg-4">
                    <div class="profile-header-img-wrap position-relative h-100">
                        @php
                            $galleryImages = $images->where('image_status', '!=', 'Selfie');
                            $mainImage = $galleryImages->where('image_status', 'Main')->first();
                            
                            if (isset($targetModernUser) && $targetModernUser) {
                                $imagePath = $targetModernUser->profileImage();
                            } elseif ($mainImage) {
                                $imagePath = asset('uploads/' . $mainImage->image_name);
                            } else {
                                $fallback = (strtolower($profile->Gender) == 'female' || $profile->Gender == 2) ? 'women1.png' : 'men.png';
                                $imagePath = asset('assets/images/matri/' . $fallback);
                            }
                        @endphp
                        <img src="{{ $imagePath }}" class="w-100 h-100 object-fit-cover" alt="Profile Image" style="min-height: 350px;">
                        <div class="verified-badge position-absolute top-0 start-0 m-3 bg-success text-white px-3 py-1 rounded-pill small fw-bold shadow-sm">
                            <i class="fas fa-check-circle me-1"></i> Verified
                        </div>
                        <div class="photo-count position-absolute bottom-0 end-0 m-3 bg-dark bg-opacity-50 text-white px-3 py-1 rounded-pill small">
                            <i class="fas fa-camera me-1"></i> {{ $galleryImages->count() }} Photos
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="profile-info-block p-4 p-md-5">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h1 class="profile-name-lg serif-font text-dark mb-1">{{ $profile->Name }}</h1>
                                <p class="text-muted mb-0">{{ $profile->varan_id }} | Registered by {{ $profile->created_for }}</p>
                            </div>
                            <!-- <div class="text-end d-none d-md-block">
                                <span class="badge bg-maroon rounded-pill px-3 py-2 fw-normal">Online - 10m ago</span>
                            </div> -->
                        </div>
                        
                        <p class="profile-meta-line fs-5 fw-500 text-maroon mb-4">{{ $profile->age }} Yrs | {{ $profile->height }} | {{ $profile->district }}, {{ $profile->state }}</p>
                        
                        <div class="row g-3 mb-5">
                            <div class="col-6 col-md-3">
                                <label class="d-block text-muted small text-uppercase ls-1 fw-bold mb-1">Religion</label>
                                <span class="fw-600">{{ $profile->religion_name }}</span>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="d-block text-muted small text-uppercase ls-1 fw-bold mb-1">Caste</label>
                                <span class="fw-600">{{ $profile->caste_name }}</span>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="d-block text-muted small text-uppercase ls-1 fw-bold mb-1">Education</label>
                                <span class="fw-600">{{ $profile->education_name }}</span>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="d-block text-muted small text-uppercase ls-1 fw-bold mb-1">Profession</label>
                                <span class="fw-600">{{ $profile->job_detail }}</span>
                            </div>
                        </div>

                        <div class="profile-action-buttons d-flex flex-wrap gap-2">
                            @if(!$user || $user->id != $profile->id)
                                @if(!$interest)
                                    <form action="{{ route('interest.send', ['id' => $targetModernUser->id ?? $profile->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-maroon px-4 py-2 rounded-pill shadow-sm"><i class="fas fa-heart me-2"></i> Send Interest</button>
                                    </form>
                                @elseif($interest->status == 0)
                                    <form action="{{ route('interest.cancel', ['id' => $targetModernUser->id ?? $profile->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning px-4 py-2 rounded-pill shadow-sm text-dark"><i class="fas fa-clock me-2"></i> Requested</button>
                                    </form>
                                @elseif($interest->status == 1)
                                    <button class="btn btn-success px-4 py-2 rounded-pill shadow-sm disabled"><i class="fas fa-check-circle me-2"></i> Connected</button>
                                @elseif($interest->status == 2)
                                    <button class="btn btn-danger px-4 py-2 rounded-pill shadow-sm disabled"><i class="fas fa-times-circle me-2"></i> Declined</button>
                                @endif

                                @if($interest && $interest->status == 1)
                                    <form action="{{ route('chat.start', $targetModernUser->id ?? $profile->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-gold px-4 py-2 rounded-pill text-white border-0"><i class="fas fa-comment-dots me-2"></i> Chat Now</button>
                                    </form>
                                @else
                                    <button class="btn btn-outline-secondary px-4 py-2 rounded-pill disabled" title="Send interest & connect to chat"><i class="fas fa-lock me-2"></i> Chat Locked</button>
                                @endif
                                
                                <!--<form action="#" method="POST">-->
                                <!--    <button class="btn btn-light px-4 py-2 rounded-pill"><i class="fas fa-star me-2 text-gold"></i> Shortlist</button>-->
                                <!--</form>-->
                            @else
                                <a href="{{ route('dashboard') }}" class="btn btn-maroon px-4 py-2 rounded-pill shadow-sm"><i class="fas fa-edit me-2"></i> Edit My Profile</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <!-- 🔷 2. About Me Section -->
                <div class="info-card bg-white rounded-4 shadow-sm p-4 mb-4">
                    <h4 class="serif-font mb-4 border-bottom pb-3"><i class="fas fa-user-tag me-2 text-maroon"></i> About Me</h4>
                    <p class="text-muted leading-relaxed">{{ $profile->about_myself ?? 'No description provided.' }}</p>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <!-- 🔷 3. Basic Details Section -->
                        <div class="info-card bg-white rounded-4 shadow-sm p-4 h-100">
                            <h4 class="serif-font mb-4 border-bottom pb-3">Basic Information</h4>
                            <div class="info-list">
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted small">Marital Status</span>
                                    <span class="fw-600 small">{{ $profile->marital_status_name }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted small">Mother Tongue</span>
                                    <span class="fw-600 small">{{ $profile->Monther_tongue }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted small">Caste / Sub-Caste</span>
                                    <span class="fw-600 small">{{ $profile->caste_name }} / {{ $profile->sub_caste_name }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted small">Star / Rasi</span>
                                    <span class="fw-600 small">{{ $profile->star_name ?? 'Not specified' }} / {{ $profile->rasi_name ?? 'Not specified' }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted small">Physical Status</span>
                                    <span class="fw-600 small">{{ $profile->physical_status_name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- 🔷 4. Education & Career Section -->
                        <div class="info-card bg-white rounded-4 shadow-sm p-4 h-100">
                            <h4 class="serif-font mb-4 border-bottom pb-3">Education & Career</h4>
                            <div class="info-list">
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted small">Qualification</span>
                                    <span class="fw-600 small">{{ $profile->education_name }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted small">College</span>
                                    <span class="fw-600 small">{{ $profile->eduction_detail }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted small">Occupation</span>
                                    <span class="fw-600 small">{{ $profile->job_detail }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted small">Annual Income</span>
                                    <span class="fw-600 small text-maroon">{{ $profile->income_name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 🔷 5. Family Details Section -->
                <div class="info-card bg-white rounded-4 shadow-sm p-4 mb-4">
                    <h4 class="serif-font mb-4 border-bottom pb-3">Family Information</h4>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted small">Father's Occupation</span>
                                <span class="fw-600 small">{{ $profile->father_occuption }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted small">Mother's Occupation</span>
                                <span class="fw-600 small">{{ $profile->mother_occuption }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted small">Siblings</span>
                                <span class="fw-600 small">{{ $profile->total_sibblings }} (Brothers: {{ $profile->elder_brother + $profile->younger_brother }}, Sisters: {{ $profile->elder_sister + $profile->younger_sister }})</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted small">Native City</span>
                                <span class="fw-600 small">{{ $profile->district }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 🔷 6. Contact Details (Locking Logic) -->
                <div class="info-card bg-white rounded-4 shadow-sm p-4 mb-4">
                    <h4 class="serif-font mb-4 border-bottom pb-3"><i class="fas fa-address-book me-2 text-maroon"></i> Contact Information</h4>
                    
                    @if($isContactUnlocked || ($user && $user->id == $profile->id))
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle bg-light p-3">
                                        <i class="fas fa-phone text-maroon fs-5"></i>
                                    </div>
                                    <div>
                                        <span class="d-block text-muted small">Phone Number</span>
                                        <h5 class="mb-0 fw-bold">{{ $profile->mblno ?? $profile->phone ?? 'Not provided' }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle bg-light p-3">
                                        <i class="fas fa-envelope text-maroon fs-5"></i>
                                    </div>
                                    <div class="flex-grow-1" style="min-width: 0;">
                                        <span class="d-block text-muted small">Email Address</span>
                                        <h5 class="mb-0 fw-bold text-lowercase" style="word-break: break-word; overflow-wrap: anywhere;">{{ strtolower($profile->email_id) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="position-relative p-4 rounded-4 bg-light text-center">
                            <div class="blur-overlay py-3" style="filter: blur(5px);">
                                <h5 class="mb-1 text-dark">+91 98XXX XXXXX</h5>
                                <p class="mb-0 small text-muted">user.example@email.com</p>
                            </div>
                            <div class="lock-indicator position-absolute top-50 start-50 translate-middle text-center w-100 px-3">
                                @if($activePackage && ($activePackage->no_of_phno > $activePackage->no_of_phno_viewed))
                                    <form action="{{ route('profile.unlock', $profile->id) }}" method="POST" id="unlockContactForm">
                                        @csrf
                                        <button type="button" id="unlockContactBtn" class="btn btn-maroon px-4 rounded-pill shadow mb-2">
                                            <i class="fas fa-unlock me-2"></i> Unlock Contact ({{ $activePackage->no_of_phno - $activePackage->no_of_phno_viewed }} Left)
                                        </button>
                                    </form>
                                @else
                                    <div class="bg-maroon text-white d-inline-block rounded-pill p-3 mb-2 shadow">
                                        <i class="fas fa-lock fs-5"></i>
                                    </div>
                                @endif
                                <h6 class="fw-bold mb-1">Contact Details Locked</h6>
                                <p class="small text-muted mb-0">
                                    @if($activePackage && ($activePackage->no_of_phno <= $activePackage->no_of_phno_viewed))
                                        You have reached your contact view limit. Please <a href="{{ route('plans.index') }}" class="text-maroon fw-bold">Upgrade/Renew</a>.
                                    @elseif(!$activePackage)
                                        <a href="{{ route('plans.index') }}" class="text-maroon fw-bold">Upgrade to Premium</a> or send interest to unlock.
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-4">
                @if($horoscopeMatch)
                    <!-- 🔷 6.5 Horoscope Compatibility Section -->
                    <div class="horoscope-compatibility-card rounded-4 shadow-sm p-4 mb-4 position-relative overflow-hidden" 
                         style="background: #fff; border: 1px solid #e2e8f0; border-top: 5px solid #D4AF37;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="serif-font mb-0 text-dark"><i class="fas fa-om me-2 text-gold"></i> Horoscope Match</h4>
                            <span class="badge bg-gold-gradient text-white rounded-pill px-3 py-2 small fw-normal">Porutham Check</span>
                        </div>

                        <div class="match-summary-wrapper p-3 rounded-4 mb-4" style="background: #fffaf0; border: 1px dashed #D4AF37;">
                            <div class="row align-items-center g-0">
                                <div class="col-4 text-center border-end border-gold border-opacity-25">
                                    <div class="porutham-score-display">
                                        <h2 class="display-5 fw-bold text-gold mb-0">{{ $horoscopeMatch->no_matches }}</h2>
                                        <p class="xx-small text-muted text-uppercase fw-bold ls-1 mb-0">Total Score</p>
                                    </div>
                                </div>
                                <div class="col-8">
                                    @php 
                                        $isOk = strtolower($horoscopeMatch->Status) === 'ok';
                                        $statusTamil = $isOk ? 'உத்தமம்' : 'அதமம்';
                                        $statusDesc = $isOk ? 'சிறந்த பொருத்தம்' : 'பொருத்தம் இல்லை';
                                        $icon = $isOk ? 'fa-check-double' : 'fa-times-circle';
                                        $statusColor = $isOk ? '#28a745' : '#dc3545';
                                    @endphp
                                    <div class="ps-3 text-start">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span class="status-indicator-dot" style="width: 10px; height: 10px; border-radius: 50%; background: {{ $statusColor }}; box-shadow: 0 0 8px {{ $statusColor }}80;"></span>
                                            <h5 class="fw-bold mb-0 text-dark" style="font-size: 1.1rem;">{{ $statusTamil }}</h5>
                                        </div>
                                        <p class="mb-0 text-muted" style="font-size: 0.8rem; line-height: 1.2;">{{ $statusDesc }}</p>
                                        <p class="mt-2 mb-0 xx-small text-muted fw-500">
                                            {{ $horoscopeMatch->no_matches }} out of 12 poruthams match favorably.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="compatibility-level-box">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="xx-small fw-bold text-muted text-uppercase ls-1">Matching Quality</span>
                                <span class="small fw-bold {{ $isOk ? 'text-success' : 'text-danger' }}">
                                    @php $matchPercent = round(($horoscopeMatch->no_matches / 12) * 100); @endphp
                                    {{ $matchPercent }}%
                                </span>
                            </div>
                            <div class="progress rounded-pill mb-3" style="height: 10px; background: #f0f0f0; border: 1px solid #eee;">
                                <div class="progress-bar {{ $isOk ? 'bg-success-gradient' : 'bg-danger-gradient' }} progress-bar-striped progress-bar-animated" 
                                     role="progressbar" 
                                     style="width: {{ $matchPercent }}%"></div>
                            </div>
                            <div class="p-3 rounded-4 {{ $isOk ? 'bg-success-soft' : 'bg-danger-soft' }} border-0">
                                <p class="mb-0 small fw-bold {{ $isOk ? 'text-success' : 'text-danger' }}" style="line-height: 1.4;">
                                    <i class="fas {{ $icon }} me-2"></i>
                                    {{ $isOk ? 'திருமணத்திற்கு ஏற்ற உத்தமமான பொருத்தம் உள்ளது.' : 'அதமம் - ஜாதக பொருத்தம் மிக குறைவாக உள்ளது.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- 🔷 7. Partner Preference Section -->
                <div class="info-card bg-maroon text-white rounded-4 shadow-sm p-4 mb-4">
                    <h4 class="serif-font mb-4 border-bottom border-white  text-white border-opacity-25 pb-3">Partner Preferences</h4>
                    <div class="info-list-white">
                        <div class="mb-3">
                            <label class="d-block small text-white-50">Age Range</label>
                            <span class="fw-bold">{{ ($partnerExpectations->age_from ?? '21') . ' - ' . ($partnerExpectations->age_to ?? '30') }} Years</span>
                        </div>
                        <div class="mb-3">
                            <label class="d-block small text-white-50">Religion / Caste</label>
                            <span class="fw-bold">{{ $partnerExpectations->religion_name ?? 'Any' }} / {{ $partnerExpectations->caste_name ?? 'Any' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="d-block small text-white-50">Education</label>
                            <span class="fw-bold">{{ $partnerExpectations->education_name ?? 'Any Degree' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="d-block small text-white-50">Annual Income</label>
                            <span class="fw-bold">{{ $partnerExpectations->income_name ?? 'Any' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="d-block small text-white-50">Employment</label>
                            <span class="fw-bold">{{ $partnerExpectations->job_name ?? 'Any' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="d-block small text-white-50">Eating Habit</label>
                            <span class="fw-bold">{{ $partnerExpectations->preference_eating ?? 'Any' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="d-block small text-white-50">Complexion / Body Type</label>
                            <span class="fw-bold">{{ $partnerExpectations->complexion_name ?? 'Any' }} / {{ $partnerExpectations->body_name ?? 'Any' }}</span>
                        </div>
                        <div>
                            <label class="d-block small text-white-50">Preferred Location</label>
                            <span class="fw-bold">{{ $partnerExpectations->preference_location ?? 'Anywhere' }}</span>
                        </div>
                    </div>
                </div>

                <!-- 🔷 8. Photo Gallery Section -->
                <div class="info-card bg-white rounded-4 shadow-sm p-4 mb-4">
                    <h4 class="serif-font mb-4 border-bottom pb-3">Photo Gallery</h4>
                    <div class="row g-2">
                        @foreach($galleryImages as $img)
                        <div class="col-6">
                            <img src="{{ asset('uploads/' . $img->image_name) }}" class="w-100 rounded-3 shadow-xs object-fit-cover" style="height: 120px;">
                        </div>
                        @endforeach
                        @if($galleryImages->isEmpty())
                        <div class="col-12 py-3 text-center text-muted small">No gallery photos added.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .text-maroon { color: #900C3F !important; }
    .bg-maroon { background-color: #900C3F !important; }
    .btn-maroon { background: #900C3F; color: #fff; }
    .btn-maroon:hover { background: #7a0a35; color: #fff; }
    .btn-outline-maroon { color: #900C3F; border: 1.5px solid #900C3F; }
    .btn-outline-maroon:hover { background: #900C3F; color: #fff; }
    .ls-1 { letter-spacing: 1px; }
    .fw-500 { font-weight: 500; }
    .fw-600 { font-weight: 600; }
    .xx-small { font-size: 0.7rem; }
    .object-fit-cover { object-fit: cover; }
    .info-list-white label { opacity: 0.7; }
    
    /* Premium Gradients & Utils */
    .bg-gold-gradient { background: linear-gradient(135deg, #D4AF37 0%, #B8860B 100%); }
    .bg-success-gradient { background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%); }
    .bg-danger-gradient { background: linear-gradient(135deg, #dc3545 0%, #bd2130 100%); }
    .bg-success-soft { background-color: rgba(40, 167, 69, 0.1); }
    .bg-danger-soft { background-color: rgba(220, 53, 69, 0.1); }
    .text-gold { color: #D4AF37 !important; }
    .text-maroon { color: #900C3F !important; }
</style>

<!-- SweetAlert2 for Unlock Contact -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const unlockBtn = document.getElementById('unlockContactBtn');
        if (unlockBtn) {
            unlockBtn.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Unlock Contact?',
                    text: 'This will use 1 contact view from your balance. Do you want to proceed?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#900C3F',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Yes, Unlock it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form
                        const form = document.getElementById('unlockContactForm');
                        if (form) {
                            form.submit();
                        }
                    }
                });
            });
        }
    });
</script>
@endsection
