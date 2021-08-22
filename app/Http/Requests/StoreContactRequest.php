<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "firstName" => ["required", "alpha"],
            "middleName" => ["nullable", "alpha"],
            "lastName" => ["required", "alpha"],
            "birthDate" => ["required", "date"],
            "emailAddress" => ["nullable", "email"],
            "homePhone" => ["required_without_all:workPhone,mobilePhone"],
            "workPhone" => ["required_without_all:homePhone,mobilePhone"],
            "mobilePhone" => ["required_without_all:homePhone, workPhone"]
        ];
    }
}
