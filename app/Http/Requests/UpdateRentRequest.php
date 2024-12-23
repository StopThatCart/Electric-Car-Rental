<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UpdateRentRequest extends FormRequest
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
            'date_return' => 'sometimes|required|date|after_or_equal:date_rent|max:'.Carbon::now()->year,
            'state' => 'sometimes|required|string|in:"In progress","Waiting for you","Rented","Returned","Canceled"',
        ];
    }
}
