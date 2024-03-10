<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreMeasurementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (DB::table('aquarium')->join('sensor', 'id', '=', 'sensor.aquariumId')
            ->where('user_id', Auth::id())
            ->where('serialNum', $this->input('sensorNum'))
            ->exists()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'value' => 'required',
            'sensorNum' => 'required|max:255',
            'time' => 'required',
        ];
    }
}
