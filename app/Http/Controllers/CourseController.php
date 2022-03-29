<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $data = Course::get();

        return view('course.index', [
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('course.create');
    }

    public function store(Request $request)
    {
        // $object = new Course();
        // $object->fill($request->except('_token'));
        // $object->save();

        Course::create($request->except('_token'));

        return redirect()->route('courses.index');
    }

    public function edit(Course $course)
    {
        return view('course.edit', [
            'each' => $course,
        ]);
    }

    public function update(Request $request, Course $course)
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

        $course->fill($request->except('_token'));
        $course->save();

        return redirect()->route('course.index');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        // Course::destroy($course->id);
        // Course::where('id', $course->id)->delete();

        return redirect()->route('course.index');
    }
}
