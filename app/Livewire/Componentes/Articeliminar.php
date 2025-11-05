<?php

namespace App\Livewire\Componentes;

use Livewire\Component;

class Articeliminar extends Component
{
    public $verForm = false;
    public $id;

    public function VerForm(){
        $this->verForm=true;
    }

    public function CerrarForm(){
        $this->verForm=false;
    }

    public function render()
    {
        return view('livewire.componentes.articeliminar');
    }
}
