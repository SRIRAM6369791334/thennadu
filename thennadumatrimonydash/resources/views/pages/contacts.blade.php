@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Contact Enquiries')
@section('main-content')

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Contact Enquiries</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Contact Enquiries</li>
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
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Subject</th>
                                    <th class="text-center">Date Received</th>
                                    <th class="text-center">Message</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td class="text-center" style="vertical-align:middle">{{ $loop->iteration }}</td>
                                        <td class="text-center" style="vertical-align:middle">
                                            <strong>{{ $contact->name }}</strong>
                                        </td>
                                        <td class="text-center" style="vertical-align:middle">{{ $contact->email }}</td>
                                        <td class="text-center" style="vertical-align:middle">{{ $contact->subject }}</td>
                                        <td class="text-center" style="vertical-align:middle">{{ \Carbon\Carbon::parse($contact->created_at)->format('d M Y, h:i A') }}</td>
                                        <td class="text-center" style="vertical-align:middle">
                                            @if($contact->message)
                                                <button type="button" class="btn btn-primary btn-sm" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#contactMessageModal" 
                                                    data-bs-message="{{ $contact->message }}">
                                                    View Msg
                                                </button>
                                            @else
                                                <span class="text-muted small">No Msg</span>
                                            @endif
                                        </td>
                                        <td class="text-center" style="vertical-align:middle">
                                            <form method="POST" action="{{ route('contacts.destroy', $contact->id) }}" onsubmit="return confirm('Do you want to delete this contact enquiry?')">
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
    <div class="modal fade" id="contactMessageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-xl">
                <div class="modal-header bg-primary text-white rounded-top-4">
                    <h5 class="modal-title serif-font">Contact Enquiry Message</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p id="full_message_contact" class="text-muted" style="white-space: pre-line;"></p>
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
            var contactMessageModal = document.getElementById('contactMessageModal')
            if (contactMessageModal) {
                contactMessageModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget
                    var message = button.getAttribute('data-bs-message')
                    var modalBody = contactMessageModal.querySelector('#full_message_contact')
                    modalBody.textContent = message
                })
            }
        });
    </script>
    @endsection
@endsection
