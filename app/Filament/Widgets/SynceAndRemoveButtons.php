<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Artisan;

class SynceAndRemoveButtons extends Widget
{

    protected static string $view = 'filament.widgets.synce-and-remove-buttons';

    public function assignCodenames()
    {
        Artisan::call('codenames:assign');
        return redirect()->back()->with('success', 'Codenames assigned successfully.');
    }

    public function clearCodenames()
    {
        Artisan::call('codenames:clear');
        return redirect()->back()->with('success', 'Codenames cleared successfully.');
    }


    protected function getRoutes(): \Closure
    {
        return function ($router) {
            $router->post('/assign-codenames', [static::class, 'assignCodenames'])->name('assign-codenames');
            $router->post('/clear-codenames', [static::class, 'clearCodenames'])->name('clear-codenames');
        };
    }
}

