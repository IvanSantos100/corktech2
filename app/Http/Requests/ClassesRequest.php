<?php

namespace CorkTech\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassesRequest extends FormRequest
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
            'tamanho' => "required|max:20",
            'espessura' => "required|numeric",
            'atacado' => "required|numeric",
            'varejo' => "required|numeric",
            'granel' => "required|numeric",
        ];
    }
}
