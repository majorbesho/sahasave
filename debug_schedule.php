<?php

use App\Models\User;
use App\Models\Schedule;
use App\Models\Appointment;
use Carbon\Carbon;

// Mock Request
$slug = 'dr-drbeshoy-pediatrics';
$date = '2026-01-05';

echo "Testing for Doctor Slug: $slug at Date: $date\n";

$doctor = User::doctors()
    ->whereHas('doctorProfile', function ($q) use ($slug) {
        $q->where('slug', $slug);
    })
    ->firstOrFail();

echo "Doctor Found: " . $doctor->name . " (ID: " . $doctor->id . ")\n";

$carbonDate = Carbon::parse($date);
$dayOfWeek = $carbonDate->dayOfWeek;

echo "Day of Week: $dayOfWeek\n";

$schedules = Schedule::where('doctor_id', $doctor->id)
    ->where('day_of_week', $dayOfWeek)
    ->where('is_active', true)
    ->get();

echo "Schedules Found: " . $schedules->count() . "\n";

foreach ($schedules as $schedule) {
    echo "Schedule ID: " . $schedule->id . "\n";
    echo "Start Time: " . $schedule->start_time->format('H:i') . "\n";
    echo "End Time: " . $schedule->end_time->format('H:i') . "\n";

    // Test getAvailableSlots
    $slots = $schedule->getAvailableSlots($date);
    echo "Available Slots: " . count($slots) . "\n";
    foreach ($slots as $slot) {
        echo " - " . $slot['start_time'] . ' to ' . $slot['end_time'] . " (" . ($slot['is_available'] ? 'Available' : 'Booked') . ")\n";
    }
}
