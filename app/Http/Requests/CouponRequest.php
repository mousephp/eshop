<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            return $this->createRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }
 
    public function createRules(): array
    {
        return [
            'code'   => 'string|required|unique:coupons,code',
            'type'   => 'required|in:fixed,percent',
            'value'  => 'required|numeric',
            'status' => 'required|in:active,inactive'
        ];
    }
 
    public function updateRules(): array
    {
        return [
            'code'   => 'string|required|unique:coupons,code,'.$this->coupon.',id',
            'type'   => 'required|in:fixed,percent',
            'value'  => 'required|numeric',
            'status' => 'required|in:active,inactive'
        ];
    }
 
 
    public function messages()
    {
        return [
     
        ];
    }
}
