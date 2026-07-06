   
@extends('layout.default')
@section('content')
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '<div style="font-family: \'Playfair Display\', serif; font-size: 2.2rem; color: #900C3F; margin-bottom: 5px;">A New Beginning</div>',
                html: '<div style="font-family: \'Outfit\', sans-serif; color: #666; font-size: 1.1rem; line-height: 1.6;">{{ session('success') }}<br><span style="color:#D4AF37; font-weight:600; font-size:1.2rem; display:block; margin-top:15px;">Wishing you the best in your partner search!</span></div>',
                imageUrl: '{{ asset('assets/images/matri/affectionate-indian-couple-celebrating-propose-day-together.jpg') }}',
                imageWidth: 280,
                imageHeight: 180,
                imageAlt: 'Welcome',
                confirmButtonText: '<span style="font-family: \'Outfit\', sans-serif; font-weight: 600; letter-spacing: 0.5px;">Begin Your Journey</span> <i class="fa-solid fa-heart ms-2"></i>',
                confirmButtonColor: '#D4AF37',
                background: '#FFFDF9',
                padding: '2.5em',
                customClass: {
                    popup: 'wedding-alert-popup',
                    confirmButton: 'wedding-alert-btn',
                    image: 'wedding-alert-img'
                }
            });
        });
    </script>
    <style>
        .wedding-alert-popup { border-radius: 24px !important; border: 3px solid #D4AF37 !important; }
        .wedding-alert-img { border-radius: 16px !important; object-fit: cover !important; }
        .wedding-alert-btn { border-radius: 50px !important; padding: 14px 38px !important; }
    </style>
    @endif
    
    <!-- ================> Banner Slider start here <================== -->
    <div class="banner-slider-wrapper">
        <div class="swiper banner-slider">
            <div class="swiper-wrapper">
                @forelse($banners as $banner)
                <div class="swiper-slide matrimony-banner-item" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.4)), url('{{ env('DASHBOARD_URL', 'https://dashboard.varan2varan.com/') . $banner->image }}') no-repeat center 20% / cover;">
                    <div class="container-fluid px-md-5 h-100">
                        <div class="banner-content d-flex w-100 justify-content-center align-items-center h-100">
                            <div class="banner-text wow fadeInLeft" data-wow-duration="1s">
                                <h1 class="serif-font display-3 text-white">{!! str_replace(['{', '}'], ['<span style="color: #D4AF37;">', '</span>'], $banner->title) !!}</h1>
                                <p class="lead text-white-50 mb-4">{{ $banner->subtitle }}</p>
                                <div class="banner-ctas d-flex gap-3">
                                    <a href="{{ url('register') }}" class="btn btn-primary-premium px-4 py-2">Register Free Now <i class="fas fa-heart ms-1"></i></a>
                                    <a href="{{ url('matches') }}" class="btn btn-outline-light rounded-pill px-4 py-2">Browse Profiles</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="swiper-slide matrimony-banner-item" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.4)), url('{{ asset('assets/images/matri/banner_1.png') }}') no-repeat center 20% / cover;">
                    <div class="container-fluid px-md-5 h-100">
                        <div class="banner-content d-flex w-100 justify-content-center align-items-center h-100">
                            <div class="banner-text wow fadeInLeft" data-wow-duration="1s">
                                <h1 class="serif-font display-3 text-white">Find Your <span style="color: #D4AF37;">Perfect</span> Soulmate</h1>
                                <p class="lead text-white-50 mb-4">The Most Trusted Tamil Matrimony platform with verified profiles and cultural values.</p>
                                <div class="banner-ctas d-flex gap-3">
                                    <a href="{{ url('register') }}" class="btn btn-primary-premium px-4 py-2">Register Free Now <i class="fas fa-heart ms-1"></i></a>
                                    <a href="{{ url('matches') }}" class="btn btn-outline-light rounded-pill px-4 py-2">Browse Profiles</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide matrimony-banner-item" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.4)), url('{{ asset('assets/images/matri/banner_2.png') }}') no-repeat center 20% / cover;">
                    <div class="container-fluid px-md-5 h-100">
                        <div class="banner-content d-flex w-100 justify-content-center align-items-center h-100">
                            <div class="banner-text">
                                <h1 class="serif-font display-3 text-white">Trust, <span style="color: #D4AF37;">Culture</span> & Tradition</h1>
                                <p class="lead text-white-50 mb-4">Helping Tamil families connect globally for generations with safety and security.</p>
                                <div class="banner-ctas d-flex gap-3">
                                    <a href="{{ url('register') }}" class="btn btn-primary-premium px-4 py-2">Start Free Search <i class="fas fa-search ms-1"></i></a>
                                    <a href="{{ url('about') }}" class="btn btn-outline-light rounded-pill px-4 py-2">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <!-- Floating Banner Search Box -->
        <div class="banner-search-floating" style="margin-top: 50px;">
            <div class="container">
                <div class="search-box-card wow fadeInUp" data-wow-duration="1.2s">
                    <form action="{{ url('matches') }}" method="GET" class="row g-3 align-items-end">
                        <div class="col-lg-3 col-md-6">
                            <label class="form-label d-flex align-items-center gap-2 mb-2"><i class="fas fa-user-friends text-maroon"></i> I'm looking for a</label>
                            <select class="form-select custom-select-premium" name="gender">
                                <option value="Bride">Bride</option>
                                <option value="Groom">Groom</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <label class="form-label d-flex align-items-center gap-2 mb-2"><i class="fas fa-calendar-alt text-maroon"></i> Age Range</label>
                            <div class="d-flex align-items-center gap-2">
                                <select class="form-select custom-select-premium" name="min_age">
                                    @for($i=21; $i<=70; $i++) <option value="{{$i}}">{{$i}}</option> @endfor
                                </select>
                                <span class="text-muted small">to</span>
                                <select class="form-select custom-select-premium" name="max_age">
                                    @for($i=21; $i<=70; $i++) <option value="{{$i}}" {{$i == 35 ? 'selected' : ''}}>{{$i}}</option> @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <label class="form-label d-flex align-items-center gap-2 mb-2"><i class="fas fa-pray text-maroon"></i> Religion</label>
                            <select class="form-select custom-select-premium" name="religion">
                                <option value="Any">Any</option>
                                <option value="1">Hindu</option>
                                <option value="2">Christian</option>
                                <option value="3">Muslim</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <button type="submit" class="btn-search-banner-premium w-100">Let's Find Matches</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> Banner Slider end here <================== -->

    <!-- ================> Information Sections start here <================== -->
    <section class="info-sections py-5" style="margin-top: 130px;">
        <div class="container">
            <!-- About Trust -->
            <div class="row align-items-center mb-5 overflow-hidden">
                <div class="col-lg-6 wow fadeInLeft">
                    <div class="pe-lg-5">
                        <h6 class="text-uppercase text-gold fw-bold mb-2">Trust and Security</h6>
                        <h2 class="serif-font mb-4">Building Relationships on <span class="text-maroon">Trust</span></h2>
                        <p class="text-muted mb-4">At Thennadu Matrimony, we understand that finding a life partner is a journey of trust. We go above and beyond to ensure that every profile on our platform is genuine and verified.</p>
                        <ul class="trust-list list-unstyled">
                            <li><i class="fas fa-check-circle me-2"></i> Manual verification of every profile</li>
                            <li><i class="fas fa-check-circle me-2"></i> Privacy controls to protect your data</li>
                            <li><i class="fas fa-check-circle me-2"></i> Dedicated safety support team</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight">
                    <img src="{{ asset('assets/images/matri/hands-indian-bride-groom-intertwined-together-making-authentic-wedding-ritual.jpg') }}" alt="Trust" class="img-fluid rounded-4 shadow" style="width: 100%; height: 400px; object-fit: cover;">
                </div>
            </div>

            <!-- How It Works -->
            <div class="how-it-works-section bg-light-maroon p-5 rounded-4 mb-5 wow fadeInUp">
                <div class="text-center mb-5">
                    <h2 class="serif-font">How It <span class="text-maroon">Works</span></h2>
                    <p class="text-muted">Simple 4-step process to find your soulmate</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="step-card-modern">
                            <div class="step-number">1</div>
                            <div class="step-icon-modern"><i class="fas fa-user-plus"></i></div>
                            <h5 class="mt-3">Register</h5>
                            <p class="small text-muted">Create your basic account in minutes</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="step-card-modern">
                            <div class="step-number">2</div>
                            <div class="step-icon-modern"><i class="fas fa-id-card"></i></div>
                            <h5 class="mt-3">Create Profile</h5>
                            <p class="small text-muted">Add background and preferences</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="step-card-modern">
                            <div class="step-number">3</div>
                            <div class="step-icon-modern"><i class="fas fa-search"></i></div>
                            <h5 class="mt-3">Find Matches</h5>
                            <p class="small text-muted">Search based on your criteria</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="step-card-modern">
                            <div class="step-number">4</div>
                            <div class="step-icon-modern"><i class="fas fa-comments"></i></div>
                            <h5 class="mt-3">Connect</h5>
                            <p class="small text-muted">Express interest and start talking</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Why Choose Us -->
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                        <h4 class="serif-font mt-3">Verified Profiles</h4>
                        <p class="text-muted">We manually check every profile to provide you with the most authentic experience possible.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon"><i class="fas fa-lock"></i></div>
                        <h4 class="serif-font mt-3">Privacy Protection</h4>
                        <p class="text-muted">You have full control over who sees your photos and contact information.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon"><i class="fas fa-magic"></i></div>
                        <h4 class="serif-font mt-3">Smart Matchmaking</h4>
                        <div class="feature-icon-sub mt-2" style="font-size: 0.8rem; color: #900C3F;">Trusted Platform</div>
                        <p class="text-muted mt-2">Our algorithms suggest the most compatible matches based on your cultural and personal preferences.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================> Information Sections end here <================== -->

    <!-- ================> Profiles for you section end here <================== -->

    <!-- ================> Profiles for you section start here <================== -->
    <section class="profiles-section py-5 bg-light">
        <div class="container">
            <div class="section__header text-center mb-5 wow fadeInUp">
                <h2 class="serif-font">Profiles for <span class="text-maroon">You</span></h2>
                <div class="title-divider mx-auto"></div>
                <p class="text-muted mt-3">Discover hand-picked profiles tailored to your preferences.</p>
            </div>
            
            <div class="row g-4 justify-content-center">
                @foreach($profiles as $profile)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="profile-card-modern h-100 shadow-sm border-0">
                        <div class="profile-img-container">
                            @guest
                                <a href="{{ url('login') }}" class="text-decoration-none">
                                    <img src="{{ $profile->profileImage() }}" alt="{{ $profile->name }}" class="profile-img blur-img">
                                    <div class="lock-overlay">
                                        <div class="lock-content">
                                            <i class="fas fa-lock mb-2"></i>
                                            <p class="small">Join to view profiles</p>
                                            <span class="btn btn-sm btn-gold rounded-pill px-3 mt-1">Login Now</span>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <a href="{{ route('profile.view', $profile->user_ID) }}">
                                    <img src="{{ $profile->profileImage() }}" alt="{{ $profile->name }}" class="profile-img">
                                </a>
                                <div class="verify-tag"><i class="fas fa-check-circle me-1"></i> Verified</div>
                                @if(isset($profile->score))
                                    <div class="score-badge-home">{{ $profile->score }}% Match</div>
                                @endif
                            @endguest
                        </div>
                        <div class="profile-body p-4 text-center">
                            @guest
                                <h5 class="serif-font mb-1">
                                    <a href="{{ url('login') }}" class="text-dark text-decoration-none hover-maroon">{{ Str::mask($profile->name, '*', 2) }}</a>
                                </h5>
                            @else
                                <h5 class="serif-font mb-1">
                                    <a href="{{ route('profile.view', $profile->user_ID) }}" class="text-dark text-decoration-none hover-maroon">{{ $profile->name }}</a>
                                </h5>
                            @endguest
                            <p class="small text-muted mb-2"><i class="fas fa-map-marker-alt me-1"></i> {{ $profile->district ?? 'Tamil Nadu' }}</p>
                            @php
                                $age = \Carbon\Carbon::parse($profile->dob)->age;
                                $details = ($profile->educationJob->job_detail ?? $profile->job_detail) . ' | ' . $profile->religion . ' | ' . $profile->caste;
                            @endphp
                            <p class="profile-info-text mb-3 small">{{ $age }} yrs | {{ $details }}</p>
                            @guest
                                <a href="{{ url('login') }}" class="btn-view-profile-modern w-100 shadow-sm">View Details</a>
                            @else
                                <a href="{{ route('profile.view', $profile->user_ID) }}" class="btn-view-profile-modern w-100 shadow-sm">View Details</a>
                            @endguest
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5 wow fadeInUp">
                <a href="{{ url('matches') }}" class="btn-more-profiles">Browse All Profiles <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </section>
    <!-- ================> Profiles for you section end here <================== -->

    <!-- ================> Membership Plans section start here <================== -->
    <section class="pricing-section py-5" id="membership">
        <div class="container py-lg-5">
            <div class="section__header text-center mb-5 wow fadeInUp">
                <h2 class="serif-font">Choose Your <span class="text-maroon">Perfect</span> Plan</h2>
                <div class="title-divider mx-auto"></div>
                <p class="text-muted mt-3">Select a membership plan that fits your search and find your soulmate faster.</p>
            </div>

            <div class="row g-5 justify-content-center">
                @forelse($packages as $index => $plan)
                <div class="col-lg-4 col-md-6">
                    <div class="card pricing-card h-100 border-0 rounded-4 overflow-hidden position-relative {{ $index == 1 ? 'premium-plan scale-up' : 'bg-white shadow-lg' }} animate__animated animate__fadeInUp" style="animation-delay: {{ $index * 0.2 }}s;">

                        @if($index == 1)
                        <div class="popular-badge position-absolute top-0 end-0 bg-gold text-maroon px-4 py-1 rounded-bl-3 fw-bold small">
                            Most Popular
                        </div>
                        @endif

                        <div class="{{ $index == 1 ? 'bg-maroon text-white p-5 text-center' : 'bg-light p-5 text-center border-bottom' }}">
                            <h3 class="serif-font fw-bold mb-3 {{ $index == 1 ? 'text-gold' : 'text-maroon' }}">{{ $plan->package_name }}</h3>
                            <div class="display-4 fw-bold mb-2">₹{{ number_format($plan->package_price) }}</div>
                            <span class="small {{ $index == 1 ? 'opacity-75' : 'text-muted' }}">Valid for {{ $plan->validity }} Days</span>
                        </div>

                        <div class="card-body p-5">
                            <ul class="list-unstyled mb-5 plan-features">
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="fas fa-check-circle me-3 {{ $index == 1 ? 'text-gold' : 'text-maroon' }}"></i>
                                    <span><strong>{{ $plan->no_of_images ?: 0 }}</strong> Profile Images Upload</span>
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="fas fa-check-circle me-3 {{ $index == 1 ? 'text-gold' : 'text-maroon' }}"></i>
                                    <span><strong>{{ $plan->noofmblno ?: 0 }}</strong> Verified Contacts View</span>
                                </li>

                                @if($plan->no_of_videos)
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="fas fa-check-circle me-3 {{ $index == 1 ? 'text-gold' : 'text-maroon' }}"></i>
                                    <span>Video Profile Upload</span>
                                </li>
                                @endif

                                @if(strtolower($plan->specification_3) === 'yes')
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="fas fa-check-circle me-3 {{ $index == 1 ? 'text-gold' : 'text-maroon' }}"></i>
                                    <span>Direct Chat Booking</span>
                                </li>
                                @else
                                <li class="mb-3 d-flex align-items-center opacity-50 text-muted">
                                    <i class="fas fa-times-circle me-3"></i>
                                    <del>Direct Chat</del>
                                </li>
                                @endif

                                @if(strtolower($plan->specification_5) === 'yes')
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="fas fa-check-circle me-3 {{ $index == 1 ? 'text-gold' : 'text-maroon' }}"></i>
                                    <span>Advanced Profile Search</span>
                                </li>
                                @else
                                <li class="mb-3 d-flex align-items-center opacity-50 text-muted">
                                    <i class="fas fa-times-circle me-3"></i>
                                    <del>Advanced Profile Search</del>
                                </li>
                                @endif

                                @if(strtolower($plan->specification_6) === 'yes')
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="fas fa-check-circle me-3 {{ $index == 1 ? 'text-gold' : 'text-maroon' }}"></i>
                                    <span>Voice/Video Call Option</span>
                                </li>
                                @else
                                <li class="mb-3 d-flex align-items-center opacity-50 text-muted">
                                    <i class="fas fa-times-circle me-3"></i>
                                    <del>Call Option</del>
                                </li>
                                @endif

                            </ul>

                            <a href="{{ url('plans') }}" class="btn w-100 rounded-pill py-3 fw-bold shadow-sm {{ $index == 1 ? 'btn-gold' : 'btn-outline-maroon' }}">
                                Select {{ $plan->package_name }}
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted">
                    <p class="fs-5">No plans are currently available. Please check back later.</p>
                </div>
                @endforelse
            </div>

            <div class="text-center mt-5 wow fadeInUp">
                <a href="{{ url('plans') }}" class="btn btn-outline-maroon rounded-pill px-5 py-2 fw-bold">
                    View All Plans <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>
    <!-- ================> Membership Plans section end here <================== -->

    <!-- ================> Success Stories section start here <================== -->
    <section class="success-stories" id="success-stories">
        <div class="container">
            <div class="section__header text-center mb-4 wow fadeInUp">
                <h2 class="serif-font text-white">Heartwarming <span style="color: #D4AF37; text-shadow: 0 0 10px rgba(212, 175, 55, 0.3);">Success</span> Stories</h2>
                <p class="text-white-50">Couples who found their happily ever after through Thennadu Matrimony.</p>
            </div>
            
            <div class="stories-slider-wrapper wow fadeInUp" data-wow-delay="0.2s">
                <div class="swiper stories-slider">
                    <div class="swiper-wrapper">
                        @forelse($stories as $story)
                        <div class="swiper-slide h-auto">
                            <div class="story-card-vertical glass-card">
                                <div class="story-img-top">
                                    @php
                                        $imgPath = $story->image;
                                        $finalUrl = (strpos($imgPath, 'story_') !== false) 
                                            ? asset('assets/images/matri/' . $imgPath)
                                            : env('DASHBOARD_URL', 'https://dashboard.varan2varan.com/') . 'images/success_stories/' . $imgPath;
                                    @endphp
                                    <img src="{{ $finalUrl }}" alt="{{ $story->male_name }} & {{ $story->female_name }}" class="story-photo-top">
                                    <div class="story-overlay-tag"><i class="fas fa-heart me-1"></i> Success</div>
                                </div>
                                <div class="p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="quote-box-premium"><i class="fas fa-quote-left"></i></div>
                                        <span class="wedding-date-premium"><i class="fas fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($story->married_date)->format('M d, Y') }}</span>
                                    </div>
                                    <h5 class="serif-font couple-title mb-2">{{ $story->male_name }} & {{ $story->female_name }}</h5>
                                    <p class="story-desc mb-0">"{{ Str::limit($story->description, 120) }}"</p>
                                    <div class="divider-gold mt-3"></div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="swiper-slide h-auto">
                            <div class="story-card-vertical glass-card">
                                <div class="story-img-top">
                                    <img src="{{ asset('assets/images/matri/story_1.png') }}" class="story-photo-top">
                                    <div class="story-overlay-tag"><i class="fas fa-heart me-1"></i> Success</div>
                                </div>
                                <div class="p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="quote-box-premium"><i class="fas fa-quote-left"></i></div>
                                        <span class="wedding-date-premium"><i class="fas fa-calendar-alt me-1"></i> Sept 15, 2023</span>
                                    </div>
                                    <h5 class="serif-font couple-title mb-2">Karthik & Shalini</h5>
                                    <p class="story-desc mb-0">"We found each other through this platform within 3 months. The verified profiles made it easy."</p>
                                    <div class="divider-gold mt-3"></div>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                    <div class="swiper-pagination-stories mt-2 text-center"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================> Success Stories section end here <================== -->

