<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable ;
use Illuminate\Notifications\Notifiable;

class Emp extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'emp';

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'photo',
        'phone',
        'repcode',
    ];


}
