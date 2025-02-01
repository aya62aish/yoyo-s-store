<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
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
        $response = ApiResponse::sendresponse(422,'validation error', $validator->messages()->all());
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
            'phone' => [
                'required',                                 // Field is required
                'string',                                   // Must be a string
                'min:10',                                   // Minimum 10 characters
                'max:15',                                   // Maximum 15 characters (adjust for your region)
            ],
            'password' => [
                'required',                                 // Field is required
            ],
        ];
    }
}