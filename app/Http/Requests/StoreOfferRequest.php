<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOfferRequest extends FormRequest
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
            'car_id' => 'required|integer|exists:cars,id',
            'period' => [
                'required',
                'integer',
                'min:3',
                'max:30',
                Rule::unique('offers')->where(function ($query) {
                    return $query->where('car_id', $this->car_id);
                }),
            ],
            'price'  => 'required|numeric|min:1|max:900000',
        ];
    }
}
