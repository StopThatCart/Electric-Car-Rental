<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreCarRequest extends FormRequest
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
            'brand_id' => 'required|integer|exists:brands,id|max:100|min:1',
            'model' => 'required|string|unique:cars|max:100|min:1',
            'description' => 'required|string|max:200|min:1',
            'description_en' => 'required|string|max:200|min:1',
            'year' => 'required|integer|min:2000|max:'.Carbon::now()->year,
            'battery' => 'required|numeric|min:1|max:200',
            'seats' => 'required|int|min:1|max:100',
            'gear' => 'required|string|in:Manual,Automatic',
            'img' => 'required|string|max:50',
        ];
    }
}
