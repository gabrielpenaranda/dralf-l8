<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PruebaRinse extends Model
{
    protected $table = 'pruebarinses';

    protected $fillable = ['ph', 'conductividad', 'lotes_id', 'numero'];

    public $timestamps = false;

    public function lotes()
    {
        return $this->belongsTo(Lote::class);
    }
}
