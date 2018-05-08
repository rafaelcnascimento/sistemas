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
      /*  $material = Material::find(50);

        $carrinho = array(
            'material' => $material->id,
            'codigo' => $material->codigo,
            'quantidade' => 10
        );

        Session::push('cart', $carrinho);

        $material = Material::find(35);

        $carrinho = array(
            'material' => $material->id,
            'codigo' => $material->codigo,
            'quantidade' => 15
        );

        Session::push('cart', $carrinho);

        $testes = Session::get('cart');

        foreach ($testes as $teste)
        {
            echo $teste['codigo'];
        }*/

       foreach (Session('cart') as $key => $carrinho){

            echo $carrinho['codigo'].'<br>';
            echo $carrinho['quantidade'].'<br>';
            echo $carrinho['material'].'<br>';

         }

         foreach (Session('cart') as $key => $val)
         {
             if ($val['material'] === 672)
             {
                 $cart = Session::get('cart');
                 unset($cart[$key]);
                 Session::put('cart', $cart);
             }
         }

         foreach (Session('cart') as $key => $carrinho){

              echo $carrinho['codigo'].'<br>';
              echo $carrinho['quantidade'].'<br>';
              echo $carrinho['material'].'<br>';

           }
   

  
    }
}

