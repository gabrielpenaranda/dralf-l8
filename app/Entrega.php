<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
  protected $table = 'entregas';

  protected $fillable = ['fecha', 'numero', 'facturas_id'];

  public $timestamps = false;

  public function detalle_entregas()
  {
    return $this->hasMany(DetalleEntrega::class);
  }

  public function facturas()
  {
    return $this->belongsTo(Factura::class);
  }

}
