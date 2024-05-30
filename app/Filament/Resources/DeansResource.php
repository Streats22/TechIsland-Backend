<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeansResource\Pages;
use App\Filament\Resources\DeansResource\RelationManagers;
use App\Models\Deans;
use App\Models\Schools;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DeansResource extends Resource
{
    protected static ?string $model = Deans::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

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
                Forms\Components\TextInput::make('administrator_id')
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
            //
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        // Retrieving the teacher directly using the auth guard.

        $admin = Auth::guard('web')->user();
        $dean = Auth::guard('dean')->user();
        if ($dean){
            return static::$model::where('id', $dean->id);
        } else if($admin){
            return static::$model::query();
        }
        return static::$model::where('id', 0);
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDeans::route('/'),
            'create' => Pages\CreateDeans::route('/create'),
            'edit' => Pages\EditDeans::route('/{record}/edit'),
        ];
    }
}
