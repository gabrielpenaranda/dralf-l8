<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
  use HasFactory;

  protected $table = 'cobros';

  protected $fillable = ['fecha', 'numero', 'banco', 'monto', 'facturas_id'];

  public $timestamps = false;

  public function facturas()
  {
    return $this->belongsTo(Factura::class);
  }

}
