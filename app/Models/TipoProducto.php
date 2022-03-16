<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    use HasFactory;

    protected $table = 'tipoproductos';

    protected $fillable = ['nombre'];

    public $timestamps = false;

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
