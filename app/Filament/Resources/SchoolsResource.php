<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolsResource\Pages;
use App\Filament\Resources\SchoolsResource\RelationManagers;
use App\Models\Schools;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolsResource extends Resource
{
    protected static ?string $model = Schools::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('school_name')->label('School Name'),
            Forms\Components\TextInput::make('school_dean')->nullable()->label('School Dean'),
            Forms\Components\TextInput::make('adress')->label('Address'),
            Forms\Components\TextInput::make('street')->nullable()->label('Street'),
            Forms\Components\TextInput::make('number')->nullable()->label('Number'),
            Forms\Components\TextInput::make('number_extra')->nullable()->label('Number Extra'),
            Forms\Components\TextInput::make('school_phone')->nullable()->label('School Phone'),
            Forms\Components\TextInput::make('contact_person_name')->nullable()->label('Contact Person Name'),
            Forms\Components\TextInput::make('contact_person_email')->nullable()->label('Contact Person Email')->email(),
            Forms\Components\TextInput::make('contact_person_phone')->nullable()->label('Contact Person Phone'),
        ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('school_name'),
                Tables\Columns\TextColumn::make('contact_person_name'),
                Tables\Columns\TextColumn::make('contact_person_email'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchools::route('/'),
            'create' => Pages\CreateSchools::route('/create'),
            'edit' => Pages\EditSchools::route('/{record}/edit'),
        ];
    }
}
