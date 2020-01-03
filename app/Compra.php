<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';
    protected $fillable = ['total','proovedor_id'];

    public function ingredientes()
    {
        return $this->belongsToMany('App\Inventario');
    }

    public function proovedor()
    {
        return $this->belongsTo('App\Proovedor', 'proovedor_id');
    }
}
