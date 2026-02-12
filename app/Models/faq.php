<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Str;

class Faq extends Model implements TranslatableContract
{
    use Translatable, HasSlug, SoftDeletes;

    protected $table = 'faqs';

    protected $fillable = [
        'slug',
        'photo',
        'status',
        'og_image',
        'sort_order',
        'category_id',
        'related_faqs',
        'views_count',
        'helpful_yes',
        'helpful_no',
    ];

    // هذا مهم: حدد الحقول التي يمكن ترجمتها
    public $translatedAttributes = [
        'title',
        'description',
        'question',
        'answer',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    // هذا مهم: اسم model الترجمات
    public $translationModel = FaqTranslation::class;

    // هذا مهم: اسم الجدول للترجمات
    public $translationForeignKey = 'faq_id';

    protected $casts = [
        'related_faqs' => 'array',
        'views_count' => 'integer',
        'helpful_yes' => 'integer',
        'helpful_no' => 'integer',
        'sort_order' => 'integer',
    ];

    // إزالة الـ boot method لأنه يتعارض مع HasSlug
    // أو أصلحه هكذا:
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // لن ننشئ slug هنا، سنتركه لـ HasSlug
        });

        static::updating(function ($model) {
            // لن ننشئ slug هنا، سنتركه لـ HasSlug
        });
    }

    // Slug Options
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function ($model) {
                // التحقق من وجود ترجمات
                if ($model->translations && $model->translations->count() > 0) {
                    $currentLocale = app()->getLocale();
                    $translation = $model->translations->where('locale', $currentLocale)->first() ??
                        $model->translations->where('locale', 'ar')->first() ??
                        $model->translations->where('locale', 'en')->first();

                    if ($translation && $translation->question) {
                        return $translation->question;
                    }
                }

                // إذا لم توجد ترجمات بعد، استخدم قيمة مؤقتة
                return 'faq-' . time() . '-' . Str::random(5);
            })
            ->saveSlugsTo('slug');
    }

    // Relations
    public function category()
    {
        return $this->belongsTo(FaqCategory::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(FaqTag::class, 'faq_faq_tag');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopePublished($query)
    {
        return $query->whereIn('status', ['active', 'inactive']);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function scopePopular($query, $limit = 10)
    {
        return $query->orderBy('views_count', 'desc')->limit($limit);
    }

    public function scopeHelpful($query, $limit = 10)
    {
        return $query->orderByRaw('(helpful_yes - helpful_no) DESC')->limit($limit);
    }

    // Methods
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function markAsHelpful($helpful = true)
    {
        if ($helpful) {
            $this->increment('helpful_yes');
        } else {
            $this->increment('helpful_no');
        }
    }

    public function getHelpfulnessRatioAttribute()
    {
        $total = $this->helpful_yes + $this->helpful_no;
        if ($total === 0) {
            return 0;
        }
        return round(($this->helpful_yes / $total) * 100, 2);
    }

    protected $appends = ['helpfulness_ratio'];
}
