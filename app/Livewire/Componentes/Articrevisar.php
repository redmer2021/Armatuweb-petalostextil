<?php

namespace App\Livewire\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Articrevisar extends Component
{
    public $verForm = false;
    public $id;
    public $articulo = [];
    public $categorias = [];
    public $fotos = [];
    public $fotoPrincipal = '';

    public $codigo = '';
    public $categoria = '';
    public $nombre = '';
    public $descrip = '';
    public $compoKit = '';
    public $caracDest = '';
    public $usosRec = '';
    public $medidas = '';
    public $peso = '';
    public $precio = 0;
    public $descPorTransfer = 0;
    public $stockActual = 0;
    public $visitas = 0;
    public $pausado = 0;

    public function VerForm(){
        $this->verForm=true;
    }

    public function CerrarForm(){
        $this->verForm=false;
    }

    public function SeleccionaFoto($fotoSelec){
        $this->fotoPrincipal = $fotoSelec;
    }
    

    public function mount()
    {
        $this->articulo = DB::table('vta_catalogo')
            ->select('codigo', 
            'categoria', 
            'nomCategoria',
            'nombre', 
            'descrip', 
            'compoKit', 
            'caracDest', 
            'usosRec', 
            'medidas', 
            'peso', 
            'precio', 
            'nomFoto',
            'descPorTransfer', 
            'stockActual', 
            'visitas', 
            'pausado')
            ->where('id', $this->id)
            ->first();
        $this->fotos = DB::table('tb_fotos')
            ->select('nro_foto', 'nomFoto')
            ->where('id_articulo', $this->id)
            ->get();
        $this->fotoPrincipal = $this->articulo->nomFoto;

        $this->codigo = $this->articulo->codigo;
        $this->categoria = $this->articulo->nomCategoria;
        $this->nombre = $this->articulo->nombre;
        $this->descrip = $this->articulo->descrip;
        $this->compoKit = $this->articulo->compoKit;
        $this->caracDest = $this->articulo->caracDest;
        $this->usosRec = $this->articulo->usosRec;
        $this->medidas = $this->articulo->medidas;
        $this->peso = $this->articulo->peso;
        $this->precio = $this->articulo->precio;
        $this->descPorTransfer = $this->articulo->descPorTransfer;
        $this->stockActual = $this->articulo->stockActual;
        $this->visitas = $this->articulo->visitas;
        $this->pausado = $this->articulo->pausado;
    }

    public function render()
    {
        return view('livewire.componentes.articrevisar');
    }
}
