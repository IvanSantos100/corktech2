<?php

namespace CorkTech\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutosRequest extends FormRequest
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
        $id = $this->route('produto');

        return [
            'codigo' => "required|max:64|unique:produtos,codigo,$id",
            'descricao' => "required|max:50",
            'preco' => "required|numeric",
            'estampa_id' => "exists:estampas,id",
            'classe_id' => "exists:classes,id",
            'tipoproduto_id' => "exists:tipo_produtos,id",
        ];
    }
}
