<?php

namespace Modules\Anexos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
}
