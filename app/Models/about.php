<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class about extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'slug',
        'discreption',
        'sdiscreption',
        'photo',
        'status',
        'youtubeUrl',
        'mainImg',
        'testim_caption',
        'team_caption',
        'no1',
        'text1',
        'no2',
        'text2',
        'no3',
        'text3',
        'no4',
        'text4',
        'address',
        'city',

    ];


}
