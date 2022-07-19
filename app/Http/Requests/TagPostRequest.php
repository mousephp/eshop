<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagPostRequest extends FormRequest
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
            'name'   => 'required|unique:post_tags,name|min:3|max:50',
            'status' => 'nullable|in:active,inactive',
        ];
    }
 
    public function updateRules(): array
    {
        return [
            'name'   => 'required|min:3|max:50|unique:post_tags,name',$this->tagPost.',$id',
            'status' => 'nullable|in:active,inactive',
        ];
    }
 
 
    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên Thể Loại!',
            'name.unique'   => 'Tên Thể Loại đã tồn tại, vui lòng nhập lại!',
            'name.min'      => 'Tên Thể Loại gồm ít nhất 3 ký tự!',
            'name.max'      => 'Tên Thể Loại gồm tối đa 50 ký tự!'   
        ];
    }
}
