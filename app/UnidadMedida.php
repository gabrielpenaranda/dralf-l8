<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    protected $table = 'unidadmedidas';

    protected $fillable = ['unidad', 'abreviatura'];

    public $timestamps = false;

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function materiaprimas()
    {
        return $this->hasMany(MateriaPrima::class);
    }

}
