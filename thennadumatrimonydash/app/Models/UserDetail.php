<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class UserDetail extends Model {
    use HasFactory;
    protected $fillable = ['user_id', 'height', 'complexion', 'body_type', 'eating_habit'];
}
