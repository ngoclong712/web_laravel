<?php

namespace App\Http\Requests;

use App\Enums\StudentsStatusEnum;
use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
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
                Rule::in(StudentsStatusEnum::asArray()),
            ],
            'avatar' => [
                'nullable',
                'image',
                'file'
            ],
            'course_id' => [
                'required',
                Rule::exists(Course::class, 'id'),
            ]
        ];
    }
}
