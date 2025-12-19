<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'status',
        'visibility',
        'content_type', // article, news, guide, research, tips, faq, case_study
        'reading_time',
        'views',
        'likes',
        'shares',
        'author_id',
        'category_id',
        // SEO Fields
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_image',
        'twitter_image',
        'schema_type', // Article, NewsArticle, BlogPosting, MedicalWebPage
        // AI & Rich Snippets
        'faq_json', // JSON for FAQ schema
        'how_to_json', // JSON for HowTo schema
        'breadcrumb_json', // JSON for breadcrumb schema
        'review_json', // JSON for review schema
        'local_business_json', // JSON for local business schema
        // Content Optimization
        'target_keywords', // JSON array of target keywords
        'ls_keyword', // Latent Semantic Indexing keyword
        'semantic_topics', // JSON array of related topics
        'word_count',
        'flesch_score', // Readability score
        'sentiment_score', // Positive/negative sentiment
        // E-E-A-T Signals (Expertise, Authoritativeness, Trustworthiness)
        'author_bio',
        'author_credentials',
        'sources_references', // JSON array of sources
        'last_updated',
        'update_frequency', // daily, weekly, monthly
        'featured',
        'published_at',
        'scheduled_for',
        // Performance Tracking
        'ctr', // Click-through rate
        'dwell_time', // Average time on page
        'bounce_rate',
        // Social Signals
        'social_shares_count', // JSON: {facebook: 10, twitter: 5, linkedin: 3}
        'backlinks_count',
        'referring_domains',
    ];

    protected $casts = [
        'views' => 'integer',
        'likes' => 'integer',
        'shares' => 'integer',
        'word_count' => 'integer',
        'featured' => 'boolean',
        'published_at' => 'datetime',
        'scheduled_for' => 'datetime',
        'last_updated' => 'datetime',
        'target_keywords' => 'array',
        'semantic_topics' => 'array',
        'sources_references' => 'array',
        'social_shares_count' => 'array',
        'faq_json' => 'array',
        'how_to_json' => 'array',
        'breadcrumb_json' => 'array',
        'review_json' => 'array',
        'local_business_json' => 'array',
    ];



    // في App\Models\Blog.php
    public function createTranslationJob($targetLocales, $priority = 'medium', $options = [])
    {
        $job = TranslationJob::create([
            'source_type' => self::class,
            'source_id' => $this->id,
            'source_locale' => $this->source_locale,
            'target_locales' => $targetLocales,
            'priority' => $priority,
            'content_fields' => ['title', 'excerpt', 'content', 'meta_title', 'meta_description'],
            'translation_options' => array_merge([
                'preserve_formatting' => true,
                'translate_medical_terms' => true,
                'cultural_adaptation' => true,
                'seo_optimized' => true,
            ], $options),
            'status' => 'pending',
        ]);

        // Dispatch job if auto-translation is enabled
        if (config('translation.auto_process')) {
            // dispatch(new ProcessTranslationJob($job));
        }

        return $job;
    }


    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function relatedTags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_tag', 'blog_id', 'tag_id');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function relatedPosts()
    {
        return $this->belongsToMany(Blog::class, 'blog_related', 'blog_id', 'related_blog_id');
    }

    /**
     * Get all translations for the blog.
     */
    public function translations()
    {
        return $this->morphMany(TranslatableContent::class, 'translatable');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function incrementViews()
    {
        $this->views++;
        $this->save();
    }

    public function generateStructuredData()
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => $this->schema_type ?? 'Article',
            'headline' => $this->title,
            'description' => $this->excerpt,
            'image' => $this->featured_image,
            'author' => [
                '@type' => 'Person',
                'name' => $this->author->name ?? 'SehaSave Team',
                //'url' => $this->author ? route('author.profile', $this->author->slug) : null,
                'credentials' => $this->author_credentials
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'SehaSave',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('assets/img/logo.png')
                ]
            ],
            'datePublished' => $this->published_at->toIso8601String(),
            'dateModified' => $this->last_updated ? $this->last_updated->toIso8601String() : $this->published_at->toIso8601String(),
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => url()->current()
            ],
            'wordCount' => $this->word_count,
            'timeRequired' => "PT{$this->reading_time}M",
            'keywords' => $this->target_keywords,
            'articleSection' => $this->category->name ?? 'Health',
        ];
    }
}
