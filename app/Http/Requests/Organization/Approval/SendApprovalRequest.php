<?php

namespace App\Http\Requests\Organization\Approval;

use Illuminate\Foundation\Http\FormRequest;

class SendApprovalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->approval->event->organization->id === $this->user()->organization->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
