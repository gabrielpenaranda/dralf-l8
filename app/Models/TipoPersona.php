<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPersona extends Model
{
    use HasFactory;

    protected $table = 'tipopersonas';

    protected $fillable = ['nombre'];

    public $timestamps = false;

    public function personas()
    {
        return $this->hasMany(Persona::class);
    }

}
