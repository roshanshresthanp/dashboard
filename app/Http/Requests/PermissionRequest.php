<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class PermissionRequest extends FormRequest
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
        $id = $this->route('permission');
        return [
            'name'=>'required|string|max:50|unique:permissions,name,'.$id,
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['slug'=>Str::slug($this->name),'guard'=>'api']);

    }
}
