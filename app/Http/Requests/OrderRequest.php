<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'full_name'        => 'string|required',
            'address'          => 'string|required',
            'coupon'           => 'nullable|numeric',
            'phone'            => 'numeric|required',
            'post_code'        => 'string|nullable',
            'email'            => 'string|required',
            'province'         => "required",
            'district'         => "required",
            'ward'             => "required",
            'shipping_address' => 'string|required',
        ];
    }
 
    public function updateRules(): array
    {
        return [
            'full_name'        => 'string|required',
            'address'          => 'string|required',
            'coupon'           => 'nullable|numeric',
            'phone'            => 'numeric|required',
            'post_code'        => 'string|nullable',
            'email'            => 'string|required',
            'province'         => "required",
            'district'         => "required",
            'ward'             => "required",
            'shipping_address' => 'string|required',
        ];
    }
 
 
    public function messages()
    {
        return [
     
        ];
    }
}
