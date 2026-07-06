<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class EducationJob extends Model {
    use HasFactory;
    protected $fillable = ['user_id', 'education', 'job_category', 'job_detail', 'annual_income'];
}
