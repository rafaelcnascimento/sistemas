<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Pedido extends Model
{
    protected $guarded = [];

    protected $dates = ['recebido_at'];

    public function materials()
    {
        return $this->belongsToMany('App\Material', 'material_pedido', 'id_pedido','id_material')->withPivot('quantidade', 'atendido');
    }

    public function situacao()
    {
        return $this->belongsTo('App\Situation', 'situation_id');
    }

    public function criador() 
    {    
        return $this->belongsTo('App\User','user_id');
    }

    public function recebedor() 
    {    
        return $this->belongsTo('App\User','recebedor_id');
    }
}
