<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPersona extends Model
{
    protected $table = 'tipopersonas';

    protected $fillable = ['nombre'];

    public $timestamps = false;

    public function personas()
    {
        return $this->hasMany(Persona::class);
    }

}
