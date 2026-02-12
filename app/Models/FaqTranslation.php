<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqTranslation extends Model
{
    protected $table = 'faq_translations';

    protected $fillable = [
        'faq_id',
        'locale',
        'title',
        'description',
        'question',
        'answer',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public $timestamps = false;

    // العلاقة مع الـ FAQ
    public function faq()
    {
        return $this->belongsTo(Faq::class);
    }
}
