<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
        'brand_id' => 'sometimes|required|integer|exists:brands,id|max:100|min:1',
        'name' => 'required|string|max:100|min:3',
        'email' => 'required|string|unique:users,email,'.$this->user->id.'|email:rfc|min:5|max:255',
        'password' => 'sometimes|required|string|max:255|min:4',
        'role_id' => 'sometimes|required|integer|in:1,2,3',
    ];
    }

}
