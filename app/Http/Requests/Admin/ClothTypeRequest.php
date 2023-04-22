<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ClothTypeRequest extends FormRequest
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
            'name'=>['required','string','max:50','unique:cloth_types,name,'.$this->cloth_type],
            'parent_id'=>'integer',
            'rate'=>'required|numeric',
            'image'=>'nullable|max:250|url'
            // 'guard_name'=>'required|max:10',
        ];
        
    }

    protected function prepareForValidation()
    {
        $this->merge(['slug'=>Str::slug($this->name),'status'=>request()->status=='on' ? 1 : 0]);

    }
}
