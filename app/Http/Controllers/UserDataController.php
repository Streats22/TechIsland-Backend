<?php

namespace App\Http\Controllers;

use App\Models\Deans;
use App\Models\Schools;
use App\Models\Students;
use App\Models\Teachers;
use App\Models\Workshops;
use Illuminate\Support\Facades\Request;


class UserDataController extends Controller
{
    public function index()
    {
        $students  = Students::get();
        $teachers =  Teachers::get();
        $deans  = Deans::get();
        $schools =  Schools::get();
        $workshops = Workshops::get();
        return [
            'Student' => $students,
            'Teachers' => $teachers,
            'Deans' => $deans,
            'Schools' => $schools,
            'Workshops' => $workshops,
        ];

    }

    public function show($id)
    {
        $student = Students::where('id', $id)->first();
        $teacher = Teachers::where('id', $student->teacher_id)->first();
        $workshop_1 = Workshops::where('id' , $student->result_1 )->first();
        $workshop_2 = Workshops::where('id' , $student->result_2 )->first();
        $workshop_3 = Workshops::where('id' , $student->result_3 )->first();
        $school = Schools::where('id', $student->school_id)->first();
        if ($teacher->last_name === '') {
            $lastname = 'achternaam niet bekend';
        }
        else{
                $lastname = $teacher->last_name;
            }
        if ($student) {
            return [
                'name' => $student->name,
                'school' => $school->school_name,
                'student_number' => $student->student_number,
                'codename' => $student->codename,
                'email' => $student->email,
                'teacher' => $lastname,
                'uitslag1' => $workshop_1->name,
                'uitslag2' => $workshop_2->name,
                'uitslag3' =>  $workshop_3->name,
                'visit_date' => $student->visit_date
            ];

        }
    }
}

