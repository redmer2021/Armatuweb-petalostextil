<div>
    <div wire:click="VerCarrito()" class="flex cursor-pointer relative">
        <img src="{{ asset('imgs/carrito.svg') }}" alt="Carrito de compras" class="w-[2.8rem] h-[2.8rem]">
        <div class="flex flex-col">
            <span class="text-[14px] hidden md:block font-bold md:text-[16px]">Carrito</span>
            <span class="md:hidden absolute -top-2 right-4 text-black">{{ $totalCantidad }}</span>
            <span class="text-[14px] hidden md:block md:text-[16px]">$ {{ number_format($totalPrecio, 2, '.', ',') }}</span>
        </div>
    </div>

    @script
        <script>
            document.addEventListener('livewire:navigated', () => {
                const uuidGuardado = localStorage.getItem('carrito_uuid');
                if (uuidGuardado) {
                    $wire.call('setUuid', uuidGuardado);
                }
            });
        </script>
    @endscript


    <section 
        class="ventanaModal" 
        x-cloak 
        x-show="$wire.verForm" 
        x-transition.duration.0ms
        x-effect="document.body.classList.toggle('overflow-hidden', $wire.verForm)"
    >
        @if ($totalPrecio == 0)
            <div class="ventanaInterna_2 relative">
                <img src="{{ asset('imgs/carrito-vacio.png') }}" alt="Carrito de compras" class="w-full h-full object-contain">
                <div class="absolute bottom-2 right-2 flex flex-col">
                    <span class="mb-2 md:text-4xl text-black font-bold">CARRITO VACÍO</span>
                    <button wire:click="CerrarForm()" class="cursor-pointer bg-[#D4A373] hover:bg-[#E9EDC9] transition-colors duration-200 font-bold px-5 py-1 rounded-md text-black text-[12px] md:text-[15px]">Ir de compras!!</button>
                </div>
            </div>
        @else
            <div class="ventanaInterna_1">
                <img src="{{ asset('imgs/cancelar.png' ) }}" 
                    alt="Cancelar"
                    wire:click="CerrarForm()"
                    class="cursor-pointer absolute right-6 h-[2rem] w-[2rem]">

                <div class="mt-[2rem] md:h-full m-[0.5rem] grid grid-cols-1 md:grid-cols-[60%_auto]">
                    <!-- Columna de artículos -->
                    <div class="h-[58vh] md:h-[70vh] overflow-y-auto flex flex-col ">
                        @foreach ($carrito as $it)
                            @livewire('componentes.itemcarrito', ['item' => $it], key( sha1(json_encode($it)) ))
                        @endforeach
                    </div>                        
                    
                    <!-- Columna del resumen -->
                    <div class="p-[1rem] pl-0 md:pl-[3rem] h-[58vh] md:h-[70vh] overflow-y-auto">
                        <div class="grid md:grid-cols-1 gap-y-4">
                            
                            <div class="grid grid-cols-2">
                                <div class="flex items-center">
                                    <span>Total compra:</span>
                                </div>
                                <div class="flex justify-end items-center">
                                    <span class="text-[15px] text-[#1F1F1F] md:text-[18px] font-bold">$ {{ number_format($totalPrecio, 2, '.', ',') }}</span>
                                </div>
                            </div>
                
                            <div>
                                <div class="flex items-center ml-2 mb-2">
                                    <img src="{{ asset('imgs/entrega-rapida.png') }}" alt="Entregas" class="h-[2rem] w-auto">
                                    <span class="text-xs ml-2">Envío a domicilio</span>
                                </div>
                                <div class="px-3 py-2 border border-[#E9E9E9] rounded-md mb-1">
                                    <div class="flex flex-col">
                                        <div>
                                            <input class="cursor-pointer mr-2" wire:model.live="tipEnvio" value="1" id="op1" type="radio" name="tipEnvio">
                                            <label for="op1" class="cursor-pointer text-xs">Correo Argentino</label>
                                        </div>

                                        @if ($tipEnvio == 1)
                                            <div>
                                                <div class="grid grid-cols-[3.5rem_1fr] gap-2 my-1 items-center">
                                                    <label class="block text-xs " for="dirProvincia">Provincia</label>
                                                    <select wire:model.live="dirProvincia" class="text-xs py-1 w-full border-[1px] @error('dirProvincia') border-red-500 @else border-gray-400 @enderror " name="dirProvincia" id="dirProvincia">
                                                        <option value="0">Seleccionar Provincia...</option>
                                                        @foreach ($tb_provincias as $provincia)
                                                            <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>                                    
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="grid grid-cols-[3.5rem_1fr] gap-2 my-1 items-center">
                                                    <label for="dirCalleAltura" class="text-xs">Dirección</label>
                                                    <input id="dirCalleAltura" maxlength="50" wire:model="dirCalleAltura" type="text" class="w-full px-2 py-1 text-xs border-[1px] @error('dirCalleAltura') border-red-500 @else border-gray-400 @enderror  focus:outline-none focus:ring-0">
                                                </div>
                                                <div class="grid grid-cols-[3.5rem_1fr] gap-2 my-1 items-center">
                                                    <label class="block text-xs " for="dirLocalidad">Localidad</label>
                                                    <input id="dirLocalidad" maxlength="50" wire:model="dirLocalidad" type="text" class="w-full px-2 py-1 text-xs border-[1px] @error('dirLocalidad') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0">
                                                </div>
                                                <div class="grid grid-cols-[3.5rem_1fr] gap-2 my-1 items-center">
                                                    <label class="block text-xs " for="dirCodPostal">CP</label>
                                                    <input id="dirCodPostal" maxlength="15" wire:model="dirCodPostal" type="text" class="w-full px-2 py-1 text-xs border-[1px] @error('dirCodPostal') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0">
                                                </div>
                                                <div class="grid grid-cols-[3.5rem_1fr] gap-2 my-1 items-center">
                                                    <label class="block text-xs " for="dirEntreCalles">E. Calles</label>
                                                    <input id="dirEntreCalles" maxlength="255" wire:model="dirEntreCalles" type="text" class="w-full px-2 py-1 text-xs border-[1px] @error('dirEntreCalles') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0">
                                                </div>
                                            </div>
                                        @endif
                                    </div>                                    
                                </div>
                                <div class="px-3 py-2 border border-[#E9E9E9] rounded-md">
                                    <div class="flex flex-col">
                                        <div>
                                            <input class="cursor-pointer mr-2" wire:model.live="tipEnvio" value="2" id="op2" type="radio" name="tipEnvio">
                                            <label for="op2" class="cursor-pointer text-xs">Moto solo en CABA</label>
                                        </div>

                                        @if ($tipEnvio == 2)
                                            <div>
                                                <div class="grid grid-cols-[3.5rem_1fr] gap-2 my-1 items-center">
                                                    <label for="dirCalleAltura" class="text-xs">Dirección</label>
                                                    <input id="dirCalleAltura" maxlength="50" wire:model="dirCalleAltura" type="text" class="w-full px-2 py-1 text-xs border-[1px] @error('dirCalleAltura') border-red-500 @else border-gray-400 @enderror  focus:outline-none focus:ring-0">
                                                </div>
                                                <div class="grid grid-cols-[3.5rem_1fr] gap-2 my-1 items-center">
                                                    <label class="block text-xs " for="dirBarrio">Barrio</label>
                                                    <input id="dirBarrio" maxlength="50" wire:model="dirBarrio" type="text" class="w-full px-2 py-1 text-xs border-[1px] @error('dirBarrio') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0">
                                                </div>
                                                <div class="grid grid-cols-[3.5rem_1fr] gap-2 my-1 items-center">
                                                    <label class="block text-xs " for="dirCodPostal">C. P.</label>
                                                    <input id="dirCodPostal" maxlength="15" wire:model="dirCodPostal" type="text" class="w-full px-2 py-1 text-xs border-[1px] @error('dirCodPostal') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0">
                                                </div>
                                                <div class="grid grid-cols-[3.5rem_1fr] gap-2 my-1 items-center">
                                                    <label class="block text-xs " for="dirEntreCalles">E. Calles</label>
                                                    <input id="dirEntreCalles" maxlength="255" wire:model="dirEntreCalles" type="text" class="w-full px-2 py-1 text-xs border-[1px] @error('dirEntreCalles') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0">
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                {{-- <div class="px-3 py-2 border border-[#E9E9E9] rounded-md ">
                                    <div class="flex justify-between">
                                        <div class="flex items-center">
                                            <input class="cursor-pointer mr-2" wire:model.live="tipEnvio" value="1" id="op1" type="radio" name="tipEnvio">
                                            <label for="op1" class="cursor-pointer text-xs">Correo Argentino</label>
                                        </div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="flex items-center">
                                            <input class="cursor-pointer mr-2" wire:model.live="tipEnvio" value="2" id="op2" type="radio" name="tipEnvio">
                                            <label for="op2" class="cursor-pointer text-xs">Moto solo en CABA</label>
                                        </div>
                                        @if ($tipEnvio == 2)
                                            <div>
                                                <div class="mt-[1rem] grid grid-cols-[3.5rem_1fr] gap-2 mb-2 items-center">
                                                    <label for="dirCalle" class="text-xs">Calle</label>
                                                    <input id="dirCalle" maxlength="50" wire:model="dirCalle" type="text" class="w-full px-2 py-1 text-xs border-[1px] @error('dirCalle') border-red-500 @else border-gray-400 @enderror  focus:outline-none focus:ring-0">
                                                </div>
                                                <div class="grid grid-cols-[3.5rem_1fr] gap-2 mb-2 items-center">
                                                    <label class="block text-xs " for="dirAltura">Altura</label>
                                                    <input id="dirAltura" maxlength="20" wire:model="dirAltura" type="text" class="w-full px-2 py-1 text-xs border-[1px] @error('dirAltura') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0">
                                                </div>
                                                <div class="grid grid-cols-[3.5rem_1fr] gap-2 mb-2 items-center">
                                                    <label class="block text-xs " for="dirProvincia">Provincia</label>
                                                    <input id="dirProvincia" maxlength="30" wire:model="dirProvincia" type="text" class="w-full px-2 py-1 text-xs border-[1px] @error('dirProvincia') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0">
                                                </div>
                                                <div class="grid grid-cols-[3.5rem_1fr] gap-2 mb-2 items-center">
                                                    <label class="block text-xs " for="dirLocalidad">Localidad</label>
                                                    <input id="dirLocalidad" maxlength="50" wire:model="dirLocalidad" type="text" class="w-full px-2 py-1 text-xs border-[1px] @error('dirLocalidad') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0">
                                                </div>
                                                <div class="grid grid-cols-[3.5rem_1fr] gap-2 mb-2 items-center">
                                                    <label class="block text-xs " for="dirCodPostal">Código Postal</label>
                                                    <input id="dirCodPostal" maxlength="15" wire:model="dirCodPostal" type="text" class="w-full px-2 py-1 text-xs border-[1px] @error('dirCodPostal') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0">
                                                </div>
                                                <div class="grid grid-cols-[3.5rem_1fr] gap-2 mb-2 items-center">
                                                    <label class="block text-xs " for="dirEntreCalles">Entre Calles</label>
                                                    <input id="dirEntreCalles" maxlength="255" wire:model="dirEntreCalles" type="text" class="w-full px-2 py-1 text-xs border-[1px] @error('dirEntreCalles') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0">
                                                </div>
                                            </div>

                                        @endif
                                    </div>


                                </div> --}}
                            </div>
                
                            <div>
                                <div class="flex items-center ml-2 mb-2">
                                    <img src="{{ asset('imgs/localizacion.png') }}" alt="Entregas" class="h-[2rem] w-auto">
                                    <span class="text-xs ml-2">Retirar en</span>
                                </div>
                                <div class="px-3 py-2 border border-[#E9E9E9] rounded-md flex justify-between items-center">
                                    <div class="flex items-center">
                                        <input class="cursor-pointer mr-2" wire:model.live="tipEnvio" value="3" id="op3" type="radio" name="tipEnvio">
                                        <label for="op3" class="cursor-pointer text-xs">Antonio Machado 558 - Caballito - CABA</label>
                                    </div>
                                    <span>$ 0.00</span>
                                </div>
                            </div>
                
                            <div>
                                <div class="bg-[#FEF0E9] px-3 py-2 border border-[#E9E9E9] rounded-md flex justify-between items-center">
                                    <span class="text-xs">Total a Pagar:</span>
                                    <span>$ {{ number_format($totalFinal, 2, '.', ',') }}</span>
                                </div>
                            </div>

                            <div class="mb-[2rem] md:mb-0">
                                <div class="flex items-center ml-2 mb-2">
                                    <img src="{{ asset('imgs/pagar-con.png') }}" alt="Pagar" class="h-[2rem] w-auto">
                                    <span class="text-xs ml-2">Pagar con:</span>
                                </div>
                                <div class="px-3 py-4 border border-[#E9E9E9] rounded-md flex flex-col">
                                    <div class="flex justify-between items-center">
                                        <div class="flex justify-start items-center">
                                            <input class="cursor-pointer mr-2" wire:model.live="tipPago" value="1" id="tipPago" type="checkbox" name="tipPago">
                                            <label for="tipPago" class="cursor-pointer text-xs">Transferencia</label>
                                        </div>
                                        <span class="text-xs">{{ $pjeDescTransfer }}% de descuento</span>
                                    </div>
                                    @if ($tipPago)
                                        <span class="pl-[1rem] text-xs mt-[1rem]">CBU: 0110599530000045849333</span>
                                        <span class="pl-[1rem] text-xs">Alias: rene.merlo</span>
                                        <span class="pl-[1rem] text-xs">A nombre de: MERLO RENE DANIEL</span>
                                        <span class="pl-[1rem] text-xs">CUIL: 20-20073000-4</span>
                                        <span class="pl-[1rem] text-xs">Enviar comprobante a rmerlo@gmail.com</span>
                                        <span class="mt-[1rem] font-bold italic text-[#405D39] text-xs">¡¡Por favor, transferir el monto exacto. Una vez que se acredite el importe, te avisaremos por e-mail!!</span>
                                        <button wire:click="Aceptar()" class="my-[1rem] cursor-pointer bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200 font-bold px-5 py-2 text-white text-[12px] md:text-[15px]">Aceptar</button>
                                    @endif


                                    @if (!$tipPago)
                                        <button wire:click="IniciarPago2()" class="mt-[1rem] cursor-pointer bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200 font-bold px-5 py-2 text-white text-[12px] md:text-[15px]">Mercado Pago</button>
                                    @endif

                                    @error('tipEnvio')
                                        <div class="text-red-600 text-sm font-semibold mb-2">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    {{-- <button wire:click="IniciarPago1()" class="cursor-pointer bg-[#D4A373] hover:bg-[#E9EDC9] transition-colors duration-200 font-bold px-5 py-2 rounded-md text-black text-[12px] md:text-[15px]">Dinero en Cuenta</button>
                                    <button wire:click="IniciarPago2()" class="cursor-pointer bg-[#D4A373] hover:bg-[#E9EDC9] transition-colors duration-200 font-bold px-5 py-2 rounded-md text-black text-[12px] md:text-[15px]">Varios Medios de Pago</button> --}}
                                </div>
                            </div>

                            {{-- <div>
                                <div class="px-3 py-2 border border-[#E9E9E9] rounded-md flex justify-between items-center">
                                    <span class="text-xs font-bold">¡¡Transferencia, {{ $pjeDescTransfer }}% de descuento:</span>
                                    <span class="font-bold">$ {{ number_format($totalConDesc, 2, '.', ',') }} !!</span>
                                </div>
                            </div>
                
                            <div class="mt-[2rem] mb-[2rem] md:mb-0">
                                <div class="flex items-center ml-2 mb-2">
                                    <img src="{{ asset('imgs/pagar-con.png') }}" alt="Pagar" class="h-[2rem] w-auto">
                                    <span class="text-xs ml-2">Pagar con:</span>
                                </div>
                                <div class="px-3 py-4 border border-[#D4A373] rounded-md flex justify-between items-center">
                                    <button wire:click="IniciarPago1()" class="cursor-pointer bg-[#D4A373] hover:bg-[#E9EDC9] transition-colors duration-200 font-bold px-5 py-2 rounded-md text-black text-[12px] md:text-[15px]">Dinero en Cuenta</button>
                                    <button wire:click="IniciarPago2()" class="cursor-pointer bg-[#D4A373] hover:bg-[#E9EDC9] transition-colors duration-200 font-bold px-5 py-2 rounded-md text-black text-[12px] md:text-[15px]">Varios Medios de Pago</button>
                                </div>
                            </div> --}}
                
                        </div>
                    </div>
                                
                </div>
            </div>
        @endif
    </section>
    
</div>


@script
<script>
    window.addEventListener('eliminar-uuid', event => {
        localStorage.setItem('carrito_uuid', '');
    });
</script>
@endscript

