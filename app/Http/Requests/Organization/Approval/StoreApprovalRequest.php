<?php

namespace App\Http\Requests\Organization\Approval;

use Illuminate\Foundation\Http\FormRequest;

class StoreApprovalRequest extends FormRequest
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
            'id' => ['required'],
            'file_pendukung' => ['required'],
            'file_pendukung.*' => 'required|mimes:pdf,png,jpg,jpeg|max:2048',
        ];
    }
}
