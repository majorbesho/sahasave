<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranslatableContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'translatable_type',
        'translatable_id',
        'locale',
        'key',
        'value'
    ];

    /**
     * Get the parent translatable model.
     */
    public function translatable()
    {
        return $this->morphTo();
    }
}
