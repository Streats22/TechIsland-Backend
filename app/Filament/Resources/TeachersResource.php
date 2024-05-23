<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeachersResource\Pages;
use App\Filament\Resources\TeachersResource\RelationManagers\StudentRelationManager;
use App\Models\Schools;
use App\Models\Teachers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TeachersResource extends Resource
{
    protected static ?string $model = Teachers::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name'),
                Forms\Components\TextInput::make('last_name'),
                Forms\Components\Select::make('school')
                    ->preload()
                    ->options(Schools::pluck('school_name', 'school_name'))
                    ->searchable(),
                Forms\Components\TextInput::make('email'),

                Forms\Components\TextInput::make('dean_id')
                    ->default(Auth::id())
                    ->hidden()
                    ->visible(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([

                Tables\Columns\TextColumn::make('last_name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('school'),
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
    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->isTeacher()) {
            return parent::getEloquentQuery()->where('teacher_id', auth()->id());
        }
        return parent::getEloquentQuery();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeachers::route('/create'),
            'edit' => Pages\EditTeachers::route('/{record}/edit'),
        ];
    }
}
