<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



///
//  Multiple reward types - cashback, discount, points, free consultation
// ✅ Usage limits - عدد مرات الاستخدام
// ✅ Stackable rewards - إمكانية الدمج
// ✅ Priority system - ترتيب التطبيق
// ✅ Conditions validation - شروط مرنة
// ✅ Doctor/Specialty filters - تطبيق محدد
// ✅ Transaction tracking - تتبع كامل
// ✅ Auto code generation - كود فريد
// ✅ Expiry management - إدارة الصلاحية
////
class RewardTransaction extends Model
{
    use HasFactory;

    const TYPE_ISSUED = 'issued';
    const TYPE_USED = 'used';
    const TYPE_EXPIRED = 'expired';
    const TYPE_CANCELLED = 'cancelled';
    const TYPE_REFUNDED = 'refunded';

    protected $fillable = [
        'reward_id',
        'user_id',
        'appointment_id',
        'type',
        'amount',
        'description',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'metadata' => 'array',
    ];

    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeForReward($query, $rewardId)
    {
        return $query->where('reward_id', $rewardId);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}
