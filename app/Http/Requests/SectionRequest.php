<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            'section_nom' => 'required|max:255|unique:sections,section_nom,'.$this->id

        ];
    }

    public function messages()
    {
        return [
            'section_nom.required' => "Le champ nom de la section est obligatoire.",
            'section_nom.unique' => "Le nom de la section a déjà été prise..",
        ];
    }
}
