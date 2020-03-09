<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDepositoRequest extends FormRequest
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
            'nombre' => "required|unique:depositos,nombre|min:2|max:30",
            'direccion' => "required|min:2|max:80",
            'telefono' => "required|min:2|max:50",
            'factura' => "required",
            'ciudades_id' => "required",
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
            'nombre.required' => 'El nombre es requerido',
            'nombre.unique' => 'El nombre ya existe',
            'nombre.min' => 'El nombre debe tener al menos dos caracteres',
            'nombre.max' => 'El nombre debe tener maximo treinta caracteres',
            'direccion.required' => 'La dirección es requerido',
            'direccion.min' => 'La dirección debe tener al menos dos caracteres',
            'direccion.max' => 'La dirección debe tener maximo ochenta caracteres',
            'telefono.required' => 'Los números telefónicos es requerido',
            'telefono.min' => 'Los números telefónicos deben tener al menos dos caracteres',
            'telefono.max' => 'Los números telefónicos n tener maximo cincuenta caracteres',
            'ciudades_id.required' => 'El estado es requerido',
            'factura.required' => 'Debe señalar si el deposito tendra productos para facturar',
        ];
    }
}
