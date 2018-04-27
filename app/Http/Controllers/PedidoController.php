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
        $carrinho =  Carrinho::orderBy('id', 'desc')->first();

        $id_carrinho = $carrinho->id_carrinho;

        $id_carrinho++;

        session([ 'cart' => $id_carrinho ]);
        
        $materiais = Material::where('cidade_id', Auth::user()->cidade_id)->orderBy('codigo', 'ASC')->paginate(50);

        return view('layouts.novoPedido', compact('materiais', 'id_carrinho'));
    }

    public function carrinho(Request $request)
    {
        $output="";

        $quantidade = $request->quantidade;

        $material = Material::find($request->item);

        Carrinho::create([
            'id_carrinho' => $request->id_carrinho,
            'id_material' => $request->item,
            'quantidade' => $request->quantidade
        ]);

        $output.='<tr id="row'.$material->id.'">'.
        '<td>'.$material->codigo.'</td>'.
        '<td>'.$quantidade.'</td>'.
        '<td><a><span class="glyphicon glyphicon-remove" onclick="myFunction('.$material->id.')" style="margin-left: 25px"></span></a></td>'.
        '</tr>';
        
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
