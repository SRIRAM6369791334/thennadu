<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatSetting extends Model
{
    protected $fillable = ['user_id', 'allow_chat', 'allow_only_matched', 'is_blocked'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
