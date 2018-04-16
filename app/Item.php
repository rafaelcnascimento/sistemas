<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
   protected $guarded = ['id'];

   public function remessa()
       {
        return $this->belongsTo('App\Remessa','remessa_id');
       }
}
