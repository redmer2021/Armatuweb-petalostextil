<?php

namespace App\Livewire\Componentes;

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
    public $totEnvioDom = 9350;
    public $totEnvioPto = 7250;
    public $totalFinal = 0;
    public $totalConDesc= 0;
    public $pjeDescTransfer = 25;
    public $verForm = false;
    public $carrito = [];
    public $guidCarrito;
    public $tipEnvio = 0;

    #[On('cerrar-carrito')]
    public function CerrarForm(){
        $this->verForm=false;
    }

    public function VerCarrito(){
        $this->carrito = DB::table('vta_carrito')
        ->where('guidCarrito', $this->guidCarrito)
        ->get();        
        $this->verForm = true;
    }

    #[On('recargar-carrito')] 
    public function RecargarCarrito(){
        $this->carrito = DB::table('vta_carrito')
        ->where('guidCarrito', $this->guidCarrito)
        ->get();        
    }

    #[On('recalcular')] 
    public function setUuid($uuid)
    {
        $this->guidCarrito = $uuid;
        $carrito = DB::table('tb_carrito')
        ->selectRaw('SUM(cantidad) as total_cantidad, SUM(cantidad * precioUnit) as total_precio')
        ->where('guidCarrito', $uuid)
        ->first();

        // Guardar resultados en propiedades (si queres usarlos en la vista)
        $this->totalCantidad = $carrito->total_cantidad ?? 0;
        $this->totalPrecio   = $carrito->total_precio ?? 0;

        $this->recalcularTotal();

    }

    public function updatedTipEnvio($value)
    {
        $this->recalcularTotal();
    }
    
    private function recalcularTotal()
    {
        if ($this->tipEnvio == 1) {
            $this->totalFinal = $this->totalPrecio + $this->totEnvioDom;
        } elseif ($this->tipEnvio == 2) {
            $this->totalFinal = $this->totalPrecio + $this->totEnvioPto;
        } else {
            $this->totalFinal = $this->totalPrecio;
        }

        // aplicar descuento sobre totalFinal
        $this->totalConDesc = $this->totalFinal - ($this->totalFinal * $this->pjeDescTransfer / 100);        

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


    public function render()
    {
        return view('livewire.componentes.carrito');
    }
}


