<?php

namespace App\Livewire\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Articeliminar extends Component
{
    public $verForm = false;
    public $id;
    public $articulo = [];
    public $msgUsr = '';

    public function VerForm(){
        $this->verForm=true;
    }

    public function CerrarForm(){
        $this->verForm=false;
    }

    public function Si(){
        // Verificar si el artículo existe
        $articulo = DB::table('tb_articulos')
            ->select('id')
            ->where('id', $this->id)
            ->first();

        if (!$articulo) {
            $this->msgUsr = 'Artículo no encontrado.';
            $this->verForm = false;
            return;
        }

        // Verificar si el artículo está referenciado en tb_carrito
        $existeEnCarrito = DB::table('tb_carrito')
            ->where('idArticulo', $this->id)
            ->exists();

        if ($existeEnCarrito) {
            // No eliminar
            $this->msgUsr = 'No se puede eliminar: el artículo está vinculado en un pedido.';
        } else {
            // Eliminar el artículo
            DB::table('tb_articulos')
                ->where('id', $this->id)
                ->delete();

            // Eliminar fotos
            DB::table('tb_fotos')
                ->where('id_articulo', $this->id)
                ->delete();

            // Cerrar formulario
            $this->verForm=false;
            $this->dispatch('selec-dtos');
        }

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
        return view('livewire.componentes.articeliminar');
    }
}
