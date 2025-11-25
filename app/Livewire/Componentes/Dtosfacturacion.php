<?php

namespace App\Livewire\Componentes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Exceptions\MPApiException;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmarVenta;

class Dtosfacturacion extends Component
{
    public $pjeDescTransfer = 25;
    public $tipPago = false;
    public $tb_provincias = [];
    public $carrito = [];
    public $nroVenta = 0;
    public $guidCarrito = '';
    public $totalPrecio = 0;
    public $totalFinal = 0;
    public $totDescuTransfer = 0;
    public $dtosFacNombre = '';
    public $dtosFacApellido = '';
    public $dtosFacDireccion='';
    public $dtosFacProvincia=0;
    public $dtosFacLocCiudad='';
    public $dtosFacCodPostal='';
    public $dtosFacTelefono = '';
    public $dtosFacCorreoE = '';

    public $dtosAltNombre = '';
    public $dtosAltApellido = '';
    public $dtosAltDireccion = '';
    public $dtosAltProvincia = 0;
    public $dtosAltLocCiudad = '';
    public $dtosAltCodPostal = '';
    public $dtosFacNotas = '';
    public $tipEnvio=0;
    public $totEnvioDom = 0;
    public $msgError = '';
  
    public $usarDireccionAlternativa = false;
    
    public function updatedDtosFacProvincia(){
        $this->msgError = '';
        if ($this->tipEnvio == 1){
            $costoEnvio = DB::table('tb_provincias')
            ->select('impoEnvio')
            ->where('id', $this->dtosFacProvincia)
            ->first();
            $this->totEnvioDom = $costoEnvio->impoEnvio ?? 0;
        } else if ($this->tipEnvio == 2){
            $this->totEnvioDom = 10000;
        } else if ($this->tipEnvio == 3){
            $this->totEnvioDom = 0;
        }
        $this->totalFinal = $this->totalPrecio+$this->totEnvioDom;
    }

    public function updatedDtosAltProvincia(){
        $this->msgError = '';
        if ($this->tipEnvio == 1){
            $costoEnvio = DB::table('tb_provincias')
            ->select('impoEnvio')
            ->where('id', $this->dtosAltProvincia)
            ->first();
            $this->totEnvioDom = $costoEnvio->impoEnvio ?? 0;
        } else if ($this->tipEnvio == 2){
            $this->totEnvioDom = 10000;
        } else if ($this->tipEnvio == 3){
            $this->totEnvioDom = 0;
        }
        $this->totalFinal = $this->totalPrecio+$this->totEnvioDom;
    }

    public function updatedTipPago(){
        if ($this->tipPago){
            $this->totDescuTransfer = ($this->totalPrecio * $this->pjeDescTransfer) / 100;
        } else {
            $this->totDescuTransfer = 0;
        }
    }

    public function updatedTipEnvio(){
        $this->msgError = '';
        if ($this->tipEnvio == 1){
            if ($this->usarDireccionAlternativa){
                $costoEnvio = DB::table('tb_provincias')
                ->select('impoEnvio')
                ->where('id', $this->dtosAltProvincia)
                ->first();
                $this->totEnvioDom = $costoEnvio->impoEnvio ?? 0;
            } else{
                $costoEnvio = DB::table('tb_provincias')
                ->select('impoEnvio')
                ->where('id', $this->dtosFacProvincia)
                ->first();
                $this->totEnvioDom = $costoEnvio->impoEnvio ?? 0;
            }
        } else if ($this->tipEnvio == 2){
            $this->totEnvioDom = 10000;
            if ($this->usarDireccionAlternativa){
                $this->dtosAltProvincia = 24;
            }else{
                $this->dtosFacProvincia = 24;
            }
        } else if ($this->tipEnvio == 3){
            $this->totEnvioDom = 0;
            $this->reset([
                'dtosAltNombre',
                'dtosAltApellido',
                'dtosAltDireccion',
                'dtosAltProvincia',
                'dtosAltLocCiudad',
                'dtosAltCodPostal',]);
            $this->usarDireccionAlternativa=false;
        }
        $this->totalFinal = $this->totalPrecio+$this->totEnvioDom;

        if ($this->tipEnvio < 3 && $this->totEnvioDom == 0){
            $this->msgError = '¡Debe seleccionar una provincia!';
        }         
    }
    
    public function mount()
    {
        $this->tb_provincias = DB::table('tb_provincias')->get();
        if (session()->has('datos_fac')) {
            $datos = session('datos_fac');
            $this->dtosFacDireccion = $datos['dirCalleAltura'];
            $this->dtosFacProvincia = $datos['dirProvincia'];
            $this->dtosFacLocCiudad = $datos['dirLocalidad'];
            $this->dtosFacCodPostal = $datos['dirCodPostal'];
            $this->totalPrecio = $datos['totalPrecio'];
            $this->carrito = $datos['carrito'];
            $this->totalFinal= $this->totalPrecio;
            $this->guidCarrito = $this->carrito[0]->guidCarrito;
            $this->tipEnvio = $datos['tipEnvio'];
        }
    }

