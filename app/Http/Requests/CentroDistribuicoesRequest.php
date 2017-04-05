<?php

namespace CorkTech\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CentroDistribuicoesRequest extends FormRequest
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
            'descricao' => "required|max:50",
            'tipo' => "required",
            'prazo_fabrica' => "required|numeric",
            'prazo_nacional' => "required|numeric",
            'prazo_regional' => "required|numeric",
            'valor_base' => "required|numeric",
        ];
    }
}
