<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTerceroRequest extends FormRequest
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
                'rif' => 'required|unique:terceros,rif|min:10|max:10',
                'nombre' => 'required|unique:terceros,nombre|min:5|max:80',
                'razon_social' => 'required|unique:terceros',
                'direccion' => 'required|min:20|max:200',
                'telefono' => 'max:50',
                'email' => 'email|max:50',
                'ciudades_id' => 'required',
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
            'rif.required' => 'El RIF es requerido',
            'rif.unique' => 'El RIF debe ser único, el RIF introducido ya existe',
            'rif.min' => 'El RIF debe tener 10 caracteres',
            'rif.max' => 'El RIF de tener máximo 10 caracteres',
            'nombre.required' => 'El nombre es requerido',
            'nombre.unique' => 'El nombre ya existe',
            'razon_social.required' => 'La razón social es requerido',
            'razon_social.unique' => 'La razón social ya existe',
            'direccion.required' => 'La dirección es requerida',
            'ciudades_id.required' => 'Debe señalar la ciudad',
        ];
    }
}
