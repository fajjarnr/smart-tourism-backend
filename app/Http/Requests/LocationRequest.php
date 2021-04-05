<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phoneNumber' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'latitude' => ['required', 'string', 'max:255'],
            'longitude' => ['required', 'string', 'max:255'],
            'rate' => ['required', 'string', 'max:255'],
            'htm' => ['required', 'string', 'max:255'],
            'hours' => ['required', 'string', 'max:255'],
            'facilities' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'string', 'max:255'],
        ];
    }
}
