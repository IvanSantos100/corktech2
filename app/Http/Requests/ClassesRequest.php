<?php

namespace CorkTeck\Http\Requests;

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
            'tamanho' => "required|max:20",
            'espessura' => "required|max:20",
            'atacado' => "required|max:20",
            'varejo' => "required|max:20",
            'granel' => "required|max:20",
        ];
    }
}