@endsection

@push('styles')
<style>
/* Variables */
:root {
    --primary-maroon: #900C3F;
    --primary-gold: #D4AF37;
    --text-dark: #333;
    --text-muted: #666;
}

/* Banner Slider Refined */
.banner-slider-wrapper {
    position: relative;
    background: #eda026;
}
.banner-slider {
    height: 550px;
    width: 100%;
}
.matrimony-banner-item {
    height: 550px;
    position: relative;
    overflow: hidden;
}
.banner-text h1 {
    font-size: 3.2rem;
    font-weight: 700;
    line-height: 1.1;
    margin-bottom: 20px;
    text-shadow: 0 4px 15px rgba(0,0,0,0.5);
}
.banner-text p {
    font-size: 1.2rem;
    max-width: 550px;
    font-family: 'Outfit', sans-serif;
    color: rgba(255,255,255,0.95) !important;
    margin-bottom: 30px;
}

/* Floating Search Card */
.banner-search-floating {
    position: absolute;
    bottom: -105px;
    left: 0;
    right: 0;
    z-index: 50;
}
.search-box-card {
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(20px);
    padding: 30px 40px;
    border-radius: 20px;
    box-shadow: 0 15px 45px rgba(0,0,0,0.12);
    border: 1px solid rgba(255, 255, 255, 1);
    position: relative;
}
.search-box-card::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 20px;
    right: 20px;
    height: 3px;
    background: linear-gradient(to right, transparent, var(--primary-gold), transparent);
    opacity: 0.5;
}
.custom-select-premium {
    height: 52px;
    border-radius: 10px;
    border: 1px solid #e0e0e0;
    padding: 0 15px;
    font-size: 0.9rem;
    background-color: #fff;
    transition: all 0.3s ease;
    color: #444;
}
.custom-select-premium:focus {
    border-color: var(--primary-maroon);
    box-shadow: 0 0 0 4px rgba(144, 12, 63, 0.05);
}
.btn-search-banner-premium {
    background: linear-gradient(135deg, var(--primary-maroon), #7a0a35);
    color: #fff;
    width: 100%;
    height: 52px;
    border-radius: 10px;
    border: none;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: 0 8px 20px rgba(144, 12, 63, 0.2);
}
.btn-search-banner-premium:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(144, 12, 63, 0.3);
    filter: brightness(1.1);
}
.banner-ctas .btn {
    padding: 12px 28px !important;
    font-weight: 600;
}
.btn-primary-premium {
    background: var(--primary-maroon);
    color: #fff;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
}
.btn-primary-premium:hover {
    background: #c70039;
    color: #fff;
}

