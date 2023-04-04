<?php

namespace App\Http\Requests\Admin\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'image' => ['sometimes', 'image', 'max:10240'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->student->user->id)],
            'password' => ['sometimes', 'nullable', 'string', 'confirmed'],
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'sid' => ['required', 'string', Rule::unique('students', 'sid')->ignore($this->student->id), 'min:10'],
            'faculty_id' => ['required', 'exists:faculties,id'],
            'year' => ['required', 'integer', 'digits:4', 'min:1900', 'max:2050']
        ];
    }
}
