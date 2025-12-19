<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'color',
        'parent_id',
        'order',
        'is_active',
        // SEO Fields
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'schema_type', // CollectionPage, MedicalSpecialty
        'category_image',
        'alt_text',
        // E-A-T
        'expertise_level', // beginner, intermediate, expert
        'authority_score',
        'trust_indicators', // JSON: certifications, awards, affiliations
        // Content Strategy
        'target_audience', // JSON: patients, doctors, general_public
        'content_focus', // JSON: [prevention, treatment, wellness]
        'blog_count',
        // Performance
        'avg_read_time',
        'engagement_rate',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'trust_indicators' => 'array',
        'target_audience' => 'array',
        'content_focus' => 'array',
        'blog_count' => 'integer',
        'order' => 'integer',
        'authority_score' => 'float',
        'engagement_rate' => 'float',
    ];

    public function parent()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(BlogCategory::class, 'parent_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }

    public function getBreadcrumbSchema()
    {
        $breadcrumbs = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => []
        ];

        $position = 1;
        $current = $this;
        
        while ($current) {
            $breadcrumbs['itemListElement'][] = [
                '@type' => 'ListItem',
                'position' => $position,
                'name' => $current->name,
                'item' => route('blog.category', $current->slug)
            ];
            $current = $current->parent;
            $position++;
        }

        // Add home page
        array_unshift($breadcrumbs['itemListElement'], [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Home',
            'item' => url('/')
        ]);

        return $breadcrumbs;
    }
}