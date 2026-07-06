<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoroscopeDetail extends Model
{
    protected $fillable = ['user_id', 'rasi', 'star', 'dosam', 'birth_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
