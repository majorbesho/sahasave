<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class winner extends Model
{


    use  HasFactory, Notifiable;



    protected $fillable = [
        'name',
        'slug',
        'fullName',
        'email',
        'Isvideo',
        'photo',
        'phone',
        'nationality',
        'dateOfbarth',
        'address',
        'status',

    ];


}
