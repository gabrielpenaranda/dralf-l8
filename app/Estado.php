<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';

    protected $fillable = ['nombre'];

    public $timestamps = false;

    public function ciudades()
    {
        return $this->hasMany(Ciudad::class);
    }

}
