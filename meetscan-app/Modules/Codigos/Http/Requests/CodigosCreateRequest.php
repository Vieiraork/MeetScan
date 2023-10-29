<?php

namespace Modules\Codigos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Codigos\Entities\Codigo;
use Modules\Usuarios\Entities\Usuario;

class CodigosCreateRequest extends FormRequest
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
            'ds_codigo_acesso' => 'required|min:8|max:8|unique:tb_codigo_acesso',
            'id_usuario'       => 'required'
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
            'ds_codigo_acesso.required' => 'O campo Código é obrigatório',
            'ds_codigo_acesso.min'      => 'O campo Código deve ter no mínimo 8 dígitos',
            'ds_codigo_acesso.max'      => 'O campo Código deve ter no máximo 8 dígitos',
            'ds_codigo_acesso.unique'   => 'O Código inserido já foi cadastrado para outro modador',
            'id_usuario.required'       => 'O campo Usuário é obrigatório'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        //
    }
}
