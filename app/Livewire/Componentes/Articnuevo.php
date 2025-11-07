<?php

namespace App\Livewire\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Articnuevo extends Component
{
    use WithFileUploads;

    public $verForm = false;
    public $categorias = [];
    public $fotos = [];
    
    public $nroTemporal=0;
    public $fotoPrincipal='';
    public $imagenSelect='';
    public $errorImagen='';

    public $imagen;
    public $imgKey;
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
        $this->nroTemporal = random_int(100000, 999999);
    }

    public function CerrarForm(){
        $this->verForm=false;
    }

    public function Cancelar(){
        $usuario = Auth::user()->email ?? 'sistema';
        
        // 1️⃣ Obtener todas las fotos actuales para el usuario y nroTemporal
        $fotos = DB::table('tb_fotos_tmp')
            ->where('nroArtic', $this->nroTemporal)
            ->where('user', $usuario)
            ->pluck('nomFoto'); // solo trae los nombres de archivo
    
        // 2️⃣ Eliminar los archivos físicos si existen
        foreach ($fotos as $foto) {
            if (Storage::disk('img_publicos')->exists($foto)) {
                Storage::disk('img_publicos')->delete($foto);
            }
        }
    
        // 3️⃣ Eliminar los registros de la tabla
        DB::table('tb_fotos_tmp')
            ->where('nroArtic', $this->nroTemporal)
            ->where('user', $usuario)
            ->delete();
    
        // 4️⃣ Limpiar la lista local y cerrar formulario
        $this->fotos = [];        
        $this->verForm=false;
    }

    public function SeleccionaFoto($fotoSelec){
        $this->errorImagen = '';
        $this->fotoPrincipal = $fotoSelec;
    }

    public function EliminarImg(){
        $usuario = Auth::user()->email ?? 'sistema';

        // 1️⃣ Eliminar archivo físico si existe
        if (Storage::disk('img_publicos')->exists($this->fotoPrincipal)) {
            Storage::disk('img_publicos')->delete($this->fotoPrincipal);
        }
    
        // 2️⃣ Eliminar registro de la tabla
        DB::table('tb_fotos_tmp')
            ->where('nomFoto', $this->fotoPrincipal)
            ->where('user', $usuario)
            ->where('nroArtic', $this->nroTemporal)
            ->delete();
    
        // 3️⃣ Actualizar la lista de fotos
        $this->fotos = DB::table('tb_fotos_tmp')
            ->where('nroArtic', $this->nroTemporal)
            ->where('user', $usuario)
            ->orderBy('nroFoto')
            ->get();
        $this->fotoPrincipal = '';
        $this->errorImagen = '';
    }

    public function SubirImg(){
        $this->errorImagen = '';
        if ($this->imagen){
            $extension = $this->imagen->getClientOriginalExtension();
            // Crear un nombre único con la extensión original
            $nombreArchivo = 'art_' . time() . '.' . $extension;

            $this->imagen->storeAs('', $nombreArchivo, [
                'disk' => 'img_publicos'
            ]);

            $ultimoNumero = DB::table('tb_fotos_tmp')
            ->where('nroArtic', $this->nroTemporal)
            ->where('user', Auth::user()->email ?? 'sistema')
            ->max('nroFoto');
        
            $nuevoNumero = ($ultimoNumero ?? 0) + 1;

            DB::table('tb_fotos_tmp')->insert([
                'nroArtic'   => $this->nroTemporal,
                'nroFoto'    => $nuevoNumero,
                'nomFoto'    => $nombreArchivo,
                'user'       => Auth::user()->email ?? 'sistema',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Obtener todas las fotos del usuario y artículo actual
            $this->fotos = DB::table('tb_fotos_tmp')
                ->where('nroArtic', $this->nroTemporal)
                ->where('user', Auth::user()->email ?? 'sistema')
                ->orderBy('nroFoto')
                ->get();            
                            
            $this->reset(['imagen']);
            $this->imgKey = rand();
        } else {
            $this->errorImagen = 'Seleccionar una imagen...';
        }
    }

    public function Grabar(){
        $rules = [
            'codigo' => [
                'required',
                'regex:/^[A-Za-z]{3}\d{3}$/',
                Rule::unique('tb_articulos', 'codigo'),
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

        $idArticulo = DB::table('tb_articulos')->insertGetId([
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
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $usuario = Auth::user()->email ?? 'sistema';

        $fotosTmp = DB::table('tb_fotos_tmp')
        ->where('nroArtic', $this->nroTemporal)
        ->where('user', $usuario)
        ->get();        

        foreach ($fotosTmp as $foto) {
            DB::table('tb_fotos')->insert([
                'id_articulo' => $idArticulo,
                'nro_foto'    => $foto->nroFoto,
                'nomFoto'     => $foto->nomFoto,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }        
        
        DB::table('tb_fotos_tmp')
            ->where('nroArtic', $this->nroTemporal)
            ->where('user', $usuario)
            ->delete();

        $this->verForm=false;
        $this->dispatch('selec-dtos');
    }

    
    public function mount(){
        $this->categorias = DB::table('tb_categorias')->get();
    }
    public function render()
    {
        return view('livewire.componentes.articnuevo');
    }
}
