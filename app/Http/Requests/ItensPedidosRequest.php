<?php

namespace CorkTeck\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItensPedidosRequest extends FormRequest
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
            'descricao' => "required|max:50",
            'preco' => "required|numeric",
            'estampa_id' => "exists:estampas,id",
            'classe_id' => "exists:classes,id",
            'tipoproduto_id' => "exists:tipo_produtos,id",
        ];
    }
}
