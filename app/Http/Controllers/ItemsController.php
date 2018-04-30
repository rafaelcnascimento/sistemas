<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \App\Remessa;
use \App\Item;
use Carbon\Carbon;

class ItemsController extends Controller
{
    public function store()
    {
        $item = new \App\Item;

        /* Se a checkox não for marcada a variavel POST referente virá vazia(null)
        Então, usando um operador ternário, será setada como 0, caso contrário será 1*/
        $AR = (is_null(request('AR'))) ? 0 : 1;
        $MP = (is_null(request('MP'))) ? 0 : 1;
        $SEDEX = (is_null(request('SEDEX'))) ? 0 : 1;
        
        if (!is_null(request('codigo_rastreio'))) {
            Item::create([
                'codigo_rastreio' => request('codigo_rastreio'),
                'remessa_id' => request('remessa_id'),
                'AR' => $AR,
                'MP' => $MP,
                'SEDEX' => $SEDEX,
            ]);
        }
        
        $remessa = Remessa::find(request('remessa_id'));

        $remessa->update([
            'sem_registro' => request('sem_registro'),
            'observacao' => request('observacao'),
        ]);

        if (request('fixar') == 1) {
            session([
                'AR' => $AR,
                'MP' => $MP,
                'SEDEX' => $SEDEX,
                'fixo' => 1,
            ]);
        } else {
            $keys = array('AR','MP', 'SEDEX','fixo');
            session(array_fill_keys($keys, '0'));
        }
    
        
    
        return redirect()->back();
    }
    
    public function destroy(Item $item)
    {
        $item->delete();
        
        return redirect()->back();
    }
}
