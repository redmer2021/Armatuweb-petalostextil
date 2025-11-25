<?php

namespace App\Livewire\Componentes;

use Livewire\Attributes\On;
use Livewire\Component;

class Politcambios extends Component
{
    public $verPoliticas = true;

    #[On('setear_ver')]
    public function SetVerPoliticas($estado){
        $this->verPoliticas=$estado;
    }

    public function render()
    {
        return view('livewire.componentes.politcambios');
    }
}
