<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name'=>'required|string|max:255',
            'mobile'=>'required|regex:/\b\d{10}\b/|unique:users,mobile,'.$this->id,
            // 'password'=>'nullable|regex:/\b\d{4}\b/',
            'username' => 'nullable|unique:users,username'.$this->id,
            'mobile' => ['required','string','size:10','unique:users,mobile,'.$this->id],
            'email' => 'nullable|unique:users,email,'.$this->id,
            'gender' => 'nullable',
            'image' => 'nullable',
            'address' => 'nullable|max:250',
            // 'password' => ['required', Password::min(8)->letters()->numbers()->symbols()],
            'confirm_password' => 'required|same:password',
        ];
    }
}
