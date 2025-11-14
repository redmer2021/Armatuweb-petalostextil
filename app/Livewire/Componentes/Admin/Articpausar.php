<?php

namespace App\Livewire\Componentes\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Articpausar extends Component
{
    public $verForm = false;
    public $id;
    public $articulo = [];

    public function VerForm(){
        $this->verForm=true;
    }

    public function CerrarForm(){
        $this->verForm=false;
    }

    public function Si(){
        $articulo = DB::table('tb_articulos')
            ->select('pausado')
            ->where('id', $this->id)
            ->first();

        if ($articulo) {
            $nuevoValor = $articulo->pausado == 1 ? 2 : 1;

            DB::table('tb_articulos')
                ->where('id', $this->id)
                ->update(['pausado' => $nuevoValor]);
        }

        $this->verForm=false;
        $this->dispatch('selec-dtos');
    }

    public function No(){
        $this->verForm=false;
    }

    public function mount()
    {
        $this->articulo = DB::table('tb_articulos')
            ->select('codigo', 'nombre', 'pausado')
            ->where('id', $this->id)
            ->first();
    }

    public function render()
    {
        return view('livewire.componentes.admin.articpausar');
    }
}
