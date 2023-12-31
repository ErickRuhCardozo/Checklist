<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:30'],
            'password' => ['required', 'min:4'],
            'type' => ['required', 'numeric'],
            'work_period' => ['required', 'numeric'],
            'unity_id' => ['required', 'numeric'],
        ];
    }
}
