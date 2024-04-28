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
            'ds_codigo_acesso' => 'required|min:9|max:9',
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
            'ds_codigo_acesso.min'      => 'O campo Código deve ter no mínimo 9 dígitos',
            'ds_codigo_acesso.max'      => 'O campo Código deve ter no máximo 9 dígitos',
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
        $codigo = Codigo::where('id_usuario', '=', $validator->attributes()['id_usuario'])->first();

        $validator->after(function ($validator) use ($codigo) {
            if (!is_null($codigo)) {
                $validator->errors()->add('id_usuario', 'Não é possível associar mais de um código a um usuário');
            }
        });

        return;
    }
}
