<?php

namespace App\Livewire\Componentes\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Editprecioenvios extends Component
{
    public $verForm = false;
    public $tb_provincias = [];

    public function VerForm(){
        $this->verForm=true;
    }

    public function CerrarForm(){
        $this->verForm=false;
    }

    #[On('selec-dtos-prov')]
    public function SelectDtos(){
        $this->tb_provincias = DB::table('tb_provincias')->get();
    }

    public function mount()
    {
        $this->SelectDtos();
    }


    public function render()
    {
        return view('livewire.componentes.admin.editprecioenvios');
    }
}
