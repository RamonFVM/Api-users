<?php

namespace App\Http\Controllers;
use App\Models\usuarios;

use Illuminate\Http\Request;

class UsuarioController extends Controller{
   
    public function login(Request $request){


        $request->validate([
            'email'=>'required|email',
            'senha'=>'required|senha',
        ]);

        $usuario= usuarios::where('email', $request->email)-first();

        if($usuario && Hash::check($request->senha, $usuario->senha)){

            $nome= $usuario-nome;
        }


    }
}
