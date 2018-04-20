<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Material;
use DB;
use Auth;

class MaterialController extends Controller
{
    public function index()
    {
        $materiais = Material::where('cidade_id', Auth::user()->cidade_id)->orderBy('codigo', 'ASC')->paginate(50);

        return view('layouts.listaMateriais', compact('materiais'));
    }

    public function adicionarMaterial()
    {
        return view('layouts.novoMaterial');
    }

    public function store()
    {
        $material = new Material;

        $material->codigo = request('codigo');
        $material->descricao = request('descricao');
        $material->quantidade = request('quantidade');
        $material->cidade_id = Auth::user()->cidade_id;
        
        $material->save();

        return redirect('/material/lista');
    }

    public function editarMaterial(Material $material)
    {
        return view('layouts.editarMaterial', compact('material'));
    }

    public function update(Material $material)
    {
        $material->update([
                'codigo' => request('codigo'),
                'descricao' => request('descricao'),
                'quantidade' => request('quantidade')
        ]);
                
        return redirect('/material/lista');
    }

    public function delete(Material $material)
    {
        $material->delete();

        return redirect('/material/lista');
    }

    public function buscaMaterial(Request $request)
    {
        $output="";
       
        $materiais = new Material;

        $materiais = Material::where('descricao', 'LIKE', "%{$request->search}%")
                        ->orWhere('codigo', 'LIKE', "%{$request->search}%")->orderBy('codigo', 'ASC')->get();
     
        if ($materiais) {
            foreach ($materiais as $material) {
                $output.='<tr>'.
                '<td>'.$material->id.'</td>'.
                '<td>'.$material->codigo.'</td>'.
                '<td>'.$material->descricao.'</td>'.
                '<td>'.$material->quantidade.'</td>'.
                '<td>'.'<a class="btn btn-primary" href="/material/'.$material->id.'">Editar</a></td>'.
                '</tr>';
            }
            return Response($output);
        }
    }
}
