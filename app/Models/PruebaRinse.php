<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PruebaRinse extends Model
{
    use HasFactory;

    protected $table = 'pruebarinses';

    protected $fillable = ['ph', 'conductividad', 'lotes_id', 'numero'];

    public $timestamps = false;

    public function lotes()
    {
        return $this->belongsTo(Lote::class);
    }
}
