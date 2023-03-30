<?php

namespace App\Http\Requests\Admin\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEventRequest extends FormRequest
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
            'banner' => ['sometimes', 'image', 'dimensions:min_width=400,min_height=200'],
            'type' => ['required', 'string', Rule::in(['offline', 'online', 'hybrid'])],
            'event_category' => ['required', 'exists:event_categories,id'],
            'location' => ['required'],
            'meeting_link' => ['sometimes'],
            'start' => ['required'],
            'end' => ['required'],
            'registration_start' => ['required'],
            'registration_end' => ['required'],
            'description' => ['required', 'string', 'min:50']
        ];
    }
}