/* Info Sections */
.text-gold { color: var(--primary-gold); }
.text-maroon { color: var(--primary-maroon); }
.bg-light-maroon { background: #fff8fb; }
.trust-list li {
    margin-bottom: 15px;
    font-weight: 500;
    color: #555;
}
.trust-list i {
    color: #28a745;
}

/* How It Works Modern */
.step-card-modern {
    position: relative;
    padding: 20px;
}
.step-number {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 30px;
    height: 30px;
    background: var(--primary-gold);
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    z-index: 2;
}
.step-icon-modern {
    width: 80px;
    height: 80px;
    background: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 1.8rem;
    color: var(--primary-maroon);
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    border: 1px solid #eee;
}

/* Feature Card */
.feature-card {
    background: #fff;
    border-radius: 20px;
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
}
.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.08);
    border-color: var(--primary-gold);
}
.feature-icon {
    font-size: 2.5rem;
    color: var(--primary-maroon);
}

/* Profile Cards Modern */
.profile-card-modern {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}
.profile-card-modern:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}
.profile-img-container {
    height: 250px;
    position: relative;
    overflow: hidden;
}
.profile-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.blur-img {
    filter: blur(10px);
}
.lock-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    text-align: center;
}
.lock-content i {
    font-size: 2rem;
    color: var(--primary-gold);
}
.btn-gold {
    background: var(--primary-gold);
    color: #fff;
    border: none;
}
.verify-tag {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(40, 167, 69, 0.9);
    color: #fff;
    padding: 2px 10px;
    border-radius: 50px;
    font-size: 0.75rem;
}
.score-badge-home {
    position: absolute;
    bottom: 15px;
    left: 15px;
    background: linear-gradient(135deg, #D4AF37, #b8952d);
    color: #fff;
    padding: 2px 12px;
    border-radius: 50px;
    font-size: 0.7rem;
    font-weight: 700;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    z-index: 5;
}
.btn-view-profile-modern {
    display: inline-block;
    padding: 10px;
    background: var(--primary-maroon);
    color: #fff;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 500;
    transition: all 0.3s ease;
}
.btn-view-profile-modern:hover {
    background: #7a0a35;
    color: #fff;
}
.btn-more-profiles {
    background: #fff;
    color: var(--primary-maroon);
    border: 2px solid var(--primary-maroon);
    padding: 12px 35px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}
.btn-more-profiles:hover {
    background: var(--primary-maroon);
    color: #fff;
}

/* Success Stories */
.success-stories {
    background: linear-gradient(rgba(144, 12, 63, 0.96), rgba(120, 10, 50, 0.96)), url('{{ asset('assets/images/bg-img/01.jpg') }}') center/cover fixed;
    position: relative;
    padding: 50px 0 20px;
}
.glass-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    overflow: hidden;
    transition: all 0.3s ease;
}
.story-img-top {
    height: 200px;
    position: relative;
    overflow: hidden;
}
.story-photo-top {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.story-overlay-tag {
    position: absolute;
    top: 12px;
    right: 12px;
    background: var(--primary-gold);
    color: #fff;
    padding: 2px 10px;
    font-size: 0.6rem;
    font-weight: 700;
    border-radius: 4px;
}
.quote-box-premium {
    font-size: 1.2rem;
    color: var(--primary-gold);
}
.wedding-date-premium {
    font-size: 0.7rem;
    font-weight: 600;
    color: var(--primary-maroon);
    background: #fff8fb;
    padding: 2px 8px;
    border-radius: 4px;
}
.couple-title {
    color: var(--primary-maroon);
    font-weight: 700;
    font-size: 1.1rem;
}
.story-desc {
    font-size: 0.85rem;
    line-height: 1.5;
    color: #555;
    font-style: italic;
}
.divider-gold {
    width: 35px;
    height: 2px;
    background: var(--primary-gold);
    border-radius: 5px;
    opacity: 0.4;
}

.stories-slider {
    padding: 10px 0 30px !important;
}

.swiper-pagination-stories .swiper-pagination-bullet {
    background: #fff !important;
    opacity: 0.3;
}

.swiper-pagination-stories .swiper-pagination-bullet-active {
    background: var(--primary-gold) !important;
    opacity: 1;
}

/* Membership Plans Styles */
.pricing-section {
    background: #fffaf0;
}
.pricing-card {
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    border: 1px solid rgba(0,0,0,0.05);
}
.pricing-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 30px 60px rgba(0,0,0,0.12) !important;
}
.premium-plan {
    background: white;
    box-shadow: 0 20px 40px rgba(144, 12, 63, 0.15) !important;
    border: 2px solid #900C3F;
    z-index: 2;
}
@media (min-width: 992px) {
    .scale-up {
        transform: scale(1.05);
    }
    .scale-up:hover {
        transform: scale(1.08) translateY(-10px);
    }
}
.plan-features li {
    margin-bottom: 0.75rem;
}
.pricing-features li {
    margin-bottom: 12px;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
}
.btn-outline-gold {
    border: 2px solid #D4AF37;
    color: #D4AF37;
}
.btn-outline-gold:hover {
    background: #D4AF37;
    color: #fff;
}

