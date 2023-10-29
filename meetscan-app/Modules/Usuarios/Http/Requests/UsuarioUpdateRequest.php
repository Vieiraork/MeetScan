<?php

namespace Modules\Usuarios\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioUpdateRequest extends FormRequest
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
            'no_usuario' => 'required|min:3|max:200',
            'ds_email'   => 'required',
            'ds_senha'   => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'no_usuario.required' => 'O campo Nome é obrigatório',
            'no_usuario.min'      => 'O campo Nome deve ter no mínimo 3 letras',
            'no_usuario.max'      => 'O campo Nome deve ter no máximo 200 letras',
            'ds_email.required'   => 'O campo E-mail é obrigatório'
        ];
    }
}
