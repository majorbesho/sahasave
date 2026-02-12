<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class FaqTag extends Model implements TranslatableContract
{
    use Translatable, HasSlug;

    protected $table = 'faq_tags';

    protected $fillable = ['slug'];

    public $translatedAttributes = ['name'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function faqs()
    {
        return $this->belongsToMany(Faq::class, 'faq_faq_tag');
    }
}
