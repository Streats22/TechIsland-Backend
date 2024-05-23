<?php

namespace App\Filament\Imports;

use App\Models\Workshops;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class WorkshopsImporter extends Importer
{
    protected static ?string $model = Workshops::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('start_date')
                ->rules(['date']),
            ImportColumn::make('start_time'),
            ImportColumn::make('end_date')
                ->rules(['date']),
            ImportColumn::make('end_time'),
            ImportColumn::make('type')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('company_school')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
        ];
    }

    public function resolveRecord(): ?Workshops
    {
        // return Workshops::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Workshops();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your workshops import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
