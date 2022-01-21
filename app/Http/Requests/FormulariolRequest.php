<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormulariolRequest extends FormRequest
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
            'cedula' => 'required',
            'nombres' => 'required',
            'depvot' => 'required',
            'munvot' => 'required',
            'lugvot' => 'required',
            'mesvot' => 'required',
            'celular' => 'required',
            'municipio' => 'required',
            'comuna' => 'required',
            'barrio' => 'required',
            'direccion' => 'required',
            'email' => 'required',
            'fecnac' => 'required',
            'genero' => 'required',
            'poblacion' => '',
            'ocupacion' => 'required',
            'profesion' => 'required',
            'aporte' => '',
        ];
    }

    public function messages()
    {
        return [
            'cedula.required' => 'El campo cédula es obligatoria',
        ];
    }
}
