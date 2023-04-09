<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

/**
 * @OA\Schema(
 *      title="Store User request",
 *      description="Store User request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
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
     * @OA\Property(
     *      title="email",
     *      description="Description of the new project",
     *      example="This is new project's description"
     * )
     *
     * @var string
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$this->user,
            'mobile' => ['required','string','size:10','unique:users,mobile,'.$this->user],
            'email' => 'nullable|unique:users,email,'.$this->user,
            'role_id' => 'required|integer|exists:roles,id',
            'address' => 'nullable',
                        // 'mobile' => 'integer',

        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['status'=>request()->status=='on' ? 1 : 0]);
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
