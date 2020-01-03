<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'global';
    protected $fillable = ['name','logo','direccion','ingresos','egresos','caja_extra'];
}
