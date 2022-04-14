<?php

namespace App\Http\Controllers;

use App\Enums\StudentStatusEnum;
use App\Models\Course;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    private Builder $model;

    public function __construct()
    {
        $this->model = (new Student())->query();
        $routeName   = Route::currentRouteName();
        $arr         = explode('.', $routeName);
        $arr         = array_map('ucfirst', $arr);
        $title       = implode(' - ', $arr);

        $arrStudentStatus = StudentStatusEnum::getArrayView();

        View::share('title', $title);
        View::share('arrStudentStatus', $arrStudentStatus);
    }

    public function index()
    {
        return view('student.index');
    }

    public function api(Request $request)
    {
        return DataTables::of($this->model->with('course'))
            ->editColumn('gender', function ($object) {
                return $object->gender_name;
            })
            ->editColumn('status', function ($object) {
                return StudentStatusEnum::getKeyByValue($object->status);
            })
            ->addColumn('age', function ($object) {
                return $object->age;
            })
            ->addColumn('course_name', function ($object) {
                return $object->course->name;
            })
            ->addColumn('edit', function ($object) {
                return route('students.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('students.destroy', $object);
            })
            ->filterColumn('course_name', function ($query, $keyword) {
                if ($keyword !== 'null') {
                    $query->whereHas('course', function ($q) use ($keyword) {
                        return $q->where('id', $keyword);
                    });
                }
            })
            ->filterColumn('status', function ($query, $keyword) {
                if ($keyword !== '0') {
                    $query->where('status', $keyword);
                }
            })
            ->make(true);
    }


    public function create()
    {
        $courses = Course::query()->get();

        return view('student.create', [
            'courses' => $courses,
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
        $path          = Storage::disk('public')->putFile('avatars', $request->file('avatar'));
        $arr           = $request->validated();
        $arr['avatar'] = $path;
        $this->model->create($arr);

        return redirect()->route('students.index')->with('success', 'Đã thêm thành công');
    }

    public function show(Student $student)
    {
        //
    }

    public function edit(Student $student)
    {
        //
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

    public function destroy(Student $student)
    {
        //
    }
}
