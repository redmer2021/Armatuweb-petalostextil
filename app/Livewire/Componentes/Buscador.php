<?php

namespace App\Livewire\Componentes;

use Livewire\Component;

class Buscador extends Component
{
    public $txtabuscar='';

    public function BuscarPorNombre(){
        $this->dispatch('filtrarPorNombre', cadBusqueda: $this->txtabuscar);
        $this->dispatch('defRender', varRender: false);
    }

    public function render()
    {
        return view('livewire.componentes.buscador');
    }
}
