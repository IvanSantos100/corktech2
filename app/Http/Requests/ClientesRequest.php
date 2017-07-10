<?php

namespace CorkTech\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientesRequest extends FormRequest
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

        $id = $this->route('cliente');
        $tipo = \Request::input('tipo');
        switch ($tipo){
            case 1: $tipo = 11; break;
            case 2: $tipo = 14; break;
        }
        return [
            'tipo' => "required",
            'nome' => "required",
            'documento' => "required|min:$tipo|max:$tipo|unique:clientes,documento,$id|documento",
            'endereco' => "required",
            'bairro' => "required",
            'cidade' => "required",
            'uf' => "required",
            'cep' => "required|numeric|digits:8",
            'responsavel' => $tipo == 2 ? "required" : '',
            'fone' => "required|numeric",
            'celular' => "required|numeric"
        ];
    }

    public function messages()
    {
        $tipo = \Request::input('tipo');
        switch ($tipo){
            case 1: $tipo = 'CPF'; break;
            case 2: $tipo = 'CNPJ'; break;
        }
        return [
            'documento.documento' => "$tipo inválido"
        ];
    }

}
