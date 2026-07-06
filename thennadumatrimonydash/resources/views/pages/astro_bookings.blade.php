@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Astro Consultations')
@section('main-content')

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Astro Consultations</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Horoscope Lead Management</li>
                        </ol>
                    </nav>
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
                                    <th class="text-center">Customer Name</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Date Received</th>
                                    <th class="text-center">Message</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consultations as $consult)
                                    <tr>
                                        <td class="text-center" style="vertical-align:middle">{{ $loop->iteration }}</td>
                                        <td class="text-center" style="vertical-align:middle">
                                            <strong>{{ $consult->name }}</strong>
                                        </td>
                                        <td class="text-center" style="vertical-align:middle">{{ $consult->phone }}</td>
                                        <td class="text-center" style="vertical-align:middle">{{ $consult->email ?? 'N/A' }}</td>
                                        <td class="text-center" style="vertical-align:middle">
                                            <form action="{{ route('astro.status', $consult->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                                    <option value="pending" {{ $consult->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="contacted" {{ $consult->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                                                    <option value="completed" {{ $consult->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td class="text-center" style="vertical-align:middle">{{ $consult->created_at->format('d M Y, h:i A') }}</td>
                                        <td class="text-center" style="vertical-align:middle">
                                            @if($consult->message)
                                                <button type="button" class="btn btn-primary btn-sm" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#astroMessageModal" 
                                                    data-bs-message="{{ $consult->message }}">
                                                    View Msg
                                                </button>
                                            @else
                                                <span class="text-muted small">No Msg</span>
                                            @endif
                                        </td>
                                        <td class="text-center" style="vertical-align:middle">
                                            <form method="POST" action="{{ route('astro.destroy', $consult->id) }}" onsubmit="return confirm('Do you want to delete this consultation record?')">
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
    <div class="modal fade" id="astroMessageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-xl">
                <div class="modal-header bg-primary text-white rounded-top-4">
                    <h5 class="modal-title serif-font">Consultation Requirement</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p id="full_message_astro" class="text-muted" style="white-space: pre-line;"></p>
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
            var astroMessageModal = document.getElementById('astroMessageModal')
            if (astroMessageModal) {
                astroMessageModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget
                    var message = button.getAttribute('data-bs-message')
                    var modalBody = astroMessageModal.querySelector('#full_message_astro')
                    modalBody.textContent = message
                })
            }
        });
    </script>
    @endsection
@endsection
