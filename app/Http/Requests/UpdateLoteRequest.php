<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Menor;

class UpdateLoteRequest extends CreateLoteRequest
{
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
        return [
            'fecha_produccion' => "required|date_format:d-m-Y",
            'fecha_vencimiento' => "required|date_format:d-m-Y",
            'cantidad_producida' => "required|numeric",
            'cantidad_prueba' => ["required", "numeric", new Menor($cprol)],
        ];
    }
}