/* Swiper Customization */
.swiper-button-next, .swiper-button-prev {
    color: #fff !important;
    background: rgba(144, 12, 63, 0.4);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    transition: all 0.3s ease;
}
.swiper-button-next:after, .swiper-button-prev:after {
    font-size: 20px;
}
.swiper-button-next:hover, .swiper-button-prev:hover {
    background: rgba(144, 12, 63, 0.8);
}
.swiper-pagination-bullet-active {
    background: var(--primary-gold) !important;
}

@media (max-width: 991px) {
    .banner-slider, .banner-item, .matrimony-banner-item { 
        height: 480px !important; 
    }
    .banner-text h1 { 
        font-size: 2rem ; 
    }
    .banner-text p {
        font-size: 0.95rem !important;
        margin-bottom: 20px !important;
    }
    .banner-search-floating { 
        position: relative; 
        bottom: 0; 
        margin-top: 0;
        transform: translateY(-40px);
        z-index: 100;
    }
    .search-box-card {
        padding: 25px 20px !important;
        margin: 0 10px !important;
    }
    .banner-content {
        align-items: center !important;
        text-align: center;
        padding-top: 20px;
    }
    .banner-text p {
        margin: 0 auto 20px;
    }
    .banner-ctas {
        justify-content: center;
        gap: 10px !important;
    }
    .banner-ctas .btn {
        padding: 10px 18px !important;
        font-size: 0.85rem !important;
    }
}

@media (max-width: 575px) {
    .banner-slider, .banner-item, .matrimony-banner-item { 
        height: 500px !important; 
    }
    .banner-text h1 { 
        font-size: 1.5rem ; 
    }
    .banner-ctas {
        flex-direction: column;
    }
    .banner-ctas .btn {
        width: 75%;
    }
}

/* Final Cleanup of duplications */
@media (max-width: 480px) {
    .banner-slider, .banner-item, .matrimony-banner-item { 
        height: 520px !important; 
    }
}
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.banner-slider', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        const storiesSwiper = new Swiper('.stories-slider', {
            slidesPerView: 1,
            spaceBetween: 25,
            loop: true,
            autoHeight: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination-stories',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1100: {
                    slidesPerView: 3,
                }
            }
        });
    });
</script>
@endpush
