<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationJob extends Model
{
    protected $fillable = ['user_id', 'education', 'job_category', 'job_detail', 'annual_income'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
