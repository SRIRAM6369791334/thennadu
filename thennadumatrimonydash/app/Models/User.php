<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authendicatable;

class User extends Authendicatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'dob',
        'religion',
        'caste',
        'marital_status',
        'mother_tongue',
        'phone',
        'district',
        'mblno',
        'user_ID',
        'role',
    ];

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function educationJob()
    {
        return $this->hasOne(EducationJob::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function familyDetail()
    {
        return $this->hasOne(FamilyDetail::class);
    }

    public function horoscopeDetail()
    {
        return $this->hasOne(HoroscopeDetail::class);
    }

    public function partnerPreference()
    {
        return $this->hasOne(PartnerPreference::class);
    }

    public function profileImage()
    {
        $image = Image::where('varanid', $this->user_ID)->first();
        if ($image && $image->image_name) {
            return url('uploads/' . $image->image_name);
        }
        $fallback = ($this->gender == 2) ? 'women 2.png' : 'men2.png';
        return url('assets/images/matri/' . $fallback);
    }
}


