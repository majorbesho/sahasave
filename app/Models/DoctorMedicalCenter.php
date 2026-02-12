<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorMedicalCenter extends Model
{
    use HasFactory;

    protected $table = 'doctor_medical_centers';

    protected $fillable = [
        'doctor_id',
        'medical_center_id',
    ];
}
