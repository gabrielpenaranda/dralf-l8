<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = 'ciudades';

    protected $fillable = ['nombre', 'estados_id'];

    public $timestamps = false;

    public function estados()
    {
        return $this->belongsTo(Estado::class);
    }

    public function terceros()
    {
        return $this->hasMany(Tercero::class);
    }

}
