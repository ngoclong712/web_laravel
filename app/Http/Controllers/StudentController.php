<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::query()->get();
        return view('students.index', [
            'students' => $students,
        ]);
    }

    public function create()
    {
        return view('students.create');
    }
    public function store(Request $request)
    {
        $student = new Student();
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->gender = $request->input('gender');
        $student->birthdate = $request->input('birthdate');
        $student->save();
    }
}
