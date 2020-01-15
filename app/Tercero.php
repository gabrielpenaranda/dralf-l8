<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tercero extends Model
{
  protected $table = 'terceros';

  protected $fillable = ['rif', 'nombre', 'direccion', 'razon_social', 'telefono', 'cliente', 'proveedor', 'laboratorio', 'email', 'ciudades_id'];

  public $timestamps = false;

  public function facturas()
  {
    return $this->hasMany(Factura::class);
  }

  public function ciudades()
  {
    return $this->belongsTo(Ciudad::class);
  }

  public function personas()
  {
      return $this->hasMany(Persona::class);
  }
}
