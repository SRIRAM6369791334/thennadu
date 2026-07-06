@extends('layout.default')

@section('content')
<div class="chat-main-container py-4 bg-light" style="min-height: calc(100vh - 100px);">
    <div class="container" style="max-width: 1350px;">
        <div class="row g-0 rounded-4 overflow-hidden shadow-lg bg-white border" style="height: 75vh; min-height: 550px;">
            <!-- Left Sidebar -->
            <div class="col-md-4 col-lg-3 border-end bg-white">
                <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-bold">Recent Chats</h5>
                    <!-- <button class="btn btn-sm btn-outline-primary rounded-circle">
                        <i class="fas fa-ellipsis-v"></i>
                    </button> -->
                </div>
                
                <div class="p-2 border-bottom">
                    <input type="text" id="chatSearchInput" class="form-control form-control-sm rounded-pill px-3" placeholder="Search by name...">
                </div>
                
                <div class="conversation-list overflow-auto" style="height: calc(100% - 110px);">
                    @forelse($conversations as $conv)
                        @php
                            $otherUser = $conv->user_one == $user->id ? $conv->userTwo : $conv->userOne;
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
                                    @if($conv->messages()->where('sender_id', '!=', $user->id)->where('is_read', false)->count() > 0)
                                        <span class="badge rounded-pill bg-danger ms-1">
                                            {{ $conv->messages()->where('sender_id', '!=', $user->id)->where('is_read', false)->count() }}
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
            <div class="col-md-8 col-lg-9 d-flex flex-column bg-white h-100">
                @if(isset($conversation))
                    @php
                        $otherUser = $conversation->user_one == $user->id ? $conversation->userTwo : $conversation->userOne;
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
                    <div id="message-container" class="flex-grow-1 overflow-auto p-4" style="background-color: #efeae2; background-image: url('/assets/images/chat-bg.png'); background-repeat: repeat; background-size: 400px;">
                        @php $lastDate = null; @endphp
                        @foreach($messages as $message)
                            @php
                                $msgDate = $message->created_at->format('Y-m-d');
                                if($msgDate == \Carbon\Carbon::today()->format('Y-m-d')) {
                                    $displayDate = 'Today';
                                } elseif($msgDate == \Carbon\Carbon::yesterday()->format('Y-m-d')) {
                                    $displayDate = 'Yesterday';
                                } else {
                                    $displayDate = $message->created_at->format('d M Y');
                                }
                            @endphp
                            
                            @if($lastDate !== $msgDate)
                                <div class="text-center my-3">
                                    <span class="badge bg-white text-muted shadow-sm px-3 py-2 rounded-pill border">{{ $displayDate }}</span>
                                </div>
                                @php $lastDate = $msgDate; @endphp
                            @endif

                            @include('pages.chat.partials.message', ['message' => $message, 'user' => $user])
                        @endforeach
                    </div>

                    <!-- Footer / Input -->
                    <div class="p-3 border-top bg-white position-relative">
                        <!-- Emoji Picker -->
                        <emoji-picker id="emojiPicker" class="d-none position-absolute" style="bottom: 100%; left: 15px; z-index: 1050; box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15); border-radius: 8px;"></emoji-picker>
                        <form id="chat-form" action="{{ route('chat.send') }}" method="POST">
                            @csrf
                            <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                            <div class="input-group">
                                <button class="btn btn-light border" type="button" id="emoji-btn">
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
                            <div class="mt-4">
                                <a href="{{ route('dashboard.interests') }}" class="btn btn-outline-primary px-4 rounded-pill">
                                    <i class="fas fa-heart me-2"></i> View Mutual Interests
                                </a>
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
    
    .avatar-wrapper img {
        object-fit: cover;
    }
</style>

