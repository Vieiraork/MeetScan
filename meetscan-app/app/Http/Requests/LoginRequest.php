<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ds_email' => 'required|max:200',
            'ds_senha' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ds_email.required' => 'O campo E-mail é obrigatório',
            'ds_email.max'      => 'O campo E-mail deve conter no máximo 200 caracteres',
            'ds_senha.required' => 'O campo Senha é obrigatório'
        ];
    }
}
