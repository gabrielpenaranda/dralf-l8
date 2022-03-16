<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    use HasFactory;
    
    protected $table = 'depositos';

    protected $fillable = ['nombre', 'direccion', 'telefono', 'ciudades_id', 'factura'];

    public function ciudades()
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function lotes()
    {
        return $this->hasMany(Lote::class);
    }
}
