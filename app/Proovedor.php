<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proovedor extends Model
{
    protected $table = 'proovedores';
    protected $fillable = ['nombre','domicilio','colonia','referencia','telefono'];

    public function compras()
    {
        return $this->hasMany('App\Compra', 'proovedor_id', 'id');
    }
}
