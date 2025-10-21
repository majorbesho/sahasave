<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class focus extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'discreption',
        'photo',
        'status',
        'mainWord',

    ];
}
