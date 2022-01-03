<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    //exibe formulário de criação de usuário
    public function create()
    {
        return view('registro.create');
    }

    //para salvar os dados de criação de novo usuário
    public function store(Request $request)
    {
        //pegar todas as informações do form
        $data = $request->only(['name', 'email', 'password']);
        //fazer hash da senha antes de cadastrar
        $data['password'] = Hash::make($data['password']);
        //criar novo usuário
        $user = User::create($data);

        Auth::login($user);
        return redirect()->route('listar_series');
    }
}
