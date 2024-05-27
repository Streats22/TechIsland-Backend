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
use Illuminate\Http\Request;
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
        // Retrieving the dean directly using the 'dean' guard.
        $dean = Auth::guard('dean')->user();
        // Retrieving the admin using the 'web' guard.
        $admin = Auth::guard('web')->user();
        $teacher = Auth::guard('teacher')->user();

        if ($dean) {
            // Return the query filtered by dean_id if a dean is authenticated
            return static::$model::where('dean_id', $dean->id);
        }elseif($teacher){
            return static::$model::where('id', $teacher->id);
        } elseif ($admin) {
            // Return all records if an admin is authenticated
            return static::$model::query();
        }

        // Optionally, handle cases where there is no authenticated dean or admin
        // This might return no results or handle access differently
        return static::$model::where('id', 0); // Effectively returns no results
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
