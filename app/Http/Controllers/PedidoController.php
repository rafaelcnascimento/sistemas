<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \App\Pedido;
use \App\Carrinho;
use \App\Objeto;
use \App\Material;
use Carbon\Carbon;
use DB;

class PedidoController extends Controller
{
    public function index()
    {
        $pedido = Pedido::find(1);

        return view('layouts.pedidos', compact('pedido'));
    }

    public function novoPedido()
    {
        $cart =  Carrinho::orderBy('id', 'desc')->first();

        $id_carrinho = $cart->id_carrinho;

        $carrinhos = Carrinho::where('id_carrinho', $id_carrinho)->get();

        $id_carrinho++;

        session([ 'cart' => $id_carrinho ]);
        
        $materiais = Material::where('cidade_id', Auth::user()->cidade_id)->orderBy('codigo', 'ASC')->paginate(50);

        return view('layouts.novoPedido', compact('materiais', 'id_carrinho', 'carrinhos'));
    }

    public function store()
    {
        $fugg = \Session::get('cart');
        echo "$fugg";
    }

    public function carrinho(Request $request)
    {
        $output="";

        $quantidade = $request->quantidade;

        $material = Material::find($request->item);

        Carrinho::create([
            'id_carrinho' => $request->id_carrinho,
            'id_material' => $request->item,
            'quantidade' => $request->quantidade,
            'codigo' => $material->codigo
        ]);

        $output.='<tr id="row'.$material->id.'">'.
        '<td>'.$material->codigo.'</td>'.
        '<td>'.$quantidade.'</td>'.
        '<td><div id="'.$material->id.'" class="glyphicon glyphicon-remove" style="cursor:pointer; margin-left:25px;"></div></td>';
        
        return Response($output);
    }

    public function destroyCarrinho(Request $request)
    {
        $output="";
       
        Carrinho::where('id_material', $request->item)->where('id_carrinho', $request->carrinho)->delete();
        
        return Response($output);
    }

    public function buscaMaterial(Request $request)
    {
        $output="";
       
        $materiais = new Material;

        $materiais = Material::where('descricao', 'LIKE', "%{$request->search}%")->where('cidade_id', Auth::user()->cidade_id)
                                ->orWhere('codigo', 'LIKE', "%{$request->search}%")->where('cidade_id', Auth::user()->cidade_id)->orderBy('codigo', 'ASC')->get();
     
        if ($materiais) {
            foreach ($materiais as $material) {
                $output.='<tr>'.
                '<td>'.$material->id.'</td>'.
                '<td>'.$material->codigo.'</td>'.
                '<td>'.$material->descricao.'</td>'.
                '<td>'.$material->quantidade.'</td>'.
                '<td><input type="text"  id="qtd'.$material->id.'" style="width: 50px"></td>'.
                '<td><button type="button" class="btn btn-success" id="'.$material->id.'" value="'.$material->id.'">Adicionar</button></td>'.
                '</tr>';
            }
            return Response($output);
        }
    }
}
