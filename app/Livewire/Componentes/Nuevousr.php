<?php

namespace App\Livewire\Componentes;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivarCuentaMail;
use App\Mail\Regenerarpassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Nuevousr extends Component
{    
    public $verForm = false;
    public $verFormNuevoUsr = false;
    public $verFormRecuperarClave = false;
    public $verFormEditPerfil = false;
    public $verMsgUsr1 = false;
    public $verMsgUsr2 = false;

    public $tb_provincias = [];

    // Login
    public $txtUserName;
    public $txtUserPassword;

    // Nuevo usuario
    public $txtNomApe;
    public $txtEmail;
    public $txtUserPasswordReing;
    public $dirCalle;
    public $dirAltura;
    public $dirProvincia;
    public $dirLocalidad;
    public $dirCodPostal;

    // Mail de Recuperación de Clave
    public $txtEmailRecup;


    public function VerLogin(){
        $this->verForm = true;
    }

    public function NuevoUsuario(){
        $this->verForm = false;
        $this->verFormNuevoUsr = true;
    }

    public function EditarPerfil(){
        // Obtener el usuario logueado
        $user = Auth::user();

        if ($user) {
            $this->txtNomApe = $user->nomApe;
            $this->txtEmail = $user->email;
            
            // Obtener la dirección de envío del usuario
            $tb_direc_envios = DB::table('tb_direc_envios')
            ->where('idUser', $user->id)
             ->first();
            if ($tb_direc_envios) {
                $this->dirCalle = $tb_direc_envios->calle;
                $this->dirAltura = $tb_direc_envios->altura;
                $this->dirProvincia = $tb_direc_envios->idProvincia;
                $this->dirLocalidad = $tb_direc_envios->localidad;
                $this->dirCodPostal = $tb_direc_envios->codPostal;
            }
        }
        $this->verFormEditPerfil = true;
    }

    public function CancelarEditarPerfil(){
        $this->LimpiarCampos();
        $this->verFormEditPerfil = false;
    }

    public function GrabarEditPerfil(){

        $rules = [
            'txtNomApe' => ['required'],
            'dirCalle' => ['required'],
            'dirAltura' => ['required'],
            'dirProvincia' => ['required', 'not_in:0'],
            'dirCodPostal' => ['required'],
        ];
    
        $messages = [
            'txtNomApe.required' => 'Debe ingresar su nombre y apellido',
            'dirCalle.required' => 'Debe ingresar la calle',
            'dirAltura.required' => 'Debe ingresar altura',
            'dirProvincia.required' => 'Debe seleccionar una provincia',
            'dirProvincia.not_in' => 'Debe seleccionar una provincia válida',
            'dirCodPostal.required' => 'Debe ingresar Código Postal',
        ];
    
        // Si el usuario quiere cambiar la contraseña
        if (!empty($this->txtUserPassword)) {
            $rules['txtUserPassword'] = ['required'];
            $rules['txtUserPasswordReing'] = ['required', 'same:txtUserPassword'];
    
            $messages['txtUserPassword.required'] = 'Debe ingresar Contraseña';
            $messages['txtUserPasswordReing.required'] = 'Debe reingresar la contraseña';
            $messages['txtUserPasswordReing.same'] = 'Las contraseñas no coinciden';
        }
    
        $this->validate($rules, $messages);

        $user = Auth::user();

        // Actualizar nombre y apellido del usuario
        $updateData = [
            'nomApe' => $this->txtNomApe,
            'updated_at' => now()
        ];

        // Si ingresó contraseña, actualizar también
        if (!empty($this->txtUserPassword)) {
            $updateData['password'] = bcrypt($this->txtUserPassword);
        }

        DB::table('users')
            ->where('id', $user->id)
            ->update($updateData);

        // Verificar si existe dirección
        $direccion = DB::table('tb_direc_envios')
        ->where('idUser', $user->id)
        ->first();
        

        if ($direccion) {
            // Actualizar registro existente
            DB::table('tb_direc_envios')
                ->where('idUser', $user->id)
                ->update([
                    'calle' => $this->dirCalle,
                    'altura' => $this->dirAltura,
                    'idProvincia' => $this->dirProvincia,
                    'localidad' => $this->dirLocalidad,
                    'codPostal' => $this->dirCodPostal,
                    'updated_at' => now()
                ]);
        } else {
            // Insertar nuevo registro
            DB::table('tb_direc_envios')->insert([
                'idUser' => $user->id,
                'tipDirec' => 1,
                'calle' => $this->dirCalle,
                'altura' => $this->dirAltura,
                'idProvincia' => $this->dirProvincia,
                'localidad' => $this->dirLocalidad,
                'codPostal' => $this->dirCodPostal,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
 
        $this->LimpiarCampos();
        $this->verFormEditPerfil = false;
    }


    public function RecuperarClave(){
        $this->verForm = false;
        $this->verFormRecuperarClave = true;
    }

    public function CancelarEnlaceRecup(){
        $this->verFormRecuperarClave = false;
        $this->resetErrorBag();
        $this->reset([
            'txtEmailRecup'
        ]);
    }

    public function GenerarEnlaceRecup(){
        $this->validate([
            'txtEmailRecup' => ['required', 'email'],
        ], [
            'txtEmailRecup.required' => 'Debe ingresar un email válido',
            'txtEmailRecup.email' => 'Email no válido',
        ]);
        
        // Buscar usuario
        $user = DB::table('users')
           ->where('email', $this->txtEmailRecup)
            ->first();

        if (!$user) {
            $this->addError('error', 'El email no está registrado.');
            return;
        }   
        
        try{
            // Generar token único
            $token = Str::random(40);
            $expiresAt = Carbon::now()->addMinutes(10);        

            // Actualizar en la tabla users
            DB::table('users')
            ->where('id', $user->id)
            ->update([
                'validation_token'   => $token,
                'validation_expires' => $expiresAt,
                'estado'             => 0,
                'updated_at'         => now(),
            ]);

            //disparar mail para validar cuenta
            $url = url('recuperar-cta/' . $token);
            //Log::info($url);
            Mail::to($this->txtEmailRecup)->send(new Regenerarpassword($url));            

            $this->resetErrorBag();
            $this->reset([
                'txtEmailRecup'
            ]);
            $this->verMsgUsr2=true;

        } catch (\Exception $e) {
            session()->flash('error', 'Ocurrió un error: ' . $e->getMessage());
            Log::info($e->getMessage());
        }

        $this->verFormRecuperarClave = false;
    }

    public function CancelarNuevoUsuario(){
        $this->LimpiarCampos();
        $this->verFormNuevoUsr = false;
    }

    public function GrabarNuevoUsuario(){
        $this->validate([
            'txtNomApe' => ['required'],
            'txtEmail' => ['required', 'email', 'unique:users,email'],
            'txtUserPassword' => ['required'],
            'txtUserPasswordReing' => ['required', 'same:txtUserPassword'],
            'dirCalle' => ['required'],
            'dirAltura' => ['required'],
            'dirProvincia' => ['required', 'not_in:0'],
            'dirCodPostal' => ['required'],
        ], [
            'txtNomApe.required' => 'Debe ingresar su nombre y apellido',            
            'txtEmail.required' => 'Debe ingresar un email válido',
            'txtEmail.email' => 'Email no válido',
            'txtEmail.unique' => 'El email ya está registrado',
            'txtUserPassword.required' => 'Debe ingresar Contraseña',
            'txtUserPasswordReing.required' => 'Debe reingresar la contraseña',
            'txtUserPasswordReing.same' => 'Las contraseñas no coinciden',
            'dirCalle.required' => 'Debe ingresar la calle',
            'dirAltura.required' => 'Debe ingresar altura',
            'dirProvincia.required' => 'Debe seleccionar una provincia',
            'dirProvincia.not_in' => 'Debe seleccionar una provincia válida',            
            'dirCodPostal.required' => 'Debe ingresar Código Postal',
        ]);

        
        DB::beginTransaction();
        //Generar token único
        $activationToken = Str::random(64);
        

        try {
            $idUser = DB::table('users')->insertGetId([
                'name' => $this->txtNomApe,
                'nomApe' => $this->txtNomApe,
                'email' => $this->txtEmail,
                'password' => Hash::make($this->txtUserPassword),
                'estado' => 0, //cuenta inactiva
                'activation_token' => $activationToken,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('tb_direc_envios')->insert([
                'idUser' => $idUser,
                'tipDirec' => 1, // 1: Dirección principal
                'calle' => $this->dirCalle,
                'altura' => $this->dirAltura,
                'localidad' => $this->dirLocalidad ?? '',
                'idProvincia' => $this->dirProvincia,
                'codPostal' => $this->dirCodPostal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            //disparar mail para validar cuenta
            $url = url('activar-cta/' . $activationToken);
            Mail::to($this->txtEmail)->send(new ActivarCuentaMail($this->txtNomApe, $url));            

            DB::commit();
            $this->LimpiarCampos();
            $this->verMsgUsr1 = true;
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Ocurrió un error: ' . $e->getMessage());
            Log::info($e->getMessage());
        }

        $this->verFormNuevoUsr = false;
    }

    public function CerrarMsg1(){
        $this->verMsgUsr1 = false;
    }

    public function CerrarMsg2(){
        $this->verMsgUsr2 = false;
    }

    private function LimpiarCampos(){
        $this->reset(
            [
                'txtNomApe',
                'txtEmail',
                'txtUserPassword',
                'txtUserPasswordReing',
                'dirCalle',
                'dirAltura',
                'dirProvincia',
                'dirLocalidad',
                'dirCodPostal',
            ]);
        $this->resetErrorBag();
    }

    public function CancelarLogin(){
        $this->verForm = false;
    }

    public function Login(){
        $this->validate([
            'txtUserName' => ['required', 'email'],
            'txtUserPassword' => ['required'],
        ], [
            'txtUserName.required' => 'Debe ingresar Email',
            'txtUserName.email' => 'Email no válido',
            'txtUserPassword.required' => 'Debe ingresar Contraseña',
        ]);
        
        $credentials = [
            'email' => $this->txtUserName,
            'password' => $this->txtUserPassword,
        ];
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // obtenemos el usuario autenticado

            // Verificamos si la cuenta está activa
            if ($user->estado != 1 || !empty($user->activate_token)) {
                Auth::logout(); // cerramos sesión si está autenticado
                throw ValidationException::withMessages([
                    'credNoValidas' => 'La cuenta aún no ha sido activada.'
                ]);
            }            

            $this->verForm = false;
            $this->txtUserName = '';
            $this->txtUserPassword = '';

        } else {
            throw ValidationException::withMessages([
                'credNoValidas' => 'Las credenciales ingresadas son incorrectas. Acceso Denegado'
            ]);
        }

    }

    public function CerrarSesion(){
        Auth::logout();
    }


    public function mount()
    {
        $query = DB::table('tb_provincias');
        $this->tb_provincias = $query->get();
    }


    public function render()
    {
        return view('livewire.componentes.nuevousr', ['tb_provincias' => $this->tb_provincias]);
    }
}
