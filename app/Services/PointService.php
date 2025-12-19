<?php

namespace App\Services;

use App\Models\User;
use App\Models\PointTransaction;
use App\Models\LoyaltyPoint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PointService
{
    /**
     * Calculate and award points for a completed appointment.
     *
     * @param  mixed  $appointment
     * @return \App\Models\PointTransaction|null
     */
    public function earnFromAppointment($appointment)
    {
        $user = $appointment->patient;

        // Ensure user relationship exists
        if (!$user) {
            Log::warning("PointService: Appointment {$appointment->id} has no patient attached.");
            return null;
        }

        // 1. Check Eligibility
        if (!$this->isEligibleForPoints($user, $appointment)) {
            Log::info("PointService: User {$user->id} is not eligible for points on appointment {$appointment->id}.");
            return null;
        }

        return DB::transaction(function () use ($user, $appointment) {
            // 2. Calculate Base Points
            $basePoints = $this->calculateBasePoints($appointment);

            // 3. Calculate Bonuses (Activity based)
            $activityBonuses = $this->calculateActivityBonuses($user, $appointment);

            // 4. Apply Tier Multiplier
            // Usually tiers apply to the base earning power. 
            // Formula: (Base + ActivityBonuses) * TierMultiplier
            $tierMultiplier = $user->loyaltyPoints?->tier->points_earning_rate ?? 1.0;

            $totalPoints = round(($basePoints + $activityBonuses) * $tierMultiplier);

            // 5. Record Transaction
            $transaction = $this->recordPointTransaction(
                $user,
                'earn_appointment',
                $totalPoints,
                $appointment
            );

            // 6. Update User Stats & Appointment Flag
            $this->updateUserStats($user, $appointment);

            Log::info("PointService: Awarded {$totalPoints} points to user {$user->id} for appointment {$appointment->id}.");

            return $transaction;
        });
    }

    public function earnFromDoctorAppointment($appointment)
    {
        $doctor = $appointment->doctor;

        // Ensure doctor logic similar to patient but tailored (maybe different config/rules)
        // For simplicity, we assume doctors earn fixed or % of fee

        $points = config('loyalty.doctor_points_per_appointment', 100);

        return DB::transaction(function () use ($doctor, $appointment, $points) {
            return $this->recordPointTransaction(
                $doctor,
                'earn_doctor_service',
                $points,
                $appointment
            );
        });
    }

    private function isEligibleForPoints($user, $appointment)
    {
        // Conditions:
        // 1. Appointment is completed
        // 2. Points not already awarded
        // 3. User is active

        // Assuming 'points_awarded' is a boolean column or we check if a transaction exists for this source
        $alreadyAwarded = $appointment->points_awarded ?? PointTransaction::where('source_type', get_class($appointment))
            ->where('source_id', $appointment->id)
            ->exists();

        return $appointment->status === 'completed' &&
            !$alreadyAwarded &&
            $user->status === 'active';
    }

    private function calculateBasePoints($appointment)
    {
        $points = 0;

        // Fixed points per appointment
        $points += config('loyalty.points_per_appointment', 50);

        // Duration based points (if duration is available in minutes)
        if (isset($appointment->duration)) {
            $points += $appointment->duration * config('loyalty.points_per_minute', 0.5);
        }

        // Service Type points
        $points += $this->getServiceTypePoints($appointment);

        return $points;
    }

    private function calculateActivityBonuses($user, $appointment)
    {
        $bonus = 0;

        // First Appointment Bonus
        if ($user->completed_appointments == 0) { // Assuming this is incremented AFTER this process, or represents previous count
            $bonus += config('loyalty.first_appointment_bonus', 200);
        }

        // Streak Bonus (every 5th appointment)
        // If current count is 4, this makes 5.
        $currentCount = $user->completed_appointments + 1;
        if ($currentCount > 0 && $currentCount % 5 === 0) {
            $bonus += config('loyalty.streak_bonus', 300);
        }

        // Weekend Bonus
        if ($appointment->scheduled_for && $appointment->scheduled_for instanceof Carbon && $appointment->scheduled_for->isWeekend()) {
            $bonus += config('loyalty.weekend_bonus', 50);
        } else if (isset($appointment->date) || isset($appointment->time)) {
            // Fallback if scheduled_for isn't a Carbon object directly
            $date = Carbon::parse($appointment->date ?? $appointment->created_at);
            if ($date->isWeekend()) {
                $bonus += config('loyalty.weekend_bonus', 50);
            }
        }

        return $bonus;
    }

    private function getServiceTypePoints($appointment)
    {
        // Example: logic to fetch points based on service category/type
        // return $appointment->service->loyalty_points ?? 0;
        return 0; // Default placeholder
    }

    private function recordPointTransaction(User $user, string $type, int $amount, $source = null)
    {
        // Ensure user has loyalty points account
        $loyaltyPoints = $user->initializeLoyaltyPoints();

        $transaction = PointTransaction::create([
            'user_id' => $user->id,
            'loyalty_point_id' => $loyaltyPoints->id,
            'transaction_code' => 'PT' . time() . strtoupper(substr(md5(uniqid()), 0, 6)),
            'type' => $type,
            'points' => $amount,
            'points_before' => $loyaltyPoints->points,
            'points_after' => $loyaltyPoints->points + $amount,
            // Calculate monetary value based on current rate
            'monetary_value' => $amount * ($loyaltyPoints->points_value_rate ?? 0.01),
            'direction' => 'credit',
            'source_type' => $source ? get_class($source) : null,
            'source_id' => $source?->id,
            'status' => 'approved',
            'approved_at' => now(),
            'expires_at' => now()->addDays($loyaltyPoints->tier?->points_expiry_days ?? 365),
            'description' => 'نقاط مكتسبة من موعد #' . ($source->id ?? ''),
        ]);

        // Update Balance
        $loyaltyPoints->increment('points', $amount);
        $loyaltyPoints->increment('available_points', $amount);
        $loyaltyPoints->increment('total_earned', $amount);

        // Check for Tier Upgrade
        $loyaltyPoints->updateTier();

        return $transaction;
    }

    private function updateUserStats(User $user, $appointment)
    {
        // Increment completed appointments count
        $user->increment('completed_appointments');

        // Mark appointment as points awarded to prevent double counting
        // Check if the appointment model has this column, otherwise we rely on transaction check existance
        if (\Schema::hasColumn($appointment->getTable(), 'points_awarded')) {
            $appointment->points_awarded = true;
            $appointment->save();
        }
    }
}
