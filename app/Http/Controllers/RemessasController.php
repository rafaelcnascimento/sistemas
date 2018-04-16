<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \App\Remessa;
use \App\Item;
use Carbon\Carbon;

class RemessasController extends Controller
{
    public function index() 
    {    
        $remessas = Remessa::with('itens')->orderBy('id', 'DSC')->paginate(10);

        $items = Item::all();

        return view('layouts.remessas', compact('remessas','items'));
    }
    
    public function store() 
    {    
        $remessa = new \App\Remessa;

        $nova_remessa = Remessa::create ([
            'user_id' => Auth::user()->id
        ]);

        return redirect('/correio/'.$nova_remessa->id);
    }

    public function show(Remessa $remessa) 
    {    
        if (Auth::user()->sigla != $remessa->criador->sigla && Auth::user()->sigla != 'adm') 
        {
            return redirect()->back();
        }

        return view('layouts.registrarRemessa', compact('remessa'));
    }

    public function delete(Remessa $remessa) 
    {    
        $remessa->delete();

        return redirect('/correio');
    }

    public function busca() 
    {    
       $data_inicio =  implode('-', array_reverse(explode('/', request('busca_inicio'))));
       $data_final = implode('-', array_reverse(explode('/', request('busca_fim'))));

       $resultados = Remessa::whereBetween('created_at', array($data_inicio." 00:00:00", $data_final." 23:59:59"))->orderBy('id', 'DSC')->get();
       return view('layouts.buscaCorreio', compact('resultados'));
    }
}
