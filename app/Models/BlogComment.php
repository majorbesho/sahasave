<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'user_id',
        'parent_id',
        'content',
        'status', // pending, approved, spam, rejected
        'likes',
        'dislikes',
        'reactions',
        'metadata',
    ];

    protected $casts = [
        'reactions' => 'array',
        'metadata' => 'array',
        'likes' => 'integer',
        'dislikes' => 'integer',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(BlogComment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(BlogComment::class, 'parent_id');
    }

    // A fast way to load replies recursively if needed, though typically done via AJAX or eager loading a fixed depth
    public function children()
    {
        return $this->hasMany(BlogComment::class, 'parent_id')->with('children');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
