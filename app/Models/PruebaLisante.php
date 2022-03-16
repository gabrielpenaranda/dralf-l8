<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PruebaLisante extends Model
{
    use HasFactory;

    protected $table = 'pruebalisantes';

    protected $fillable = ['ph', 'conductividad', 'contaje', 'lotes_id', 'numero'];

    public $timestamps = false;

    public function lotes()
    {
        return $this->belongsTo(Lote::class);
    }
}