@push('scripts')
<script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@1/index.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.16.1/dist/echo.iife.js"></script>
<script>
$(document).ready(function() {
    const messageContainer = $('#message-container');
    
    // Emoji Picker Logic
    const emojiPicker = document.querySelector('emoji-picker');
    const emojiBtn = document.getElementById('emoji-btn');
    const chatInput = document.getElementById('chat-input');

    if(emojiBtn && emojiPicker) {
        emojiBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation(); // prevent document click from firing instantly
            emojiPicker.classList.toggle('d-none');
        });

        emojiPicker.addEventListener('emoji-click', event => {
            const cursorPosition = chatInput.selectionStart;
            const textBefore = chatInput.value.substring(0, cursorPosition);
            const textAfter = chatInput.value.substring(cursorPosition);
            chatInput.value = textBefore + event.detail.unicode + textAfter;
            
            $(chatInput).trigger('input');
            chatInput.selectionStart = chatInput.selectionEnd = cursorPosition + event.detail.unicode.length;
            chatInput.focus();
        });

        document.addEventListener('click', (event) => {
            if (!emojiBtn.contains(event.target) && !emojiPicker.contains(event.target)) {
                emojiPicker.classList.add('d-none');
            }
        });
    }
    
    // Scroll to bottom like WhatsApp
    function scrollToBottom(animate = true) {
        if (messageContainer.length) {
            const scrollHeight = messageContainer[0].scrollHeight;
            if (animate) {
                messageContainer.stop().animate({ scrollTop: scrollHeight }, 300);
            } else {
                messageContainer.scrollTop(scrollHeight);
            }
        }
    }
    
    // Instant scroll on page load
    setTimeout(() => scrollToBottom(false), 50);
    // Extra safety scroll after images might have loaded
    setTimeout(() => scrollToBottom(false), 500);

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
                Swal.fire('Error', 'Failed to send message', 'error');
            },
            complete: function() {
                $('#send-btn').prop('disabled', false);
            }
        });
    });

    // Auto-expand textarea
    $('#chat-input').on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
        if (this.scrollHeight > 150) {
            this.style.overflowY = 'auto';
            this.style.height = '150px';
        } else {
            this.style.overflowY = 'hidden';
        }
    });

    // Enter to Send
    $('#chat-input').on('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            $('#chat-form').submit();
        }
    });

    // Search Bar filtering
    $('#chatSearchInput').on('input', function() {
        const query = $(this).val().toLowerCase();
        $('.conversation-item').each(function() {
            const name = $(this).find('h6').text().toLowerCase();
            if(name.includes(query)) {
                $(this).removeClass('d-none').addClass('d-flex');
            } else {
                $(this).removeClass('d-flex').addClass('d-none');
            }
        });
    });

    @if(isset($conversation))
    // Setup Laravel Echo via CDN for Pusher
    window.Pusher = Pusher;
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '{{ config('broadcasting.connections.pusher.key') }}',
        cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
        forceTLS: true,
        auth: {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });

    window.Echo.connector.pusher.connection.bind('state_change', function(states) {
        console.log("WebSocket State:", states.current);
    });

    window.Echo.private('chat.{{ $conversation->id }}')
        .subscribed(() => {
            console.log("WebSocket Subscribed successfully!");
        })
        .error((err) => {
            console.error("WebSocket Subscription Error:", err);
        })
        .listen('.App\\Events\\MessageSent', (e) => {
            console.log("WebSocket Event Received! Sender ID:", e.message.sender_id, "My ID:", {{ $user->id }});
            // Only update if the message is from the other person
            if (String(e.message.sender_id) !== String({{ $user->id }})) {
                console.log("Fetching new messages from server...");
                // Debounce the reload to prevent browser freeze during load tests
                clearTimeout(window.chatReloadTimer);
                window.chatReloadTimer = setTimeout(() => {
                    $.ajax({
                        url: window.location.href,
                        method: 'GET',
                        cache: false,
                        success: function(html) {
                            const newHtml = $(html).find('#message-container').html();
                            if (newHtml) {
                                messageContainer.html(newHtml);
                                scrollToBottom(true);
                            }
                        }
                    });
                }, 200);
            }
        });
    @endif
});
</script>
@endpush
@endsection
