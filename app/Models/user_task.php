<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'slug',
        'user_id',
        'task_id',
        'reward_points',
        'proof',
        'status',
];

}
