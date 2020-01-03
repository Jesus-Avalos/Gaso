<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleTemp extends Model
{
    protected $table = 'detalle_temps';

    protected $fillable = ['ingrediente_id','detalle_id'];
}
