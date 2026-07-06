<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'subtitle',
        'btn_1_text',
        'btn_1_url',
        'btn_2_text',
        'btn_2_url',
        'status',
        'order',
    ];
}