    //Pago por Mercado Pago
    public function IniciarPago2(){

        $this->ValidarCampos();
        $this->GrabarPedido();

        Mail::to($this->dtosFacCorreoE)->send(new ConfirmarVenta($this->dtosFacNombre, $this->carrito, $this->nroVenta));

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

    private function GrabarPedido(){
        // Generar un número de venta único
        do {
            $this->nroVenta = random_int(10000000, 99999999);
        } while (DB::table('tb_ventas')->where('nroVenta', $this->nroVenta)->exists());

        DB::table('tb_ventas')->insert([
            'guidCarrito'       => $this->guidCarrito,
            'nroVenta'          => $this->nroVenta,
            'estado'            => 1, //1: Pedido Ingresado, 2: Pedido Enviado: 3: Pedido Pausado
            'fecVenta'          => now(),
            'fecEnvio'          => null,
            'linkSeguimiento'   => '',
            'enviarADirAlt'     => $this->usarDireccionAlternativa == true ? 1 : 2,
            'dtosFacNombre'     => $this->dtosFacNombre,
            'dtosFacApellido'   => $this->dtosFacApellido,
            'dtosFacDireccion'  => $this->dtosFacDireccion,
            'dtosFacProvincia'  => $this->dtosFacProvincia,
            'dtosFacLocCiudad'  => $this->dtosFacLocCiudad,
            'dtosFacCodPostal'  => $this->dtosFacCodPostal,
            'dtosFacTelefono'   => $this->dtosFacTelefono,
            'dtosFacCorreoE'    => $this->dtosFacCorreoE,
            'dtosAltNombre'     => $this->dtosAltNombre,
            'dtosAltApellido'   => $this->dtosAltApellido,
            'dtosAltDireccion'  => $this->dtosAltDireccion,
            'dtosAltProvincia'  => $this->dtosAltProvincia,
            'dtosAltLocCiudad'  => $this->dtosAltLocCiudad,
            'dtosAltCodPostal'  => $this->dtosAltCodPostal,
            'dtosFacNotas'      => $this->dtosFacNotas,
            'totalEnvio'        => $this->totEnvioDom,
            'totalPedido'       => $this->totalFinal - $this->totDescuTransfer,
            'totalDescTransfer' => $this->totDescuTransfer,
            'formaDePago'       => $this->tipPago == true ? 1 : 2, //1: Transferencia, 2:Mercado Pago
            'enviarPor'         => $this->tipEnvio,
            'created_at'        => now(),
            'updated_at'        => now()
        ]);

        //El estado 1 es pendiente de envío por correo o por moto
        $updateData = [
            'estado' => 1,
            'updated_at' => now()
        ];
    
        DB::table('tb_carrito')
            ->where('guidCarrito', $this->guidCarrito)
            ->update($updateData);

        //eliminar-uuid
        $this->dispatch(
            'eliminar-uuid',
            uuid: $this->guidCarrito 
        );

        return redirect('/');        

    }
    private function ValidarCampos(){

        $rules = [
            'tipEnvio'          => ['required', 'not_in:0'],
            'dtosFacNombre'     => ['required'],
            'dtosFacApellido'   => ['required'],
            'dtosFacDireccion'  => ['required'],
            'dtosFacProvincia'  => ['required', 'not_in:0'],
            'dtosFacCodPostal'  => ['required'],
            'dtosFacCorreoE'    => ['required', 'email'],
        ];
    
        $messages = [
            'tipEnvio.required' => 'Debe seleccionar un método de Envío',
            'tipEnvio.not_in' => 'Debe seleccionar un método de Envío',
            'dtosFacNombre.required' => 'Debe ingresar Nombre',
            'dtosFacApellido.required' => 'Debe ingresar Apellido',
            'dtosFacDireccion.required' => 'Debe ingresar Dirección',
            'dtosFacProvincia.required' => 'Debe seleccionar una Provincia',
            'dtosFacProvincia.not_in' => 'Debe seleccionar una Provincia',
            'dtosFacCodPostal.required' => 'Debe ingresar Código Postal',
            'dtosFacCorreoE.required' => 'Debe ingresar Correo Electrónico',
            'dtosFacCorreoE.email' => 'El Correo Electrónico ingresado es incorrecto',
        ];

        if ($this->usarDireccionAlternativa) {
            $rules = array_merge($rules, [
                'dtosAltNombre'     => ['required'],
                'dtosAltApellido'   => ['required'],
                'dtosAltDireccion'  => ['required'],
                'dtosAltProvincia'  => ['required', 'not_in:0'],
                'dtosAltCodPostal'  => ['required'],
            ]);

            $messages = array_merge($messages, [
                'dtosAltNombre.required'    => 'Debe ingresar Nombre (Dirección alternativa)',
                'dtosAltApellido.required'  => 'Debe ingresar Apellido (Dirección alternativa)',
                'dtosAltDireccion.required' => 'Debe ingresar Dirección (Dirección alternativa)',
                'dtosAltProvincia.required' => 'Debe seleccionar una Provincia (Dirección alternativa)',
                'dtosAltProvincia.not_in'   => 'Debe seleccionar una Provincia (Dirección alternativa)',
                'dtosAltCodPostal.required' => 'Debe ingresar Código Postal (Dirección alternativa)',
            ]);
        }

        $this->validate($rules, $messages);        

    }

    //Pago por Trnasferencias
    public function Aceptar(){
        $this->ValidarCampos();
        $this->GrabarPedido();

        Mail::to($this->dtosFacCorreoE)->send(new ConfirmarVenta($this->dtosFacNombre, $this->carrito, $this->nroVenta));
        
    }


    public function render()
    {
        return view('livewire.componentes.dtosfacturacion');
    }
}
