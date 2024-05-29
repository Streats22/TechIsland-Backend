<?php
namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('codenames:assign')->daily();
        $schedule->command('codenames:clear')->daily();
        $schedule->command('assign:roles {userType}')->daily();
    }
    protected $routeMiddleware = [
        // Existing middleware...
        'admin.auth' => \App\Http\Middleware\AdminAuthMiddleware::class,
        'teacher.auth' => \App\Http\Middleware\TeacherAuthMiddleware::class,
        'dean.auth' => \App\Http\Middleware\DeanAuthMiddleware::class,
    ];

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
