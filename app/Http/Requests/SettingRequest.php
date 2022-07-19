<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'config_key'   => 'required|unique:settings,config_key|min:3|max:255',
            'config_value' => 'required|min:3',
            //'type'   => 'required',
        ];
    }
 
    public function updateRules(): array
    {
        return [
            'config_key'   => 'required|min:3|max:255|unique:settings,config_key,'.$this->setting,',id',
            'config_value' => 'required|min:3',
        ];
    }
 
 
    public function messages()
    {
        return [
            // 'name.required' => 'Bạn chưa nhập tên tags!',
            // 'name.unique'   => 'Tên tags đã tồn tại, vui lòng nhập lại!',
            // 'name.min'      => 'Tên tags gồm ít nhất 3 ký tự!',
            // 'name.max'      => 'Tên tags gồm tối đa 50 ký tự!'    
        ];
    }
}
