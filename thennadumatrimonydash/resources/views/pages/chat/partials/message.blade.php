@php
    $isMine = $message->sender_id === auth()->id();
@endphp

<div class="message-wrapper d-flex flex-column {{ $isMine ? 'align-items-end' : 'align-items-start' }} mb-3">
    <div class="message-content p-3 shadow-sm {{ $isMine ? 'bg-primary text-white' : 'bg-white text-dark border' }}" 
         style="max-width: 75%; border-radius: {{ $isMine ? '1.25rem 1.25rem 0.25rem 1.25rem' : '1.25rem 1.25rem 1.25rem 0.25rem' }};">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <small class="fw-bold me-2">{{ $isMine ? 'You' : $message->sender->name }}</small>
            <small style="font-size: 0.7rem; opacity: 0.8;">{{ $message->created_at->format('H:i') }}</small>
        </div>
        <div class="message-text">
            {{ $message->message }}
        </div>
        @if($isMine)
            <div class="text-end mt-1" style="font-size: 0.7rem; opacity: 0.8;">
                <i class="fas {{ $message->is_read ? 'fa-check-double' : 'fa-check' }}"></i>
            </div>
        @endif
    </div>
</div>
