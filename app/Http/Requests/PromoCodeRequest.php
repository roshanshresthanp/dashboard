<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
class PromoCodeRequest extends FormRequest
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
            'title'=>'required|string|max:255',
            'code'=>'required|string|max:255|unique:promo_codes,code,'.$this->promo_code,
            'promo_type'=>'nullable|max:255',
            'worth'=>'nullable|numeric|gt:0',
            // 'featured_status'=>'nullable',
            // // 'eligible'=>'required',
            'activation_date'=>'required|date|after_or_equal:today',
            'expire_date'=>'required|date|after_or_equal:activation_date',
            'usage_limit'=>'nullable|integer'
        ];
        
    }

    protected function prepareForValidation()
    {  
        try{
            $datePickerData = request()->range;
            $dateStrings = explode(' / ', $datePickerData);
            $startTimestamp = strtotime($dateStrings[0]);
            $endTimestamp = strtotime($dateStrings[1]);
    
            // Format the timestamps as date strings
            $startDate = date('Y-m-d H:i:s', $startTimestamp);
            $endDate = date('Y-m-d H:i:s', $endTimestamp);

            $this->merge([
                'activation_date'=>$startDate,
                'expire_date'=>$endDate,
                'slug'=>Str::slug($this->title),
                'status'=>request()->status=='on' ? 1 : 0,
                'featured_status'=>request()->featured_status=='on' ? 1 : 0
            ]);

            }catch(\Exception $e){
                // return redirect()->back()->with('error','Something went wrong !!');
            }
       

       



       



    }
}
