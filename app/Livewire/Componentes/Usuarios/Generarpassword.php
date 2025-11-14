<?php

namespace App\Livewire\Componentes\Usuarios;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Generarpassword extends Component
{
    public $txtUserPassword;
    public $txtUserPasswordReing;
    public $token;

    public function CancelarReinicio(){
        return redirect('/');
    }

    public function GrabarNuevaPassword(){

        $this->validate([
            'txtUserPassword' => ['required'],
            'txtUserPasswordReing' => ['required', 'same:txtUserPassword'],
        ], [
            'txtUserPassword.required' => 'Debe ingresar Contraseña',
            'txtUserPasswordReing.required' => 'Debe reingresar la contraseña',
            'txtUserPasswordReing.same' => 'Las contraseñas no coinciden',
        ]);

        // Buscar usuario con el token válido
        $user = DB::table('users')
        ->where('validation_token', $this->token)   // el token deberías tenerlo en el componente o request
        ->where('validation_expires', '>', Carbon::now())
        ->first();

        if (!$user) {
            $this->addError('token', 'El token es inválido o ha expirado.');
            return;
        }

        // Actualizar password y activar cuenta
        DB::table('users')
        ->where('id', $user->id)
        ->update([
            'password' => Hash::make($this->txtUserPassword),
            'estado' => 1,
            'validation_token' => null,
            'validation_expires' => null,
            'updated_at' => Carbon::now()
        ]);

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.componentes.usuarios.generarpassword');
    }
}
