<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registercheck extends FormRequest
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
            'user_tel'=>'required',
            'user_pwd'=>'required',
            'user_pwd1'=>'required'
        ];
    }

    public function messages(){
        return[
            'user_tel.required'=>'手机号不能为空',
            'user_pwd.required'=>'密码不能为空',
            'user_pwd1.required'=>'密码不能为空',
        ];
    }

}
