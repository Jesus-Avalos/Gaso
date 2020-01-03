<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $table = 'Mesas';

    protected $fillable = ['name','description','status'];
}
