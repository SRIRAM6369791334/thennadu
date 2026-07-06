<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestRequest extends Model
{
    protected $table = 'interest_requests';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'status'
    ];

    /**
     * Get the user who sent the interest.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the user who is receiving the interest.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
