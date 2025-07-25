<?php

namespace App\Http\Controllers;

use App\Enums\StudentsStatusEnum;
use App\Models\Course;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new Student())->query();
        $name = Route::currentRouteName();
        $arr = explode('.', $name);
        $arr = array_map('ucfirst', $arr);
        $arr = implode(' - ', $arr);

        $arrStudentStatus = StudentsStatusEnum::getArrayView();

        View::share('title', $arr);
        View::share('arrStudentStatus', $arrStudentStatus);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('student.index');
    }

    public function api()
    {
        return Datatables::of($this->model)
            ->addColumn('age', function ($object) {
                return $object->age;
            })
            ->addColumn('edit', function ($object) {
                return route('students.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('students.destroy', $object);
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::query()->get();
        return view('student.create',[
            'courses' => $courses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $this->model->create($request->validated());

        return redirect()->route('students.index')->with('success', "Added Students Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
