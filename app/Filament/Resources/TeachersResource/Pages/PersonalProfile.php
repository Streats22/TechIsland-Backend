<?php

namespace App\Filament\Resources\TeachersResource\Pages;

use Filament\Pages\Page;
use Filament\Tables;

class PersonalProfile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Profile';
    protected static string $view = 'filament.pages.personal-profile';

    public $teacher;
    public $students;

    public function render(): \Illuminate\Contracts\View\View
    {
        return $this->view('filament.pages.personal-profile', [
            'teacher' => auth()->user(),  // Example context
            'students' => auth()->user()->students()->get()
        ]);
    }
    public function mount(): void
    {
        $this->teacher = auth()->user();  // Assuming the teacher uses the same auth system
        $this->students = $this->teacher->students()->get();
    }

    protected function getHeaderWidgets(): array
    {
        return [
            Tables\Widgets\Table::make()
                ->columns([
                    Tables\Columns\TextColumn::make('student_number')->label('Student Number'),
                    Tables\Columns\TextColumn::make('first_name')->label('First Name'),
                    Tables\Columns\TextColumn::make('last_name')->label('Last Name'),
                    // Add other columns as necessary
                ])
                ->records($this->students)
                ->emptyState('No students assigned yet')
        ];
    }
}

