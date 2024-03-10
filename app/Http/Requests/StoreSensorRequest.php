<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreSensorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (DB::table('aquarium')->where('user_id', Auth::id())->where('id', $this->input('aquariumId'))->exists()) {
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
            'serialNum' => 'required|max:255',
            'aquariumId' => 'required|max:11|exists:aquarium,id',
            'sensor_type' => 'required|max:255',
            'senName' => 'required|max:255',
        ];
    }
}
