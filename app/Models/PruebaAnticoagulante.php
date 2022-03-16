<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PruebaAnticoagulante extends Model
{
    use HasFactory;

    protected $table = 'pruebaanticoagulantes';

    protected $fillable = ['ph', 'tubo', 'lotes_id', 'numero'];

    public $timestamps = false;

    public function lotes()
    {
        return $this->belongsTo(Lote::class);
    }

}
