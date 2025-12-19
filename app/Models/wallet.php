<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'wallet_number',
        'type',
        'currency',
        'balance',
        'pending_balance',
        'hold_balance',
        'total_deposits',
        'total_withdrawals',
        'total_transactions',
        'status',
        'is_default',
        'settings',
        'limits',
        'last_activity_at'
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'pending_balance' => 'decimal:2',
        'hold_balance' => 'decimal:2',
        'total_deposits' => 'decimal:2',
        'total_withdrawals' => 'decimal:2',
        'total_transactions' => 'decimal:2',
        'settings' => 'array',
        'limits' => 'array',
        'is_default' => 'boolean',
        'last_activity_at' => 'datetime'
    ];

    // العلاقات
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    // النطاقات
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // التوابع المساعدة
    public function getAvailableBalanceAttribute()
    {
        return $this->balance - $this->hold_balance;
    }

    public function getTotalBalanceAttribute()
    {
        return $this->balance + $this->pending_balance;
    }

    public function canWithdraw($amount): bool
    {
        return $this->available_balance >= $amount &&
            $this->status === 'active' &&
            ($this->limits['max_withdrawal'] ?? 0) >= $amount;
    }

    public function generateWalletNumber()
    {
        if (!$this->wallet_number) {
            $prefix = 'WLT';
            $userId = str_pad($this->user_id, 6, '0', STR_PAD_LEFT);
            $random = strtoupper(substr(md5(uniqid()), 0, 6));
            $this->wallet_number = $prefix . $userId . $random;
        }
        return $this->wallet_number;
    }

    public function deposit($amount, $type = 'deposit', $description = null, $source = null, $metadata = [])
    {
        return \DB::transaction(function () use ($amount, $type, $description, $source, $metadata) {
            $transaction = $this->transactions()->create([
                'transaction_id' => 'TXN' . time() . strtoupper(substr(md5(uniqid()), 0, 8)),
                'type' => $type,
                'amount' => $amount,
                'balance_before' => $this->balance,
                'balance_after' => $this->balance + $amount,
                'currency' => $this->currency,
                'status' => 'completed',
                'direction' => 'credit',
                'description' => $description,
                'source_type' => $source ? get_class($source) : null, // Fix: Use class name as string
                'source_id' => $source?->id, // Fix: Use ID
                'metadata' => $metadata,
                'processed_at' => now(),
            ]);

            $this->increment('balance', $amount);
            $this->increment('total_deposits', $amount);
            $this->increment('total_transactions');
            $this->touch('last_activity_at');

            return $transaction;
        });
    }

    public function withdraw($amount, $type = 'withdrawal', $description = null, $source = null, $metadata = [])
    {
        if (!$this->canWithdraw($amount)) {
            throw new \Exception('Insufficient funds or wallet limit reached.');
        }

        return \DB::transaction(function () use ($amount, $type, $description, $source, $metadata) {
            $transaction = $this->transactions()->create([
                'transaction_id' => 'TXN' . time() . strtoupper(substr(md5(uniqid()), 0, 8)),
                'type' => $type,
                'amount' => $amount,
                'balance_before' => $this->balance,
                'balance_after' => $this->balance - $amount,
                'currency' => $this->currency,
                'status' => 'completed',
                'direction' => 'debit',
                'description' => $description,
                'source_type' => $source ? get_class($source) : null,
                'source_id' => $source?->id,
                'metadata' => $metadata,
                'processed_at' => now(),
            ]);

            $this->decrement('balance', $amount);
            $this->increment('total_withdrawals', $amount);
            $this->increment('total_transactions');
            $this->touch('last_activity_at');

            return $transaction;
        });
    }
}
