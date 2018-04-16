<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Material;
use DB;

class MaterialController extends Controller
{
    public function index() 
    {     
        $materiais = DB::connection('san')->table('materials')->orderBy('descricao','ASC')->paginate(50);

        return view('layouts.listaMateriais', compact('materiais'));
    }

    public function adicionarMaterial() 
    {    
        return view('layouts.novoMaterial');
    }

    public function store() 
    {    
        $material = new Material;
                
        $material->setConnection('san');

        $material->codigo = request('codigo');
        $material->descricao = request('descricao');
        $material->quantidade = request('quantidade');
            
        $material->save();

        return redirect('/material/lista');
    }

    public function editarMaterial($id) 
    {    
        $material = DB::connection('san')->table('materials')->where('id', $id)->first();

        return view('layouts.editarMaterial', compact('material'));
    }

    public function update($id) 
    {    
        $material = DB::connection('san')->table('materials')->where('id', $id)
                ->update([
                    'codigo' => request('codigo'),
                    'descricao' => request('descricao'),
                    'quantidade' => request('quantidade')
                ]);
                
        return redirect('/material/lista');
    }

    public function delete($id) 
    {   
        DB::connection('san')->table('materials')->where('id', $id)->delete(); 

        return redirect('/material/lista');
    }

    public function buscaMaterial(Request $request) 
    {    
        $output="";
       
        $materiais = new Material;

        $materiais = DB::connection('san')->table('materials')->where('descricao','LIKE','%'.$request->search."%")->get();
     
        if($materiais)
        {
            foreach ($materiais as $material) 
            {
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
