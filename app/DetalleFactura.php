<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
  protected $table = 'detallefacturas';

  protected $fillable = ['cantidad', 'resto', 'precio', 'costo', 'preciousd', 'facturas_id', 'lotes_id'];

  public $timestamps = false;

  public function facturas()
  {
    return $this->belongsTo(Factura::class);
  }

  public function detalleentregas()
  {
    return $this->hasMany(DetalleEntrega::class);
  }

  public function lotes()
  {
    return $this->belongsTo(Lote::class);
  }

}
