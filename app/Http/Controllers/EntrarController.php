<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrarController extends Controller
{
    public function index()
    {
        return view('entrar.index');
    }

    public function entrar(Request $request)
    {
        //função laravel para pegar apenas email e senha
        //função laravel para logar o usuario com os dados do request
        if(!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->back()->withErrors('Usuário ou senha inválidos.');
        }
        
        return redirect()->route('listar_series');
    }
}
