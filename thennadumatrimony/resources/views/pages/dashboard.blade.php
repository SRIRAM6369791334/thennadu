@extends('layout.default')

@section('content')
<div class="dashboard-wrapper py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-md-4 col-lg-3">
                @include('layout.dashboard_sidebar')

                <!-- 🔷 6. ACCOUNT STATUS & TRUST SCORE -->
                <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                    <div class="card-header bg-white border-0 py-3 px-4">
                        <h5 class="serif-font mb-0">Trust Score</h5>
                    </div>
                    <div class="card-body px-4 pb-4 pt-0">
                        <div class="trust-score-circle mx-auto mb-3" data-score="{{ $trustScore }}">
                            <svg viewBox="0 0 36 36" class="circular-chart maroon">
                                <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="circle" stroke-dasharray="{{ $trustScore }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <text x="18" y="20.35" class="percentage serif-font">{{ $trustScore }}%</text>
                            </svg>
                        </div>
                        <div class="status-list mt-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="small text-muted"><i class="fas fa-envelope-open-text me-2 {{ !empty($profile->email_id) ? 'text-success' : 'text-secondary' }}"></i> Email Verified</span>
                                @if(!empty($profile->email_id))
                                    <i class="fas fa-check-circle text-success small"></i>
                                @else
                                    <i class="fas fa-exclamation-circle text-warning small" title="Not Verified"></i>
                                @endif
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="small text-muted"><i class="fas fa-mobile-alt me-2 {{ !empty($profile->mobile_no) ? 'text-success' : 'text-secondary' }}"></i> Mobile Verified</span>
                                @if(!empty($profile->mobile_no))
                                    <i class="fas fa-check-circle text-success small"></i>
                                @else
                                    <i class="fas fa-exclamation-circle text-warning small" title="Not Verified"></i>
                                @endif
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="small text-muted"><i class="fas fa-portrait me-2 {{ $profile->status == 1 ? 'text-success' : 'text-warning' }}"></i> Profile Status</span>
                                <span class="badge {{ $profile->status == 1 ? 'bg-success' : 'bg-warning' }} rounded-pill" style="font-size: 0.6rem;">{{ $profile->status == 1 ? 'Approved' : 'Pending' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Content -->
            <div class="col-lg-9">
                @if(session('success'))
                    <div id="swal-success" data-message="{{ session('success') }}" style="display:none;"></div>
                @endif
                @if(session('error'))
                    <div id="swal-error" data-message="{{ session('error') }}" style="display:none;"></div>
                @endif
                <!-- 🔷 1. PROFILE HEADER SECTION -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
                    <div class="card-body p-3 p-md-4">
                        <div class="row align-items-center">
                            <div class="col-md-auto text-center mb-4 mb-md-0">
                                <div class="position-relative d-none">
                                    @php
                                        $mainImage = $images->where('image_status', 'Main')->first();
                                        $hasSelfie = $images->where('image_status', 'Selfie')->count() > 0;
                                        $imagePath = $mainImage ? asset('uploads/' . $mainImage->image_name) : asset('assets/images/matri/user.png');
                                    @endphp
                                    <img src="{{ $imagePath }}" 
                                         alt="Profile" 
                                         class="rounded-circle border border-5 border-white shadow shadow-sm profile-img-dash"
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                     @if($hasSelfie)
                                        <div class="verified-badge-dash" title="Profile Verified"><i class="fas fa-check"></i></div>
                                     @endif
                                </div>
                            </div>
                            <div class="col-md ps-md-4 text-center text-md-start">
                                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-start gap-2 mb-2">
                                    <h2 class="serif-font mb-0 text-dark profile-name-dash">{{ $profile->Name }}</h2>
                                    @if($profile->status == 1)
                                        <span class="badge bg-success bg-opacity-10 text-success text-white border border-success border-opacity-25 px-3 py-2 rounded-pill fw-bold" style="font-size: 0.65rem;">
                                            <i class="fas fa-shield-alt me-1"></i> ADMIN APPROVED
                                        </span>
                                    @endif
                                </div>
                                <p class="text-muted mb-3 fw-500 profile-sub-dash">{{ $profile->job_detail }} | {{ $profile->age }} Yrs | {{ $profile->district_name ?? $profile->district }}</p>
                                
                                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-start gap-3 gap-md-4 mb-4 text-muted small">
                                    <span><i class="fas fa-id-badge text-maroon me-1"></i> ID: <strong class="text-dark">{{ $profile->varan_id }}</strong></span>
                                    <span><i class="fas fa-clock text-maroon me-1"></i> Active: <strong class="text-dark">Online Now</strong></span>
                                </div>

                                <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-2">
                                    <button class="btn btn-maroon px-4 rounded-pill shadow-sm flex-grow-1 flex-md-grow-0" data-bs-toggle="modal" data-bs-target="#editProfileModal"><i class="fas fa-user-edit me-2"></i> Edit Profile</button>
                                    <a href="{{ route('profile.view', $profile->varan_id) }}" class="btn btn-outline-maroon px-4 rounded-pill flex-grow-1 flex-md-grow-0"><i class="fas fa-eye me-2"></i> Preview</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 🔷 USER ACTIVITY SECTION -->
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-4 col-lg">
                        <div class="card border-0 shadow-sm rounded-4 p-3 text-center transition-up bg-white">
                            <div class="stat-icon bg-info text-white mb-2 mx-auto d-flex align-items-center justify-content-center">
                                <i class="fas fa-eye"></i>
                            </div>
                            <h4 class="mb-0 fw-bold">{{ $stats['views'] }}</h4>
                            <p class="text-muted xx-small text-uppercase ls-1 mb-0 mt-1">Profile Views</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg">
                        <div class="card border-0 shadow-sm rounded-4 p-3 text-center transition-up bg-white">
                            <div class="stat-icon bg-danger text-white mb-2 mx-auto d-flex align-items-center justify-content-center" style="background: #900C3F !important;">
                                <i class="fas fa-paper-plane"></i>
                            </div>
                            <h4 class="mb-0 fw-bold">{{ $stats['interests_sent'] }}</h4>
                            <p class="text-muted xx-small text-uppercase ls-1 mb-0 mt-1">Interests Sent</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg text-decoration-none" href="#">
                        <div class="card border-0 shadow-sm rounded-4 p-3 text-center transition-up bg-white membership-stat-card border-top border-5 {{ $activePackage ? 'border-success' : 'border-gold' }}">
                            <div class="stat-icon {{ $activePackage ? 'bg-success' : 'bg-warning' }} text-white mb-2 mx-auto d-flex align-items-center justify-content-center">
                                <i class="fas fa-crown"></i>
                            </div>
                            <h4 class="mb-0 fw-bold">{{ $activePackage ? strtoupper($activePackage->package_name) : 'FREE' }}</h4>
                            <p class="text-muted xx-small text-uppercase ls-1 mb-0 mt-1">{{ $activePackage ? 'Expires ' . \Carbon\Carbon::parse($activePackage->validity_date)->format('M d') : 'Current Plan' }}</p>
                            <a href="{{ route('plans.index') }}" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg">
                        <div class="card border-0 shadow-sm rounded-4 p-3 text-center transition-up bg-white">
                            <div class="stat-icon bg-success text-white mb-2 mx-auto d-flex align-items-center justify-content-center">
                                <i class="fas fa-comments"></i>
                            </div>
                            <h4 class="mb-0 fw-bold">{{ $stats['active_chats'] }}</h4>
                            <p class="text-muted xx-small text-uppercase ls-1 mb-0 mt-1">Active Chats</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg">
                        <div class="card border-0 shadow-sm rounded-4 p-3 text-center transition-up bg-white">
                            <div class="stat-icon bg-warning text-white mb-2 mx-auto d-flex align-items-center justify-content-center" style="background: #FFB30E !important;">
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="mb-0 fw-bold">{{ $stats['shortlisted'] }}</h4>
                            <p class="text-muted xx-small text-uppercase ls-1 mb-0 mt-1">Shortlisted</p>
                        </div>
                    </div>
                </div>

                @if(!$hasSelfie)
                <!-- 🔷 IDENTITY VERIFICATION PROMPT -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white overflow-hidden position-relative" style="border-left: 5px solid #10b981 !important;">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h5 class="serif-font mb-2">Verify Your <span class="text-success">Identity</span></h5>
                            <p class="text-muted small mb-3">Get a <span class="badge bg-success rounded-pill">Verified</span> badge on your profile by uploading a live selfie. Verified profiles get 10x more matches!</p>
                            <button class="btn btn-success px-4 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#selfieModal"><i class="fas fa-camera me-2"></i> Verify Now</button>
                        </div>
                        <div class="col-lg-4 text-center d-none d-lg-block">
                             <i class="fas fa-user-shield fa-4x text-success opacity-25"></i>
                        </div>
                    </div>
                </div>
                @endif

                @if(!$activePackage)
                <!-- 🔷 MEMBERSHIP UPGRADE SECTION -->
                <div id="plans-section" class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white overflow-hidden position-relative animate__animated animate__pulse animate__infinite" style="animation-duration: 3s; border: 1px solid #900C3F22;">
                    <div class="position-absolute top-0 end-0 p-4 opacity-10">
                        <i class="fas fa-gem fa-6x text-maroon rotate-15"></i>
                    </div>
                    <div class="row align-items-center position-relative">
                        <div class="col-lg-8">
                            <h5 class="serif-font mb-2">Upgrade to <span class="text-maroon">Premium</span></h5>
                            <p class="text-muted small mb-3">Unlock all features including direct chat, verified contacts and advanced search.</p>
                            <a href="{{ route('plans.index') }}" class="btn btn-maroon px-5 rounded-pill shadow-sm">View All Plans <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                        <div class="col-lg-4 text-center mt-4 mt-lg-0">
                            <div class="bg-maroon-light p-3 rounded-4">
                                <ul class="list-unstyled text-start small mb-0">
                                    <li class="mb-2"><i class="fas fa-check text-maroon me-2"></i> View Contact Info</li>
                                    <li class="mb-2"><i class="fas fa-check text-maroon me-2"></i> Unlimited Chats</li>
                                    <li><i class="fas fa-check text-maroon me-2"></i> Priority Search</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <!-- 🔷 ACTIVE MEMBERSHIP DETAILS -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white overflow-hidden position-relative">
                    <div class="position-absolute top-0 end-0 p-4 opacity-10">
                        <!-- <i class="fas fa-certificate fa-6x text-success rotate-15"></i> -->
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="serif-font mb-2">Active Plan: <span class="text-success">{{ $activePackage->package_name }}</span></h5>
                            <p class="text-muted small mb-0">Experience premium benefits until <strong>{{ \Carbon\Carbon::parse($activePackage->validity_date)->format('d M, Y') }}</strong></p>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <a href="{{ route('plans.index') }}" class="btn btn-outline-success btn-sm rounded-pill px-4">Renew or Upgrade</a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- 🔷 PROFILE COMPLETION UI -->
                <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 mb-4 bg-white">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                        <h5 class="serif-font mb-2 mb-md-0">Profile Completion <span class="text-maroon">({{ $completion }}%)</span></h5>
                        <div class="progress rounded-pill flex-grow-1 mx-md-4 shadow-sm" style="height: 10px; background: #eaedf0;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $completion }}%; background: linear-gradient(to right, #900C3F, #C70039);"></div>
                        </div>
                    </div>
                    
                    <div class="row g-2 g-md-3">
                        <div class="col-6 col-md-3">
                            <div class="completion-card {{ !empty($profile->Name) ? 'completed' : '' }}">
                                <i class="fas fa-check-circle"></i>
                                <span>Basic Details</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="completion-card {{ !empty($profile->stars) ? 'completed' : '' }}">
                                <i class="fas fa-check-circle"></i>
                                <span>Horoscope</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="completion-card {{ !empty($profile->eduction) ? 'completed' : '' }}">
                                <i class="fas fa-check-circle"></i>
                                <span>Education</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="completion-card {{ $images->count() > 0 ? 'completed' : '' }}">
                                <i class="fas fa-check-circle"></i>
                                <span>Gallery</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-12">
                        <!-- 🔷 3. PROFILE DETAILS SECTIONS -->
                        <div class="info-card-premium mb-4 rounded-4 shadow-sm border-0 bg-white p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                                <h5 class="serif-font mb-0"><i class="fas fa-user-circle me-2 text-maroon"></i> Basic Information</h5>

                            </div>
                            <div class="row g-4 mb-3">
                                <div class="col-md-4">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Full Name</label>
                                    <span class="fw-600">{{ $profile->Name }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Age / DOB</label>
                                    <span class="fw-600">{{ $profile->age }} Yrs ({{ $profile->dob }})</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Religion / Caste</label>
                                    <span class="fw-600">{{ $profile->religion_name }} / {{ $profile->caste_name }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Marital Status</label>
                                    <span class="fw-600">{{ $profile->marital_status_name }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Mother Tongue</label>
                                    <span class="fw-600">{{ $profile->Monther_tongue }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Caste / Sub-Caste</label>
                                    <span class="fw-600">{{ $profile->caste_name }} / {{ $profile->sub_caste_name }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Native City</label>
                                    <span class="fw-600">{{ $profile->district_name ?? $profile->district }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Physical Status</label>
                                    <span class="fw-600 badge bg-info bg-opacity-10 text- whittext-info px-3">{{ $profile->physical_status_name }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="info-card-premium mb-4 rounded-4 shadow-sm border-0 bg-white p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                                <h5 class="serif-font mb-0"><i class="fas fa-star-of-david me-2 text-maroon"></i> Horoscope Details</h5>

                            </div>
                            <div class="row g-4 mb-3">
                                <div class="col-md-3">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Rasi</label>
                                    <span class="fw-600">{{ $profile->rasi_name ?? 'Not Set' }}</span>
                                </div>
                                <div class="col-md-3">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Star</label>
                                    <span class="fw-600">{{ $profile->star_name ?? 'Not Set' }}</span>
                                </div>
                                <div class="col-md-3">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Laknam</label>
                                    <span class="fw-600">{{ $profile->laknam_name ?? 'Not Set' }}</span>
                                </div>
                                <div class="col-md-3">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Birth Time</label>
                                    <span class="fw-600">{{ $profile->birth_time ?? 'Not Set' }}</span>
                                </div>
                            </div>
                            @if($horoscope)
                            <div class="mt-3 p-3 bg-light rounded-4 border border-dashed text-center d-md-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center mb-3 mb-md-0">
                                    @php
                                        $ext = pathinfo($horoscope->img_name, PATHINFO_EXTENSION);
                                        $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp']);
                                    @endphp
                                    <div class="horo-preview-icon bg-white p-2 rounded shadow-sm me-3">
                                        @if($isImage)
                                            <i class="fas fa-file-image text-success fa-2x"></i>
                                        @else
                                            <i class="fas fa-file-pdf text-danger fa-2x"></i>
                                        @endif
                                    </div>
                                    <div class="text-start">
                                        <span class="d-block fw-bold small">Horoscope File</span>
                                        <span class="text-muted xx-small text-uppercase">{{ $ext }} Document</span>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    @if($isImage)
                                        <button class="btn btn-sm btn-maroon rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#viewHoroModal">View Image</button>
                                    @endif
                                    <a href="{{ asset('uploads/' . $horoscope->img_name) }}" target="_blank" class="btn btn-sm btn-outline-maroon rounded-pill px-3">Download</a>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="info-card-premium mb-4 rounded-4 shadow-sm border-0 bg-white p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                                <h5 class="serif-font mb-0"><i class="fas fa-graduation-cap me-2 text-maroon"></i> Education & Career</h5>

                            </div>
                            <div class="row g-4 mb-3">
                                <div class="col-md-4">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Education</label>
                                    <span class="fw-600">{{ $profile->education_name }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Occupation</label>
                                    <span class="fw-600">{{ $profile->job_detail }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Annual Income</label>
                                    <span class="fw-600 text-maroon fw-bold">{{ $profile->income_name }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- 🔷 PARTNER PREFERENCES SECTION -->
                        <div class="info-card-premium mb-4 rounded-4 shadow-sm border-0 bg-white p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                                <h5 class="serif-font mb-0"><i class="fas fa-heart me-2 text-maroon"></i> Partner Preferences</h5>

                            </div>
                            <div class="row g-4 mb-3">
                                <div class="col-md-3 col-6">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Age Range</label>
                                    <span class="fw-600">{{ ($partnerExpectations->age_from ?? '21') . ' - ' . ($partnerExpectations->age_to ?? '30') }} Yrs</span>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Religion</label>
                                    <span class="fw-600">{{ $partnerExpectations->religion_name ?? 'Any' }}</span>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Education</label>
                                    <span class="fw-600">{{ $partnerExpectations->education_name ?? 'Any Degree' }}</span>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Annual Income</label>
                                    <span class="fw-600">{{ $partnerExpectations->income_name ?? 'Any' }}</span>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Employment</label>
                                    <span class="fw-600">{{ $partnerExpectations->job_name ?? 'Any' }}</span>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Eating Habit</label>
                                    <span class="fw-600">{{ $partnerExpectations->preference_eating ?? 'Any' }}</span>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Complexion</label>
                                    <span class="fw-600">{{ $partnerExpectations->complexion_name ?? 'Any' }}</span>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Body Type</label>
                                    <span class="fw-600">{{ $partnerExpectations->body_name ?? 'Any' }}</span>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="d-block text-muted small fw-bold text-uppercase ls-1 mb-1">Location</label>
                                    <span class="fw-600">{{ $partnerExpectations->preference_location ?? 'Anywhere' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- 🔷 PHOTO GALLERY SECTION -->
                        <div class="info-card-premium mb-4 rounded-4 shadow-sm border-0 bg-white p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                                <h5 class="serif-font mb-0"><i class="fas fa-images me-2 text-maroon"></i> Managed Photos</h5>

                            </div>
                            <div class="row g-3">
                                @forelse($images as $img)
                                <div class="col-md-3 col-6">
                                    <div class="gallery-item-premium shadow-sm">
                                        <img src="{{ asset('uploads/' . $img->image_name) }}" class="img-fluid rounded-3 w-100" style="height: 150px; object-fit: cover;">
                                        <div class="img-badge">{{ $img->image_status }}</div>
                                        <div class="img-hover-overlay">
                                            <div class="d-flex flex-column gap-2 p-3 w-100">
                                                @if($img->image_status != 'Main')
                                                <form action="{{ route('dashboard.photo.main', $img->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-light btn-sm w-100 rounded-pill"><i class="fas fa-star me-1 text-warning"></i> Set Main</button>
                                                </form>
                                                @endif
                                                <form action="{{ route('dashboard.photo.delete', $img->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this photo?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm w-100 rounded-pill"><i class="fas fa-trash me-1"></i> Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12 py-4 text-center">
                                    <i class="fas fa-image fa-3x text-light mb-2"></i>
                                    <p class="text-muted small">No gallery photos yet.</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<style>
    .dashboard-wrapper { min-height: 100vh; }
    .text-maroon { color: #900C3F !important; }
    .bg-maroon { background-color: #900C3F !important; }
    .border-maroon { border-color: #900C3F !important; }
    .btn-maroon { background: #900C3F; color: #fff; }
    .btn-maroon:hover { background: #7a0a35; color: #fff; }
    .btn-outline-maroon { color: #900C3F; border: 1.5px solid #900C3F; }
    .btn-outline-maroon:hover { background: #900C3F; color: #fff; }
    
    .verified-badge-dash {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #0d6efd;
        color: #fff;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid #fff;
        font-size: 0.7rem;
    }

    .ls-1 { letter-spacing: 1px; }
    .fw-500 { font-weight: 500; }
    .fw-600 { font-weight: 600; }
    .xx-small { font-size: 0.6rem; }
    
    .transition-up {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .transition-up:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    .completion-card {
        background: #fdf8f9;
        border: 1px dashed #eecad5;
        padding: 12px;
        border-radius: 12px;
        text-align: center;
        transition: all 0.3s ease;
    }
    .completion-card.completed {
        background: #e6f9f1;
        border: 1px solid #c3e6cb;
        color: #155724;
    }
    .completion-card i { font-size: 1.2rem; margin-bottom: 5px; display: block; color: #ccc; }
    .completion-card.completed i { color: #28a745; }
    .completion-card span { font-size: 0.65rem; font-weight: 600; }

    /* Profile Header Responsive */
    .profile-name-dash { font-size: 1.8rem; }
    .profile-sub-dash { font-size: 1rem; }
    @media (max-width: 767px) {
        .profile-img-dash { width: 120px !important; height: 120px !important; }
        .profile-name-dash { font-size: 1.5rem; }
        .profile-sub-dash { font-size: 0.9rem; }
    }

    /* Trust Score SVG */
    .circular-chart { display: block; margin: 10px auto; max-width: 100px; max-height: 100px; }
    @media (min-width: 992px) {
        .circular-chart { max-width: 80%; max-height: 250px; }
    }
    .circle-bg { fill: none; stroke: #eee; stroke-width: 2.8; }
    .circle { fill: none; stroke-width: 2.8; stroke-linecap: round; transition: stroke-dasharray 1s ease 0s; }
    .maroon .circle { stroke: #900C3F; }
    .percentage { fill: #333; font-size: 0.5em; text-anchor: middle; }

    .gallery-item-premium {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        cursor: pointer;
    }
    .gallery-item-premium .img-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(144, 12, 63, 0.85);
        color: #fff;
        font-size: 0.6rem;
        padding: 2px 8px;
        border-radius: 50px;
        font-weight: 700;
        text-transform: uppercase;
    }
    .img-hover-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: flex-end;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .gallery-item-premium:hover .img-hover-overlay { opacity: 1; }

    .membership-stat-card {
        border-top: 5px solid #D4AF37 !important;
        cursor: pointer;
    }
    .membership-stat-card:hover {
        background-color: #fffdf5 !important;
    }
    .plan-mini-card {
        transition: all 0.3s ease;
    }
    .plan-mini-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .bg-maroon-light { background-color: rgba(144, 12, 63, 0.05); }
    .rotate-15 { transform: rotate(15deg); }
    .border-gold { border-color: #D4AF37 !important; }
    .nav-tabs .nav-link { color: #555; border: none; transition: all 0.3s ease; }
    .nav-tabs .nav-link:hover { background: #f0f0f0; color: #900C3F; }
    .nav-tabs .nav-link.active { background: #fff !important; color: #900C3F !important; border-bottom: 3px solid #900C3F !important; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
</style>
    </div>
</div>

<!-- Unified Edit Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 rounded-4 shadow overflow-hidden">
            <div class="modal-header border-0 bg-maroon text-white p-4">
                <h5 class="modal-title serif-font">Update Your Profile & Preferences</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <ul class="nav nav-tabs nav-fill border-0 bg-light" id="editTabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active py-3 small fw-bold text-uppercase border-0 rounded-0" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personalContent" type="button" role="tab">Personal Info</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link py-3 small fw-bold text-uppercase border-0 rounded-0" id="partner-tab" data-bs-toggle="tab" data-bs-target="#partnerContent" type="button" role="tab">Partner Preferences</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link py-3 small fw-bold text-uppercase border-0 rounded-0" id="photo-tab" data-bs-toggle="tab" data-bs-target="#photoContent" type="button" role="tab">Gallery Upload</button>
                    </li>
                </ul>
                <div class="tab-content" id="editTabsContent">
                    <!-- Personal Info Tab -->
                    <div class="tab-pane fade show active p-4" id="personalContent" role="tabpanel">
                        <form action="{{ route('dashboard.profile.update') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Full Name</label>
                                    <input type="text" name="Name" class="form-control rounded-pill" value="{{ $profile->Name }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Date of Birth</label>
                                    <input type="date" name="dob" class="form-control rounded-pill" value="{{ $profile->dob }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Marital Status</label>
                                    <select name="marital_status" class="form-select rounded-pill">
                                        @foreach($marital_statuses as $ms)
                                        <option value="{{ $ms->id }}" {{ $profile->marital_status == $ms->id ? 'selected' : '' }}>{{ $ms->matrial_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Religion</label>
                                    <select name="Religion" id="edit_religion" class="form-select rounded-pill">
                                        @foreach($religions as $rel)
                                        <option value="{{ $rel->id }}" {{ $profile->Religion == $rel->id ? 'selected' : '' }}>{{ $rel->religion_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Caste</label>
                                    <select name="Caste" id="edit_caste" class="form-select rounded-pill">
                                        @foreach($castes as $caste)
                                        <option value="{{ $caste->id }}" {{ $profile->Caste == $caste->id ? 'selected' : '' }}>{{ $caste->Caste_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Sub-Caste</label>
                                    <select name="sub_caste" id="edit_subcaste" class="form-select rounded-pill">
                                        <option value="">Select Sub-Caste</option>
                                        @foreach($subcastes as $sc)
                                        <option value="{{ $sc->id }}" {{ $profile->sub_caste == $sc->id ? 'selected' : '' }}>{{ $sc->subcategory_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-dark small">Native City</label>
                                    <select name="district" class="form-select rounded-pill">
                                        @foreach($cities as $city)
                                            <option value="{{ $city->city_id }}" {{ $profile->district == $city->city_id ? 'selected' : '' }}>{{ $city->city_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-dark small">Physical Status</label>
                                    <select name="physical_status" class="form-select rounded-pill">
                                        <option value="1" {{ $profile->physical_status == 1 ? 'selected' : '' }}>Normal</option>
                                        <option value="2" {{ $profile->physical_status == 2 ? 'selected' : '' }}>Physically Challenged</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-4">
                                    <label class="form-label fw-bold text-dark small">About Me</label>
                                    <textarea name="about_myself" class="form-control rounded-4" rows="3">{{ $profile->about_myself }}</textarea>
                                </div>

                                <h6 class="serif-font text-maroon mb-3 border-bottom pb-2"><i class="fas fa-briefcase me-2"></i> Education & Career</h6>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-dark small">Education</label>
                                    <select name="eduction" class="form-select rounded-pill">
                                        @foreach($education_list as $edu)
                                            <option value="{{ $edu->id }}" {{ $profile->eduction == $edu->id ? 'selected' : '' }}>{{ $edu->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-dark small">Occupation</label>
                                    <select name="job_category" class="form-select rounded-pill">
                                        @foreach($job_categories as $job)
                                            <option value="{{ $job->id }}" {{ $profile->job_category == $job->id ? 'selected' : '' }}>{{ $job->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Annual Income</label>
                                    <select name="annual_income" class="form-select rounded-pill">
                                        <option value="">Select Income Range</option>
                                        @foreach($income_list as $inc)
                                        <option value="{{ $inc->id }}" {{ $profile->annual_income == $inc->id ? 'selected' : '' }}>{{ $inc->salary }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mt-4 border-top pt-3">
                                    <h6 class="serif-font mb-3">Horoscope Details</h6>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold">Rasi</label>
                                    <select id="dash_rasi" name="rasi" class="form-select rounded-pill">
                                        <option value="">Select Rasi</option>
                                        @foreach($rasis as $rasi)
                                        <option value="{{ $rasi->id }}" {{ $profile->rasi == $rasi->id ? 'selected' : '' }}>{{ $rasi->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold">Star</label>
                                    <select id="dash_star" name="stars" class="form-select rounded-pill">
                                        <option value="">Select Star</option>
                                        @foreach($stars as $star)
                                        <option value="{{ $star->id }}" {{ $profile->stars == $star->id ? 'selected' : '' }}>{{ $star->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold">Laknam</label>
                                    <select name="laknam" class="form-select rounded-pill">
                                        <option value="">Select Laknam</option>
                                        @foreach($rasis as $r)
                                        <option value="{{ $r->id }}" {{ $profile->laknam == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold">Birth Time</label>
                                    <input type="time" name="birth_time" class="form-control rounded-pill" value="{{ $profile->birth_time }}">
                                </div>
                            </div>
                            <div class="text-end mt-4 pt-3 border-top">
                                <button type="button" class="btn btn-light rounded-pill px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-maroon rounded-pill px-5 shadow-sm">Save Changes</button>
                            </div>
                        </form>
                    </div>

                    <!-- Partner Tab -->
                    <div class="tab-pane fade p-4" id="partnerContent" role="tabpanel">
                        <form action="{{ route('dashboard.partner.update') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Age From</label>
                                    <input type="number" name="age_from" class="form-control rounded-pill" value="{{ $partnerExpectations->age_from ?? 21 }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Age To</label>
                                    <input type="number" name="age_to" class="form-control rounded-pill" value="{{ $partnerExpectations->age_to ?? 30 }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Expected Marital Status</label>
                                    <select name="marital_status" class="form-select rounded-pill">
                                        <option value="0">Any</option>
                                        @foreach($marital_statuses as $ms)
                                        <option value="{{ $ms->id }}" {{ ($partnerExpectations->marital_status ?? '') == $ms->id ? 'selected' : '' }}>{{ $ms->matrial_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Expected Religion</label>
                                    <select name="preference_religion" id="pref_religion" class="form-select rounded-pill">
                                        <option value="0">Any</option>
                                        @foreach($religions as $rel)
                                        <option value="{{ $rel->id }}" {{ ($partnerExpectations->preference_religion ?? '') == $rel->id ? 'selected' : '' }}>{{ $rel->religion_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Expected Caste</label>
                                    <select name="preference_caste" id="pref_caste" class="form-select rounded-pill">
                                        <option value="0">Any</option>
                                        @foreach($castes as $caste)
                                        <option value="{{ $caste->id }}" {{ ($partnerExpectations->preference_caste ?? '') == $caste->id ? 'selected' : '' }}>{{ $caste->Caste_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Expected Sub-Caste</label>
                                    <select name="preference_subcaste" id="pref_subcaste" class="form-select rounded-pill">
                                        <option value="0">Any</option>
                                        @foreach($subcastes as $sc)
                                        <option value="{{ $sc->id }}" {{ ($partnerExpectations->preference_subcaste ?? '') == $sc->id ? 'selected' : '' }}>{{ $sc->subcategory_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Education Preference</label>
                                    <select name="preference_educat" class="form-select rounded-pill">
                                        <option value="0">Any</option>
                                        @foreach($education_list as $edu)
                                        <option value="{{ $edu->id }}" {{ ($partnerExpectations->preference_educat ?? '') == $edu->id ? 'selected' : '' }}>{{ $edu->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Height From</label>
                                    <select name="preference_height" class="form-select rounded-pill">
                                        <option value="0">Any</option>
                                        @foreach($heights as $h)
                                        <option value="{{ $h->id }}" {{ ($partnerExpectations->preference_height ?? '') == $h->id ? 'selected' : '' }}>{{ $h->height_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Annual Income Preference</label>
                                    <select name="preference_income" class="form-select rounded-pill">
                                        <option value="0">Any</option>
                                        @foreach($income_list as $inc)
                                        <option value="{{ $inc->id }}" {{ ($partnerExpectations->preference_income ?? '') == $inc->id ? 'selected' : '' }}>{{ $inc->salary }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Employment Preference</label>
                                    <select name="preference_jobcat" class="form-select rounded-pill">
                                        <option value="0">Any</option>
                                        @foreach($job_categories as $job)
                                        <option value="{{ $job->id }}" {{ ($partnerExpectations->preference_jobcat ?? '') == $job->id ? 'selected' : '' }}>{{ $job->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Eating Habit</label>
                                    <select name="preference_eating" class="form-select rounded-pill">
                                        <option value="Any">Any</option>
                                        <option value="Vegetarian" {{ ($partnerExpectations->preference_eating ?? '') == 'Vegetarian' ? 'selected' : '' }}>Vegetarian</option>
                                        <option value="Non-Vegetarian" {{ ($partnerExpectations->preference_eating ?? '') == 'Non-Vegetarian' ? 'selected' : '' }}>Non-Vegetarian</option>
                                        <option value="Eggetarian" {{ ($partnerExpectations->preference_eating ?? '') == 'Eggetarian' ? 'selected' : '' }}>Eggetarian</option>
                                        <option value="Vegan" {{ ($partnerExpectations->preference_eating ?? '') == 'Vegan' ? 'selected' : '' }}>Vegan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Complexion</label>
                                    <select name="preference_complexion" class="form-select rounded-pill">
                                        <option value="0">Any</option>
                                        @foreach($complexions as $comp)
                                        <option value="{{ $comp->id }}" {{ ($partnerExpectations->preference_complexion ?? '') == $comp->id ? 'selected' : '' }}>{{ $comp->com_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Body Type</label>
                                    <select name="preference_bodytype" class="form-select rounded-pill">
                                        <option value="0">Any</option>
                                        @foreach($body_types as $bt)
                                        <option value="{{ $bt->id }}" {{ ($partnerExpectations->preference_bodytype ?? '') == $bt->id ? 'selected' : '' }}>{{ $bt->btype }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold">Preferred Location</label>
                                    <input type="text" name="preference_location" class="form-control rounded-pill" value="{{ $partnerExpectations->preference_location ?? '' }}" placeholder="Chennai / Anywhere etc.">
                                </div>
                            </div>
                            <div class="text-end mt-4 pt-3 border-top">
                                <button type="button" class="btn btn-light rounded-pill px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-maroon rounded-pill px-5 shadow-sm">Save Preferences</button>
                            </div>
                        </form>
                    </div>

                    <!-- Photo Tab -->
                    <div class="tab-pane fade p-4 text-center" id="photoContent" role="tabpanel">
                        <div class="mb-4">
                            <i class="fas fa-cloud-upload-alt fa-3x text-light mb-3"></i>
                            <h6 class="serif-font">Upload New Gallery Photo</h6>
                            <p class="text-muted small">Please select a clear photo. Maximum size 5MB.</p>
                        </div>
                        <form action="{{ route('dashboard.photo.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="photo" class="form-control rounded-pill mb-4" required accept="image/*">
                            <div class="text-end mt-2 pt-3 border-top">
                                <button type="button" class="btn btn-light rounded-pill px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-maroon rounded-pill px-5 shadow-sm">Start Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Horoscope Modal -->
@if($horoscope)
<div class="modal fade" id="viewHoroModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow overflow-hidden">
            <div class="modal-header border-0 bg-maroon text-white p-4">
                <h5 class="modal-title serif-font">Horoscope View</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 text-center bg-light">
                <img src="{{ asset('uploads/' . $horoscope->img_name) }}" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endif

<!-- Selfie Upload Modal -->
<div class="modal fade" id="selfieModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow overflow-hidden">
            <div class="modal-header border-0 bg-success text-white p-4">
                <h5 class="modal-title serif-font"><i class="fas fa-camera me-2"></i> Identity Verification</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-muted small mb-4">Take a live selfie to verify your identity and build trust with potential matches.</p>
                
                <div class="verification-box-dash bg-dark rounded-4 overflow-hidden mb-3" style="min-height: 300px; display: flex; align-items: center; justify-content: center; position: relative;">
                    <video id="dashCameraVideo" autoplay playsinline style="width: 100%; height: auto; display: none;"></video>
                    <canvas id="dashSnapCanvas" hidden></canvas>
                    <img id="dashSelfiePreview" src="" alt="Selfie" style="width: 100%; height: auto; display: none;">
                    
                    <div id="dashCameraPlaceholder" class="text-white text-center">
                        <i class="fas fa-user-circle fa-4x opacity-50 mb-3"></i>
                        <br>
                        <button type="button" class="btn btn-outline-light rounded-pill px-4" id="dashStartCameraBtn">
                            <i class="fas fa-video me-2"></i> Start Camera
                        </button>
                    </div>

                    <button type="button" class="btn btn-light rounded-circle shadow-lg" id="dashCaptureBtn" style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); width: 60px; height: 60px; display: none;">
                        <i class="fas fa-camera fa-lg"></i>
                    </button>
                </div>

                <div id="selfieUploadActions" style="display: none;">
                    <button type="button" class="btn btn-success w-100 rounded-pill py-2 fw-bold" id="dashSubmitSelfieBtn">
                        <i class="fas fa-check-circle me-2"></i> Submit Verification
                    </button>
                    <button type="button" class="btn btn-link w-100 text-muted small mt-2" id="retakeSelfieBtn">
                        Retake Photo
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow overflow-hidden">
            <div class="modal-header border-0 bg-danger text-white p-4">
                <h5 class="modal-title serif-font"><i class="fas fa-exclamation-triangle me-2"></i> Delete Account</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-warning rounded-4 mb-4 border-0 shadow-sm">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-exclamation-circle text-warning fa-lg me-3 mt-1"></i>
                        <div>
                            <strong class="d-block mb-1">Are you sure you want to delete your account?</strong>
                            <span class="small text-muted">Your request will be sent to admin for approval. Once approved, your account and all data will be permanently deleted.</span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('dashboard.request.delete') }}" method="POST" id="deleteAccountForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark small">Reason for deletion <span class="text-danger">*</span></label>
                        <select name="delete_reason" class="form-select rounded-pill border-2" id="deleteReasonSelect" required>
                            <option value="">Select a reason</option>
                            <option value="Found Partner">Found a partner through this matrimony</option>
                            <option value="Privacy Concerns">Privacy concerns</option>
                            <option value="Not Finding Matches">Not finding suitable matches</option>
                            <option value="Too Many Messages">Too many unwanted messages</option>
                            <option value="Duplicate Account">I have a duplicate account</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3" id="otherReasonGroup" style="display: none;">
                        <label class="form-label fw-bold text-dark small">Please tell us more</label>
                        <textarea name="delete_reason_detail" class="form-control rounded-4 border-2" rows="3" placeholder="Please specify your reason..."></textarea>
                    </div>

                    <div class="bg-light rounded-4 p-3 mb-0">
                        <h6 class="small fw-bold text-dark mb-2"><i class="fas fa-info-circle text-maroon me-1"></i> What happens after deletion?</h6>
                        <ul class="small text-muted mb-0 ps-3" style="list-style-type: disc;">
                            <li>Your profile will be deactivated immediately</li>
                            <li>Admin will review your request</li>
                            <li>Once approved, all your data will be permanently deleted</li>
                            <li>This action <strong>cannot be undone</strong></li>
                        </ul>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 p-4 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirmDeleteBtn" class="btn btn-danger rounded-pill px-4 shadow-sm">
                    <i class="fas fa-trash me-1"></i> Yes, Delete My Account
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-gold { background: #D4AF37; color: #000; }
    .btn-gold:hover { background: #b8952d; }
</style>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Delete Account - Show/Hide Other Reason
        const deleteReasonSelect = document.getElementById('deleteReasonSelect');
        const otherReasonGroup = document.getElementById('otherReasonGroup');
        if (deleteReasonSelect) {
            deleteReasonSelect.addEventListener('change', function() {
                otherReasonGroup.style.display = this.value === 'Other' ? 'block' : 'none';
            });
        }

        // SweetAlert Flash Messages
        var swalSuccess = document.getElementById('swal-success');
        var swalError = document.getElementById('swal-error');
        if (swalSuccess) {
            Swal.fire({ icon: 'success', title: 'Success', text: swalSuccess.dataset.message, confirmButtonColor: '#900C3F' });
        }
        if (swalError) {
            Swal.fire({ icon: 'error', title: 'Error', text: swalError.dataset.message, confirmButtonColor: '#900C3F' });
        }

        // Delete Account - SweetAlert Confirmation
        var confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        if (confirmDeleteBtn) {
            confirmDeleteBtn.addEventListener('click', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone. Your account will be permanently deleted after admin approval.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#900C3F',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, Delete My Account',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        document.getElementById('deleteAccountForm').submit();
                    }
                });
            });
        }

        // Selfie Camera Logic for Dashboard
        const startCameraBtn = document.getElementById('dashStartCameraBtn');
        const placeholder = document.getElementById('dashCameraPlaceholder');
        const video = document.getElementById('dashCameraVideo');
        const captureBtn = document.getElementById('dashCaptureBtn');
        const snapCanvas = document.getElementById('dashSnapCanvas');
        const selfiePreview = document.getElementById('dashSelfiePreview');
        const uploadActions = document.getElementById('selfieUploadActions');
        const submitBtn = document.getElementById('dashSubmitSelfieBtn');
        const retakeBtn = document.getElementById('retakeSelfieBtn');
        
        let stream = null;

        if (startCameraBtn) {
            startCameraBtn.onclick = async function() {
                try {
                    stream = await navigator.mediaDevices.getUserMedia({ video: true });
                    video.srcObject = stream;
                    video.style.display = 'block';
                    captureBtn.style.display = 'block';
                    placeholder.style.display = 'none';
                    selfiePreview.style.display = 'none';
                    uploadActions.style.display = 'none';
                } catch (err) {
                    Swal.fire('Error', 'Camera access denied or not available.', 'error');
                    console.error(err);
                }
            };
        }

        if (captureBtn) {
            captureBtn.onclick = function() {
                const context = snapCanvas.getContext('2d');
                snapCanvas.width = video.videoWidth;
                snapCanvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, snapCanvas.width, snapCanvas.height);
                
                const dataUrl = snapCanvas.toDataURL('image/png');
                selfiePreview.src = dataUrl;
                selfiePreview.style.display = 'block';
                video.style.display = 'none';
                captureBtn.style.display = 'none';
                uploadActions.style.display = 'block';

                // Stop camera
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }
            };
        }

        if (retakeBtn) {
            retakeBtn.onclick = () => {
                startCameraBtn.click();
            };
        }

        if (submitBtn) {
            submitBtn.onclick = async function() {
                const dataUrl = selfiePreview.src;
                
                Swal.fire({
                    title: 'Uploading...',
                    didOpen: () => { Swal.showLoading(); }
                });

                try {
                    const response = await fetch('{{ route("dashboard.selfie.upload") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ selfie_image: dataUrl })
                    });
                    const data = await response.json();
                    
                    if (data.success) {
                        Swal.fire('Success', data.message, 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                } catch (error) {
                    Swal.fire('Error', 'Something went wrong!', 'error');
                }
            };
        }

        // Modal cleanup on close
        const selfieModal = document.getElementById('selfieModal');
        if (selfieModal) {
            selfieModal.addEventListener('hidden.bs.modal', function () {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }
                video.style.display = 'none';
                captureBtn.style.display = 'none';
                placeholder.style.display = 'block';
                selfiePreview.style.display = 'none';
                uploadActions.style.display = 'none';
            });
        }
        async function fetchMasterData(endpoint, params = {}) {
            try {
                const url = new URL('{{ url("/api/master") }}/' + endpoint);
                Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));
                const response = await fetch(url);
                return await response.json();
            } catch (error) {
                console.error('Error fetching ' + endpoint + ':', error);
                return [];
            }
        }

        async function populateSelect(selectId, endpoint, params = {}, defaultText = 'Select', selectedValue = null) {
            const select = document.getElementById(selectId);
            if (!select) return;
            
            select.innerHTML = `<option value="">Loading...</option>`;
            const data = await fetchMasterData(endpoint, params);
            
            select.innerHTML = `<option value="">${defaultText}</option>`;
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.textContent = item.name;
                if (selectedValue && item.id == selectedValue) {
                    option.selected = true;
                }
                select.appendChild(option);
            });
        }

        // --- Edit Profile Form Logic ---
        const editReligionSelect = document.getElementById('edit_religion');
        const editCasteSelect = document.getElementById('edit_caste');
        const editSubCasteSelect = document.getElementById('edit_subcaste');

        if (editReligionSelect) {
            editReligionSelect.addEventListener('change', function() {
                if (this.value) {
                    populateSelect('edit_caste', 'castes', { religion_id: this.value }, 'Select Caste');
                    editSubCasteSelect.innerHTML = '<option value="">Select Sub-Caste</option>';
                } else {
                    editCasteSelect.innerHTML = '<option value="">Select Caste</option>';
                    editSubCasteSelect.innerHTML = '<option value="">Select Sub-Caste</option>';
                }
            });
        }

        if (editCasteSelect) {
            editCasteSelect.addEventListener('change', function() {
                if (this.value) {
                    populateSelect('edit_subcaste', 'subcastes', { caste_id: this.value }, 'Select Sub-Caste');
                } else {
                    editSubCasteSelect.innerHTML = '<option value="">Select Sub-Caste</option>';
                }
            });
        }

        // --- Partner Preferences Form Logic ---
        const prefReligionSelect = document.getElementById('pref_religion');
        const prefCasteSelect = document.getElementById('pref_caste');
        const prefSubCasteSelect = document.getElementById('pref_subcaste');

        if (prefReligionSelect) {
            prefReligionSelect.addEventListener('change', function() {
                if (this.value && this.value != "0") {
                    populateSelect('pref_caste', 'castes', { religion_id: this.value }, 'Any Caste');
                    prefSubCasteSelect.innerHTML = '<option value="0">Any Sub-Caste</option>';
                } else {
                    prefCasteSelect.innerHTML = '<option value="0">Any Caste</option>';
                    prefSubCasteSelect.innerHTML = '<option value="0">Any Sub-Caste</option>';
                }
            });
        }

        if (prefCasteSelect) {
            prefCasteSelect.addEventListener('change', function() {
                if (this.value && this.value != "0") {
                    populateSelect('pref_subcaste', 'subcastes', { caste_id: this.value }, 'Any Sub-Caste');
                } else {
                    prefSubCasteSelect.innerHTML = '<option value="0">Any Sub-Caste</option>';
                }
            });
        }

        // --- Rasi to Star Mapping ---
        const dashRasi = document.getElementById('dash_rasi');
        const dashStar = document.getElementById('dash_star');

        if (dashRasi && dashStar) {
            dashRasi.addEventListener('change', function() {
                const rasiId = this.value;
                if (!rasiId) {
                    dashStar.innerHTML = '<option value="">Select Star</option>';
                    return;
                }

                // Fetch stars using API
                fetch(`{{ url('/services/horoscope/get-stars') }}/${rasiId}`)
                    .then(response => response.json())
                    .then(data => {
                        let options = '<option value="">Select Star</option>';
                        data.forEach(star => {
                            options += `<option value="${star.id}">${star.name}</option>`;
                        });
                        dashStar.innerHTML = options;
                    })
                    .catch(error => console.error('Error fetching stars:', error));
            });
        }

        @if(session('show_preference_modal'))
            var editModal = new bootstrap.Modal(document.getElementById('editProfileModal'));
            var partnerTab = document.getElementById('partner-tab');
            if(partnerTab) partnerTab.click();
            editModal.show();
        @endif
    });
</script>
@endpush
@endsection
