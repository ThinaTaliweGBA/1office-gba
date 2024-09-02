<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMembershipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'Name' => 'required|max:255',
            'Surname' => 'required',
            'IDNumber' => 'required',
            'Line1' => 'required',
            'City' => 'required',
            'Province' => 'required',
            'Country' => 'required',
            // 'Telephone' => 'required|integer|digits:10',
            'inputDay' => 'required',
            'inputMonth' => 'required|in:01,02,03,04,05,06,07,08,09,10,11,12',
            'inputYear' => 'required',
            'Email' => 'email',
            'PostalCode' => 'required',
            'memtype' => 'required|not_in:0',
        ];
    }
}
