<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\TierService;

class EvaluateLoyaltyTiers extends Command
{
    protected $signature = 'loyalty:evaluate-tiers';
    protected $description = 'Evaluate loyalty tiers for all eligible users';

    public function handle(TierService $tierService)
    {
        $this->info('Starting tier evaluation...');

        $users = User::whereHas('loyaltyPoints', function ($q) {
            $q->whereDate('next_evaluation_date', '<=', now());
        })->get();

        $count = 0;
        foreach ($users as $user) {
            try {
                if ($tierService->evaluateUserTier($user)) {
                    $this->info("Updated tier for user: {$user->id}");
                }
                $count++;
            } catch (\Exception $e) {
                $this->error("Failed for user {$user->id}: " . $e->getMessage());
            }
        }

        $this->info("Completed. Processed {$count} users.");
    }
}
