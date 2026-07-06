<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyDetail extends Model
{
    protected $fillable = ['user_id', 'father_name', 'mother_name', 'siblings_count'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
