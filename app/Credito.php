<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    protected $table = 'credito';
    protected $fillable = ['venta_id','total_pago'];
}
