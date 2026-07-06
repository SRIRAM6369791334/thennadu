@extends('pages.layouts.default')
@section('title', 'Manage Interest Requests - Admin Dashboard')
@section('main-content')

<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Interests</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Interest Requests Management</li>
                    </ol>
                </nav>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
            <div class="text-white">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Analytics Cards -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 mb-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Interests</p>
                                <h4 class="my-1 text-info">{{ $stats['total'] }}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-light-info text-info ms-auto">
                                <i class='bx bxs-heart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Accepted Rate</p>
                                <h4 class="my-1 text-success">{{ $stats['accepted_pc'] }}%</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-light-success text-success ms-auto">
                                <i class='bx bxs-check-circle'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Rejected Rate</p>
                                <h4 class="my-1 text-danger">{{ $stats['rejected_pc'] }}%</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-light-danger text-danger ms-auto">
                                <i class='bx bxs-x-circle'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Pending Requests</p>
                                <h4 class="my-1 text-warning">{{ $stats['pending'] }}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-light-warning text-warning ms-auto">
                                <i class='bx bxs-time'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Filters & Search</h5>
                <form action="{{ url('admin/interests') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Search</label>
                        <input type="text" name="search" class="form-control" placeholder="Search Name, Email, or User ID..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Pending</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Accepted</option>
                            <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary px-4"><i class='bx bx-filter'></i> Apply</button>
                        <a href="{{ url('admin/interests') }}" class="btn btn-outline-secondary px-4">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Sender</th>
                                <th>Receiver</th>
                                <th>Status</th>
                                <th>Date Sent</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($interests as $item)
                            <tr>
                                <td>#{{ $item->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="widgets-icons-2 rounded-circle bg-light-primary text-primary me-2"><i class='bx bx-user'></i></div>
                                        <div>
                                            <h6 class="mb-0 font-14">{{ $item->sender->name ?? 'Unknown' }} 
                                                <a href="javascript:;" class="text-info view-profile-btn" data-id="{{ $item->id }}" data-type="sender"><i class="bx bx-show"></i></a>
                                            </h6>
                                            <p class="mb-0 font-13 text-secondary">{{ $item->sender->user_ID ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="widgets-icons-2 rounded-circle bg-light-danger text-danger me-2"><i class='bx bx-user'></i></div>
                                        <div>
                                            <h6 class="mb-0 font-14">{{ $item->receiver->name ?? 'Unknown' }}
                                                <a href="javascript:;" class="text-info view-profile-btn" data-id="{{ $item->id }}" data-type="receiver"><i class="bx bx-show"></i></a>
                                            </h6>
                                            <p class="mb-0 font-13 text-secondary">{{ $item->receiver->user_ID ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($item->status == 0)
                                        <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                    @elseif($item->status == 1)
                                        <span class="badge bg-success px-3 py-2">Accepted</span>
                                    @elseif($item->status == 2)
                                        <span class="badge bg-danger px-3 py-2">Rejected</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at ? $item->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                                <td>
                                    <div class="d-flex order-actions gap-2">
                                        <!-- Force Accept Button -->
                                        <form action="{{ url('admin/interests/accept/'.$item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success text-white" title="Force Accept"><i class="bx bx-check"></i></button>
                                        </form>
                                        
                                        <!-- Force Reject Button -->
                                        <form action="{{ url('admin/interests/reject/'.$item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning text-white" title="Force Reject"><i class="bx bx-x"></i></button>
                                        </form>

                                        <!-- Delete Button -->
                                        <form action="{{ url('admin/interests/'.$item->id) }}" method="POST" onsubmit="return confirm('WARNING: Are you sure you want to delete this interaction permanently?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger text-white" title="Delete Permanent"><i class="bx bx-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <img src="{{ asset('assets/images/icons/no-data.png') }}" class="mb-3" width="100">
                                    <h5 class="text-secondary">No interest requests found</h5>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $interests->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Preview Modal -->
<div class="modal fade" id="profilePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content border-top border-0 border-4 border-primary">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold"><span id="profileType"></span> Profile: <span id="profileId" class="text-primary"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modalLoading" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div id="modalContent" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-3 text-uppercase font-weight-bold">Basic Information</h6>
                            <table class="table table-sm">
                                <tr><th>Name:</th><td id="pName"></td></tr>
                                <tr><th>Gender:</th><td id="pGender"></td></tr>
                                <tr><th>DOB:</th><td id="pDob"></td></tr>
                                <tr><th>Caste:</th><td id="pCaste"></td></tr>
                                <tr><th>Status:</th><td id="pStatus"></td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3 text-uppercase font-weight-bold">Physical Details</h6>
                            <table class="table table-sm">
                                <tr><th>Height:</th><td id="pHeight"></td></tr>
                                <tr><th>Complexion:</th><td id="pComplexion"></td></tr>
                                <tr><th>Body Type:</th><td id="pBody"></td></tr>
                                <tr><th>Eating Habit:</th><td id="pEating"></td></tr>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-3 text-uppercase font-weight-bold">Education & Job</h6>
                            <table class="table table-sm">
                                <tr><th>Education:</th><td id="pEdu"></td></tr>
                                <tr><th>Occupation:</th><td id="pJob"></td></tr>
                                <tr><th>Income:</th><td id="pIncome"></td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3 text-uppercase font-weight-bold">Family Details</h6>
                            <table class="table table-sm">
                                <tr><th>Father:</th><td id="pFather"></td></tr>
                                <tr><th>Mother:</th><td id="pMother"></td></tr>
                                <tr><th>Siblings:</th><td id="pSiblings"></td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = new bootstrap.Modal(document.getElementById('profilePreviewModal'));
    const btnClass = '.view-profile-btn';

    $(document).on('click', btnClass, function() {
        const id = $(this).data('id');
        const type = $(this).data('type');
        
        $('#modalContent').hide();
        $('#modalLoading').show();
        modal.show();

        $.get(`/admin/interests/profile/${id}/${type}`, function(data) {
            const user = data.user;
            $('#profileType').text(data.type);
            $('#profileId').text(data.varan_id);

            // Populate data
            $('#pName').text(user.name);
            $('#pGender').text(user.gender);
            $('#pDob').text(user.dob);
            $('#pCaste').text(user.caste);
            $('#pStatus').text(user.status == 1 ? 'Approved' : 'Pending');

            $('#pHeight').text(user.user_detail?.height || 'N/A');
            $('#pComplexion').text(user.user_detail?.complexion || 'N/A');
            $('#pBody').text(user.user_detail?.body_type || 'N/A');
            $('#pEating').text(user.user_detail?.eating_habit || 'N/A');

            $('#pEdu').text(user.education_job?.education || 'N/A');
            $('#pJob').text(user.education_job?.job_detail || 'N/A');
            $('#pIncome').text(user.education_job?.annual_income || 'N/A');

            $('#pFather').text(user.family_detail?.father_name || 'N/A');
            $('#pMother').text(user.family_detail?.mother_name || 'N/A');
            $('#pSiblings').text(user.family_detail?.siblings_count || '0');

            $('#modalLoading').hide();
            $('#modalContent').show();
        }).fail(function() {
            alert('Failed to fetch profile details.');
            modal.hide();
        });
    });
});
</script>

@endsection
