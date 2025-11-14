<?php

namespace App\Livewire\Componentes\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Articeditar extends Component
{
    use WithFileUploads;

    public $verForm = false;
    public $id;
    /** @var object $articulo */
    public $articulo = [];
    public $categorias = [];
    public $fotos = [];
    public $fotoPrincipal = '';
    public $imagen;
    public $imgKey;
    public $errorImagen='';

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
        // Obtener las fotos del artículo actual
        $fotos_tmp = DB::table('tb_fotos')
            ->select('id_articulo', 'nro_foto', 'nomFoto')
            ->where('id_articulo', $this->id)
            ->get();

            
            // Obtener el usuario o usar "sistema" por defecto
            $userEmail = Auth::check() ? Auth::user()->email : 'sistema';
            
            // Recorrer cada foto y guardarla en tb_fotos_tmp
            foreach ($fotos_tmp as $it) {
                DB::table('tb_fotos_tmp')->insert([
                    'nroArtic'   => $it->id_articulo,
                'nroFoto'    => $it->nro_foto,
                'nomFoto'    => $it->nomFoto,
                'user'       => $userEmail,
                'regEstado'  => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        $this->fotos = DB::table('tb_fotos_tmp')
            ->select('nroFoto', 'nomFoto', 'regEstado')
            ->where('nroArtic', $this->id)
            ->where('regEstado', 1)
            ->get();

        if (count($this->fotos) > 0){
            $this->fotoPrincipal = $this->fotos[0]->nomFoto;
        }
        $this->verForm=true;
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
            ->where('nroArtic', $this->id)
            ->where('user', Auth::user()->email ?? 'sistema')
            ->max('nroFoto');
        
            $nuevoNumero = ($ultimoNumero ?? 0) + 1;

            DB::table('tb_fotos_tmp')->insert([
                'nroArtic'   => $this->id,
                'nroFoto'    => $nuevoNumero,
                'nomFoto'    => $nombreArchivo,
                'user'       => Auth::user()->email ?? 'sistema',
                'regEstado'  => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Obtener todas las fotos del usuario y artículo actual
            $this->fotos = DB::table('tb_fotos_tmp')
                ->where('nroArtic', $this->id)
                ->where('user', Auth::user()->email ?? 'sistema')
                ->orderBy('nroFoto')
                ->get();

            $this->reset(['imagen']);
            $this->imgKey = rand();
        } else {
            $this->errorImagen = 'Seleccionar una imagen...';
        }
    }


    public function EliminarImg(){
        // Obtener el usuario o usar "sistema" por defecto
        $userEmail = Auth::check() ? Auth::user()->email : 'sistema';

        DB::table('tb_fotos_tmp')
            ->where('nroArtic', $this->id)
            ->where('nomFoto', $this->fotoPrincipal)
            ->where('user', $userEmail)
            ->update(['regEstado' => 2]);

        $this->fotos = DB::table('tb_fotos_tmp')
            ->select('nroFoto', 'nomFoto', 'regEstado')
            ->where('nroArtic', $this->id)
            ->where('regEstado', 1)
            ->get();

        $this->fotoPrincipal='';
        if (count($this->fotos) > 0){
            $this->fotoPrincipal=$this->fotos[0]->nomFoto;
        }

    }

    public function CerrarForm(){
        // Obtener el usuario o usar "sistema" por defecto
        $userEmail = Auth::check() ? Auth::user()->email : 'sistema';

        DB::table('tb_fotos_tmp')
            ->where('nroArtic', $this->id)
            ->where('user', $userEmail)
            ->delete();

        $this->errorImagen='';
        $this->verForm=false;
    }

    public function mount()
    {
        //Pasar las fotos de la tabla tb_fotos a tb_fotos_tmp, en el campo fotoElim grabar 1
        //agregar el nombre de usuario
        //luego, cuando se agrega o eliminan fotos, se hacen sobre tb_fotos_tmp
        //si se hace cancelar, no se elimina ninguna foto de la carpeta de fotos del sistema
        //cuando se elimina una foto, marcar el registro en tb_fotos_tmp, campo fotoElim a 2, pero
        //no eliminar el registro. Si se agrega una nueva foto, generar registro en tb_fotos_tmp y en el
        //campo fotoElim grabar 3 (nueva foto).
        //Cuando se confirma la edición de datos, se recorre tb_fotos_tmp, si el registro está en 1,
        //no se hace nada, si está en 2, eliminar el registro de la tabla tb_fotos y eliminar la foto de carpeta de fotos
        //si está en 3, generar nuevo registro en tb_fotos.
        //limpiar el archivo tb_fotos_tmp.

        //Cuando se recorre el archivo tb_fotos_tmp, si está en 2, significa que está borrado y no se debe mostrar foto
        //pequeña en el listado de la izquierda, donde se hace click para ver en grande la foto.

        $this->categorias = DB::table('tb_categorias')->get();

        $this->articulo = DB::table('vta_catalogo')
            ->where('id', $this->id)
            ->first();

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
        $this->CerrarForm();
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

        //recorrer el archivo de fotos tb_fotos_tmp, los registros que están en 1, quedan sin hacer nada
        //los que están en 2, son fotos eliminadas, hay que eliminarlas de la carpeta de fotos y del archivo de fotos tb_fotos
        //los que están en 3, son fotos nuevas, se agrega un registro en tb_fotos y la foto ya está en la carpeta.
        //limpiar el archivo tb_fotos_tmp

        $this->fotos = DB::table('tb_fotos_tmp')
            ->select('nroArtic', 'nroFoto', 'nomFoto', 'regEstado')
            ->where('nroArtic', $this->id)
            ->get();

        foreach ($this->fotos as $it) {
            if ($it->regEstado == 2){
                // 1️⃣ Eliminar archivo físico si existe
                if (Storage::disk('img_publicos')->exists($it->nomFoto)) {
                    Storage::disk('img_publicos')->delete($it->nomFoto);
                }
                DB::table('tb_fotos')
                    ->where('id_articulo', $it->nroArtic)
                    ->where('nomFoto', $it->nomFoto)
                    ->delete();
            } else if ($it->regEstado == 3){
                // Obtener el último nro_foto usado para ese artículo
                $ultimoNumero = DB::table('tb_fotos')
                    ->where('id_articulo', $it->nroArtic)
                    ->max('nro_foto');

                // Si no hay registros, empieza desde 1
                $nuevoNumero = $ultimoNumero ? $ultimoNumero + 1 : 1;                
                DB::table('tb_fotos')->insert([
                    'id_articulo' => $it->nroArtic,
                    'nro_foto'    => $nuevoNumero,
                    'nomFoto'     => $it->nomFoto,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }

        // Traer las fotos ordenadas por nro_foto
        $fotos = DB::table('tb_fotos')
        ->where('id_articulo', $this->id)
        ->orderBy('nro_foto')
        ->get();

        $contador = 1;

        // Recorrer y actualizar los números
        foreach ($fotos as $foto) {
            DB::table('tb_fotos')
                ->where('id', $foto->id)
                ->update(['nro_foto' => $contador]);
            $contador++;
        }        

        $this->CerrarForm();

        $this->dispatch('selec-dtos');
    }

    public function render()
    {
        return view('livewire.componentes.admin.articeditar');
    }
}
