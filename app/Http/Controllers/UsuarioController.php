<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 

class UsuarioController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string', 
        ]);

       
        $usuario = Usuarios::where('email', $request->email)->first(); 

        
        if ($usuario && Hash::check($request->senha, $usuario->senha)) {
            $nome = $usuario->nome; 

            return response()->json(['nome' => $nome], 200);
        } else {
          
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }
    }

    public function cadastro(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email|unique:usuarios,email', 
            'senha' => 'required|string|min:6', 
        ]);

      
        $cripto = Hash::make($request->senha);

        
        $usuario = Usuarios::create([
            'email' => $request->email,
            'senha' => $cripto,
        ]);

        return response()->json(['message' => 'Cadastrado com sucesso'], 201); 
    }
}