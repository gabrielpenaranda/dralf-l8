<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleEntrega extends Model
{
  use HasFactory;

  protected $table = 'detalleentregas';

  protected $fillable = ['cantidad', 'entregas_id', 'detallefacturas_id'];

  public $timestamps = false;

  public function entregas()
  {
    return $this->belongsTo(Entrega::class);
  }

  public function detallefacturas()
  {
    return $this->belongsTo(DetalleFactura::class);
  }

  public function lotes()
  {
    return $this->belongsTo(Lote::class);
  }

}
