<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacoras';

    protected $fillable = ['descripcion', 'accion', 'tabla', 'tabla_id', 'user_id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // *************************************************************************************

    public function register($bitacoras, $accion, $descripcion, $tabla_id, $tabla, $user_id)
    {
        switch ($accion)
        {
            case 'C':
                $desc = "Crear registro: ".$descripcion;
                break;
            case 'D':
                $desc = "Eliminar registro: ".$descripcion;
                break;
            case 'U':
                $desc = "Actualizar/Modificar registro: ".$descripcion;
                break;
        }
        $bitacoras->descripcion = $desc;
        $bitacoras->accion = $accion;
        $bitacoras->tabla = $tabla;
        $bitacoras->tabla_id = $tabla_id;
        $bitacoras->user_id = $user_id;
        $bitacoras->save();
    }

}
