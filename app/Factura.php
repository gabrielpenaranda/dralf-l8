<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
  protected $table = 'facturas';

  protected $fillable = ['numero', 'fecha', 'monto', 'saldo', 'iva', 'documento', 'entregado', 'terceros_id'];

  public $timestamps = false;

  public function terceros()
  {
    return $this->belongsTo(Tercero::class);
  }

  public function cobros()
  {
    return $this->hasMany(Cobro::class);
  }

  public function detallefacturas()
  {
    return $this->hasMany(DetalleFactura::class);
  }

  public function entregas()
  {
    return $this->hasMany(Entrega::class);
  }

}
