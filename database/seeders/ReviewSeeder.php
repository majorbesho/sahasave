<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get random appointments to turn into completed appointments with reviews
        // We'll take 30 random appointments
        $appointments = Appointment::inRandomOrder()->take(30)->get();

        $positiveComments = [
            "طبيب ممتاز جداً، استمعت لنصائحه وكانت مفيدة.",
            "Great experience, highly recommended!",
            "تعامل راقي ومهنية عالية. شكراً دكتور.",
            "The clinic was very clean and the staff was friendly.",
            "تجربة جيدة، الانتظار لم يكن طويلاً.",
            "Professional and knowledgeable doctor.",
            "أفضل دكتور تعاملت معه، تشخيص دقيق.",
            "Thank you for your help, I feel much better now.",
            "خدمة ممتازة وسريعة.",
            "Highly professional and caring doctor.",
            "شرح الحالة بوضوح وأعطاني الوقت الكافي.",
            "Very satisfied with the treatment plan.",
            "دكتور متمكن وخلوق.",
            "The appointment started on time.",
            "أنصح به بشدة."
        ];

        foreach ($appointments as $appointment) {
            // Ensure the appointment is marked as completed so the review is logically valid
            $appointment->update(['status' => 'completed']);

            // Check if review already exists to avoid duplicates
            if (!$appointment->review) {
                Review::create([
                    'patient_id' => $appointment->patient_id,
                    'doctor_id' => $appointment->doctor_id,
                    'appointment_id' => $appointment->id,
                    'rating' => rand(4, 5), // Generate mostly 4 and 5 stars
                    'comment' => $positiveComments[array_rand($positiveComments)],
                    'status' => 'approved', // Auto-approve seeded reviews
                ]);
            }
        }
    }
}
