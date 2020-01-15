<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PruebaAnticoagulante extends Model
{
    protected $table = 'pruebaanticoagulantes';

    protected $fillable = ['ph', 'tubo', 'lotes_id'];

    public $timestamps = false;

    public function lotes()
    {
        return $this->belongsTo(Lote::class);
    }

}
