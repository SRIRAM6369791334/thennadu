@extends('pages.layouts.default')
@section('title', 'Thennadu Matrimony - Dashboard')
@section('main-content')

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
                <div class="breadcrumb-title pe-3">Search Results</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Matching Profiles</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <a href="/matches" class="btn btn-outline-primary radius-30 px-4">
                        <i class="bx bx-search-alt mr-1"></i> New Search
                    </a>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
                @forelse ($register as $profiles)
                    <div class="col">
                        <div class="card radius-15 profile-card border-top border-0 border-4 border-primary">
                            <div class="card-body text-center">
                                <div class="profile-image-wrapper mb-3">
                                    @php
                                        $imgPath = $profiles->image_name ? 'https://mobilevaran.varan2varan.com/public/images/'.$profiles->image_name : 'assets/images/placeholder-profile.jpg';
                                    @endphp
                                    <img src="{{ $imgPath }}" 
                                         class="rounded-circle p-1 border shadow-sm" 
                                         width="120" height="120"
                                         style="object-fit: cover; border: 3px solid #673ab7 !important;"
                                         onerror="this.src='/assets/images/avatars/avatar-1.png'">
                                </div>
                                <h5 class="mb-1 mt-3 font-weight-bold text-dark">{{ $profiles->Name }}</h5>
                                <div class="mb-2">
                                    <span class="badge bg-light-primary text-primary radius-10 px-3">{{ $profiles->Caste_name ?: 'N/A' }}</span>
                                    <span class="text-secondary font-size-13 d-block mt-1">{{ $profiles->varan_id }}</span>
                                </div>
                                
                                <div class="profile-details-grid my-3 px-2">
                                    <div class="row g-2 text-start">
                                        <div class="col-6">
                                            <div class="p-2 border radius-10 bg-light-blue shadow-sm-hover transition-all h-100">
                                                <small class="text-muted d-block font-size-10 uppercase tracking-tighter">Gender & Age</small>
                                                <span class="fw-bold fs-6">{{ $profiles->Gender }}, {{ $profiles->age }} yrs</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="p-2 border radius-10 bg-light-blue shadow-sm-hover transition-all h-100">
                                                <small class="text-muted d-block font-size-10 uppercase tracking-tighter">Occupation</small>
                                                <span class="fw-bold d-block text-truncate fs-6" title="{{ $profiles->job_cat ?: 'Public/Private' }}">{{ $profiles->job_cat ?: 'Private' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="p-2 border radius-10 bg-light-gold shadow-sm-hover transition-all h-100">
                                                <small class="text-muted d-block font-size-10 uppercase tracking-tighter">Star & Rasi</small>
                                                <span class="fw-bold d-block fs-6">{{ $profiles->star_name ?: 'N/A' }} / {{ $profiles->rasi_name ?: 'N/A' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="p-2 border radius-10 bg-light-blue shadow-sm-hover transition-all h-100">
                                                <small class="text-muted d-block font-size-10 uppercase tracking-tighter">Location</small>
                                                <span class="fw-bold d-block text-truncate fs-6" title="{{ $profiles->city_name }}, {{ $profiles->state_name }}"><i class="bx bx-map-pin text-danger"></i> {{ $profiles->city_name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid mt-4">
                                    <a href="{{ route('profiles.show', $profiles->id) }}" class="btn btn-primary radius-30 shadow-sm border-0 bg-gradient-deepblue pulse-hover">
                                        <i class="bx bx-show-alt mr-1"></i> View Full Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="card radius-15 p-5 shadow-lg border-0 bg-white mx-auto" style="max-width: 600px;">
                            <i class="bx bx-search-alt-2 display-1 text-primary-light opacity-50 mb-4"></i>
                            <h3 class="text-dark font-weight-bold">No Profiles Match Your Search</h3>
                            <p class="text-muted mb-4 fs-5">Try widening your search criteria to find your perfect match. Maybe adjust the age or location filters.</p>
                            <div>
                                <a href="/matches" class="btn btn-primary btn-lg radius-30 px-5 shadow-sm transform-hover">
                                    <i class="bx bx-undo mr-1"></i> Refine Search Settings
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <style>
        .profile-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            overflow: hidden;
            background: #fff;
            border: none !important;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .profile-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12) !important;
        }
        .bg-gradient-deepblue {
            background: #6a11cb;
            background: -webkit-linear-gradient(45deg, #6a11cb, #2575fc) !important;
            background: linear-gradient(45deg, #6a11cb, #2575fc) !important;
        }
        .bg-light-blue { background-color: #f8f9ff !important; }
        .bg-light-gold { background-color: #fffdf2 !important; border-color: #ffeeb3 !important; }
        .bg-light-primary { background-color: #f0f7ff !important; border: 1px solid #c2e0ff !important; }
        .radius-15 { border-radius: 15px; }
        .radius-10 { border-radius: 10px; }
        .radius-30 { border-radius: 30px; }
        .fw-bold { font-weight: 700; }
        .fs-6 { font-size: 0.95rem !important; }
        .font-size-10 { font-size: 10px !important; }
        .uppercase { text-transform: uppercase; }
        .tracking-tighter { letter-spacing: -0.01em; }
        .transition-all { transition: all 0.2s ease; }
        .shadow-sm-hover:hover { box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .text-primary-light { color: #6a11cb; }
        .pulse-hover:hover { animation: pulse 1s infinite; }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(106, 17, 203, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(106, 17, 203, 0); }
            100% { box-shadow: 0 0 0 0 rgba(106, 17, 203, 0); }
        }
        .transform-hover { transition: transform 0.2s; }
        .transform-hover:hover { transform: scale(1.05); }
    </style>
@endsection




