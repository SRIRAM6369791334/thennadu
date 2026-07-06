<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{conversationId}', function ($authUser, $conversationId) {
    $conversation = \App\Models\Conversation::find($conversationId);
    if (!$conversation) return false;
    
    // Map the authenticated session user to the actual User model like ChatController does
    $user = \App\Models\User::where('email', $authUser->email ?? $authUser->email_id)->first();
    if (!$user) return false;

    return (int) $user->id === (int) $conversation->user_one || (int) $user->id === (int) $conversation->user_two;
});
