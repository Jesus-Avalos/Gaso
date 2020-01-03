<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corte extends Model
{
    protected $table = 'cortes';

    protected $fillable = ['recuento','caja','descuadre','apertura'];
}
