<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = ['nombre', 'codigo', 'capacidad', 'prueba', 'precio', 'impuesto', 'costo', 'unidadmedidas_id', 'tipoproductos_id'];

    public $timestamps = false;

    public function lotes()
    {
        return $this->hasMany(Lote::class);
    }

    public function unidadmedidas()
    {
        return $this->belongsTo(UnidadMedida::class);
    }

    public function tipoproductos()
    {
        return $this->belongsTo(TipoProducto::class);
    }

}
