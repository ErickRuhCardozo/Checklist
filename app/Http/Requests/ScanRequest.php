<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'checklist_id' => ['required', 'numeric'],
            'place_id' => ['required', 'numeric'],
            'worker' => ['required'],
            'observations' => ['nullable'],
            'tasks' => ['nullable', 'array'],
        ];
    }
}
