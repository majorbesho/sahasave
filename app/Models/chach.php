<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chach extends Model
{
    use HasFactory;

    protected $fillable = [
        'empid',
        'ticketno',
        'user_id',
        'bookheaderCode',
        'paperCode',
    ];
}
