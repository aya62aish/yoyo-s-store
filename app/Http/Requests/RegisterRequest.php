<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;


class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
protected function failedValidation(Validator $validator)
{
    if($this->is('api/*')){
        $response = ApiResponse::sendresponse(422,'validation error', $validator->errors());
        //need to change to validate
        throw new ValidationException($validator, $response);
    }
}
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',                 // Field is required
                'string',                   // Must be a string
                'max:255',                  // Maximum length of 255 characters
                'regex:/^[a-zA-Z\s]+$/',    // Only letters and spaces allowed
                'min:2',                    // Minimum 2 characters
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'phone' => [
                'required',                                 // Field is required
                'string',                                   // Must be a string
                'min:10',                                   // Minimum 10 characters
                'max:15',                                   // Maximum 15 characters (adjust for your region)
                'regex:/^\+?[0-9]{10,15}$/',                // Allow international format (optional + sign)
                'unique:users,phone',                       // Must be unique in 'users' table
            ],
            'password' => [
                'required',                                 // Field is required
                'string',                                   // Must be a string
                'min:8',                                    // Minimum length of 8 characters
                'max:255',                                  // Maximum 255 characters
                'confirmed',                                // Must match password_confirmation field
                'regex:/[A-Z]/',                            // At least one uppercase letter
                'regex:/[a-z]/',                            // At least one lowercase letter
                'regex:/[0-9]/',                            // At least one number
                'regex:/[@$!%*#?&]/',                       // At least one special character
                'not_regex:/\s/',                           // No spaces allowed
                'not_in:password,12345678,qwerty,letmein',  // Disallow common passwords
            ],
            'fcm_token'=>
            [
                'required',
                'string',
            ]
        ];
    }
}
