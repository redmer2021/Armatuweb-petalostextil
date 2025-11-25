<div>
    <div>
        <div class="flex items-center cursor-pointer">
            @if(Auth::check())
                <!-- Usuario logueado -->
                <img wire:click="VerCerrarSesion()" src="{{ asset('imgs/img_sistema/userNuevo.svg') }}" alt="Nuevo Usuario" class="h-[1.5rem] md:h-[1.5rem] w-auto">
                <div class="flex flex-col ml-2">
                    <span wire:click="EditarPerfil()" class="hover:underline md:text-[16px] hidden md:flex font-bold">{{ Auth::user()->nomApe }}</span>
                    <span wire:click="CerrarSesion()" class="hover:underline md:text-[16px] hidden md:flex">Cerrar Sesión</span>
                </div>

            @else
                <!-- Usuario no logueado -->
                <div wire:click="VerLogin()" class="hover:underline flex cursor-pointer">
                    <img  src="{{ asset('imgs/img_sistema/userNuevo.svg') }}" alt="Nuevo Usuario" class="h-[2rem] w-auto">
                    <div class="flex flex-col ml-2">
                        <span class="text-[#1F1F1F] hidden md:block font-bold text-[14px] md:text-[16px]">Iniciar Sesión</span>
                        <span class="text-[#1F1F1F] hidden md:block text-[14px] md:text-[16px]">Registrate</span>
                    </div>
                </div>
            @endif
        </div>

        
        <!-- Formulario para Cierre de Sesión - Edición de Perfil -->
        <section 
            class="ventanaModal" 
            x-cloak 
            x-show="$wire.verFormCierre" 
            x-transition.duration.0ms
            x-effect="document.body.classList.toggle('overflow-hidden', $wire.verFormCierre)"
        >
            <div class="ventanaInterna_3">
                @if(Auth::check())
                    <span class="block text-center text-3xl md:text-4xl font-bold mb-[2rem]" >{{ Auth::user()->nomApe }}</span>
                @endif
                <button wire:click="CerrarSesion()" class="bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200 py-2 text-white cursor-pointer w-full mb-[2rem]">Cerrar Sesión</button>
                <button wire:click="EditarPerfil()" class="bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200 py-2 text-white px-4  cursor-pointer w-full mb-[2rem]">Editar Perfil</button>
            </div>
        </section>


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
                    <label for="txtUserPassword1">Contraseña</label>
                    <input id="txtUserPassword1" wire:model="txtUserPassword" type="password" class="block w-full px-2 py-2 text-md border-[1px] border-gray-400 focus:outline-none focus:ring-0" placeholder="Ingresa tu Contraseña...">
                    <div class="my-4 flex justify-end">
                        <button wire:click.stop="RecuperarClave()" class="cursor-pointer text-xs underline">¿Olvidaste tu contraseña?</button>
                    </div>
                </div>
                <div class="flex justify-center space-x-3">
                    <button wire:click.stop="CancelarLogin()" class="bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200 px-4 py-2 cursor-pointer text-white ">Cancelar</button>
                    <button wire:click.stop="Login()" class="bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200 px-4 cursor-pointer text-white ">Iniciar Sesión</button>
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
                        <label class="text-xs" for="txtNomApe1">Nombre y Apellido</label>
                        <input id="txtNomApe1" wire:model="txtNomApe" type="text" class="block w-full px-2 py-2 text-md border-[1px] @error('txtNomApe') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Tu nombre y apellido...">
                    </div>
                    <div>
                        <label class="text-xs" for="txtEmail1">Email</label>
                        <input id="txtEmail1" wire:model="txtEmail" type="text" class="block w-full px-2 py-2 text-md border-[1px] @error('txtEmail') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Ingresa tu Email">
                        @error('txtEmail')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>                        
                        @enderror
                    </div>

                    <div>
                        <label class="text-xs" for="txtUserPassword2">Contraseña</label>
                        <input id="txtUserPassword2" wire:model="txtUserPassword" type="password" class="block w-full px-2 py-2 text-md border-[1px] @error('txtUserPassword') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Ingresa una password...">
                    </div>
                    <div>
                        <label class="text-xs" for="txtUserPasswordReing1">Reingresa la contraseña</label>
                        <input id="txtUserPasswordReing1" wire:model="txtUserPasswordReing" type="password" class="block w-full px-2 py-2 text-md border-[1px] @error('txtUserPasswordReing') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Reingresa la password...">
                        @error('txtUserPasswordReing')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>                        
                        @enderror
                    </div>

                </div>

                <div class="mt-[1rem]">
                    <span class="text-xs font-bold">Dirección principal para recibir tus compras</span>
                    <div class="grid grid-cols-12 gap-3">
                        <div class="col-span-12">
                            <label class="text-xs" for="direccion1">Dirección</label>
                            <input id="direccion1" wire:model="direccion" type="text" class="block w-full px-2 py-2 text-md border-[1px] @error('direccion') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Calle y altura...">
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
                        <div class="col-span-8 md:col-span-7">
                            <label class="text-xs" for="dirLocalidad1">Localidad</label>
                            <input id="dirLocalidad1" wire:model="dirLocalidad" type="text" class="block w-full px-2 py-2 text-md border-[1px] border-gray-400 focus:outline-none focus:ring-0" placeholder="Localidad...">
                        </div>
                        <div class="col-span-8 md:col-span-8">
                            <label class="text-xs" for="dirBarrio1">Barrio</label>
                            <input id="dirBarrio1" wire:model="dirBarrio" type="text" class="block w-full px-2 py-2 text-md border-[1px] border-gray-400 focus:outline-none focus:ring-0" placeholder="Localidad...">
                        </div>
                        <div class="col-span-4 md:col-span-4">
                            <label class="text-xs" for="dirCodPostal1">Código Postal</label>
                            <input id="dirCodPostal1" wire:model="dirCodPostal" type="text" class="block w-full px-2 py-2 text-md border-[1px] @error('dirCodPostal') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Cod. Postal...">
                        </div>
                    </div>

                    <div class="mt-[2rem] flex justify-end space-x-2">
                        <button wire:click.stop="CancelarNuevoUsuario()" class="bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200  px-4 py-2 cursor-pointer text-white">Cancelar</button>
                        <button wire:click.stop="GrabarNuevoUsuario()" class="bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200  px-4 py-2 cursor-pointer text-white">Generar Nuevo Usuario</button>
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

        <!-- Formulario para Editar Perfil de Usuario -->
        <section 
            class="ventanaModal" 
            x-cloak 
            x-show="$wire.verFormEditPerfil" 
            x-transition.duration.0ms
            x-effect="document.body.classList.toggle('overflow-hidden', $wire.verFormEditPerfil)"
        >
            <div class="ventanaInterna_4">
                <span class="block text-3xl text-center md:text-4xl font-bold" >Editando Perfil</span>
                <div class="grid md:grid-cols-2 gap-3 mt-[1rem]">
                    <div>
                        <label class="text-xs" for="txtNomApe2">Nombre y Apellido</label>
                        <input id="txtNomApe2" wire:model="txtNomApe" type="text" class="block w-full px-2 py-2 text-md border-[1px] @error('txtNomApe') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Tu nombre y apellido...">
                    </div>
                    <div>
                        <label class="text-xs" for="txtEmail2">Email</label>
                        <input id="txtEmail2" wire:model="txtEmail" type="text" class="block w-full px-2 py-2 text-md border-[1px]  border-gray-400 focus:outline-none focus:ring-0" readonly>
                    </div>

                    <div>
                        <label class="text-xs" for="txtUserPassword3">Contraseña</label>
                        <input id="txtUserPassword3" wire:model="txtUserPassword" type="password" class="block w-full px-2 py-2 text-md border-[1px] @error('txtUserPassword') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Ingresa una password...">
                    </div>
                    <div>
                        <label class="text-xs" for="txtUserPasswordReing2">Reingresa la contraseña</label>
                        <input id="txtUserPasswordReing2" wire:model="txtUserPasswordReing" type="password" class="block w-full px-2 py-2 text-md border-[1px] @error('txtUserPasswordReing') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Reingresa la password...">
                        @error('txtUserPasswordReing')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>                        
                        @enderror
                    </div>

                </div>

                <div class="mt-[1rem]">
                    <span class="text-xs font-bold">Dirección principal para recibir tus compras</span>
                    <div class="grid grid-cols-12 gap-3">
                        <div class="col-span-12">
                            <label class="text-xs" for="direccion2">Dirección</label>
                            <input id="direccion2" wire:model="direccion" type="text" class="block w-full px-2 py-2 text-md border-[1px] @error('direccion') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Calle y altura...">
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
                        <div class="col-span-8 md:col-span-7">
                            <label class="text-xs" for="dirLocalidad2">Localidad</label>
                            <input id="dirLocalidad2" wire:model="dirLocalidad" type="text" class="block w-full px-2 py-2 text-md border-[1px] border-gray-400 focus:outline-none focus:ring-0" placeholder="Localidad...">
                        </div>
                        <div class="col-span-8 md:col-span-8">
                            <label class="text-xs" for="dirBarrio2">Barrio</label>
                            <input id="dirBarrio2" wire:model="dirBarrio" type="text" class="block w-full px-2 py-2 text-md border-[1px] border-gray-400 focus:outline-none focus:ring-0" placeholder="Barrio...">
                        </div>
                        <div class="col-span-4 md:col-span-4">
                            <label class="text-xs" for="dirCodPostal2">Código Postal</label>
                            <input id="dirCodPostal2" wire:model="dirCodPostal" type="text" class="block w-full px-2 py-2 text-md border-[1px] @error('dirCodPostal') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Cod. Postal...">
                        </div>
                    </div>

                    <div class="mt-[2rem] flex justify-end space-x-2">
                        <button wire:click.stop="CancelarEditarPerfil()" class="bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200  px-4 py-2 cursor-pointer text-white">Cancelar</button>
                        <button wire:click.stop="GrabarEditPerfil()" class="bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200  px-4 py-2 cursor-pointer text-white">Grabar Datos</button>
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
                        <button wire:click.stop="CancelarEnlaceRecup()" class="bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200  px-4 py-2 cursor-pointer text-white">Cancelar</button>
                        <button wire:click.stop="GenerarEnlaceRecup()" class="bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200  px-4 py-2 cursor-pointer text-white">Recuperar Contraseña</button>
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
                    <button wire:click.stop="CerrarMsg1()" class="bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200  px-4 py-2 cursor-pointer text-white">Cerrar</button>
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
                    <button wire:click.stop="CerrarMsg2()" class="bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200  px-4 py-2 cursor-pointer text-white">Cerrar</button>
                </div>
            </div>

        </section>

    </div>
</div>
