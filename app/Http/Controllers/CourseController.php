<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\DestroyRequest;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
    public function index()
    {
        return view('course.index');
    }

    public function api()
    {
        return DataTables::of(Course::query())
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

    public function create()
    {
        return view('course.create');
    }

    public function store(StoreRequest $request)
    {
        // $object = new Course();
        // $object->fill($request->validated());
        // $object->save();

        Course::create($request->validated());

        return redirect()->route('courses.index');
    }

    public function edit(Course $course)
    {
        return view('course.edit', [
            'each' => $course,
        ]);
    }

    public function update(UpdateRequest $request, Course $course)
    {
        // Course::query()->where('id', $course->id)->update(
        //     $request->except([
        //         '_token',
        //         '_method',
        //     ])
        // );
        // $course->update(
        //     $request->except([
        //         '_token',
        //         '_method',
        //     ])
        // );

        $course->fill($request->validated());
        $course->save();

        return redirect()->route('courses.index');
    }

    public function destroy(DestroyRequest $request, $course)
    {
        // $course->delete();
        Course::destroy($course);
        // Course::where('id', $course->id)->delete();
        $arr = [];
        $arr['status'] = true;
        $arr['message'] = '';

        return response($arr, 200);
    }
}
