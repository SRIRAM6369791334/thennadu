<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterInterest extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_interests', 'master_interest_id', 'user_id');
    }
}
