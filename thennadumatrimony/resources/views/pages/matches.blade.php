@extends('layout.default')

@section('content')
<div class="profile-main-container py-5 mt-5">
    <div class="container">
        <!-- 🔥 1. Trust Indicators Above Results (Consistent with Members page) -->
        <div class="trust-indicators-bar wow fadeIn d-none d-md-flex mb-4">
            <div class="trust-bar-item"><i class="fas fa-check-circle"></i> Verified Matches</div>
            <div class="trust-bar-item"><i class="fas fa-lock"></i> 100% Privacy</div>
            <div class="trust-bar-item"><i class="fas fa-magic"></i> AI-Powered Matching</div>
        </div>

        <!-- Header Section -->
        <div class="section__header mb-5 wow fadeInUp text-center">
            <h6 class="text-uppercase text-gold fw-bold mb-2">Soulmate Discovery</h6>
            <h2 class="serif-font">Your Smart <span class="text-maroon">Matches</span></h2>
            <div class="title-divider mx-auto"></div>
            <p class="text-muted mt-3 small">Profiles curated based on your unique preferences and 50%+ compatibility.</p>
        </div>

        @if($matches->isEmpty())
            <div class="no-matches-found text-center py-5 wow fadeInUp bg-white rounded-3 shadow-sm p-5 border-top border-maroon border-5">
                <div class="mb-4">
                    <i class="fas fa-search fa-4x text-light-maroon" style="color: #eee;"></i>
                </div>
                <h4 class="serif-font">Keep Exploring!</h4>
                <p class="text-muted">We couldn't find matches above 50% based on your current preferences. <br>Try broadening your partner preferences or browse all available members.</p>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-maroon rounded-pill px-4">Update Preferences</a>
                    <a href="{{ request()->fullUrlWithQuery(['show_all' => '1']) }}" class="btn btn-maroon rounded-pill px-4 shadow-sm">Show All Profiles</a>
                </div>
            </div>
        @else
            <div class="row">
                <!-- 🔥 2. Filter Sidebar (Consistent with Members page) -->
                <!-- 🔥 2. Filter Sidebar (Hidden on mobile, shown on LG+) -->
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="filter-sidebar sticky-top" style="top: 100px; z-index: 10;">
                        @include('pages.partials._matches_filters')
                    </div>
                </div>

                <!-- Matches List -->
                <div class="col-lg-9 col-12">
                    <!-- Results Info Bar -->
                    <div class="listing-header mb-4 px-3 d-flex flex-wrap gap-3 justify-content-between align-items-center bg-white p-3 rounded-3 shadow-sm border-start border-maroon border-3">
                        <p class="mb-0 fw-bold text-maroon">
                            <span class="badge bg-maroon rounded-pill me-2">{{ $matches->total() }}</span> {{ request('show_all') ? 'All Profiles' : 'Matching Profiles' }} Found
                        </p>
                        
                        <div class="d-flex align-items-center gap-3">
                            @if(count(request()->except('page')) > 0)
                                <a href="{{ url()->current() }}" class="btn btn-light btn-sm rounded-pill px-3 shadow-sm border text-dark">
                                    <i class="fas fa-times text-danger me-1"></i> Clear Filters
                                </a>
                            @endif

                            @if(request('show_all') == '1')
                                <a href="{{ request()->fullUrlWithQuery(['show_all' => '0']) }}" class="btn btn-maroon btn-sm rounded-pill px-4 shadow-sm animate__animated animate__pulse animate__infinite">
                                    <i class="fas fa-star me-1"></i> Best Matches Only
                                </a>
                            @else
                                <a href="{{ request()->fullUrlWithQuery(['show_all' => '1']) }}" class="btn btn-outline-maroon btn-sm rounded-pill px-4 shadow-sm">
                                    <i class="fas fa-users me-1"></i> Show All Profiles
                                </a>
                            @endif
                            
                            <div class="d-lg-none">
                                <button class="btn btn-outline-maroon btn-sm rounded-pill px-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileFilter">
                                    <i class="fas fa-filter me-1"></i> Filters
                                </button>
                            </div>
                        </div>
                    </div>

                    @foreach($matches as $candidate)
                        @php
                            $score = $candidate->match_score;
                            $label = '🙂 Potential';
                            $class = 'bg-compatible';
                            if ($score >= 95) { $label = '🌟 Perfect Hit'; $class = 'bg-perfect'; }
                            elseif ($score >= 85) { $label = '💖 Soulmate'; $class = 'bg-excellent'; }
                            elseif ($score >= 70) { $label = '👍 Strong Match'; $class = 'bg-good'; }
                            elseif ($score >= 50) { $label = '👌 Compatible'; $class = 'bg-compatible'; }
                            else { $label = '🙂 Potential'; $class = 'bg-light'; }
                        @endphp

                        <!-- Matrimony Horizontal Card -->
                        <div class="matrimony-horizontal-card wow fadeInUp {{ $candidate->match_score >= 95 ? 'perfect-match-border' : '' }} flex-column flex-md-row">
                            
                                <!-- Left Image Section -->
                                <div class="card-img-left">
                                    <a href="{{ route('profile.view', ['varan_id' => $candidate->user_ID]) }}" class="d-block h-100 position-relative bg-light-soft">
                                        <img src="{{ $candidate->profileImage() }}" alt="{{ $candidate->name }}" class="profile-img-main h-100 w-100 object-fit-contain">
                                        <div class="img-overlay-bottom">
                                            <span class="badge bg-dark bg-opacity-50 text-white rounded-pill px-2 py-0 small"><i class="fas fa-camera me-1"></i> Photos</span>
                                        </div>
                                        <div class="verified-indicator">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </a>
                                </div>

                            <!-- Center Details Section -->
                            <div class="card-details-center flex-grow-1 p-3 p-md-4">
                                <div class="d-flex justify-content-between align-items-start mb-2 flex-wrap gap-2">
                                    <div class="compatibility-pill {{ $class }} rounded-pill px-3 py-1">
                                        <span class="pill-label fw-bold small">{{ $label }}</span>
                                        <span class="pill-percent small ms-2">{{ $score }}%</span>
                                    </div>
                                    <span class="text-muted small fw-bold bg-light px-2 rounded">ID: {{ $candidate->user_ID ?? 'VAR' . $candidate->id }}</span>
                                </div>
                                
                                <a href="{{ route('profile.view', ['varan_id' => $candidate->user_ID]) }}" class="text-decoration-none d-block mt-2">
                                    <h4 class="serif-font text-maroon mb-2 fs-5 fs-md-4">{{ $candidate->name }}</h4>
                                </a>
                                
                                <div class="biodata-grid row g-1 mt-2">
                                    <div class="col-6">
                                        <div class="bio-item small"><i class="fas fa-user-clock"></i> {{ \Carbon\Carbon::parse($candidate->dob)->age }} Yrs, {{ $candidate->userDetail->height ?? '5\'4"' }}</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="bio-item small"><i class="fas fa-om"></i> {{ $candidate->religion_name }}, {{ $candidate->caste_name }}</div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bio-item small"><i class="fas fa-graduation-cap"></i> {{ $candidate->education_name }}</div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bio-item small"><i class="fas fa-map-marker-alt"></i> {{ $candidate->district_name }}, {{ $candidate->state_name }}</div>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2 mt-3">
                                    @if($candidate->religion === $user->religion)
                                        <span class="badge-mini-tag"><i class="fas fa-check-circle text-success me-1"></i> Mutual Religion</span>
                                    @endif
                                    @if($candidate->caste === $user->caste)
                                        <span class="badge-mini-tag"><i class="fas fa-check-circle text-success me-1"></i> Same Caste</span>
                                    @endif
                                    
                                    @if(request('include_horoscope') == '1' && isset($candidate->horoscope_match))
                                        @php 
                                            $hMatch = $candidate->horoscope_match;
                                            $hStatus = strtolower($hMatch->Status) === 'ok' ? 'உத்தமம் (சிறந்த பொருத்தம்)' : 'அதமம் (பொருத்தம் இல்லை)';
                                            $hColor = strtolower($hMatch->Status) === 'ok' ? 'text-success' : 'text-danger';
                                            $hIcon = strtolower($hMatch->Status) === 'ok' ? 'fa-check-circle' : 'fa-times-circle';
                                        @endphp
                                        <div class="horoscope-badge-premium mt-3 bg-white border border-gold p-3 rounded-4 shadow-sm position-relative overflow-hidden" 
                                             style="border: 1px solid #D4AF37 !important; border-left: 5px solid #D4AF37 !important;">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span class="ls-1 small text-uppercase text-gold fw-bold mb-0" style="font-size: 0.6rem;">
                                                    <i class="fas fa-om me-1"></i> Horoscope Compatibility
                                                </span>
                                                <span class="badge bg-gold text-white rounded-pill px-2 py-0" style="font-size: 0.7rem;">{{ $hMatch->no_matches }}/12</span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between gap-2">
                                                <span class="small fw-bold {{ $hColor }}">
                                                    <i class="fas {{ $hIcon }} me-1"></i>
                                                    {{ $hStatus }}
                                                </span>
                                                <div class="flex-grow-1 ms-3" style="height: 6px;">
                                                    <div class="progress h-100 rounded-pill bg-light">
                                                        <div class="progress-bar bg-gold" role="progressbar" style="width: {{ ($hMatch->no_matches / 12) * 100 }}%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Right Actions Section -->
                            <div class="card-actions-right p-3 p-md-4 bg-light-soft border-start border-light d-flex flex-md-column flex-wrap gap-2 justify-content-center">
                                @php
                                    $status = $sentInterests[$candidate->id] ?? null;
                                @endphp

                                @if($status === null)
                                    <form action="{{ route('interest.send', ['id' => $candidate->id]) }}" method="POST" class="w-100">
                                        @csrf
                                        <button type="submit" class="btn btn-maroon rounded-pill w-100 py-2 small fw-bold px-3">
                                            <i class="fas fa-heart me-1"></i> Send Interest
                                        </button>
                                    </form>
                                @elseif($status == 0)
                                    <form action="{{ route('interest.cancel', ['id' => $candidate->id]) }}" method="POST" class="w-100">
                                        @csrf
                                        <button type="submit" class="btn btn-warning rounded-pill w-100 py-2 small fw-bold px-3">
                                            <i class="fas fa-clock me-1"></i> Requested
                                        </button>
                                    </form>
                                @elseif($status == 1)
                                    <button class="btn btn-success rounded-pill w-100 py-2 small fw-bold px-3 disabled">
                                        <i class="fas fa-check me-1"></i> Connected
                                    </button>
                                @elseif($status == 2)
                                    <button class="btn btn-danger rounded-pill w-100 py-2 small fw-bold px-3 disabled">
                                        <i class="fas fa-times me-1"></i> Declined
                                    </button>
                                @endif

                                @if($status == 1)
                                    <a href="{{ route('dashboard.chat') }}" class="btn btn-gold rounded-pill w-100 py-2 small fw-bold text-white text-decoration-none text-center px-3">
                                        <i class="fas fa-comment-dots me-1"></i> Chat Now
                                    </a>
                                @else
                                    <button class="btn btn-secondary rounded-pill w-100 py-2 small fw-bold px-3 disabled shadow-none" style="opacity: 0.5;">
                                        <i class="fas fa-lock me-1"></i> Chat Locked
                                    </button>
                                @endif

                                {{-- <button class="btn btn-outline-maroon rounded-pill w-100 py-2 small fw-bold bg-white px-3"><i class="fas fa-star me-1"></i> Save Profile</button> --}}
                            </div>
                        </div>
                    @endforeach
                    
                    <!-- Pagination -->
                    <div class="text-center mt-4 matches-pagination">
                        {{ $matches->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
/* CSS Variables & Theme */
:root {
    --primary-maroon: #800000;
    --primary-gold: #D4AF37;
    --text-dark: #333;
}

.text-maroon { color: var(--primary-maroon) !important; }
.text-gold { color: var(--primary-gold) !important; }
.bg-maroon { background-color: var(--primary-maroon) !important; }
.border-maroon { border-color: var(--primary-maroon) !important; }
.btn-maroon { background-color: var(--primary-maroon); color: #fff; border: none; }
.btn-maroon:hover { background-color: #600000; color: #fff; }
.btn-outline-maroon { border: 1px solid var(--primary-maroon); color: var(--primary-maroon); }
.btn-gold { background-color: var(--primary-gold); color: #fff; border: none; }
.bg-light-gold { background-color: #fdfaf0; }
.border-gold { border-color: #efdfb1 !important; }

/* Grid & Sidebar Styles */
.filter-sidebar .info-card {
    border-radius: 15px;
}

.trust-indicators-bar {
    background: #fff;
    padding: 12px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    border: 1px dashed var(--primary-gold);
}

.trust-bar-item {
    flex: 1;
    text-align: center;
    font-size: 0.85rem;
    font-weight: 600;
    color: #555;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.trust-bar-item i { color: #22c55e; }

/* Horizontal Card - Responsive Optimization */
.matrimony-horizontal-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.04);
    margin-bottom: 24px;
    border: 1px solid #f2f2f2;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.matrimony-horizontal-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(128,0,0,0.08);
    border-color: #eec9d7;
}

.card-img-left {
    width: 240px;
    min-width: 240px;
    position: relative;
    height: auto;
    min-height: 240px;
    background: #f8f8f8;
}

.profile-img-main {
    transition: transform 0.6s ease;
}

.matrimony-horizontal-card:hover .profile-img-main {
    transform: scale(1.08);
}

.img-overlay-bottom {
    position: absolute;
    bottom: 12px;
    left: 12px;
}

.verified-indicator {
    position: absolute;
    top: 12px;
    left: 12px;
    background: #fff;
    color: #16a34a;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    font-size: 1.1rem;
}

/* Compatibility Pill */
.compatibility-pill {
    background: #f8f9fa;
    border: 1px solid #eee;
}

.bg-perfect { background: #fffcf0; color: #856404; border-color: #fce7a1; }
.bg-excellent { background: #fff5f5; color: #800000; border-color: #fed7d7; }
.bg-good { background: #ebf8ff; color: #2c5282; border-color: #bee3f8; }
.bg-compatible { background: #f0fff4; color: #276749; border-color: #c6f6d5; }

.perfect-match-border {
    border: 2px solid var(--primary-gold) !important;
}

/* Bio Items */
.bio-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #4b5563;
}

.bio-item i {
    width: 16px;
    color: var(--primary-gold);
    text-align: center;
}

.badge-mini-tag {
    font-size: 0.75rem;
    background-color: #f9fafb;
    border: 1px solid #f3f4f6;
    padding: 2px 10px;
    border-radius: 6px;
    color: #6b7280;
    font-weight: 600;
}

/* Pagination Styles */
.pagination .page-link {
    color: var(--primary-maroon);
    border: none;
    margin: 0 2px;
}

.pagination .page-item.active .page-link {
    background-color: var(--primary-maroon);
    color: #fff;
}

/* 🔥 Responsive Overrides */
@media (max-width: 1199px) {
    .card-img-left { width: 200px; min-width: 200px; }
}

@media (max-width: 991px) {
    /* Tablet / iPad Mini / iPad Air view */
    .matrimony-horizontal-card { 
        margin-left: 0; 
        margin-right: 0; 
        display: flex !important;
        flex-direction: row !important; 
        flex-wrap: wrap !important; /* Allow actions to wrap to bottom */
    }
    
    .card-img-left { 
        width: 180px; 
        min-width: 180px; 
        height: 200px;
        flex-shrink: 0;
    }

    .card-details-center {
        flex: 1;
        min-width: 250px; /* Ensure details have enough room before wrapping */
        padding: 15px !important;
    }

    .card-actions-right {
        width: 100% !important; /* Forces actions to new line */
        border-left: none !important;
        border-top: 1px dashed #eee;
        flex-direction: row !important;
        padding: 12px 20px !important;
        background: #fdfdfd;
        justify-content: flex-start;
        gap: 15px !important;
    }

    .card-actions-right form, .card-actions-right a, .card-actions-right button {
        width: auto !important;
        flex: 1;
        max-width: 250px;
    }

    .profile-img-main { object-fit: contain !important; background: #fdfdfd; }
}

@media (max-width: 767px) {
    /* Mobile View */
    .matrimony-horizontal-card { 
        text-align: center; 
        flex-direction: column !important;
    }
    .card-img-left { 
        width: 100% !important;
        min-width: 100% !important;
        height: 320px !important; 
    }
    .profile-img-main {
        object-fit: contain !important; /* NO CUTTING - show fully */
        background: #fdfdfd; 
    }
    .card-actions-right { 
        flex-direction: column !important; 
        padding: 15px !important;
        width: 100% !important;
        gap: 10px !important;
    }
    .card-actions-right form, .card-actions-right a, .card-actions-right button {
        width: 100% !important;
        max-width: 100% !important;
    }
    .bio-item { justify-content: center; }
    .compatibility-pill { margin: 0 auto; }
}
</style>

    <!-- Mobile Filter Offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileFilter" aria-labelledby="mobileFilterLabel">
        <div class="offcanvas-header bg-maroon text-white">
            <h5 class="offcanvas-title serif-font" id="mobileFilterLabel">Refine Search</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @include('pages.partials._matches_filters')
        </div>
    </div>
@endsection
