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
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="interests-page shadow-sm rounded-4 bg-white p-4">
                    <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom">
                        <div>
                            <h2 class="serif-font text-maroon mb-1 fw-bold">Interest Management</h2>
                            <p class="text-muted small mb-0"><i class="fas fa-info-circle me-1"></i> Manage your connections and pending matching requests</p>
                        </div>
                    </div>

                    <!-- Stats Overview -->
                    <div class="row g-4 mb-5">
                        <div class="col-md-4">
                            <div class="card border-0 rounded-4 p-4 text-white h-100 shadow-sm transition-all" style="background: linear-gradient(135deg, #900C3F 0%, #C70039 100%);">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 70px; height: 70px; min-width: 70px;">
                                        <i class="fas fa-paper-plane fs-2" style="color: #900C3F;"></i>
                                    </div>
                                    <div>
                                        <h2 class="mb-0 fw-bold lh-1">{{ $sentRequests->count() }}</h2>
                                        <span class="xx-small opacity-75 ls-1 text-uppercase fw-600">Interests Sent</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 rounded-4 p-4 text-white h-100 shadow-sm transition-all" style="background: linear-gradient(135deg, #D4AF37 0%, #AA8D23 100%);">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 70px; height: 70px; min-width: 70px;">
                                        <i class="fas fa-inbox fs-2" style="color: #AA8D23;"></i>
                                    </div>
                                    <div>
                                        <h2 class="mb-0 fw-bold lh-1">{{ $receivedRequests->count() }}</h2>
                                        <span class="xx-small opacity-75 ls-1 text-uppercase fw-600">Interests Received</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 rounded-4 p-4 text-white h-100 shadow-sm transition-all" style="background: linear-gradient(135deg, #198754 0%, #116741 100%);">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 70px; height: 70px; min-width: 70px;">
                                        <i class="fas fa-heartbeat fs-2" style="color: #116741;"></i>
                                    </div>
                                    <div>
                                        <h2 class="mb-0 fw-bold lh-1">{{ $receivedRequests->where('status', 1)->count() + $sentRequests->where('status', 1)->count() }}</h2>
                                        <span class="xx-small opacity-75 ls-1 text-uppercase fw-600">Mutual Connections</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs for Sent/Received -->
                    <div class="d-flex justify-content-center mb-5">
                        <ul class="nav nav-pills bg-light p-1 rounded-pill shadow-sm" id="interestTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active rounded-pill px-5 fw-bold" id="received-tab" data-bs-toggle="pill" data-bs-target="#received" type="button" role="tab">
                                    <i class="fas fa-download me-2"></i> Received <span class="ms-2 px-2 py-1 bg-maroon rounded-circle" style="font-size: 0.7rem;">{{ $receivedRequests->where('status', 0)->count() }}</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-pill px-5 fw-bold" id="sent-tab" data-bs-toggle="pill" data-bs-target="#sent" type="button" role="tab">
                                    <i class="fas fa-upload me-2"></i> Sent Requests
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="interestTabsContent">
                        <!-- Received Interests -->
                        <div class="tab-pane fade show active" id="received" role="tabpanel">
                            @if($receivedRequests->isEmpty())
                                <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-light">
                                    <div class="mb-3 text-muted opacity-25">
                                        <i class="fas fa-user-circle fa-5x"></i>
                                    </div>
                                    <h4 class="fw-bold">No Interests Received Yet</h4>
                                    <p class="text-muted">Once someone expresses interest, they will appear here.</p>
                                </div>
                            @else
                                <div class="row g-4">
                                    @foreach($receivedRequests as $request)
                                        <div class="col-md-6">
                                            <div class="card border shadow-none rounded-4 overflow-hidden h-100 request-card">
                                                <div class="d-flex p-4 gap-4 align-items-center">
                                                    <div class="request-img position-relative">
                                                        <img src="{{ $request->sender->profileImage() }}" class="rounded-circle border border-3 border-light shadow-sm" width="85" height="85" alt="{{ $request->sender->name }}" style="object-fit: cover;">
                                                        @if($request->status == 1)
                                                            <div class="position-absolute bottom-0 end-0 bg-success text-white rounded-circle d-flex align-items-center justify-content-center border border-2 border-white" style="width: 25px; height: 25px; font-size: 0.7rem;">
                                                                <i class="fas fa-check"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex justify-content-between align-items-start mb-1">
                                                            <h5 class="mb-0 text-dark fw-bold">{{ $request->sender->name }}</h5>
                                                            @if($request->status == 0)
                                                                <span class="badge bg-opacity-10 text-warning xx-small px-3 border border-warning border-opacity-10">PENDING</span>
                                                            @endif
                                                        </div>
                                                        @php
                                                            $senderAge = $request->sender->dob ? \Carbon\Carbon::parse($request->sender->dob)->age : 'N/A';
                                                        @endphp
                                                        <p class="text-muted small mb-3">
                                                            {{ $senderAge }} Yrs • {{ $request->sender->religion }} • {{ $request->sender->district }}
                                                        </p>
                                                        
                                                        @if($request->status == 0)
                                                            <div class="d-flex gap-3 mt-2">
                                                                <form action="{{ route('interest.accept', $request->id) }}" method="POST" class="flex-grow-1">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-maroon btn-sm w-100 rounded-pill fw-bold py-2 shadow-sm"><i class="fas fa-check me-1"></i> Accept</button>
                                                                </form>
                                                                <form action="{{ route('interest.reject', $request->id) }}" method="POST" class="flex-grow-1">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-outline-secondary btn-sm w-100 rounded-pill py-2"><i class="fas fa-times me-1"></i> Decline</button>
                                                                </form>
                                                            </div>
                                                        @elseif($request->status == 1)
                                                            <div class="d-flex justify-content-between align-items-center   mt-2 border-top pt-3">
                                                                <span class="text-success fw-bold small">
                                                                    <i class="fas fa-check-circle me-1 text-white"></i> Connected
                                                                </span>
                                                                <a href="{{ route('chat.start', $request->sender->id) }}" class="btn btn-gold btn-sm rounded-pill text-white px-4 fw-bold shadow-sm"><i class="fas fa-comments me-1"></i> Chat Now</a>
                                                            </div>
                                                        @else
                                                            <div class="mt-2 border-top pt-3 text-center">
                                                                <span class="text-danger small opacity-75">
                                                                    <i class="fas fa-user-slash me-1"></i> Interest Declined
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Sent Interests -->
                        <div class="tab-pane fade" id="sent" role="tabpanel">
                            @if($sentRequests->isEmpty())
                                <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-light">
                                    <div class="mb-3 text-muted opacity-25">
                                        <i class="fas fa-paper-plane fa-5x"></i>
                                    </div>
                                    <h4 class="fw-bold">No Sent Requests</h4>
                                    <p class="text-muted">Start exploring matches and send interests to connect!</p>
                                </div>
                            @else
                                <div class="row g-4">
                                    @foreach($sentRequests as $request)
                                        <div class="col-md-6">
                                            <div class="card border shadow-none rounded-4 overflow-hidden h-100 request-card">
                                                <div class="d-flex p-4 gap-4 align-items-center">
                                                    <div class="request-img position-relative">
                                                        <img src="{{ $request->receiver->profileImage() }}" class="rounded-circle border border-3 border-light shadow-sm" width="85" height="85" alt="{{ $request->receiver->name }}" style="object-fit: cover;">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex justify-content-between align-items-start mb-1">
                                                            <h5 class="mb-0 text-dark fw-bold">{{ $request->receiver->name }}</h5>
                                                            @if($request->status == 1)
                                                                <span class="badge bg-success bg-opacity-10 text-success text-white xx-small px-3 border border-success border-opacity-10">CONNECTED</span>
                                                            @endif
                                                        </div>
                                                        @php
                                                            $receiverAge = $request->receiver->dob ? \Carbon\Carbon::parse($request->receiver->dob)->age : 'N/A';
                                                        @endphp
                                                        <p class="text-muted small mb-3">{{ $receiverAge }} Yrs • {{ $request->receiver->religion }} • {{ $request->receiver->district }}</p>
                                                        
                                                        @if($request->status == 0)
                                                            <div class="d-flex align-items-center justify-content-between mt-2 border-top pt-3">
                                                                <span class="text-muted small"><i class="fas fa-clock me-1"></i> Request Pending</span>
                                                                <form action="{{ route('interest.cancel', $request->receiver_id) }}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-link text-danger text-decoration-none p-0 small fw-bold">Cancel Request</button>
                                                                </form>
                                                            </div>
                                                        @elseif($request->status == 1)
                                                            <div class="d-flex justify-content-between align-items-center mt-2 border-top pt-3">
                                                                <span class="text-success fw-bold small">
                                                                    <i class="fas fa-heart me-1"></i> Connection Established
                                                                </span>
                                                                <a href="{{ route('chat.start', $request->receiver->id) }}" class="btn btn-gold btn-sm rounded-pill text-white px-4 fw-bold shadow-sm">Chat Now</a>
                                                            </div>
                                                        @else
                                                            <div class="mt-2 border-top pt-3 text-center">
                                                                <span class="text-danger small opacity-75">
                                                                    <i class="fas fa-times-circle me-1"></i> Declined by User
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-maroon { background-color: #900C3F !important; }
.text-maroon { color: #900C3F !important; }
.bg-gold { background-color: #D4AF37 !important; }
.bg-success-soft { background-color: rgba(25, 135, 84, 0.1) !important; }
.bg-danger-soft { background-color: rgba(220, 53, 69, 0.1) !important; }
.xx-small { font-size: 0.65rem; }
.ls-1 { letter-spacing: 1px; }

.nav-pills .nav-link { color: #555; padding: 12px 35px; border: 1px solid transparent; transition: all 0.3s ease; }
.nav-pills .nav-link.active { background-color: #900C3F !important; color: white !important; box-shadow: 0 5px 15px rgba(144, 12, 63, 0.3); }

.request-card { transition: all 0.3s cubic-bezier(.25,.8,.25,1); border: 1px solid #f0f0f0 !important; cursor: default; }
.request-card:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important; border-color: rgba(144, 12, 63, 0.15) !important; }

.card-header-premium { background: linear-gradient(to right, #900C3F, #C70039); }
.btn-gold { background-color: #D4AF37; border-color: #D4AF37; color: white; }
.btn-gold:hover { background-color: #AA8D23; border-color: #AA8D23; color: white; }

.object-fit-cover { object-fit: cover; }
</style>
@endsection
