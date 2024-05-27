<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('codenames:assign', function () {
    $this->handle();
})->daily();

Artisan::command('codenames:clear', function () {
    $this->handle();
})->daily();

Artisan::command('assign:roles {userType}', function () {
    $this->handle();
})->daily();
