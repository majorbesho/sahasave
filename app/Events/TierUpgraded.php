<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TierUpgraded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $oldTier;
    public $newTier;
    public $bonusPoints;

    public function __construct(User $user, $oldTier, $newTier, $bonusPoints)
    {
        $this->user = $user;
        $this->oldTier = $oldTier;
        $this->newTier = $newTier;
        $this->bonusPoints = $bonusPoints;
    }
}
