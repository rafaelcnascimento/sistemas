<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $guarded = [];

    public function materials()
    {
        return $this->belongsToMany('App\Material', 'material_pedido', 'id_pedido','id_material')->withPivot('quantidade', 'atentido');
    }

    public function situacao()
    {
        return $this->belongsTo('App\Situacao', 'cidade_id');
    }

    public function criador() 
    {    
        return $this->belongsTo('App\User','user_id');
    }
}
