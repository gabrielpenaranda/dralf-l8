<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFacturaRequest extends FormRequest
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
            'numero' => "required|numeric|unique:facturas,numero",
            'monto' => "required|numeric",
            'iva' => "required|numeric",
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
            'numero.required' => 'Introduzca el número de factura',
            'numero.numeric' => 'El número de factura debe estar en formato numérico',
            'numero.unique' => 'El número de factura ya está incluido',
            'monto.required' => 'Introduzca el monto de la factura',
            'monto.numeric' => 'El monto de factura debe ser un número',
            'iva.required' => 'Introduzca el IVA de la factura',
            'iva.numeric' => 'El IVA de factura debe ser un número',
        ];
    }
}
