<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PruebaDiluente extends Model
{
    protected $table = 'pruebadiluentes';

    protected $fillable = ['ph', 'conductividad', 'plt_1', 'plt_2', 'plt_3', 'plt_4', 'plt_5', 'lotes_id'];

    public $timestamps = false;

    public function lotes()
    {
        return $this->belongsTo(Lote::class);
    }

}
