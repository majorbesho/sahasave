<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    use HasFactory;

    protected $fillable = [
        // $table->uuid('id')->primary();
        // $table->string('type');
        // $table->morphs('notifiable');
        // $table->text('data');
        // $table->timestamp('read_at')->nullable();
        // $table->timestamps();

        'type',
        //'notifiable',
        'data',
        'read_at',





        //shoud add vendor ID
    ];

}
