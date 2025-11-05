<?php

namespace App\Livewire\Componentes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Lstarticulos extends Component
{
    public $categorias = [];
    public $lstArticulos = [];
    
    public function mount()
    {
        $query = DB::table('tb_categorias');
        $this->categorias = $query->get();
        $this->SelectDtos();
    }

    public function CerrarSesion(){
        Auth::logout();
        return redirect()->to('/');
    }

    #[On('selec-dtos')]
    public function SelectDtos(){
        $query = DB::table('vta_catalogo');
        $this->lstArticulos = $query->get();
    }

    public function render()
    {
        return view('livewire.componentes.lstarticulos', ['listArticulos' => $this->lstArticulos]);
    }
}
