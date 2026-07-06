<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Profile extends Authenticatable
{
    use Notifiable;

    protected $table = 'registers';
    
    protected $fillable = [
        'varan_id', 'created_for', 'looking_for', 'Name', 'Gender', 'dob', 'age', 
        'Monther_tongue', 'Religion', 'Caste', 'sub_caste', 'mobile_no', 'email_id', 'password',
        'height', 'physical_status', 'marital_status', 'eating_habit',
        'stars', 'rasi', 'laknam', 'dosam', 'country', 'state', 'district', 'status',
        'eduction', 'eduction_detail', 'job_category', 'job_detail', 'annual_income', 'job_location',
        'about_myself', 'interests', 'user_token', 'body_type', 'complexion', 'blood_group',
        'father_name', 'father_occuption', 'mother_name', 'mother_occuption',
        'total_sibblings', 'elder_sister', 'younger_sister', 'elder_brother', 'younger_brother',
        'birth_time', 'member_shiptype'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Primary key used to identify the auth user in the session.
     */
    public function getAuthIdentifierName(): string
    {
        return 'id';
    }

    /**
     * Override email for password resets to map to email_id column.
     */
    public function getEmailForPasswordReset(): string
    {
        return $this->email_id;
    }
}
