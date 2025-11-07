<?php

namespace App\Livewire\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Articeditar extends Component
{
    public $verForm = false;
    public $id;
    /** @var object $articulo */
    public $articulo = [];
    public $categorias = [];
    public $fotos = [];
    public $fotoPrincipal = '';

    public $codigo = '';
    public $categoria = 0;
    public $nombre = '';
    public $descrip = '';
    public $compoKit = '';
    public $caracDest = '';
    public $usosRec = '';
    public $medidas = '';
    public $peso = '';
    public $precio = 0 ;
    public $descPorTransfer = 0;
    public $stockActual = 0;
    public $visitas = 0;
    public $pausado = false;

    public function VerForm(){
        $this->verForm=true;
    }

    public function CerrarForm(){
        $this->verForm=false;
    }

    public function mount()
    {
        $this->categorias = DB::table('tb_categorias')->get();

        $this->articulo = DB::table('vta_catalogo')
            ->where('id', $this->id)
            ->first();
        $this->fotos = DB::table('tb_fotos')
            ->select('nro_foto', 'nomFoto')
            ->where('id_articulo', $this->id)
            ->get();
        $this->fotoPrincipal = $this->articulo->nomFoto;

        $this->codigo = $this->articulo->codigo;
        $this->categoria = $this->articulo->categoria;
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

        if ($this->articulo->pausado == 1){
            $this->pausado = true;
        }
        else{
            $this->pausado = false;
        }
    }

    public function SeleccionaFoto($fotoSelec){
        $this->fotoPrincipal = $fotoSelec;
    }
        

    public function Cancelar(){
        $this->verForm=false;
    }

    public function Grabar(){
        $rules = [
            'codigo' => [
                'required',
                'regex:/^[A-Za-z]{3}\d{3}$/',
                Rule::unique('tb_articulos', 'codigo')->ignore($this->id),
            ],
            'categoria' => ['required', 'not_in:0'],
            'nombre' => ['required'],
            'descrip' => ['required'],
            'precio' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'stockActual' => ['required', 'not_in:0'],
        ];
    
        $messages = [
            'codigo.required' => 'Debe ingresar un código de artículo',
            'codigo.regex' => 'El código debe tener 3 letras seguidas de 3 números (ej: ABC123)',
            'codigo.unique' => 'El código ingresado ya existe en la base de datos',
            'categoria.required' => 'Debe seleccionar una categoría',
            'categoria.not_in' => 'Debe seleccionar una categoría',
            'nombre.required' => 'Debe ingresar el nombre del artículo',
            'descrip.required' => 'Debe ingresar una descripción',
            'precio.required' => 'Debe ingresar el precio unitario',
            'precio.regex' => 'El precio debe ser un valor numérico con hasta dos decimales',            
            'precio.numeric' => 'El precio debe ser un valor numérico con hasta dos decimales',
            'stockActual.required' => 'Debe ingresar el Stock Actual',
            'stockActual.not_in' => 'El Stock Actual debe ser mayor que cero',
        ];
        
        $this->validate($rules, $messages);

        DB::table('tb_articulos')
        ->where('id', $this->id)
        ->update([
            'codigo' => $this->codigo,
            'categoria' => $this->categoria,
            'nombre' => $this->nombre,
            'descrip' => $this->descrip,
            'compoKit' => $this->compoKit,
            'caracDest' => $this->caracDest,
            'usosRec' => $this->usosRec,
            'medidas' => $this->medidas,
            'peso' => $this->peso,
            'precio' => $this->precio,
            'descPorTransfer' => $this->descPorTransfer,
            'stockActual' => $this->stockActual,
            'visitas' => (int) $this->visitas,
            'pausado' => $this->pausado ? 1 : 2,
            'updated_at' => now(),
        ]);

        $this->verForm=false;
        $this->dispatch('selec-dtos');
    }
    
    
    public function render()
    {
        return view('livewire.componentes.articeditar');
    }
}
