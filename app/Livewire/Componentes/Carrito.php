<?php

namespace App\Livewire\Componentes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Exceptions\MPApiException;

class Carrito extends Component
{
    public $totalCantidad = 0;
    public $totalPrecio = 0;
    public $totEnvioDom = 0;
    public $totEnvioMoto = 10000;
    public $totalFinal = 0;
    public $totalConDesc= 0;
    public $pjeDescTransfer = 25;
    public $verForm = false;
    public $carrito = [];
    public $guidCarrito;
    public $tipEnvio = 0;
    public $tipPago = false;

    public $dirCalleAltura = '';
    public $dirProvincia = '';
    public $dirLocalidad = '';
    public $dirBarrio='';
    public $dirCodPostal = '';
    public $dirEntreCalles = '';
    public $tb_provincias = [];
    

    #[On('cerrar-carrito')]
    public function CerrarForm(){
        $this->verForm=false;
    }

    public function VerCarrito(){
        $this->carrito = DB::table('vta_carrito')
        ->where('estado', 0)
        ->where('guidCarrito', $this->guidCarrito)
        ->get();
        $this->reset([
            'tipEnvio',
            'tipPago'
        ]);

        if (Auth::check()){
            $direcEnvios = DB::table('tb_direc_envios')
            ->where('idUser', Auth::user()->id)
            ->first();
            if ($direcEnvios){
                $this->dirCalleAltura = $direcEnvios->direccion;
                $this->dirProvincia = $direcEnvios->idProvincia;
                $this->dirLocalidad = $direcEnvios->localidad;
                $this->dirBarrio = $direcEnvios->barrio;
                $this->dirCodPostal = $direcEnvios->codPostal;
            }
        }

        $this->verForm = true;
    }

    #[On('recargar-carrito')] 
    public function RecargarCarrito(){
        $this->carrito = DB::table('vta_carrito')
        ->where('estado', 0)
        ->where('guidCarrito', $this->guidCarrito)
        ->get();        
    }

    #[On('recalcular')] 
    public function setUuid($uuid)
    {
        $this->guidCarrito = $uuid;
        $carrito = DB::table('tb_carrito')
        ->selectRaw('SUM(cantidad) as total_cantidad, SUM(cantidad * precioUnit) as total_precio')
        ->where('estado', 0)
        ->where('guidCarrito', $uuid)
        ->first();

        $this->totalCantidad = $carrito->total_cantidad ?? 0;
        $this->totalPrecio   = $carrito->total_precio ?? 0;

        $this->recalcularTotal();

    }

    public function updatedTipEnvio()
    {
        $this->resetErrorBag();

        $this->recalcularTotal();
    }

    public function updatedDirProvincia(){
        $costoEnvio = DB::table('tb_provincias')
        ->select('impoEnvio')
        ->where('id', $this->dirProvincia)
        ->first();
        $this->totEnvioDom = $costoEnvio->impoEnvio;
        $this->recalcularTotal();
    }
    
    public function updatedTipPago()
    {
        $this->resetErrorBag();
        if ($this->tipPago){
            $this->totalFinal = $this->totalConDesc;
        } else {
            $this->recalcularTotal();
        }
    }
    
    private function recalcularTotal()
    {
        if ($this->tipEnvio == 1) {
            $this->totalFinal = $this->totalPrecio + $this->totEnvioDom;
        } elseif ($this->tipEnvio == 2) {
            $this->totalFinal = $this->totalPrecio + $this->totEnvioMoto;
        } else {
            $this->totalFinal = $this->totalPrecio;
        }

        // aplicar descuento sobre totalFinal
        $this->totalConDesc = $this->totalFinal - ($this->totalFinal * $this->pjeDescTransfer / 100);        

        if ($this->tipPago){
            $this->totalFinal = $this->totalConDesc;
        }

    }

