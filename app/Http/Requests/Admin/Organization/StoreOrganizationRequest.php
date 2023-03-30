<?php

namespace App\Http\Requests\Admin\Organization;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrganizationRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'image' => ['required', 'image', 'max:2048'],
            'email' => ['required', 'unique:users'],
            'level' => ['required', Rule::in(config('constants.ORGANIZATION.LEVEL'))],
            'faculty_id' => ['sometimes', 'exists:faculties,id'],
            'password' => ['required', 'string', 'confirmed'],
            'description' => ['sometimes']
        ];
    }
}
