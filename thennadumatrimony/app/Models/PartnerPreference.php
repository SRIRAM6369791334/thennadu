<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerPreference extends Model
{
    protected $fillable = [
        'user_id', 
        'age_from', 
        'age_to', 
        'religion', 
        'caste', 
        'education', 
        'location', 
        'min_income', 
        'marital_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
