<?php

namespace App\Livewire\Componentes\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmarEnvio;

class Pedidoconfirmaenvio extends Component
{
    public $verForm = false;
    public $id = 0;

    public $dtosFacNombre = '';
    public $dtosFacCorreoE = '';
    public $msgComprador = '';
    public $linkSeguimiento = '';
    public $estado = 0;

    public function EnviarMail(){
        Mail::to($this->dtosFacCorreoE)->send(new ConfirmarEnvio($this->dtosFacNombre, $this->msgComprador, $this->linkSeguimiento));

        $updateData = [
            'estado' => 2,
            'fecEnvio' => now(),
            'linkSeguimiento' => $this->linkSeguimiento,
            'updated_at' => now()
        ];

        DB::table('tb_ventas')
            ->where('id', $this->id)
            ->update($updateData);

        $this->dispatch('selec-dtos');

        $this->CerrarForm();
    }

    public function VerForm(){
        $this->verForm=true;
    }

    public function CerrarForm(){
        $this->reset([
            'dtosFacNombre',
            'msgComprador',
            'linkSeguimiento'
        ]);
        $this->verForm=false;
    }

    public function mount()
    {
        $venta = DB::table('vta_lista_de_ventas')
            ->where('id', $this->id)
            ->first();
            
        $this->dtosFacNombre = $venta->dtosFacNombre;
        $this->dtosFacCorreoE = $venta->dtosFacCorreoE;
        $this->estado = $venta->estado;

    }

    public function render()
    {
        return view('livewire.componentes.admin.pedidoconfirmaenvio');
    }
}
