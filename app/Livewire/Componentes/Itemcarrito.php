<?php

namespace App\Livewire\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Itemcarrito extends Component
{
    public $item;
    public $unidades;
    public $totalItems;

    public function Sumar(){
        if ($this->unidades < $this->item->stockActual)
        {
            $this->unidades++;
            $this->CalcularTotalItem();
        }
    }

    public function Restar(){

        if ($this->unidades>1){
            $this->unidades--;
            $this->CalcularTotalItem();
        }
    }

    public function Eliminar(){
        DB::table('tb_carrito')
        ->where('id', $this->item->id)
        ->delete();

        $cantidadItems = DB::table('vta_carrito')
            ->where('guidCarrito', $this->item->guidCarrito)
            ->count();

        if ($cantidadItems > 0){
            $this->dispatch('recalcular', uuid: $this->item->guidCarrito);
            $this->dispatch('recargar-carrito');
        } else {
            $this->dispatch('recalcular', uuid: $this->item->guidCarrito);
            $this->dispatch('cerrar-carrito');
        }
    }

    protected function CalcularTotalItem(){
        $this->totalItems = $this->unidades * $this->item->precioUnit;
        $this->ActualizaCantidad($this->item->id);
    }

    protected function ActualizaCantidad($idArtic){
        DB::table('tb_carrito')
        ->where('id', $idArtic)
        ->update([
            'cantidad'  => $this->unidades,
            'updated_at' => now(),
        ]);
        $this->dispatch('recalcular', uuid: $this->item->guidCarrito);        
    }

    public function mount()
    {
        $this->unidades = $this->item->cantidad;
        $this->CalcularTotalItem();
    }

    public function render()
    {
        return view('livewire.componentes.itemcarrito');
    }
}
