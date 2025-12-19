<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'discreption',
        'photo',
        'qu',
        'answer',
        'status',
    ];

    // Scope للـ FAQs النشطة
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Accessor للحصول على رابط الصورة الكامل
    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            // إذا كان الرابط يحتوي على http أو https
            if (filter_var($this->photo, FILTER_VALIDATE_URL)) {
                return $this->photo;
            }

            // إذا كانت الصورة في storage
            if (Storage::exists($this->photo)) {
                return Storage::url($this->photo);
            }

            // إذا كانت الصورة في المجلد العام
            if (file_exists(public_path($this->photo))) {
                return asset($this->photo);
            }

            // صورة افتراضية
            return asset('frontend/xx/assets/img/faq-default.png');
        }

        return asset('frontend/xx/assets/img/faq-default.png');
    }

    // Accessor لتقصير الإجابة للعرض
    public function getShortAnswerAttribute()
    {
        return \Illuminate\Support\Str::limit(strip_tags($this->answer), 150);
    }

    // Append accessors
    protected $appends = ['photo_url', 'short_answer'];
}
