<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class PartnerPreference extends Model {
    use HasFactory;
    protected $fillable = ['user_id', 'age_from', 'age_to', 'religion', 'caste', 'education', 'location', 'min_income', 'marital_status'];
}
