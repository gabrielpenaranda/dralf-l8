<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Menor;

class CreateLoteRequest extends FormRequest
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
        $cprol = request()->get('cantidad_producida');
        $cprul = request()->get('cantidad_prueba');
        $numlot = request()->get('numero');
        // dd($cpl);
        return [
            'fecha_produccion' => "required|date_format:d-m-Y",
            'fecha_vencimiento' => "required|date_format:d-m-Y",
            'cantidad_producida' => "required|numeric",
            'cantidad_prueba' => ["required", "numeric", new Menor($cprol)],
            'numero' => "required|unique:lotes,numero|min:3|max:20",
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
            'fecha_produccion.required' => 'Introduzca la fecha de producción',
            'fecha_vencimiento.required' => 'Introducza la fecha de vencimiento',
            'cantidad_producida.required' => 'Introduzca la cantidad producida',
            'cantidad_prueba.required' => 'Introduzca la cantidad de prueba',
            'numero.required' => 'El número de lote es requerido',
            'numero.unique' => 'El número de lote ya existe',
            'numero.min' => 'El número de lote debe tener al menos 9 caracteres',
            'numero.max' => 'El número de lote debe tener al máximo 12 caracteres',
        ];
    }
}
