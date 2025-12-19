<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSEOData extends Model
{
    use HasFactory;

    protected $table = 'blog_seo_data';

    protected $fillable = [
        'blog_id',
        'keyword_positions',
        'backlinks',
        'internal_links',
        'external_links',
        'heading_structure',
        'page_speed_score',
        'mobile_friendliness_score',
        'core_web_vitals',
        'screenshot_data',
        'last_seo_audit',
        'audit_results'
    ];

    protected $casts = [
        'keyword_positions' => 'array',
        'backlinks' => 'array',
        'internal_links' => 'array',
        'external_links' => 'array',
        'heading_structure' => 'array',
        'core_web_vitals' => 'array',
        'screenshot_data' => 'array',
        'audit_results' => 'array',
        'last_seo_audit' => 'datetime',
        'page_speed_score' => 'float',
        'mobile_friendliness_score' => 'float',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
