<?php

namespace CorkTeck\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstoquesRequest extends FormRequest
{
    /**
     *
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
            'lote' => "required|max:30",
            'valor' => "required|numeric",
            'centrodistribuicao_id' => "exists:centro_distribuicoes,id",
            'produto_id' => "exists:produtos,id",
        ];
    }
}
