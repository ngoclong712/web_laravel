<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\DestroyRequest;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new Course())->query();
        $name = Route::currentRouteName();
        $arr = explode('.', $name);
        $arr = array_map('ucfirst', $arr);
        $arr = implode(' - ', $arr);
        View::share('title', $arr);
    }
    public function api()
    {
        return Datatables::of($this->model->withCount('students'))
            ->filterColumn('name', function ($query, $keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })
            ->editColumn('created_at', function ($object) {
                return $object->year_created_at;
            })
            ->addColumn('edit', function ($object) {
                return route('courses.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('courses.destroy', $object);
            })
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('course.index');
    }

    public function apiName(Request $request)
    {
        $q = $request->get('q');
        return $this->model
            ->where('name', 'like', '%' . "$q" . '%')
            ->get([
            'id',
            'name',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
//        $course = new Course();
//        $course->fill($request->validated());
//        $course->save();
        $this->model->create($request->validated());

        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('course.edit', [
            'each' => $course,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $courseId)
    {
        //validate
//        $this->model->where('id', $courseId)
//            ->where('user', auth()->id)
//            ->firstOrFail();

//        Another way
//        $this->model->where('id', $courseId)->update(
//            $request->validated()
//        );
//        $this->model->update(
//          $request->validated();
//        );
        $object = $this->model->findOrFail($courseId);

        $object->fill($request->validated());
        $object->save();

        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request, $courseId)
    {
//        $this->model->find($courseId)->delete();
        $this->model->where('id', $courseId)->delete();

        $arr = [];
        $arr['status'] = true;
        $arr['message'] = '';

        return response($arr, 200);
    }
}
