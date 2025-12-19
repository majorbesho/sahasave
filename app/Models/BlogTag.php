<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'tag_type',
        'related_tags',
        'synonyms',
        'usage_count',
        'search_volume',
        'competition_score',
        'trend_data'
    ];

    protected $casts = [
        'related_tags' => 'array',
        'synonyms' => 'array',
        'trend_data' => 'array',
        'usage_count' => 'integer',
        'search_volume' => 'float',
        'competition_score' => 'float',
    ];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_tag', 'tag_id', 'blog_id')
            ->withPivot('relevance_score', 'position_in_content')
            ->withTimestamps();
    }
}
