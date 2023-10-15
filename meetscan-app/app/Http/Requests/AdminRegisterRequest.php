<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegisterRequest extends FormRequest
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
            'no_usuario' => 'required|max:250|min:3',
            'ds_email'   => 'required|max:250|email',
            'ds_senha'   => 'required|min:8'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'no_usuario.required' => 'O campo Nome é obrigatório',
            'no_usuario.max'      => 'O campo Nome deve ter no máximo 250 caracteres',
            'no_usuario.min'      => 'O campo Nome deve ter no mínimo 3 caracteres',
            'ds_email.required'   => 'O campo E-mail é obrigatório',
            'ds_email.max'        => 'O campo E-mail deve ter no máximo 250 caracteres',
            'ds_email.email'      => 'O campo E-mail está preenchido com um valor inválido',
            'ds_senha.required'   => 'O campo Senha é obrigatório',
            'ds_senha.min'        => 'O campo Senha deve ter no mínimo 8 caracteres'
        ];
    }
}
