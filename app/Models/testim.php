<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testim extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'name',
         'company',
        'slug',
        'discreption',
        'photo',
        'status',


    ];


}
