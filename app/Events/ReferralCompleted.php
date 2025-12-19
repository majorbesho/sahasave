<?php

namespace App\Events;

use App\Models\Referral;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReferralCompleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $referral;

    /**
     * Create a new event instance.
     *
     * @param Referral $referral
     * @return void
     */
    public function __construct(Referral $referral)
    {
        $this->referral = $referral;
    }
}
