<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Remessa;
use App\Material;
use App\Carrinho;
use App\Pedido;
use DB;

class testeController extends Controller
{
    public function index()
    {
        Carrinho::where('id_material', 295)->where('id_carrinho', 1)->delete();

        echo "ok";
    }
}
