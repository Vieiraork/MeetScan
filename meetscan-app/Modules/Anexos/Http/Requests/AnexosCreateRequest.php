<?php

namespace Modules\Anexos\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Anexos\Entities\Anexo;
use Modules\Usuarios\Entities\Usuario;

class AnexosCreateRequest extends FormRequest
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
            'ds_arquivo' => 'nullable',
            'id_usuario' => 'required',
            'vl_arquivo' => 'required'
        ];
    }

    /**
     * 
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'id_usuario.required' => 'Selecione o usuário que pertence a foto',
            'vl_arquivo.required' => 'Selecione um arquivo de foto associado ao usuário'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param $validator
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        $anexo = Anexo::where('id_usuario', '=', $validator->attributes()['id_usuario'])->first();

        $validator->after(function ($validator) use ($anexo) {
            if (!is_null($anexo)) {
                $validator->errors()->add('id_usuario', 'Não é possível enviar mais de uma imagem para um usuário');
            }
        });

        return;
    }
}
