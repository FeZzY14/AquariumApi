<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSensorRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'serialNum' => 'sometimes|required|max:255',
            'aquariumId' => 'sometimes|required|max:11',
            'sensor_type' => 'sometimes|required|max:255',
            'name' => 'sometimes|required|max:255',
        ];
    }
}
