<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class networks extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'carrier_id',
        'broker_id',
        'shipper_id',
        'parent_user_id',
        'parent_carrier_id',
        'parent_broker_id',
        'parent_shipper_id',
        'referral_code',
        'level1',
        'level2',
        'level3',
        'level4',
        'level5',

    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function carrier()
    {
        return $this->hasOne(Carrier::class, 'id', 'carrier_id');
    }
    public function broker()
    {
        return $this->hasOne(Broker::class, 'id', 'broker_id');
    }
    public function shipper()
    {
        return $this->hasOne(Shipper::class, 'id', 'shipper_id');
    }
}
