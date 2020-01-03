<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleProducto extends Model
{
    protected $table = 'detalle_productos';

    protected $fillable = ['ingrediente_id','producto_id','porciones','precio'];
}
