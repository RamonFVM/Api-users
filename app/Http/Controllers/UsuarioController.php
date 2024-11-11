<?php

namespace App\Http\Controllers;
use App\Models\usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
 

class UsuarioController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string', 
        ]);

       
        $usuario = usuarios::where('email', $request->email)->first(); 

        
        if ($usuario && Hash::check($request->senha, $usuario->senha)) {
          
            $token = $usuario->createToken('App Name')->plainTextToken;

            return response()->json(['nome' => $usuario->nome, 'token'=>$token ], 200);
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