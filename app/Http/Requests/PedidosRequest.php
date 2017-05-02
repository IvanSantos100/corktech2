<?php

namespace CorkTech\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidosRequest extends FormRequest
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
        $request = \Request::all();  //ntrada Movimentação  Saída

        if($request['tipo'] === 'Movimentação'){
            if (\Auth::user()->centrodistribuicao_id != 1) {
                return [
                    'tipo' => "required",
                ];
            }
            if($request['origem_id'] == $request['destino_id']){
                return [
                    'origem' => 'required'
                ];
            }

            return [
                'origem_id' => 'required',
                'destino_id' => 'required'
            ];
        }

        return [
            'tipo' => "required",
        ];
    }
}
