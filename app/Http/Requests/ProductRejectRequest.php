<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRejectRequest extends FormRequest
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
            'total'  => 'required|numeric',
            'price'  => 'required|numeric',           
            'note'   => 'required|string',
            'status' => 'required|in:active,inactive',
            'prod_id' => 'required|numeric',
        ];
    }
 
    public function updateRules(): array
    {
        return [
            'total'  => 'required|numeric',
            'price'  => 'required|numeric',
            'note'   => 'required|string',
            'status' => 'required|in:active,inactive',
            'prod_id' => 'required|numeric',
        ];
    }
}
