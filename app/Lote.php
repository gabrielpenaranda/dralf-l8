<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    protected $table = 'lotes';

    protected $fillable = ['fecha_produccion', 'fecha_vencimiento', 'cantidad_producida', 'cantidad_prueba', 'cantidad_disponible', 'numero', 'costo', 'productos_id', 'prueba', 'certificado'];

    public $timestamps = false;

    public function pruebadiluentes()
    {
        return $this->hasMany(PruebaDiluente::class);
    }
    public function pruebarinses()
    {
        return $this->hasMany(PruebaRinse::class);
    }

    public function pruebalisantes()
    {
        return $this->hasMany(PruebaLisante::class);
    }

    public function pruebaanticoagulantes()
    {
        return $this->hasMany(PruebaAnticoagulante::class);
    }

    public function detallefacturas()
    {
        return $this->hasMany(DetalleFactura::class);
    }

    public function detalleentregas()
    {
        return $this->hasMany(DetalleEntrega::class);
    }

    public function productos()
    {
        return $this->belongsTo(Producto::class);
    }


}
