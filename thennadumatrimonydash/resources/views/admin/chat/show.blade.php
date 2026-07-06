@extends('pages.layouts.default')

@section('main-content')
<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.chat.index') }}">Chat Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View History</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Participants Detail -->
        <div class="row">
            <div class="col-md-6">
                <div class="card p-3 shadow-sm border-0 border-start border-4 border-primary">
                    <div class="d-flex align-items-center">
                        <img src="{{ $conversation->userOne->profileImage() }}" class="rounded-circle me-3" width="70" height="70">
                        <div>
                            <h5 class="mb-0 fw-bold">{{ $conversation->userOne->name }}</h5>
                            <p class="text-muted mb-2">ID: {{ $conversation->userOne->user_ID }}</p>
                            <form action="{{ route('admin.chat.block', $conversation->userOne->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger btn-rounded px-4 mt-2">Block User</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3 shadow-sm border-0 border-start border-4 border-success">
                    <div class="d-flex align-items-center">
                        <img src="{{ $conversation->userTwo->profileImage() }}" class="rounded-circle me-3" width="70" height="70">
                        <div>
                            <h5 class="mb-0 fw-bold">{{ $conversation->userTwo->name }}</h5>
                            <p class="text-muted mb-2">ID: {{ $conversation->userTwo->user_ID }}</p>
                            <form action="{{ route('admin.chat.block', $conversation->userTwo->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger btn-rounded px-4 mt-2">Block User</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Full Chat History -->
        <div class="card shadow-lg border-0 mt-4 rounded-4 overflow-hidden">
            <div class="card-header bg-dark text-white p-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-white"><i class="bx bx-chat me-2"></i>Full Conversation History</h5>
                <span class="badge bg-light text-dark fw-bold">ID #{{ $conversation->id }}</span>
            </div>
            <div class="card-body bg-light-subtle p-5 overflow-auto" style="height: 600px; scrollbar-width: thin;">
                @forelse($conversation->messages as $msg)
                    @php
                        $isUserOne = $msg->sender_id === $conversation->user_one;
                    @endphp
                    <div class="message-group mb-4 d-flex flex-column {{ $isUserOne ? 'align-items-start' : 'align-items-end' }}">
                        <div class="p-3 shadow-sm {{ $isUserOne ? 'bg-primary text-white border-primary' : 'bg-white text-dark border' }} {{ $msg->flagged_by_admin ? 'border-danger border-2 scale-105 shadow-lg' : '' }}" 
                             style="max-width: 65%; border-radius: {{ $isUserOne ? '1.5rem 1.5rem 1.5rem 0.25rem' : '1.5rem 1.5rem 0.25rem 1.5rem' }}; position: relative; transition: all 0.3s ease;">
                            
                            @if($msg->flagged_by_admin)
                                <div class="badge bg-danger position-absolute top-0 end-0 m-2 rounded-pill px-3 shadow-sm">Abusive Flagged</div>
                            @endif

                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <small class="fw-bold me-2">{{ $msg->sender->name }}</small>
                                <small style="font-size: 0.75rem; opacity: 0.85;">{{ $msg->created_at->format('M d, H:i') }}</small>
                            </div>
                            <div class="message-text h6 fw-normal mb-2 leading-relaxed">
                                @php
                                    $msgContent = $msg->message;
                                    // Mask sensitive data (Simple rule: mask anything looking like mobile numbers or emails)
                                    $maskedContent = preg_replace('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}/i', '[Email Masked]', $msgContent);
                                    $maskedContent = preg_replace('/[0-9]{10,12}/', '[Contact Info Masked]', $maskedContent);
                                @endphp
                                {!! nl2br(e($maskedContent)) !!}
                            </div>
                            <div class="mt-2 pt-2 border-top border-light-opacity d-flex gap-3">
                                <button type="button" class="btn btn-sm {{ $msg->flagged_by_admin ? 'btn-light-danger' : 'btn-outline-danger' }} flag-btn border-0 fw-bold" 
                                        data-id="{{ $msg->id }}" data-flagged="{{ $msg->flagged_by_admin ? '0' : '1' }}">
                                    <i class="bx bxs-flag-alt me-1"></i> {{ $msg->flagged_by_admin ? 'Unflag' : 'Flag as Abusive' }}
                                </button>
                                <small class="text-dark bg-light px-2 py-1 rounded small">Status: {{ $msg->is_read ? 'Read' : 'Delivered' }}</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-5 text-center mt-5 text-muted h4 italic shadow-sm rounded bg-white mx-auto col-md-8">
                        <i class="bx bxs-message-dots fs-1 mb-3 text-secondary opacity-50"></i><br>
                        No messages exchanged in this conversation yet.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
    .btn-light-danger { background-color: #ffe6e6; color: #dc3545; }
    .scale-105 { transform: scale(1.02); }
    .card-body::-webkit-scrollbar { width: 8px; }
    .card-body::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>

@push('scripts')
<script>
$(document).ready(function() {
    $('.flag-btn').on('click', function() {
        const btn = $(this);
        const msgId = btn.data('id');
        const flagged = btn.data('flagged');

        $.ajax({
            url: `/admin/chat/flag/${msgId}`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                flagged: flagged
            },
            success: function(response) {
                if (response.status === 'success') {
                    location.reload();
                }
            },
            error: function() {
                alert('An error occurred during moderation.');
            }
        });
    });
});
</script>
@endpush
@endsection
