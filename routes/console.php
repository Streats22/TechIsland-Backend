<?php

use App\Models\Codename;
use App\Models\Students;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('codenames:assign', function () {
    $students = Students::whereNull('codename_id')
        ->where(function ($query) {
            $query->whereNull('visit_date')
                ->orWhere('visit_date', '>=', now()->toDateString());
        })
        ->take(40)->get();

    $codenames = Codename::where('is_assigned', false)->inRandomOrder()->take(count($students))->get();

    foreach ($students as $key => $student) {
        if (isset($codenames[$key])) { // Ensure there is a codename available to assign
            $student->codename_id = $codenames[$key]->id;
            $codenames[$key]->is_assigned = true;
            $codenames[$key]->save();
            $student->save();
        }
    }

    $this->info('Codenames have been assigned to students.');
})->describe('Assigns codenames to students without codenames who have an upcoming visit date.');
Artisan::command('codenames:clear', function () {
    \App\Models\Students::whereNotNull('codename_id')->update(['codename_id' => null]);
    $this->info('All codenames have been cleared.');
})->describe('Clears all codenames from users');


Artisan::command('assign:roles {userType}', function () {
    $this->handle();
})->daily();
