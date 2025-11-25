<?php

namespace App\Livewire\Componentes\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Lstventas extends Component
{
    public $verForm = false;
    public $listVentas = [];

    public function VerForm(){
        $this->verForm=true;
    }

    public function CerrarForm(){
        $this->verForm=false;
    }

    #[On('selec-dtos')]
    public function SelectDtos(){
        $this->listVentas = DB::table('vta_lista_de_ventas')
            ->orderBy('fecVenta', 'desc')
            ->get();
    }

    public function mount()
    {
        $this->SelectDtos();
    }

    public function render()
    {
        return view('livewire.componentes.admin.lstventas',['listVentas' => $this->listVentas]);
    }
}
