<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
        return [
            'name'     => 'required|alpha|min:3|max:30|unique:users,name', //bail
            'email'    => 'required|email',
            'password' => 'required|min:5|max:50',//|confirmed
            'password_confirmation' => 'required|min:5|same:password'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute không được để trống',
            'name.min'      => ':attribute phải >= 3 ký tự',
            'name.max'      => ':attribute phải < 30 ký tự',   
            'name.alpha'    => ':attribute  không đúng định dạng',   
            'name.unique'   => ':attribute đã bị trùng',   

            'email.required'    => ':attribute không được để trống',
            'email.email'       => ':attribute không đúng định dạng',

            'password.required' => ':attribute không được để trống',
            'password.min'      => ':attribute phải >= 5 ký tự',
            'password.max'      => ':attribute phải <= 50 ký tự',

            'password_confirmation.same'     => 'password và xác nhận :attribute phải khớp', 
            'password_confirmation.min'      => ':attribute phải >= 5 ký tự',
            'password_confirmation.required' => ':attribute không được để trống'   
        ];
    }
    
     public function attributes(){
        return [
          'name'     => 'user', 
          'email'    => 'email', 
          'password' => 'password',
          'password_confirmation' => 'xác nhận password phải khớp'
        ];
    }
}
