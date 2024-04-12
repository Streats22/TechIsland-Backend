<?php

namespace App\Models;

use Filament\Forms\Components\Wizard\Step;
use Shipu\WebInstaller\Concerns\StepContract;

class OverviewInstaller implements StepContract
{
    public static function make(): Step
    {
        return Step::make('overview')
            ->label('Overview')
            ->schema([
                // Add Filament Fields Here
            ]);
    }
}
