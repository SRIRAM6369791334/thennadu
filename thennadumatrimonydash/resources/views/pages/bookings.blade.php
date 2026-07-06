@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Service Bookings')
@section('main-content')

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Service Bookings</div>
                <div class="ps-3">
                </div>
            </div>
            
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session()->get('success')}}
                <button type="button" class="btn-close" data-bs-alert="alert" aria-label="Close"></button>
              </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Service</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Mobile</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Message</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td class="text-center" style="vertical-align:middle">{{ $loop->iteration }}</td>
                                        <td class="text-center" style="vertical-align:middle">
                                            <strong>{{ $booking->service->title ?? 'N/A' }}</strong>
                                        </td>
                                        <td class="text-center" style="vertical-align:middle">{{ $booking->name }}</td>
                                        <td class="text-center" style="vertical-align:middle">{{ $booking->mobile }}</td>
                                        <td class="text-center" style="vertical-align:middle">{{ $booking->date ? date('d-m-Y', strtotime($booking->date)) : 'N/A' }}</td>
                                        <td class="text-center" style="vertical-align:middle">
                                            <form action="{{ route('bookings.status', $booking->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                    <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td class="text-center" style="vertical-align:middle">
                                            @if($booking->message)
                                                <button type="button" class="btn btn-info btn-sm text-white" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#messageModal" 
                                                    data-bs-message="{{ $booking->message }}">
                                                    View Msg
                                                </button>
                                            @else
                                                <span class="text-muted small">No Msg</span>
                                            @endif
                                        </td>
                                        <td class="text-center" style="vertical-align:middle">
                                            <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}" onsubmit="return confirm('Do you want to delete this booking?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Message Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-xl">
                <div class="modal-header bg-info text-white rounded-top-4">
                    <h5 class="modal-title serif-font">Client Message</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p id="full_message" class="text-muted" style="white-space: pre-line;"></p>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @section('script')
    <script>
        $(document).ready(function() {
            var messageModal = document.getElementById('messageModal')
            if (messageModal) {
                messageModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget
                    var message = button.getAttribute('data-bs-message')
                    var modalBody = messageModal.querySelector('#full_message')
                    modalBody.textContent = message
                })
            }
        });
    </script>
    @endsection
@endsection
