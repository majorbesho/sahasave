<?php

namespace App\Console;

use App\Models\Blog;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        // تقييم جميع المستخدمين في أول يوم من كل شهر
        $schedule->command('loyalty:evaluate-tiers')
            ->monthlyOn(1, '00:00')
            ->timezone('Asia/Riyadh');

        // تنظيف النقاط المنتهية أسبوعياً
        $schedule->command('loyalty:cleanup-expired-points')
            ->weekly()
            ->sundays()
            ->at('01:00');

        // تجديد فوائد المستويات سنوياً
        $schedule->command('loyalty:renew-tier-benefits')
            ->yearly()
            ->january(1)
            ->at('02:00');




        $schedule->call(function () {
            Blog::where('status', 'published')
                ->where('last_updated', '<', now()->subMonth())
                ->each(function ($blog) {
                    // إضافة علامة "تم التحديث"
                    $blog->last_updated = now();
                    $blog->save();

                    // إرسال ping لـ Google عن التحديث
                    $sitemapUrl = route('blog.sitemap');
                    $pingUrl = "https://www.google.com/ping?sitemap=" . urlencode($sitemapUrl);
                    @file_get_contents($pingUrl);
                });
        })->daily();

        // تحليل أداء المقالات أسبوعياً
        $schedule->call(function () {
            // تحليل مقالات لم تحصل على زيارات
            Blog::published()
                ->where('views', '<', 10)
                ->where('published_at', '<', now()->subMonth())
                ->each(function ($blog) {
                    // إعادة كتابة الـ meta description
                    $blog->meta_description = $this->optimizeMetaDescription($blog);
                    $blog->save();
                });
        })->weekly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
