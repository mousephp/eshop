<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductDetailRequest extends FormRequest
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
            'price'  => 'required|string|max:191',
            'amount' => 'required|numeric',
            'status' => 'nullable|in:active,inactive',
            // 'size'   => 'required|min:1|max:20',
            // 'color'  => 'required|min:2|max:20',
            // 'product' => 'required|numeric',
        ];
    }
 
    public function updateRules(): array
    {
        return [
            'price'  => 'required|string|max:191',
            'amount' => 'required|numeric',
            'status' => 'nullable|in:active,inactive',
            // 'size'   => 'required|min:1|max:20',
            // 'color'   => 'required|min:2|max:20',
            // 'product' => 'required|numeric',
        ];
    }
}
