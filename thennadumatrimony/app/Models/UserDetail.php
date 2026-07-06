<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = ['user_id', 'height', 'complexion', 'body_type', 'eating_habit', 'photo_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
