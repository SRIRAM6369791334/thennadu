<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class HoroscopeDetail extends Model {
    use HasFactory;
    protected $fillable = ['user_id', 'rasi', 'star', 'dosam', 'birth_time'];
}
