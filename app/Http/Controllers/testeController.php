<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Remessa;
use App\Material;
use App\Pedido;
use DB;

class testeController extends Controller
{
    public function index()
    {
        $pedido = new Pedido;

        $pedido->setConnection('san');

        $pedidos = $pedido->find(1)->get();

        dd($pedidos);

        return view('teste', compact('pedidos'));
    }
}
