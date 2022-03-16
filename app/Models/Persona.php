<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';

    protected $fillable = ['nombre', 'apellido', 'cargo', 'telefono', 'email', 'tipopersonas_id', 'terceros_id'];

    public $timestamps = false;

    public function tipopersonas()
    {
        return $this->belongsTo(TipoPersona::class);
    }

    public function terceros()
    {
        return $this->belongsTo(Tercero::class);
    }
}
