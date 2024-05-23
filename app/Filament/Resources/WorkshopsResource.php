<?php

namespace App\Filament\Resources;

use App\Filament\Imports\SchoolsImporter;
use App\Filament\Resources\TeachersResource\RelationManagers\StudentRelationManager;
use App\Filament\Resources\WorkshopsResource\Pages;
use App\Filament\Resources\WorkshopsResource\RelationManagers;
use App\Models\Workshops;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Table;


class WorkshopsResource extends Resource
{
    protected static ?string $model = Workshops::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('start_date')->nullable()->label('Start Date'),
                Forms\Components\TimePicker::make('start_time')->nullable()->label('Start Time'),
                Forms\Components\DatePicker::make('end_date')->nullable()->label('End Date'),
                Forms\Components\TimePicker::make('end_time')->nullable()->label('End Time'),
                Forms\Components\TextInput::make('type')->label('Type Workshop'),
                Forms\Components\TextInput::make('name')->label('Workshop benaming'),
                Forms\Components\TextInput::make('company_school')->label('School of bedrijfsnaam'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ImportAction::make()
                    ->importer(SchoolsImporter::class)
            ])
            ->columns([
             Tables\Columns\TextColumn::make('company_school')->label('School of bedrijf'),
                  Tables\Columns\TextColumn::make('name')->label('naam'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            StudentRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkshops::route('/'),
            'create' => Pages\CreateWorkshops::route('/create'),
            'edit' => Pages\EditWorkshops::route('/{record}/edit'),
        ];
    }
}
