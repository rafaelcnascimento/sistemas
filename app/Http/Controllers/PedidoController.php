<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \App\Pedido;
use \App\Carrinho;
use \App\Objeto;
use \App\Material;
use Carbon\Carbon;
use \App\Situation;
use Session;
use DB;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::orderBy('id', 'DSC')->paginate(10);

        return view('layouts.pedidos', compact('pedidos'));
    }

    public function show(Pedido $pedido)
    {
        return view('layouts.editarPedido', compact('pedido'));
    }

    public function novoPedido()
    {
        $materiais = Material::where('cidade_id', Auth::user()->cidade_id)->orderBy('codigo', 'ASC')->paginate(50);

        return view('layouts.novoPedido', compact('materiais'));
    }

    public function store()
    {
        $novo_pedido = Pedido::create([
            'user_id' => Auth::user()->id,
            'cidade_id' => Auth::user()->cidade_id,
            'observacao' => request('observacao')
        ]);

        $items = Session::get('cart');
        
        foreach ($items as $item) 
        {
            $novo_pedido->materials()->attach($novo_pedido->id, ['id_material' => $item['material'], 'quantidade' => $item['quantidade'], 'atentido' => 0]);
        }

        Session::forget('cart');

        return redirect('/material');

    }

    public function delete(Pedido $pedido) 
    {    
        $pedido->delete();

        return redirect('/material');
    }

    public function carrinho(Request $request)
    {
        $output="";

        $quantidade = $request->quantidade;

        $material = Material::find($request->item);

        $carrinho = array(
            'material' => $material->id,
            'codigo' => $material->codigo,
            'quantidade' => $quantidade
        );

        Session::push('cart', $carrinho);

        $output.='<tr id="row'.$material->id.'">'.
        '<td>'.$material->codigo.'</td>'.
        '<td>'.$quantidade.'</td>'.
        '<td><div id="'.$material->id.'" class="glyphicon glyphicon-remove" style="cursor:pointer; margin-left:25px;"></div></td>';
        
        return Response($output);
    }

    public function destroyCarrinho(Request $request)
    {
        $output="";

        $delete =  $request->item;
       
        foreach (Session('cart') as $key => $val)
        {
            if ($val['material'] == $delete)
            {
                $cart = Session::get('cart');
                unset($cart[$key]);
                Session::put('cart', $cart);
            }
        }

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
