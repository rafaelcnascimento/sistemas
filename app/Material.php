<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded = [];

    public function pedidos()
    {
        return $this->belongsToMany('App\Pedido', 'material_pedido', 'id_pedido', 'id_material')->withPivot('quantidade', 'atendido');
    }
}
