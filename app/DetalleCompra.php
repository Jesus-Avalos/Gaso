<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    protected $table = 'compra_inventario';
    protected $fillable = ['inventario_id','compra_id','subtotal','cantidad'];
}
