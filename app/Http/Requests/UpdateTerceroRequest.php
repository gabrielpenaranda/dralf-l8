<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTerceroRequest extends CreateTerceroRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'nombre' => 'required|min:1|max:80',
                'direccion' => 'max:200',
                'telefono' => 'max:50',
            ];
    }
}
