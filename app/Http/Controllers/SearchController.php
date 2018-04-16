<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Material;
use DB;

class SearchController extends Controller
{
    public function index() 
    {    
        $teste = null;

        return view('layouts.busca',compact('teste'));
    }

    public function store() 
    {    
        $teste = request('var');

        

        return view('layouts.busca', compact('teste'));
    }

    public function search(Request $request) 
    {    
       
            $output="";
            $users=DB::table('users')->where('nome','LIKE','%'.$request->search."%")->get();
         
            if($users)
            {
                foreach ($users as $user) 
                {
                    $output.='<tr>'.
                    '<td>'.$user->id.'</td>'.
                    '<td>'.$user->nome.'</td>'.
                    '<td>'.$user->sigla.'</td>'.
                    '<td>'.$user->email.'</td>'.
                    '</tr>';
                }
                return Response($output);
            }
        
    }

    public function testeAjax() 
    {    
        $html = '<h1>YES</h1>';

        return $html;
    }
}
