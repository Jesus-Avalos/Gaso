<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = ['codigo','name','descripcion','preparacion','precio_produccion','precio_venta','status','tiempo_preparacion','subcategoria_id'];
}
