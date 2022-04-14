<?php

namespace App\Http\Requests;

use App\Enums\StudentStatusEnum;
use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:50',
            ],
            'gender' => [
                'required',
                'boolean',
            ],
            'birthdate' => [
                'required',
                'date',
                'before:today',
            ],
            'status' => [
                'required',
                Rule::in(StudentStatusEnum::asArray()),
            ],
            'avatar' => [
                'nullable',
                'file',
                'image',
            ],
            'course_id' => [
                'required',
                Rule::exists(Course::class, 'id'),
            ],
        ];
    }
}
