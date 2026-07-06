@php
    $isMine = $message->sender_id === $user->id;
@endphp

<div class="message-wrapper d-flex {{ $isMine ? 'justify-content-end' : 'justify-content-start' }} mb-3">
    <div class="message-content position-relative p-2 shadow-sm" 
         style="max-width: 75%; min-width: 120px; 
                background-color: {{ $isMine ? '#dcf8c6' : '#ffffff' }}; 
                color: #303030;
                border-radius: 7.5px;
                border-top-{{ $isMine ? 'right' : 'left' }}-radius: 0;">
        
        <!-- Optional sender name for group chats, usually hidden in 1-on-1, but we'll keep it subtle if needed -->
        @if(!$isMine)
            <div class="text-muted fw-bold" style="font-size: 0.75rem; margin-bottom: 2px;">{{ $message->sender->name }}</div>
        @endif

        <!-- Message Body -->
        <div class="message-text" style="font-size: 0.95rem; line-height: 1.4; word-wrap: break-word;">
            {{ $message->message }}
        </div>

        <!-- Meta (Time & Ticks) -->
        <div class="d-flex justify-content-end align-items-center mt-1" style="font-size: 0.65rem; color: #888;">
            <span class="me-1">{{ $message->created_at->format('H:i') }}</span>
            @if($isMine)
                <i class="fas {{ $message->is_read ? 'fa-check-double' : 'fa-check' }}" style="color: {{ $message->is_read ? '#34B7F1' : '#888' }};"></i>
            @endif
        </div>

        <!-- WhatsApp Chat Tail (CSS Triangle) -->
        <div class="position-absolute" 
             style="top: 0; 
                    {{ $isMine ? 'right: -8px;' : 'left: -8px;' }}
                    width: 0; 
                    height: 0; 
                    border-top: 10px solid {{ $isMine ? '#dcf8c6' : '#ffffff' }}; 
                    border-{{ $isMine ? 'right' : 'left' }}: 10px solid transparent;">
        </div>
    </div>
</div>
