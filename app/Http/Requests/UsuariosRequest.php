<?php

namespace CorkTeck\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuariosRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('usuario');
        return [
            'name' => "required",
            'email' => "required",
            'password' => "required",
            'centrodistribuicao_id' => "exists:centro_distribuicoes,id",
            'endereco' => "required",
            'bairro' => "required",
            'cidade' => "required",
            'uf' => "required",
            'cep' => "required|max:11",
            'fone' => "required",
            'celular' => "required"
        ];
    }

}