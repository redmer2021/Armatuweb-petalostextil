<?php

namespace App\Livewire\Componentes\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Modifprecioenvio extends Component
{
    public $verForm = false;
    public $idProvincia = 0;
    public $dtosProvincia;
    public $impoEnvio = 0;

    public function VerForm(){
        $this->verForm=true;
    }

    public function CerrarForm(){
        $this->resetErrorBag();
        $this->verForm=false;
    }

    public function Cancelar() {
        $this->CerrarForm();
    }

    public function Confirmar() {

        $rules = [
            'impoEnvio' => [ 'gt:0' , 'required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/']
        ];
    
        $messages = [
            'impoEnvio.required' => 'Debe ingresar el precio unitario',
            'impoEnvio.regex' => 'El precio debe ser un valor numérico con hasta dos decimales',            
            'impoEnvio.numeric' => 'El precio debe ser un valor numérico con hasta dos decimales',
            'impoEnvio.gt' => 'El precio debe ser mayor que cero',
        ];
        
        $this->validate($rules, $messages);

        DB::table('tb_provincias')
        ->where('id', $this->idProvincia)
        ->update([
            'impoEnvio' => $this->impoEnvio,
            'updated_at' => now(),
        ]);
        
        $this->dispatch('selec-dtos-prov');
        $this->CerrarForm();
    }

    public function mount()
    {
        $this->dtosProvincia = DB::table('tb_provincias')
        ->where('id', $this->idProvincia)
        ->first();
        $this->impoEnvio = $this->dtosProvincia->impoEnvio;
    }
    

    public function render()
    {
        return view('livewire.componentes.admin.modifprecioenvio');
    }
}
