<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remessa extends Model
{
    protected $guarded = [];
    
    public function itens()
    {
        return $this->hasMany('App\Item','remessa_id');
    }

    public function criador() 
    {    
        return $this->belongsTo('App\User','user_id');
    }

}
