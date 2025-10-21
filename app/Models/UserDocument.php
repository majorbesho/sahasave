<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    use HasFactory;
    protected $fillable = [

        'user_id',
        // 'suppliers_id',
        'filename',
        'path',
        'mime_type',
        'size',

    ];
    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

    // public function company()
    // {
    //     return $this->belongsTo('\App\Models\suppliers');
    // }
}
