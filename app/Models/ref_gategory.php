<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_gategory extends Model
{
    use HasFactory;


 protected $fillable = [

      // $table->string('name');


        'name',
        'title',
        'slug',
        'description',
        'reward',
        'congratulatory_message',
        'taget_no_ref',
        'point_per_ref',
        'user_id',
        'ref_count',
        'ref_viset',
        'ref_buy',
        'photo'

    ];


}
