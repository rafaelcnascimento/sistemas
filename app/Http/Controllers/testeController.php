<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Remessa;
use App\Material;
use App\Carrinho;
use App\Pedido;
use Session;
use DB;

class testeController extends Controller
{
    public function index()
    {
      return view('layouts.teste');
     }
   
}

