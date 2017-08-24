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
        $request = \Request::all();

        $rules = [];
        if (\Auth::user()->centrodistribuicao_id == 1) {
            if($request['tipo'] == 2){
                $rules =  [
                    'origem_id' => 'required',
                    'destino_id' => 'required|different:origem_id',
                ];
            }
            if($request['tipo'] == 3){
                $rules =  [
                    'origem_id' => 'required',
                    'cliente_id' => 'required',
                ];
            }
        }else{
            if($request['tipo'] == 3){
                $rules =  [
                    'cliente_id' => 'required',
                ];
            }
        }

        $rules = array_merge($rules, [
            'tipo' => "required",
            'forma_pagamento' => "required",
            'desconto' => "numeric",
        ]);

        return $rules;
    }
}
