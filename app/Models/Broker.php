<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Kalnoy\Nestedset\NodeTrait;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Laravel\Cashier\Billable;



class Broker extends Model implements AuthenticatableContract

{
    use Authenticatable;
    use Billable;

    use HasApiTokens, HasFactory, Notifiable, NodeTrait;
    use NodeTrait;
    use HasFactory;
    protected $guard = 'brokers';

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'phoneOtp_verified_at',
        'password',
        'photo',
        'phone',
        'status',
        'phone_verfiy',
        'nationality',
        'dateOfbarth',
        'address',
        'provider',
        'provider_id',
        'is_verified',
        'referral_code',
        'ref_by',
        'no_of_refs',
        'ref_level_id',
        'onesignal_device_id',
        'broker_field'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }
    public function ref()
    {
        return $this->hasMany('App\Models\networks', 'parent_broker_id', 'id');
    }
    public function getrefby()
    {
        return $this->belongsTo(Broker::class, 'ref_by');
    }
    public function refChlidern()
    {
        return $this->hasMany(Broker::class, 'ref_by');
    }

    public function attachments()
    {
        return $this->morphMany(attachments::class, 'attachable');
    }


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
