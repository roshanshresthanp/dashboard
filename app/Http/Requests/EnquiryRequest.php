<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
class EnquiryRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|integer',  
            'message' => 'required|string|min:10|max:1000',           
            'source'=> 'required|string|max:50',
            'parent_id' =>'nullable|integer',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['status'=>request()->status=='on' ? 2 :1]);
    }
}
