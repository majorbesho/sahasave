<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_levels extends Model
{
    use HasFactory;
    protected $fillable = [

    'name',
    'title',
    'slug',
    'status',
    'photo',


    ];

}
