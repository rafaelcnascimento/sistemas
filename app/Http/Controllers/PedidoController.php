<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \App\Pedido;
use \App\Objeto;
use \App\Material;
use Carbon\Carbon;
use DB;

class PedidoController extends Controller
{
    public function index () 
    {      
        //$pedidos = Pedido::with('objetos')->orderBy('id', 'DSC')->paginate(25);
        
        $pedidos = new Pedido;
        
        $pedidos->setConnection('san');

        $pedidos = DB::connection('san')->table('pedidos')->orderBy('id','DSC')->paginate(25);

        //$objetos = Item::all();

        return view('layouts.pedidos', compact('pedidos')); 
    }
}
