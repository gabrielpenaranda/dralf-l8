<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePersonaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (\Auth::user())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'apellido' => 'required|min:1|max:80',
                'nombre' => 'required|min:1|max:80',
                'telefono' => 'max:50',
                'email' => 'email|max:50',
                'tipopersonas_id' => 'required',
                'terceros_id' => 'required',
            ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'apellido.required' => 'El apellido es requerido',
            'apellido.max' => 'El apellido de tener máximo 80 caracteres',
            'nombre.required' => 'El nombre es requerido',
            'nombre.max' => 'El nombre de tener máximo 80 caracteres',
            'terceros_id.required' => 'Debe señalar el tercero',
            'tipopersonas_id.required' => 'Debe señalar el tipo de persona',
        ];
    }
}
