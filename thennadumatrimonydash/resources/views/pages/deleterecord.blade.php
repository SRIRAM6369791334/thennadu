@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Delete Requests')
@section('main-content')

<div class="page-wrapper">
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Delete Account Requests</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Delete Requests</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        @if(session()->get('success'))
        <div id="swal-success" data-message="{{ session()->get('success') }}" style="display:none;"></div>
        @endif
        @if(session()->get('error'))
        <div id="swal-error" data-message="{{ session()->get('error') }}" style="display:none;"></div>
        @endif

        <!-- Stats Row -->
        @php
            $pendingCount = collect($deleterecord)->where('delete_setting', 'Pending')->count();
            $approvedCount = collect($deleterecord)->where('delete_setting', 'Approve')->count();
            $totalCount = count($deleterecord);
        @endphp
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="widgets-icons widgets-icons-2 bg-warning bg-gradient text-white rounded-3 p-3 me-3">
                                <i class="bx bx-time-five"></i>
                            </div>
                            <div>
                                <h3 class="mb-0 fw-bold">{{ $pendingCount }}</h3>
                                <p class="text-muted mb-0 small">Pending</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="widgets-icons widgets-icons-2 bg-success bg-gradient text-white rounded-3 p-3 me-3">
                                <i class="bx bx-check-shield"></i>
                            </div>
                            <div>
                                <h3 class="mb-0 fw-bold">{{ $approvedCount }}</h3>
                                <p class="text-muted mb-0 small">Approved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="widgets-icons widgets-icons-2 bg-danger bg-gradient text-white rounded-3 p-3 me-3">
                                <i class="bx bx-trash"></i>
                            </div>
                            <div>
                                <h3 class="mb-0 fw-bold">{{ $totalCount }}</h3>
                                <p class="text-muted mb-0 small">Total Requests</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Profile</th>
                                <th class="text-center">Thennadu ID</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Delete Reason</th>
                                <th class="text-center">Request Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($deleterecord as $index => $profile)
                                @php
                                    $defaultImg = asset('images/logoeng.jpeg');
                                    $profileImg = $defaultImg;
                                    if (!empty($profile->image_name)) {
                                        $checkPath = public_path('uploads/' . $profile->image_name);
                                        if (file_exists($checkPath)) {
                                            $profileImg = asset('uploads/' . $profile->image_name);
                                        }
                                    }
                                @endphp
                                <tr>
                                    <td class="text-center" style="vertical-align:middle">{{ $index + 1 }}</td>
                                    <td class="text-center" style="vertical-align:middle">
                                        <img src="{{ $profileImg }}" alt="Profile"
                                             onerror="this.src='{{ $defaultImg }}'"
                                             style="width:45px; height:45px; border-radius:50%; object-fit:cover; border:2px solid #e9ecef;">
                                    </td>
                                    <td class="text-center" style="vertical-align:middle">
                                        <span class="fw-bold">{{ $profile->varan_id }}</span>
                                    </td>
                                    <td class="text-center" style="vertical-align:middle">
                                        <span class="fw-semibold">{{ $profile->Name ?? '-' }}</span>
                                    </td>
                                    <td class="text-center" style="vertical-align:middle">
                                        <small class="text-muted">{{ $profile->email_id ?? '-' }}</small>
                                    </td>
                                    <td class="text-center" style="vertical-align:middle">
                                        <span class="badge bg-light text-dark border px-2 py-1">
                                            {{ $profile->delete_reason ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="text-center" style="vertical-align:middle">
                                        <small class="text-muted">{{ $profile->updated_at ? \Carbon\Carbon::parse($profile->updated_at)->format('d M Y, h:i A') : '-' }}</small>
                                    </td>
                                    <td class="text-center" style="vertical-align:middle">
                                        @if($profile->delete_setting == 'Approve')
                                            <span class="badge bg-success rounded-pill px-3 py-2"><i class="bx bx-check-circle me-1"></i>Approved</span>
                                        @elseif($profile->delete_setting == 'Pending')
                                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2"><i class="bx bx-time-five me-1"></i>Pending</span>
                                        @else
                                            <span class="badge bg-secondary rounded-pill px-3 py-2">N/A</span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align:middle">
                                        @if($profile->delete_setting == 'Pending')
                                            <button class="btn btn-success btn-sm me-1 approve-btn"
                                                    data-id="{{ $profile->varan_id }}"
                                                    data-name="{{ $profile->Name ?? 'User' }}">
                                                <i class="bx bx-check"></i> Approve
                                            </button>
                                            <button class="btn btn-danger btn-sm reject-btn"
                                                    data-id="{{ $profile->varan_id }}"
                                                    data-name="{{ $profile->Name ?? 'User' }}">
                                                <i class="bx bx-x"></i> Reject
                                            </button>
                                        @elseif($profile->delete_setting == 'Approve')
                                            <span class="text-success fw-semibold"><i class="bx bx-check-circle font-size-18"></i></span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bx bx-trash font-size-48 text-light mb-2"></i>
                                            <h6 class="text-muted">No delete requests found</h6>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    // SweetAlert Flash Messages
    var swalSuccess = document.getElementById('swal-success');
    var swalError = document.getElementById('swal-error');
    if (swalSuccess) {
        Swal.fire({ icon: 'success', title: 'Success', text: swalSuccess.dataset.message, confirmButtonColor: '#8B0000' });
    }
    if (swalError) {
        Swal.fire({ icon: 'error', title: 'Error', text: swalError.dataset.message, confirmButtonColor: '#8B0000' });
    }

    // Approve Button
    document.querySelectorAll('.approve-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var varanId = this.getAttribute('data-id');
            var userName = this.getAttribute('data-name');

            Swal.fire({
                title: 'Approve Delete?',
                html: 'Are you sure you want to permanently delete <strong>"' + userName + '"</strong> (' + varanId + ')?<br><br><small class="text-danger">All data will be removed and cannot be recovered.</small>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#8B0000',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="bx bx-trash me-1"></i> Yes, Delete',
                cancelButtonText: 'Cancel'
            }).then(function(result) {
                if (result.isConfirmed) {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/deletestatuschange';
                    form.innerHTML = '<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="status" value="Approve"><input type="hidden" name="prid" value="' + varanId + '">';
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });

    // Reject Button
    document.querySelectorAll('.reject-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var varanId = this.getAttribute('data-id');
            var userName = this.getAttribute('data-name');

            Swal.fire({
                title: 'Reject Delete Request?',
                html: 'Reject the delete request for <strong>"' + userName + '"</strong>?<br><br><small>Their account will remain active.</small>',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#8B0000',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="bx bx-x me-1"></i> Reject Request',
                cancelButtonText: 'Cancel'
            }).then(function(result) {
                if (result.isConfirmed) {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/deletestatuschange';
                    form.innerHTML = '<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="status" value="Pending"><input type="hidden" name="prid" value="' + varanId + '">';
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });

});
</script>
@endsection
