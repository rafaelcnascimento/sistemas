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
    public function index()
    {
        $pedido = Pedido::find(1);

        return view('layouts.pedidos', compact('pedido'));
    }

    public function novoPedido()
    {
        $materiais = Material::orderBy('descricao', 'ASC')->paginate(50);

        return view('layouts.novoPedido', compact('materiais'));
    }

    public function carrinho(Request $request)
    {
        $output="";

        $quantidade = 5;

        $material = Material::find($request->item);

        $output =   '<ul>
                        <li>'.$material->codigo.'</li>
                        <li>'.$quantidade.'</li>
                    </ul>';

        return Response($output);
    }

    public function buscaMaterial(Request $request)
    {
        $output="";
       
        $materiais = new Material;

        $materiais = Material::where('descricao', 'LIKE', "%{$request->search}%")
                    ->orWhere('codigo', 'LIKE', "%{$request->search}%")->get();
     
        if ($materiais) {
            foreach ($materiais as $material) {
                $output.='<tr>'.
                '<td>'.$material->id.'</td>'.
                '<td>'.$material->codigo.'</td>'.
                '<td>'.$material->descricao.'</td>'.
                '<td>'.$material->quantidade.'</td>'.
                '<td>'.'<button type="button" class="btn btn-success" id="button" value="'.$material->id.'">Adicionar</button>'.
                '</tr>';
            }
            return Response($output);
        }
    }
}
