<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    public function activar_cuenta($token){
        // Buscar el usuario con el token de activación
        $user = DB::table('users')->where('activation_token', $token)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Token inválido o usuario no encontrado.'
            ], 404);
        }

        // Activar la cuenta y eliminar el token
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'estado' => 1,
                'activation_token' => null
            ]);

        return redirect('/')->with('success', 'Cuenta activada correctamente.');
        
    }

    public function recuperar_cta($token){
        return view('recup_cta', [
            'token' => $token
        ]);
    }

    public function logAdmin(){
        return view('admin/login-admin');
    }

    public function panelDeControl(){
        return view('admin/panel-control');
    }
}
