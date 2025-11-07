<?php

namespace App\Livewire\Componentes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class Catalogo extends Component
{
    public $categorias = [];
    public $idCategoria = 0;
    public $titCatalogo = '';
    public $txtabuscar = '';
    public $mostrarBanner = false;
    public $RenderizarBanner = true;
    public $verForm = false;
    public $cantItemsComprados = 1;

    public $guid = '';

    public $item_id_articulo = 0;
    public $item_fotoPrincipal = '';
    public $item_fotosOtras = [];
    public $item_nombre = '';
    public $item_precio = 0;
    public $item_descTransfer = 0;
    public $item_precio_con_desc = 0;
    public $item_stock_actual = 0;
    public $item_visitas = 0;
    public $item_cuotas = '';
    public $item_descrip = '';
    public $item_compo_kit = '';
    public $item_carac_dest = '';
    public $item_usos_rec = '';
    public $item_medidas = '';
    public $item_peso = '';
    public $item_notas = '';
    public $item_pausado = 0;
    

    public function CerrarForm(){
        $this->verForm=false;
    }

    public function setUuid($uuid)
    {
        $this->guid = $uuid;
    }

    public function AgregarAlCarito(){

        if ($this->guid == ''){
            $uuid = Str::uuid()->toString();
            DB::table('tb_carrito')->insert([
                'guidCarrito' => $uuid,
                'idArticulo'    => $this->item_id_articulo,
                'cantidad'      => $this->cantItemsComprados,
                'precioUnit'    => $this->item_precio,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            // Enviar el UUID al frontend
            $this->dispatch(
                'guardar-uuid',   
                uuid: $uuid 
            );
            $this->setUuid($uuid);
            $this->dispatch('recalcular', uuid: $uuid);

        } else {

            // Verificar si ya existe ese artículo en el carrito
            $itemExistente = DB::table('tb_carrito')
            ->where('guidCarrito', $this->guid)
            ->where('idArticulo', $this->item_id_articulo)
            ->first();

            if ($itemExistente) {
                // Si ya existe, actualizamos sumando cantidad
                DB::table('tb_carrito')
                ->where('id', $itemExistente->id)
                ->update([
                    'cantidad'  => $itemExistente->cantidad + $this->cantItemsComprados,
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('tb_carrito')->insert([
                    'guidCarrito' => $this->guid,
                    'idArticulo'    => $this->item_id_articulo,
                    'cantidad'      => $this->cantItemsComprados,
                    'precioUnit'    => $this->item_precio,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]);
            }
            $this->dispatch('recalcular', uuid: $this->guid);
        }

        $this->verForm=false;
    }

    public function Sumar(){
        if ($this->cantItemsComprados < $this->item_stock_actual)
            $this->cantItemsComprados++;
    }

    public function Restar(){
        if ($this->cantItemsComprados>1)
            $this->cantItemsComprados--;
    }

    public function SeleccionaFoto($fotoSelec){
        $this->item_fotoPrincipal = $fotoSelec;
    }

    public function IniciarCompra($id){
        $this->cantItemsComprados = 1;
        $this->verForm=true;

        // 🔹 Incrementar las visitas del artículo
        DB::table('tb_articulos')
            ->where('id', $id)
            ->increment('visitas');

        $articulo = DB::table('vta_catalogo')
            ->where('id', $id)
            ->first();
        if ($articulo){
            $this->item_id_articulo = $articulo->id;
            $this->item_fotoPrincipal = $articulo->nomFoto;
            $this->item_fotosOtras = DB::table('tb_fotos')
            ->select('nomFoto')
            ->where('id_articulo', $id)
            ->get();

            $this->item_nombre = $articulo->nombre;
            $this->item_precio = $articulo->precio;
            $this->item_descTransfer = $articulo->descPorTransfer;
            $this->item_precio_con_desc = $this->item_precio * (1-($articulo->descPorTransfer/100));
            $this->item_cuotas = $articulo->cuotas;
            $this->item_stock_actual = $articulo->stockActual;
            $this->item_visitas = $articulo->visitas;
            $this->item_descrip = $articulo->descrip;
            $this->item_compo_kit = $articulo->compoKit;
            $this->item_carac_dest = $articulo->caracDest;
            $this->item_usos_rec = $articulo->usosRec;
            $this->item_medidas = $articulo->medidas;
            $this->item_peso = $articulo->peso;
            $this->item_notas = $articulo->notas;
            $this->item_pausado = $articulo->pausado;
        }
    }

    #[On('filtrarPorNombre')] 
    public function Buscar($cadBusqueda){
        $this->idCategoria = 0;
        $this->txtabuscar = $cadBusqueda;
    }

    #[On('filtratCat')] 
    public function SelecCat($idCat){
        $this->idCategoria = $idCat;
        $this->txtabuscar = '';
    }

    public function mount()
    {
        $query = DB::table('tb_categorias');
        $this->categorias = $query->get();

        $this->dispatch('componente-montado');
    }
    
    public function render()
    {
        $query = DB::table('vta_catalogo');

        if ($this->idCategoria != 0) {
            $query->where('categoria', '=', $this->idCategoria);
        }

        if (!empty($this->txtabuscar)) {
            $query->where('nombre', 'like', '%' . $this->txtabuscar . '%');
        }

        $listCatalogo = $query->get();
        
        return view('livewire.componentes.catalogo', ['listCatalogo' => $listCatalogo]);
    }
}
