<div>
    <div>
        <div class="flex flex-col items-center cursor-pointer">
            @if(Auth::check())
            <!-- Usuario logueado -->
                <img src="{{ asset('imgs/userNuevo.png') }}" alt="Nuevo Usuario" class="h-[1.5rem] md:h-[1.5rem] w-auto">
                <span class="text-[10px] md:text-xs">{{ Auth::user()->nomApe }}</span>
                <span wire:click="CerrarSesion()" class="text-[10px] md:text-xs">Cerrar Sesión</span>
            @else
                <!-- Usuario no logueado -->
                <div wire:click="VerLogin()" class="flex flex-col items-center cursor-pointer">
                    <img  src="{{ asset('imgs/userNuevo.png') }}" alt="Nuevo Usuario" class="h-[1.5rem] md:h-[1.5rem] w-auto">
                    <span class="text-[10px] md:text-xs">Entrá</span>
                    <span class="text-[10px] md:text-xs">Registrate</span>
                </div>
            @endif
        </div>
    
        <!-- Formulario para Inicio de Sesión -->
        <section 
            class="ventanaModal" 
            x-cloak 
            x-show="$wire.verForm" 
            x-transition.duration.0ms
            x-effect="document.body.classList.toggle('overflow-hidden', $wire.verForm)"
        >
            <div class="ventanaInterna_3">
                <span class="block text-center text-3xl md:text-4xl font-bold" >Iniciar Sesión</span>
                <div class="mt-[2rem]">
                    <label for="txtUserName">Email</label>
                    <input id="txtUserName" wire:model="txtUserName" type="text" class="block w-full px-2 py-2 text-md border-[1px] border-gray-400 focus:outline-none focus:ring-0" placeholder="Ingresa su email...">
                </div>
                <div class="mt-[1rem]">
                    <label for="txtUserPassword">Contraseña</label>
                    <input id="txtUserPassword" wire:model="txtUserPassword" type="password" class="block w-full px-2 py-2 text-md border-[1px] border-gray-400 focus:outline-none focus:ring-0" placeholder="Ingresa tu Contraseña...">
                    <div class="my-4 flex justify-end">
                        <button wire:click.stop="RecuperarClave()" class="cursor-pointer text-xs underline">¿Olvidaste tu contraseña?</button>
                    </div>
                </div>
                <div class="flex justify-center space-x-3">
                    <button wire:click.stop="CancelarLogin()" class="bg-black px-4 py-2 rounded-md cursor-pointer text-white ">Cancelar</button>
                    <button wire:click.stop="Login()" class="bg-black px-4 py-2 rounded-md cursor-pointer text-white ">Iniciar Sesión</button>
                </div>
                <div class="my-4 flex justify-end">
                    <button wire:click.stop="NuevoUsuario()" class="text-xs underline cursor-pointer">¿No tenes una cuenta aún? Crear una desde acá</button>
                </div>

                <!-- Mostrar un solo mensaje de error -->
                @if ($errors->any())
                    <p class="mt-2 text-sm text-red-600 font-medium">
                        {{ $errors->first() }}
                    </p>
                @endif

            </div>
        </section>


        <!-- Formulario para Alta de nuevos usuarios -->
        <section 
            class="ventanaModal" 
            x-cloak 
            x-show="$wire.verFormNuevoUsr" 
            x-transition.duration.0ms
            x-effect="document.body.classList.toggle('overflow-hidden', $wire.verFormNuevoUsr)"
        >
            <div class="ventanaInterna_4">
                <span class="block text-3xl text-center md:text-4xl font-bold" >Nuevo Usuario</span>
                <div class="grid md:grid-cols-2 gap-3 mt-[1rem]">
                    <div>
                        <label class="text-xs" for="txtNomApe">Nombre y Apellido</label>
                        <input id="txtNomApe" wire:model="txtNomApe" type="text" class="block w-full px-2 py-2 text-md border-[1px] @error('txtNomApe') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Tu nombre y apellido...">
                    </div>
                    <div>
                        <label class="text-xs" for="txtEmail">Email</label>
                        <input id="txtEmail" wire:model="txtEmail" type="text" class="block w-full px-2 py-2 text-md border-[1px] @error('txtEmail') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Ingresa tu Email">
                        @error('txtEmail')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>                        
                        @enderror
                    </div>

                    <div>
                        <label class="text-xs" for="txtUserPassword">Contraseña</label>
                        <input id="txtUserPassword" wire:model="txtUserPassword" type="password" class="block w-full px-2 py-2 text-md border-[1px] @error('txtUserPassword') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Ingresa una password...">
                    </div>
                    <div>
                        <label class="text-xs" for="txtUserPasswordReing">Reingresa la contraseña</label>
                        <input id="txtUserPasswordReing" wire:model="txtUserPasswordReing" type="password" class="block w-full px-2 py-2 text-md border-[1px] @error('txtUserPasswordReing') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Reingresa la password...">
                        @error('txtUserPasswordReing')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>                        
                        @enderror
                    </div>

                </div>

                <div class="mt-[1rem]">
                    <span class="text-xs font-bold">Dirección principal para recibir tus compras</span>
                    <div class="grid grid-cols-12 gap-3">
                        <div class="col-span-9">
                            <label class="text-xs" for="dirCalle">Calle</label>
                            <input id="dirCalle" wire:model="dirCalle" type="text" class="block w-full px-2 py-2 text-md border-[1px] @error('dirCalle') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Calle...">
                        </div>
                        <div class="col-span-3">
                            <label class="text-xs" for="dirAltura">Altura</label>
                            <input id="dirAltura" wire:model="dirAltura" type="text" class="block w-full px-2 py-2 text-md border-[1px] @error('dirAltura') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="altura...">
                        </div>

                        <div class="col-span-12 md:col-span-5">
                            <label class="text-xs" for="dirProvincia">Provincia</label>
                            <select wire:model="dirProvincia" class="text-md py-2 w-full border-[1px] @error('dirProvincia') border-red-500 @else border-gray-400 @enderror " name="dirProvincia" id="dirProvincia">
                                <option value="0">Seleccionar Provincia...</option>
                                @foreach ($tb_provincias as $provincia)
                                    <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>                                    
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-8 md:col-span-5">
                            <label class="text-xs" for="dirLocalidad">Localidad</label>
                            <input id="dirLocalidad" wire:model="dirLocalidad" type="text" class="block w-full px-2 py-2 text-md border-[1px] border-gray-400 focus:outline-none focus:ring-0" placeholder="Localidad...">
                        </div>
                        <div class="col-span-4 md:col-span-2">
                            <label class="text-xs" for="dirCodPostal">Código Postal</label>
                            <input id="dirCodPostal" wire:model="dirCodPostal" type="text" class="block w-full px-2 py-2 text-md border-[1px] @error('dirCodPostal') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Cod. Postal...">
                        </div>
                    </div>

                    <div class="mt-[2rem] flex justify-end space-x-2">
                        <button wire:click.stop="CancelarNuevoUsuario()" class="bg-black px-4 py-2 rounded-md cursor-pointer text-white ">Cancelar</button>
                        <button wire:click.stop="GrabarNuevoUsuario()" class="bg-black px-4 py-2 rounded-md cursor-pointer text-white ">Generar Nuevo Usuario</button>
                    </div>
    
                </div>

                <!-- Mostrar un solo mensaje de error -->
                @if ($errors->any())
                    <p class="mt-2 text-sm text-red-600 font-medium">
                        Debe completar todos los campos
                    </p>
                @endif
            </div>
        </section>

        <!-- Formulario para Recuperar clave de acceso -->
        <section 
            class="ventanaModal" 
            x-cloak 
            x-show="$wire.verFormRecuperarClave" 
            x-transition.duration.0ms
            x-effect="document.body.classList.toggle('overflow-hidden', $wire.verFormRecuperarClave)"
        >
            <div class="ventanaInterna_3">
                <span class="block text-center text-3xl md:text-4xl font-bold" >Recuperar Contraseña</span>
                <div class="mt-[1rem]">
                    <label class="text-xs" for="txtEmailRecup">Email</label>
                    <input id="txtEmailRecup" wire:model="txtEmailRecup" type="text" class="block mb-4 w-full px-2 py-2 text-md border-[1px] @error('txtEmailRecup') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Ingresa tu Email">
                    @error('txtEmailRecup')
                        <p class="text-red-500 text-xs mt-[1rem] mb-[1rem]">{{ $message }}</p>                        
                    @enderror
                    <div class="flex justify-center space-x-3">
                        <button wire:click.stop="CancelarEnlaceRecup()" class="bg-black px-4 py-2 rounded-md cursor-pointer text-white ">Cancelar</button>
                        <button wire:click.stop="GenerarEnlaceRecup()" class="bg-black px-4 py-2 rounded-md cursor-pointer text-white ">Recuperar Contraseña</button>
                    </div>
                </div>
                
                @if ($errors->has('error'))
                    <div class="bg-red-200 text-red-700 p-2 rounded mt-3">
                        {{ $errors->first('error') }}
                    </div>
                @endif
                
            </div>
        </section>


        <!-- Mensaje Nueva cuenta creada -->
        <section 
            class="ventanaModal" 
            x-cloak 
            x-show="$wire.verMsgUsr1" 
            x-transition.duration.0ms
            x-effect="document.body.classList.toggle('overflow-hidden', $wire.verMsgUsr1)"
        >
            <div class="ventanaInterna_5">
                <span class="mb-3 text-3xl font-bold block text-center" >Nueva cuenta creada exitosamente!!</span>
                <p class="mb-[1rem]">Se ha enviado un Email a la cuenta: {{ $txtEmailRecup }}</p>
                <p class="mb-[1rem]">Por favor, revisa tu Email y confirma la activación de esta cuenta</p>
                <div class="flex justify-end">
                    <button wire:click.stop="CerrarMsg1()" class="bg-black px-4 py-2 rounded-md cursor-pointer text-white ">Cerrar</button>
                </div>
            </div>

        </section>

        <!-- Mensaje de Recuperación de Password -->
        <section 
            class="ventanaModal" 
            x-cloak 
            x-show="$wire.verMsgUsr2" 
            x-transition.duration.0ms
            x-effect="document.body.classList.toggle('overflow-hidden', $wire.verMsgUsr2)"
        >
            <div class="ventanaInterna_5">
                <span class="mb-3 text-3xl font-bold block text-center" >Enlace de recuperación de Contraseña!!</span>
                <p class="mb-[1rem]">Se ha enviado un Email a la cuenta: {{ $txtEmailRecup }}</p>
                <p class="mb-[1rem]">Por favor, revisa tu Email y sigue las instrucciones para recuperar tu Contraseña</p>
                <div class="flex justify-end">
                    <button wire:click.stop="CerrarMsg2()" class="bg-black px-4 py-2 rounded-md cursor-pointer text-white ">Cerrar</button>
                </div>
            </div>

        </section>

    </div>
</div>
