<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventario';

    protected $fillable = ['codigo','nombre','tipo','unidad','cantidad','por_unidad','porciones','precio_unidad','precio_porcion','stock_min','status'];

    public function compras()
    {
        return $this->belongsToMany('App\Compra');
    }
}
