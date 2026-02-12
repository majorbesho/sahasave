<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class FaqCategory extends Model implements TranslatableContract
{
    use Translatable, HasSlug;

    protected $table = 'faq_categories';

    protected $fillable = [
        'slug',
        'icon',
        'sort_order',
        'status',
    ];

    public $translatedAttributes = ['name', 'description'];

    // Slug Options
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    // Relations
    public function faqs()
    {
        return $this->hasMany(Faq::class, 'category_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    // Accessors
    public function getFaqsCountAttribute()
    {
        return $this->faqs()->count();
    }

    protected $appends = ['faqs_count'];
}
