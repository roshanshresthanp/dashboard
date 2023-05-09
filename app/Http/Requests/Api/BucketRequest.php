<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BucketRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cloth_id' => 'required|integer|exists:cloth_types,id',
            'cloth_category_id' => 'nullable|integer|exists:cloth_types,id',
            'count' => 'bail|required|integer|gt:0',
            // 'rate'=>'required|numeric'

        ];
    }
}
