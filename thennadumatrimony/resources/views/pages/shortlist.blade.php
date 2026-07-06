@extends('layout.default')

@section('content')
<div class="dashboard-wrapper py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-md-4 col-lg-3">
                @include('layout.dashboard_sidebar')
            </div>

            <!-- Right Content -->
            <div class="col-md-8 col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="serif-font mb-0 text-dark">Shortlisted Profiles</h3>
                    <span class="badge bg-maroon rounded-pill px-3 py-2">8 Profiles Saved</span>
                </div>

                <div class="row g-3 g-md-4">
                    @for($i = 1; $i <= 4; $i++)
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden shortlist-card bg-white">
                            <div class="card-body p-2 p-sm-3">
                                <div class="row align-items-center g-2 g-sm-3">
                                    <div class="col-auto">
                                        <div class="position-relative">
                                            <img src="{{ asset('assets/images/matri/' . ($i % 2 == 0 ? 'cheerful-traditional-indian-woman-white-background-studio-shot.jpg' : 'portrait-beautiful-woman-wearing-traditional-sari-garment.jpg')) }}" 
                                                 class="rounded-4 shadow-sm shortlist-img" style="width: 80px; height: 80px; object-fit: cover;">
                                            <button class="btn btn-danger btn-sm rounded-circle position-absolute top-0 end-0 m-0 shadow-sm border-2 border-white" style="width: 24px; height: 24px; padding: 0;" title="Remove">
                                                <i class="fas fa-times" style="font-size: 0.6rem;"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col overflow-hidden">
                                        <h6 class="serif-font mb-1 text-dark text-truncate small fw-bold">Sushmitha Raj {{ $i }}</h6>
                                        <p class="text-muted xx-small mb-2">25Y | 5'5" | Coimbatore</p>
                                        
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-maroon btn-sm flex-grow-1 rounded-pill xx-small">Connect</button>
                                            <a href="{{ url('profile') }}" class="btn btn-outline-maroon btn-sm rounded-pill xx-small px-3">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>

                @if(false) <!-- Just for logic visual -->
                <div class="text-center py-5">
                    <div class="empty-state-icon bg-light text-muted rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                        <i class="fas fa-star fa-3x"></i>
                    </div>
                    <h5 class="text-muted">Your shortlist is empty</h5>
                    <p class="text-muted small">Browse matches and click the star icon to save profiles here.</p>
                    <a href="{{ route('dashboard.matches') }}" class="btn btn-maroon rounded-pill px-4">Browse Matches</a>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

<style>
    .shortlist-card { transition: all 0.3s ease; }
    .shortlist-card:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important; }
    .xx-small { font-size: 0.65rem; }
    .x-small { font-size: 0.8rem; }
    .fw-500 { font-weight: 500; }
    .text-maroon { color: #900C3F !important; }
    .btn-maroon { background: #900C3F; color: #fff; border: none; }
    .btn-outline-maroon { color: #900C3F; border: 1.5px solid #900C3F; }
</style>
