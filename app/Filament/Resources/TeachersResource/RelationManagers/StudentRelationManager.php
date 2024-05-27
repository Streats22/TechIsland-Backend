<?php

namespace App\Filament\Resources\TeachersResource\RelationManagers;

use App\Models\Teachers;
use App\Models\Students;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;

class StudentRelationManager extends RelationManager
{
    protected static string $relationship = 'students';  // Make sure this matches the relationship name in Teachers model


    public function form(Form|Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('Student_number')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('student_number')->label('Student Number'),
        ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}