    public function IniciarPago1(){
        try{
            MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
            
            //con esto se elimina la verificación de certificados ssl y opera en modo local
            //MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
        
            $client = new PreferenceClient();
            $preference = $client->create([
            "back_urls"=>array(
                "success" => "https://petalostextil.lienzovirtual.com.ar/",
                "failure" => "https://petalostextil.lienzovirtual.com.ar/",
                "pending" => "https://petalostextil.lienzovirtual.com.ar/"
            ),
            "differential_pricing" => array(
                "id" => 1,
            ),
            "items" => array(
                array(
                    "id" => $this->guidCarrito,
                    "title" => "Petalos Textil",
                    "description" => "Tienda Petalos Textil",
                    "quantity" => 1,
                    "currency_id" => "ARS",
                    "unit_price" => (float)$this->totalConDesc
                )
            ),
            "payment_methods" => [
                "excluded_payment_types" => [
                    ["id" => "ticket"],        // excluye pagos en efectivo (Rapipago, PagoFacil)
                    ["id" => "bank_transfer"], // excluye transferencias
                    ["id" => "credit_card"],   // excluye tarjetas de crédito
                    ["id" => "debit_card"],    // excluye tarjetas de débito
                    ["id" => "atm"],           // excluye pagos por cajero
                ],
                "default_payment_method_id" => "account_money",
                "installments" => 1 // sin cuotas
            ],        
            "external_reference" => $this->guidCarrito,
            "operation_type" => "regular_payment",
            "statement_descriptor" => "Test Store",
            ]);

            return redirect()->away($preference->init_point);
            //return redirect()->away($preference->sandbox_init_point);

        } catch (MPApiException $e) {
            Log::info($e->getApiResponse());
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    public function IniciarPago2(){

        if (empty($this->tipEnvio) || $this->tipEnvio == 0) {
            $this->addError('tipEnvio', 'Debe seleccionar un medio de envío');
            return;
        }

        if ($this->tipEnvio == 1){
            $rules = [
                'dirCalleAltura' => ['required'],
                'dirProvincia' => ['required', 'not_in:0'],
                'dirCodPostal' => ['required'],
            ];
        
            $messages = [
                'dirCalleAltura.required' => 'Debe ingresar Calle',
                'dirProvincia.required' => 'Debe ingresar la Provincia',
                'dirProvincia.not_in' => 'Debe ingresar la Provincia',
                'dirCodPostal.not_in' => 'Debe ingresar su Código Postal',
            ];
        } else if ($this->tipEnvio == 2){
            $rules = [
                'dirCalleAltura' => ['required'],
                'dirCodPostal' => ['required'],
            ];
        
            $messages = [
                'dirCalleAltura.required' => 'Debe ingresar Calle',
                'dirCodPostal.not_in' => 'Debe ingresar su Código Postal',
            ];
        }
        if ($this->tipEnvio >=1 and $this->tipEnvio <=2){
            $this->validate($rules, $messages);

            DB::table('tb_envios_pendientes')->insert([
                'guidCarrito' => $this->guidCarrito,
                'dirCalleAltura' => $this->dirCalleAltura,
                'dirProvincia' =>  $this->tipEnvio == 1 ? $this->dirProvincia : 24,
                'dirLocalidad' => $this->dirLocalidad,
                'dirBarrio' => $this->dirBarrio,
                'dirCodPostal' => $this->dirCodPostal,
                'dirEntreCalles' => $this->dirEntreCalles ?? '',
                'estado' => 0,
                'enviarPor' => $this->tipEnvio,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            //El estado 1 es pendiente de envío por correo o por moto
            $updateData = [
                'estado' => 1,
                'updated_at' => now()
            ];
    
            DB::table('tb_carrito')
                ->where('guidCarrito', $this->guidCarrito)
                ->update($updateData);
    
            $this->totalCantidad = 0;
            $this->totalPrecio   = 0;
        } else {
            //El estado 2 es pendiente de retiro por domicilio
            $updateData = [
                'estado' => 2,
                'updated_at' => now()
            ];
    
            DB::table('tb_carrito')
                ->where('guidCarrito', $this->guidCarrito)
                ->update($updateData);    
        }

        dd('p');
        
        try{
            MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
            
            //con esto se elimina la verificación de certificados ssl y opera en modo local
            //MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
        
            $client = new PreferenceClient();
            $preference = $client->create([
            "back_urls"=>array(
                "success" => "https://petalostextil.lienzovirtual.com.ar/",
                "failure" => "https://petalostextil.lienzovirtual.com.ar/",
                "pending" => "https://petalostextil.lienzovirtual.com.ar/"
            ),
            "differential_pricing" => array(
                "id" => 1,
            ),
            "items" => array(
                array(
                    "id" => $this->guidCarrito,
                    "title" => "Petalos Textil",
                    "description" => "Tienda Petalos Textil",
                    "quantity" => 1,
                    "currency_id" => "ARS",
                    "unit_price" => (float)$this->totalFinal
                )
            ),
            "external_reference" => $this->guidCarrito,
            "operation_type" => "regular_payment",
            "statement_descriptor" => "Test Store",
            ]);

            return redirect()->away($preference->init_point);
            //return redirect()->away($preference->sandbox_init_point);
        } catch (MPApiException $e) {
            Log::info($e->getApiResponse());
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    public function Aceptar(){

        if (empty($this->tipEnvio) || $this->tipEnvio == 0) {
            $this->addError('tipEnvio', 'Debe seleccionar un medio de envío');
            return;
        }

        if ($this->tipEnvio == 1){
            $rules = [
                'dirCalleAltura' => ['required'],
                'dirProvincia' => ['required', 'not_in:0'],
                'dirCodPostal' => ['required'],
            ];
        
            $messages = [
                'dirCalleAltura.required' => 'Debe ingresar Calle',
                'dirProvincia.required' => 'Debe ingresar la Provincia',
                'dirProvincia.not_in' => 'Debe ingresar la Provincia',
                'dirCodPostal.not_in' => 'Debe ingresar su Código Postal',
            ];
        } else if ($this->tipEnvio == 2){
            $rules = [
                'dirCalleAltura' => ['required'],
                'dirCodPostal' => ['required'],
            ];
        
            $messages = [
                'dirCalleAltura.required' => 'Debe ingresar Calle',
                'dirCodPostal.not_in' => 'Debe ingresar su Código Postal',
            ];
        }
        if ($this->tipEnvio >=1 and $this->tipEnvio <=2){
            $this->validate($rules, $messages);

            DB::table('tb_envios_pendientes')->insert([
                'guidCarrito' => $this->guidCarrito,
                'dirCalleAltura' => $this->dirCalleAltura,
                'dirProvincia' =>  $this->tipEnvio == 1 ? $this->dirProvincia : 24,
                'dirLocalidad' => $this->dirLocalidad,
                'dirBarrio' => $this->dirBarrio,
                'dirCodPostal' => $this->dirCodPostal,
                'dirEntreCalles' => $this->dirEntreCalles ?? '',
                'estado' => 0,
                'enviarPor' => $this->tipEnvio,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            //El estado 1 es pendiente de envío por correo o por moto
            $updateData = [
                'estado' => 1,
                'updated_at' => now()
            ];
    
            DB::table('tb_carrito')
                ->where('guidCarrito', $this->guidCarrito)
                ->update($updateData);
    
            $this->totalCantidad = 0;
            $this->totalPrecio   = 0;
        } else {
            //El estado 2 es pendiente de retiro por domicilio
            $updateData = [
                'estado' => 2,
                'updated_at' => now()
            ];
    
            DB::table('tb_carrito')
                ->where('guidCarrito', $this->guidCarrito)
                ->update($updateData);
    
            $this->totalCantidad = 0;
            $this->totalPrecio   = 0;
        }

        
        //eliminar-uuid
        $this->dispatch(
            'eliminar-uuid',
            uuid: $this->guidCarrito 
        );

        $this->reset([
            'tipEnvio',
            'tipPago',
            'dirCalleAltura',
            'dirProvincia',
            'dirLocalidad',
            'dirBarrio',
            'dirCodPostal',
            'dirEntreCalles'
        ]);

        $this->verForm=false;
    }

    public function mount()
    {
        $query = DB::table('tb_provincias');
        $this->tb_provincias = $query->get();
    }


    public function render()
    {
        return view('livewire.componentes.carrito');
    }
}


