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
                    <h3 class="serif-font mb-0 text-dark">Profile Visitors</h3>
                    <span class="text-muted small">Showing last 20 visitors</span>
                </div>

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                    <!-- Desktop Table View -->
                    <div class="table-responsive d-none d-md-block">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 text-muted x-small text-uppercase ls-1 fw-bold border-0">Visitor</th>
                                    <th class="py-3 text-muted x-small text-uppercase ls-1 fw-bold border-0">Details</th>
                                    <th class="py-3 text-muted x-small text-uppercase ls-1 fw-bold border-0">Visited On</th>
                                    <th class="pe-4 py-3 text-end text-muted x-small text-uppercase ls-1 fw-bold border-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($visitors as $visitor)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            @php
                                            $image = DB::table('images')->where('varanid', $visitor->varan_id)->where('image_status', 'Main')->first();
                                            $imagePath = $image ? asset('uploads/' . $image->image_name) : asset('assets/images/matri/men.png');
                                            @endphp
                                            <img src="{{ $imagePath }}" class="rounded-circle shadow-sm" style="width: 45px; height: 45px; object-fit: cover;">
                                            <div>
                                                <h6 class="mb-0 x-small fw-bold">{{ $visitor->Name }}</h6>
                                                <span class="xx-small text-muted">ID: {{ $visitor->varan_id }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="xx-small text-dark fw-500">{{ $visitor->age }} Yrs | {{ $visitor->district }} | {{ $visitor->job_detail }}</span>
                                    </td>
                                    <td>
                                        @php
                                        $visitTime = DB::table('trackings')
                                        ->where('partner_varan_id', auth()->user()->varan_id)
                                        ->where('user_varan_id', $visitor->varan_id)
                                        ->latest()
                                        ->first();
                                        @endphp
                                        <span class="xx-small text-muted"><i class="far fa-clock me-1"></i> {{ \Carbon\Carbon::parse($visitTime->created_at)->diffForHumans() }}</span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('profile.view', $visitor->varan_id) }}" class="btn btn-outline-maroon btn-sm rounded-pill px-3 xx-small">View Profile</a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted small">No profile visitors yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="d-md-none">
                        @foreach($visitors as $visitor)
                        <div class="p-3 border-bottom">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                @php
                                $image = DB::table('images')->where('varanid', $visitor->varan_id)->where('image_status', 'Main')->first();
                                $imagePath = $image ? asset('uploads/' . $image->image_name) : asset('assets/images/matri/men.png');
                                @endphp
                                <img src="{{ $imagePath }}" class="rounded-circle shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 small fw-bold">{{ $visitor->Name }}</h6>
                                    <p class="text-muted xx-small mb-0">{{ $visitor->age }}Y | {{ $visitor->district }} | {{ $visitor->job_detail }}</p>
                                </div>
                                <div class="text-end">
                                    @php
                                    $visitTime = DB::table('trackings')
                                    ->where('partner_varan_id', auth()->user()->varan_id)
                                    ->where('user_varan_id', $visitor->varan_id)
                                    ->latest()
                                    ->first();
                                    @endphp
                                    <span class="xx-small text-muted d-block">{{ \Carbon\Carbon::parse($visitTime->created_at)->format('d M') }}</span>
                                    <span class="xx-small text-muted d-block">{{ \Carbon\Carbon::parse($visitTime->created_at)->format('h:i A') }}</span>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('profile.view', $visitor->varan_id) }}" class="btn btn-maroon btn-sm rounded-pill flex-grow-1 xx-small py-2 border-0 shadow-sm text-center">View Profile</a>
                            </div>
                        </div>
                        @endforeach
                        @if($visitors->isEmpty())
                        <div class="p-5 text-center text-muted small">No profile visitors yet.</div>
                        @endif
                    </div>
                </div>

                <div class="mt-4 p-3 p-md-4 rounded-4 bg-maroon text-white shadow-sm d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div class="text-center text-md-start">
                        <h5 class="serif-font mb-1 text-black">Upgrade to Premium!</h5>
                        <p class="mb-0 small opacity-75 text-dark">
                            See who exactly is visiting your profile & get more visibility.
                        </p>
                    </div>
                    <a href="{{ url('/plans') }}" class="btn btn-gold px-4 rounded-pill fw-bold text-dark shadow-sm py-2">View Plans</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .ls-1 {
        letter-spacing: 1px;
    }

    .xx-small {
        font-size: 0.65rem;
    }

    .x-small {
        font-size: 0.8rem;
    }

    .smaller {
        font-size: 0.75rem;
    }

    .fw-500 {
        font-weight: 500;
    }

    .text-maroon {
        color: #900C3F !important;
    }

    .btn-outline-maroon {
        color: #900C3F;
        border: 1.5px solid #900C3F;
    }

    .btn-gold {
        background-color: #D4AF37;
        border: none;
    }

    .btn-gold:hover {
        background-color: #b8952d;
    }

    .shadow-xs {
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .table-hover tbody tr:hover {
        background-color: #fdf8f9;
    }
</style>
@endsection