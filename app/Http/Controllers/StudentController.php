<?php

namespace App\Http\Controllers;


use App\Models\Students;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\Request;


class StudentController extends Controller
{
    public function create(Request $request)
    {

        $data = Request::validate([
            'email' => ['required', 'string', 'email', 'unique:students'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name' => ['required', 'boolean'],
            'student_number' => ['nullable'],
            'result_1' => ['nullable'],
            'result_2' => ['nullable'],
            'result_3' => ['nullable'],
            'school_id' => ['nullable'],
            'visit_date' => ['nullable'],
        ]);
       $student = Students::create($data);
        return $student;
    }
    public function edit(Request $request)
    {
        $data = Request::validate([
            'email' => ['required', 'string', 'email', 'unique:students'],
            'name' => ['required', 'boolean'],
            'student_number' => ['nullable'],
            'result_1' => ['nullable'],
            'result_2' => ['nullable'],
            'result_3' => ['nullable'],
            'school_id' => ['nullable'],
            'visit_date' => ['nullable'],
        ]);
        $studentRequest =  Students::where('id' , $data->id);
        $student =  $studentRequest->update($data);

        return $student;
    }


}
