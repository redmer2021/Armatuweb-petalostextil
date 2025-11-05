<?php

namespace App\Livewire\Componentes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Logadmin extends Component
{

    public $txtUserName = '';
    public $txtUserPassword = '';
    
    
    public function CancelarLogin(){
        return redirect()->to('/');
    }

    public function Login(){
        $this->validate([
            'txtUserName' => ['required', 'email'],
            'txtUserPassword' => ['required'],
        ], [
            'txtUserName.required' => 'Debe ingresar Email',
            'txtUserName.email' => 'Email no válido',
            'txtUserPassword.required' => 'Debe ingresar Contraseña',
        ]);
        
        $credentials = [
            'email' => $this->txtUserName,
            'password' => $this->txtUserPassword,
        ];
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // obtenemos el usuario autenticado

            // Verificamos si la cuenta está activa
            if ($user->estado != 1 || !empty($user->activate_token)) {
                Auth::logout(); // cerramos sesión si está autenticado
                throw ValidationException::withMessages([
                    'credNoValidas' => 'La cuenta aún no ha sido activada.'
                ]);
            }

            if ($user->rol != 2 ) {
                Auth::logout(); // cerramos sesión si está autenticado
                throw ValidationException::withMessages([
                    'credNoValidas' => 'Usuario no autorizado...'
                ]);
            }

            $this->txtUserName = '';
            $this->txtUserPassword = '';

            return redirect()->to('panelDeControl');

        } else {
            throw ValidationException::withMessages([
                'credNoValidas' => 'Las credenciales ingresadas son incorrectas. Acceso Denegado'
            ]);
        }

    }

    public function render()
    {
        return view('livewire.componentes.logadmin');
    }
}
