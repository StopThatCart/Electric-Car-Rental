<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //W sumie używane.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100|min:3',
            'email' => 'required|string|unique:users,email|email:rfc|min:5|max:255',
            'password' => 'required|string|max:255|min:4',
            'password2' => 'required|same:password',
        ];
    }
    public function messages(): array
    {
        return [
            'password2.required' => __('pass2 required'),
            'password2.same' => __('passwords do not match'),
        ];
    }
}
