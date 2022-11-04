<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'first_name'   => 'required|min:3',
            'last_name'    => 'required|min:3',
            'email'        => 'required|email|unique:students',
            'phone_number' => 'required|regex:/^\(\d{3}\)\s\d{3}\-\d{4}$/',
            'dob'          => 'required|regex:/^\d{1,2}\/\d{1,2}\/\d{4}$/',
            'sports'       => 'array',
            'sports.*'     => 'integer',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            "first_name.required"   => "First Name is required",
            "first_name.min"        => "First Name has to have at least :min characters.",
            "last_name.required"    => "Last Name is required",
            "last_name.min"         => "Last Name has to have at least :min characters.",
            "email.required"        => "Email Address is required",
            "email.email"           => "Email Address is not correct",
            "email.unique"          => "There is a student with the same email address",
            "phone_number.required" => "Phone Number is required",
            "phone_number.regex"    => "Wrong phone number format",
            "dob.required"          => "Date of Birth is required",
            "dob.regex"             => "Wrong date of birth format",
        ];
    }
}
