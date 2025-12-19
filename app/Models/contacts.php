<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contacts extends Model
{
    use HasFactory;
    public $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message'
    ];


    public static function boot()
    {

        parent::boot();

        static::created(function ($item) {

            // $adminEmail = "contact@SehaSave.com";
            $adminEmail = "beshog32@gmail.com";
            Mail::to($adminEmail)->send(new ContactMail($item));
        });
    }
}
