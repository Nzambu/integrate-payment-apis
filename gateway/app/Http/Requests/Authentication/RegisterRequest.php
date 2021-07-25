<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "first_name" => "required|string|max:45",
            "middle_name" => "nullable|string|max:45",
            "last_name" => "required|string|max:45",
            "email" => "required|string|email:rfc,dns",
            "password" => "required|string|min:8|confirmed",
            "password_confirmation" => "required|string|min:8|string",
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
            "first_name" => [
                "description" => "The first name of the user"
            ],
            "middle_name" => [
                "description" => "The middle name of the user"
            ],
            "last_name" => [
                "description" => "The last name of the user"
            ],
            "email" => [
                "description" => "The primary email for the user's account"
            ],
            "password" => [
                "description" => "The secret word for user's account"
            ],
            "password_confirmation" => [
                "description" => "A confirmation of the secret word for the user's account"
            ]
        ];
    }
}
