<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPackage extends Model
{
    use HasFactory;

    protected $table = 'user_package';
    
    const UPDATED_AT = null;

    protected $fillable = [
        'user_varan_id',
        'package_name',
        'package_price',
        'no_of_video',
        'no_of_video_upload',
        'no_of_image',
        'no_of_image_upload',
        'no_of_horo',
        'no_of_horo_upload',
        'no_of_phno',
        'no_of_phno_viewed',
        'enable_chat',
        'enable_call',
        'enable_horoschope',
        'enable_advancesearch',
        'validity_date',
        'payment_status',
        'payment_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_varan_id', 'varan_id'); 
    }


}
