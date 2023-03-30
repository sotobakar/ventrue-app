<?php

namespace App\Http\Requests\Admin\Organization;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrganizationRequest extends FormRequest
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
            'name' => ['sometimes'],
            'image' => ['sometimes', 'image', 'max:10240'],
            'email' => ['sometimes', 'email', Rule::unique('users')->ignore($this->organization->user->id)],
            'password' => ['sometimes', 'confirmed'],
            'description' => ['sometimes'],
            'level' => ['sometimes'],
            'faculty_id' => ['sometimes', 'exists:faculties,id'],
        ];
    }
}
