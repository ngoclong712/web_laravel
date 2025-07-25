<?php

namespace App\Http\Requests\Course;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
                'bail',
                'required',
                'string',
                Rule::unique(Course::class, 'name')->ignore($this->id),
            ]
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ":attribute bắt buộc phải điền",
            'unique' => ":attribute đã tồn tại, vui lòng nhập :attribute mới",
        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'Tên',
        ];
    }
}
