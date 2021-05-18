<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;                                          // falseだとエラーでる
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|string|max:50",
            "email" => "required|email:strict,dns,spoof",
            "password" => "required|regex:/^[a-zA-Z0-9-_]+$/|min:8",
            "password_confirm" => "required",
        ];
    }
}
