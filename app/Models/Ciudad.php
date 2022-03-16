<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

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

    public function depositos()
    {
        return $table->hasMany(Deposito::class);
    }

}
