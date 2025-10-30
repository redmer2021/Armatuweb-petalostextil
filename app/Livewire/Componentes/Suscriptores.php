<?php

namespace App\Livewire\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Suscriptores extends Component
{
    public $txtEmail = '';
    public $mensajeConfirmacion = '';

    public function GrabarMail(){
        
        $this->validate([
            'txtEmail' => ['required', 'email', 'unique:tb_suscriptores,email'],
        ], [
            'txtEmail.required' => 'Debe ingresar un email válido',
            'txtEmail.email' => 'Email no válido',
            'txtEmail.unique' => 'El email ya está registrado',
        ]);

        DB::table('tb_suscriptores')->insert([
            'email' => $this->txtEmail,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->txtEmail = '';
        $this->mensajeConfirmacion = '¡Gracias por suscribirte!';
        $this->dispatch('mensaje-enviado');        
    }

    public function render()
    {
        return view('livewire.componentes.suscriptores');
    }
}
