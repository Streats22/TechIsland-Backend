<?php

namespace App\Filament\Imports;

use App\Models\Schools;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class SchoolsImporter extends Importer
{
    protected static ?string $model = Schools::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('school_name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('school_dean')
                ->rules(['max:255']),
            ImportColumn::make('adres')
                ->rules(['max:255']),
            ImportColumn::make('street')
                ->rules(['max:255']),
            ImportColumn::make('number')
                ->rules(['max:255']),
            ImportColumn::make('number_extra')
                ->rules(['max:255']),
            ImportColumn::make('school_phone')
                ->rules(['max:255']),
            ImportColumn::make('contact_person_name')
                ->rules(['max:255']),
            ImportColumn::make('contact_person_email')
                ->rules(['email', 'max:255']),
            ImportColumn::make('contact_person_phone')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?Schools
    {
        // return Schools::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Schools();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your schools import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
