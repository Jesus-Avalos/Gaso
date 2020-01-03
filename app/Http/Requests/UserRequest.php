<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        if ($this->method() == 'PUT')
        {
            $pass_rule = 'required|min:6|max:18';
            $email_rule = [
                'required',
                Rule::unique('users')->ignore($this->segment(2))
            ];
        }
        else
        {
            $pass_rule = 'required|confirmed|min:6|max:18';
            $email_rule = 'required|email|unique:users,email';
        }
        return [
            'password'  => $pass_rule,
            'email'     => $email_rule
        ];
    }
}
