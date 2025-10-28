<?php

namespace App\Livewire\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Menutematico extends Component
{
    public $categorias = [];

    public function SelecCat($id){
        $this->dispatch('filtratCat', idCat: $id);
        $this->dispatch('defRender', varRender: false);
    }

    public function mount()
    {
        $query = DB::table('tb_categorias');
        $this->categorias = $query->get();
    }

    public function render()
    {
        return view('livewire.componentes.menutematico');
    }
}
