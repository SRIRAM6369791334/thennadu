<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuccessStory extends Model
{
    use HasFactory;

    protected $table = 'success_stories';

    protected $fillable = [
        'male_name',
        'female_name',
        'married_date',
        'description',
        'image',
    ];
}
