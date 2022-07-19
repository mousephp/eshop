<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
 
    public function createRules()
    {
        return [
            'title'       => 'string|unique:banners,title|required|max:50',
            'description' => 'string|nullable',
            'photo'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'      => 'required|in:active,inactive',
        ];
    }
 
    public function updateRules()
    {
        return [
            'title'       => 'string|required|max:50|unique:banners,title,'.$this->banner.',id',
            'description' => 'string|nullable',
            //'photo'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'      => 'required|in:active,inactive',
        ];
    }
 
 
    public function messages()
    {
        return [
     
        ];
    }
}
