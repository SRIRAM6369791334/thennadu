<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'packages';

    protected $fillable = [
        'package_name',
        'package_price',
        'no_of_videos',
        'no_of_images',
        'specification_3', // chat
        'specification_4', // unknown
        'specification_5', // advanced search
        'specification_6', // call
        'specification_7',
        'specification_8',
        'specification_9',
        'specification_10',
        'package_status',
        'validity', // in days
        'noofmblno'
    ];
}
