<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title'         => 'required',
            'description'   => 'required',
            'wage'          => 'required|numeric',
            'category_id'   => 'required|numeric'
        ];
    }

    /**
     * messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required'        => 'O campo title não foi passado',
            'description.required'  => 'O campo description não foi passado',
            'wage.required'         => 'O campo wage não foi passado',
            'wage.numeric'          => 'wage não é um número',
            'category_id.required'  => 'O campo category_id não foi passado',
            'category_id.numeric'   => 'category_id não é um número'
        ];
    }
}
