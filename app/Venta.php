<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $fillable = ['tipo','subtotal','descuento','mesa_id','cliente_id','total','status','corte_id'];
}
