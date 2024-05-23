<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentsResource\Pages;
use App\Filament\Resources\StudentsResource\RelationManagers;
use App\Models\Schools;
use App\Models\Students;
use App\Models\Workshops;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class StudentsResource extends Resource
{
    protected static ?string $model = Students::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                Forms\Components\TextInput::make('email'),
                Forms\Components\TextInput::make('student_number'),
                Forms\Components\Select::make('school_id')
                    ->preload()
                    ->options(Schools::pluck( 'school_name', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('result_1')
                    ->preload()
                    ->options(Workshops::pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('result_2')
                    ->preload()
                    ->options(Workshops::pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('result_3')
                    ->preload()
                    ->options(Workshops::pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\DatePicker::make('visit_date')->nullable(),
                Forms\Components\TextInput::make('teacher_id')
                    ->default(Auth::id())
                    ->hidden()
                    ->visible(false),
            ]);

    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student_number'),
                Tables\Columns\TextColumn::make('school.school_name'),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudents::route('/create'),
            'edit' => Pages\EditStudents::route('/{record}/edit'),
        ];
    }
}
