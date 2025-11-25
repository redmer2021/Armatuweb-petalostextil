<?php

namespace App\Livewire\Componentes\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Pedidover extends Component
{
    public $verForm = false;
    public $id = 0;

    public $totalProductos = 0;
    public $totalPedido = 0;
    public $totalEnvio = 0;
    public $totalDescTransfer = 0;
    public $carrito = [];
    public $enviarPor = 0;
    public $formaDePago = 0;
    public $dtosFacNombre = '';
    public $dtosFacApellido = '';
    public $dtosFacDireccion = '';
    public $dtosFacProvincia = '';
    public $dtosFacLocCiudad = '';
    public $dtosFacCodPostal = '';
    public $dtosFacTelefono = '';
    public $dtosFacCorreoE = '';
    public $dtosAltNombre = '';
    public $dtosAltApellido = '';
    public $dtosAltDireccion = '';
    public $dtosAltProvincia = '';
    public $dtosAltLocCiudad = '';
    public $dtosAltCodPostal = '';
    public $dtosFacNotas = '';
    public $nroPedido = '';
    public $estado = '';



    public function VerForm(){
        $this->verForm=true;
    }

    public function CerrarForm(){
        $this->verForm=false;
    }

    public function mount()
    {
        $venta = DB::table('vta_lista_de_ventas')
            ->where('id', $this->id)
            ->first();

        $this->dtosFacNombre = $venta->dtosFacNombre;
        $this->dtosFacApellido = $venta->dtosFacApellido;
        $this->dtosFacDireccion = $venta->dtosFacDireccion;
        $this->dtosFacProvincia = $venta->dtosFacProvinciaNombre;
        $this->dtosFacLocCiudad = $venta->dtosFacLocCiudad;
        $this->dtosFacCodPostal = $venta->dtosFacCodPostal;
        $this->dtosFacTelefono = $venta->dtosFacTelefono;
        $this->dtosFacCorreoE = $venta->dtosFacCorreoE;
        $this->dtosAltNombre = $venta->dtosAltNombre;
        $this->dtosAltApellido = $venta->dtosAltApellido;
        $this->dtosAltDireccion = $venta->dtosAltDireccion;
        $this->dtosAltProvincia = $venta->dtosAltProvinciaNombre;
        $this->dtosAltLocCiudad = $venta->dtosAltLocCiudad;
        $this->dtosAltCodPostal = $venta->dtosAltCodPostal;
        $this->dtosFacNotas = $venta->dtosFacNotas;
        $this->totalPedido = $venta->totalPedido;
        $this->totalEnvio = $venta->totalEnvio;
        $this->totalDescTransfer = $venta->totalDescTransfer;
        $this->enviarPor = $venta->enviarPor;
        $this->formaDePago = $venta->formaDePago;

        $this->estado = $venta->estadoDesc;
        $this->nroPedido = $venta->nroVenta;


        $this->carrito = DB::table('vta_carrito')
            ->where('guidCarrito', $venta->guidCarrito)
            ->get();

        $this->totalProductos = DB::table('tb_carrito')
            ->where('guidCarrito', $venta->guidCarrito)
            ->sum(DB::raw('cantidad * precioUnit')) ?? 0;
    }


    public function render()
    {
        return view('livewire.componentes.admin.pedidover');
    }
}
