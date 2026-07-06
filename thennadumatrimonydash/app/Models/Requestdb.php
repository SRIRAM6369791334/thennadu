<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requestdb extends Model
{
    use HasFactory;

    protected $table = 'requestdbs';

    /**
     * Get the sender of the interest.
     */
    public function sender()
    {
        return $this->belongsTo(register::class, 'user_varan_id', 'varan_id');
    }

    /**
     * Get the receiver of the interest.
     */
    public function receiver()
    {
        return $this->belongsTo(register::class, 'partner_varan_id', 'varan_id');
    }
}


