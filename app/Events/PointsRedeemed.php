<?php

namespace App\Events;

use App\Models\User;
use App\Models\PointRedemption;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PointsRedeemed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $redemption;
    public $reward;

    public function __construct(User $user, PointRedemption $redemption, $reward)
    {
        $this->user = $user;
        $this->redemption = $redemption;
        $this->reward = $reward;
    }
}
