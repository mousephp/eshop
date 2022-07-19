<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'feature_image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_path'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'              => 'string|required',
            'summary'            => 'string|required',
            'description'        => 'string|required',            
            'quantity'           => "required|numeric",           
            'stock_in'           => "required|numeric",           
            'stock_out'          => "required|numeric",           
            // 'is_featured'        => 'sometimes|in:1,0',
            'status'             => 'required|in:active,inactive',
            'condition'          => 'required|in:default,new,hot',
            'price'              => 'required|numeric',
            'discount'           => 'nullable|numeric',
            'cate_id'            => 'required|exists:categories,id',
            'brand_id'           => 'required|exists:brands,id',
            'user_id'            => 'required|exists:users,id',
            'colors'             => 'required',
            'sizes'              => 'required',
        ];
    }
 
    public function updateRules(): array
    {
        return [
            'title'              => 'string|required|unique:products,title,'.$this->product.',id',
            'feature_image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_path'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'summary'            => 'string|required',
            'description'        => 'string|required',            
            'quantity'           => "required|numeric",           
            'stock_in'           => "required|numeric",           
            'stock_out'          => "required|numeric",           
            // 'is_featured'        => 'sometimes|in:1,0',
            'status'             => 'required|in:active,inactive',
            'condition'          => 'required|in:default,new,hot',
            'price'              => 'required|numeric',
            'discount'           => 'nullable|numeric',
            'cate_id'            => 'required|exists:categories,id',
            'brand_id'           => 'required|exists:brands,id',
            'user_id'            => 'required|exists:users,id',
            // 'colors'              => 'required',
            // 'sizes'               => 'required',
        ];
    }
 
 
    public function messages()
    {
        return [
     
        ];
    }
}
