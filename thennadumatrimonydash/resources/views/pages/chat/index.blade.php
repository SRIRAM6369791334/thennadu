@extends('pages.layouts.default')

@section('main-content')
<div class="chat-main-container py-5 bg-light" style="min-height: calc(100vh - 150px);">
    <div class="page-content">
        <div class="row g-0 rounded-4 overflow-hidden shadow-lg bg-white" style="height: 750px;">
            <!-- Left Sidebar -->
            <div class="col-md-4 col-lg-3 border-end bg-white">
                <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-bold">Recent Chats</h5>
                    <button class="btn btn-sm btn-outline-primary rounded-circle">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
                
                <div class="conversation-list overflow-auto" style="height: calc(100% - 65px);">
                    @forelse($conversations as $conv)
                        @php
                            $otherUser = $conv->user_one == auth()->id() ? $conv->userTwo : $conv->userOne;
                            $isActive = isset($conversation) && $conversation->id == $conv->id;
                        @endphp
                        <a href="{{ route('chat.show', $conv->id) }}" class="conversation-item d-flex align-items-center p-3 text-decoration-none border-bottom {{ $isActive ? 'bg-primary-subtle active border-start border-4 border-primary' : '' }}">
                            <div class="avatar-wrapper position-relative me-3">
                                <img src="{{ $otherUser->profileImage() }}" 
                                     class="rounded-circle" width="45" height="45" alt="{{ $otherUser->name }}">
                                <span class="position-absolute bottom-0 end-0 bg-success border border-white border-2 rounded-circle p-1"></span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 text-dark fw-bold text-truncate">{{ $otherUser->name }}</h6>
                                    <small class="text-muted">{{ $conv->lastMessage ? $conv->lastMessage->created_at->diffForHumans(null, true) : '' }}</small>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <p class="mb-0 text-muted small text-truncate">
                                        {{ $conv->lastMessage ? $conv->lastMessage->message : 'No messages yet' }}
                                    </p>
                                    @if($conv->messages()->where('sender_id', '!=', auth()->id())->where('is_read', false)->count() > 0)
                                        <span class="badge rounded-pill bg-danger ms-1">
                                            {{ $conv->messages()->where('sender_id', '!=', auth()->id())->where('is_read', false)->count() }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="p-4 text-center mt-5">
                            <i class="fas fa-comments fs-2 text-muted mb-3"></i>
                            <p class="text-muted">No conversations yet.<br><small>Connect with others to start chatting!</small></p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Chat Area -->
            <div class="col-md-8 col-lg-9 d-flex flex-column bg-white">
                @if(isset($conversation))
                    @php
                        $otherUser = $conversation->user_one == auth()->id() ? $conversation->userTwo : $conversation->userOne;
                    @endphp
                    <!-- Header -->
                    <div class="p-3 border-bottom d-flex align-items-center justify-content-between shadow-sm bg-white position-relative z-1">
                        <div class="d-flex align-items-center">
                            <img src="{{ $otherUser->profileImage() }}" 
                                 class="rounded-circle me-3 border border-primary border-2 p-0.5" width="45" height="45">
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $otherUser->name }}</h6>
                                <div class="d-flex align-items-center">
                                    <span class="bg-success rounded-circle p-1 me-2"></span>
                                    <small class="text-muted">Online</small>
                                </div>
                            </div>
                        </div>
                        <div class="actions">
                            <button class="btn btn-sm btn-light rounded-circle me-1" title="Block User">
                                <i class="fas fa-ban text-muted"></i>
                            </button>
                            <button class="btn btn-sm btn-light rounded-circle" title="Report">
                                <i class="fas fa-flag text-muted"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Messages -->
                    <div id="message-container" class="flex-grow-1 overflow-auto p-4 bg-light bg-opacity-10">
                        @foreach($messages as $message)
                            @include('pages.chat.partials.message', ['message' => $message])
                        @endforeach
                    </div>

                    <!-- Footer / Input -->
                    <div class="p-3 border-top bg-white">
                        <form id="chat-form" action="{{ route('chat.send') }}" method="POST">
                            @csrf
                            <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                            <div class="input-group">
                                <button class="btn btn-light border" type="button">
                                    <i class="far fa-smile fs-5"></i>
                                </button>
                                <textarea name="message" id="chat-input" class="form-control border-start-0 border-end-0 py-2" placeholder="Write a message..." rows="1" style="resize: none;"></textarea>
                                <button type="submit" class="btn btn-primary px-4" id="send-btn">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="card-body d-flex flex-column align-items-center justify-content-center h-100 bg-light-subtle">
                        <div class="text-center">
                            <div class="mb-4">
                                <div class="bg-primary-subtle rounded-circle d-inline-flex align-items-center justify-content-center p-5 mb-3 shadow-sm">
                                    <i class="fas fa-comments fs-1 text-primary animate__animated animate__bounceIn"></i>
                                </div>
                                <h3 class="fw-bold mt-3">Select a conversation</h3>
                                <p class="text-muted max-w-xs mx-auto">Choose a match from the list on the left to start chatting and get to know them better.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .chat-main-container {
        font-family: 'Inter', sans-serif;
    }
    .conversation-item {
        transition: all 0.2s ease;
    }
    .conversation-item:hover {
        background-color: #f8f9fa;
        transform: translateX(4px);
    }
    .conversation-item.active {
        box-shadow: inset 4px 0 0 #6366f1;
    }
    #message-container {
        scrollbar-width: thin;
        display: flex;
        flex-direction: column;
    }
    #message-container::-webkit-scrollbar {
        width: 6px;
    }
    #message-container::-webkit-scrollbar-thumb {
        background-color: #e9ecef;
        border-radius: 10px;
    }
    .message-content {
        position: relative;
        transition: transform 0.2s ease;
    }
    .message-content:hover {
        transform: scale(1.01);
    }
    
    .message-wrapper.mine .message-content {
        background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);
        color: white;
        border-radius: 1.25rem 1.25rem 0.25rem 1.25rem;
    }
    
    .message-wrapper.theirs .message-content {
        background-color: white;
        color: #1f2937;
        border-radius: 1.25rem 1.25rem 1.25rem 0.25rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
</style>

@push('scripts')
<script>
$(document).ready(function() {
    const messageContainer = $('#message-container');
    
    // Scroll to bottom
    function scrollToBottom() {
        if (messageContainer.length) {
            messageContainer.scrollTop(messageContainer[0].scrollHeight);
        }
    }
    
    scrollToBottom();

    // AJAX Form Handling
    $('#chat-form').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const input = $('#chat-input');
        const message = input.val().trim();
        
        if (message === '') return;
        
        $('#send-btn').prop('disabled', true);
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.status === 'success') {
                    messageContainer.append(response.html);
                    input.val('');
                    scrollToBottom();
                }
            },
            error: function() {
                alert('Failed to send message');
            },
            complete: function() {
                $('#send-btn').prop('disabled', false);
            }
        });
    });
});
</script>
@endpush
@endsection
