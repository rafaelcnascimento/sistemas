<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $guarded = [];

    public function materials()
    {
        return $this->belongsToMany('App\Material', 'material_pedido', 'material_id', 'pedido_id')->withPivot('quantidade', 'atentido');
    }
}
