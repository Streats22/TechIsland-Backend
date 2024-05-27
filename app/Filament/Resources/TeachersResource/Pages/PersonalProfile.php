<?php

namespace App\Filament\Resources\TeachersResource\Pages;

use App\Filament\Resources\TeachersResource;
use App\Models\Students;
use App\Models\Teachers;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PersonalProfile extends Page
{
    protected static string $resource = TeachersResource::class;

    protected static string $view = 'filament.resources.teachers-resource.pages.personal-profile';

    public $teacher;
    public $students;

    public function mount(): void
    {
        $this->teacher =  Teachers::find(auth()->id());
        $this->students = Students::where('teacher_id', $this->teacher->id )->get();
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('filament.resources.teachers-resource.pages.personal-profile', [
            'teacher' => $this->teacher,
            'students' => $this->students,
        ]);
    }
}
