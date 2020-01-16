<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PruebaLisante extends Model
{
    protected $table = 'pruebalisantes';

    protected $fillable = ['ph', 'conductividad', 'contaje', 'lotes_id', 'numero'];

    public $timestamps = false;

    public function lotes()
    {
        return $this->belongsTo(Lote::class);
    }
}
