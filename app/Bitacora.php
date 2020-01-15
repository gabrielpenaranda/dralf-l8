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
}
