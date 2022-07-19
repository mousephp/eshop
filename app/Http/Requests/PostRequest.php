<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'       => 'string|required|unique:posts,title',
            'quote'       => 'string|nullable',
            'summary'     => 'string|required',
            'description' => 'string|nullable',
            'photo'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id'     => 'required|exists:users,id',
            'post_cate_id'=> 'required|exists:post_categories,id',
            'status'      => 'required|in:active,inactive',
            'tags'        => 'required',
        ];
    }
 
    public function updateRules(): array
    {
        return [
            'title'       => 'string|required|unique:posts,title,'.$this->post.',id',
            'quote'       => 'string|nullable',
            'summary'     => 'string|required',
            'photo'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'string|nullable',
            'user_id'     => 'required|exists:users,id',
            'post_cate_id'=> 'required|exists:post_categories,id',
            'status'      => 'required|in:active,inactive',
            'tags'        => 'required',
        ];
    }
 
 
    public function messages()
    {
        return [
     
        ];
    }
}
