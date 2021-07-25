<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "email" => "required|string|exists:emails,email",
            "password" => "required|string"
        ];
    }

    /**
     * Scribe documentation
     * 
     * @return array
     */
    public function bodyParameters()
    {
        return [
            "email" => [
                "description" => "The primary email for the user's account"
            ],
            "password" => [
                "description" => "The secret word for the user's account"
            ]
        ];
    }
}
