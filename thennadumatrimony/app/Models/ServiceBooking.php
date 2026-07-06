<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'user_id',
        'name',
        'mobile',
        'email',
        'date',
        'time',
        'message',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
