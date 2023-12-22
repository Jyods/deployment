<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'definition' => 'required|string',
            'date' => 'required|date',
            'fine' => 'required|numeric',
            'isRestricted' => 'required|boolean',
            'restrictionClass' => 'required|string',
            'entry_id' => 'required|integer',
        ];
    }
}
