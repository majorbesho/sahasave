<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSocialMedia extends Model
{
    use HasFactory;

    protected $table = 'doctor_social_media';

    protected $fillable = [
        'doctor_id',
        'platform',
        'url',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
