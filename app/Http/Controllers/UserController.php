<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;

class userController extends Controller
{
    public function store() 
    {    
        $this->validate(request(),[ 
            
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|max:20|confirmed',
            'sigla' => 'required|string|size:3'
        
        ]);

        User::create([
            
            'nome' => request('nome'),
            'email' => request('email'),
            'sigla' => request('sigla'),
            'password' => Hash::make(request('password')),

        ]);

        return redirect('/login');
    }

    public function trocarSenha() 
    {    
        $this->validate(request(),[ 
            'password' => 'required|string|min:3|max:20|confirmed'
        ]);

       $user = Auth::user();

       $user->update([
           'password' => Hash::make(request('password')),
       ]);

       return redirect('/home');
    }
}
