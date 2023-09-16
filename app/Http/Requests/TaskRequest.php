<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'min:4', 'max:30'],
            'period' => ['required', 'numeric'],
            'place_id' => ['required', 'numeric']
        ];
    }
}
