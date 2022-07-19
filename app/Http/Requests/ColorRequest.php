<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
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
            'name'   => 'required|unique:colors,name|min:2|max:20',
            'status' => 'nullable|in:active,inactive',
        ];
    }
 
    public function updateRules(): array
    {
        return [
            'name'   => 'required|min:2|max:50|unique:colors,name,'.$this->color.',id',
            'status' => 'nullable|in:active,inactive',
        ];
    }
}
