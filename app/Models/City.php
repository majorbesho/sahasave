<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'flag'];

    public function cities()
    {
        return $this->hasMany(City::class, 'country_code', 'code');
    }
}
