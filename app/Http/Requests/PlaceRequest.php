<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:5', 'max:30'],
            'qrcode' => ['required', 'max:30'],
            'unity_id' => ['required', 'numeric'],
            'allowedUserTypes' => ['required', 'array'],
        ];
    }
}
