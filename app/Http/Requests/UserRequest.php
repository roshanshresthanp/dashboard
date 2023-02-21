<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            // 'username' => 'required|unique:users,username'.$this->id,
            'mobile' => ['required','string','size:10','unique:users,mobile,'.$this->id],
            'email' => 'nullable|unique:users,email,'.$this->id,
            // 'gender' => 'required',
            // 'photo' => 'sometimes',
            'address' => 'nullable',
            'password' => ['required', Password::min(8)->letters()->numbers()->symbols()],
            'confirm_password' => 'required|same:password',

            // 'college_id' => 'sometimes',
        ];
    }

    // protected $redirect = '/api/users';

    // public function messages()
    // {
        // return [
        //     'name.email' => ' Yes email',
        //     'mobile.size' => ' contact is required.'
        // ];
    // }

}
