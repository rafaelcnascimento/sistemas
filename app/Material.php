<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded = [];

    public function pedidos()
    {
        return $this->belongsToMany('App\Pedido', 'material_pedido', 'material_id', 'pedido_id')->withPivot('quantidade', 'atentido');
    }
}
