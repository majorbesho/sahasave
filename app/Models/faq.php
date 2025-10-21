<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class faq extends Model
{
    use HasFactory;



    protected $fillable = [
        'title',
        'slug',
        'discreption',
        'photo',
        'qu',
        'answer',
        'status',
    ];



}
