<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class otp extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $timestamps=false;
    protected $table = 'otp_db';
}


