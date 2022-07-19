<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'name'    => 'required|min:3|max:50|unique:tags,name',
            'email'   => 'required|email',
            'address' => 'required|min:3',
            'phone'   => 'required|unique:suppliers,phone',
            'status'  => 'required|in:active,inactive',
            'shop_name'  => 'nullable',
        ];
    }
 
    public function updateRules(): array
    {
        return [
            'name'    => 'required|min:3|max:50|unique:tags,name,'.$this->supplier.',id',
            'email'   => 'required|email',
            'address' => 'required|min:3',
            'phone'   => 'required|unique:suppliers,phone,'.$this->supplier.',id',
            'status'  => 'required|in:active,inactive',
            'shop_name'  => 'nullable',
        ];
    }

}
