<?php

namespace App\Http\Requests\Organization\Event;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'banner' => ['required', 'image', 'dimensions:min_width=400,min_height=200'],
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
