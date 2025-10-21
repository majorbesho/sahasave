<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'admins';
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'photo',
        'phone',
    ];




    public function conversations()
    {
        return $this->morphMany(Conversation::class, 'sender', 'sender_type', 'sender_id');
    }

    public function receivedConversations()
    {
        return $this->morphMany(Conversation::class, 'receiver', 'receiver_type', 'receiver_id');
    }

    public function messages()
    {
        return $this->morphMany(Message::class, 'sender', 'sender_type', 'sender_id');
    }


    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function getLastSeenAttribute()
    {
        return Carbon::parse($this->last_seen_at);
    }

    protected $appends = ['last_seen'];

    public function getProfileImageAttribute()
    {
        return $this->attributes['profile_image'] ?? null;
    }
}
