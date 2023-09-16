<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:30'],
            'password' => ['nullable', 'min:4', 'max:10'],
            'type' => ['required', 'numeric'],
            'work_period' => ['required', 'numeric'],
            'unity_id' => ['required', 'numeric'],
        ];
    }
}
