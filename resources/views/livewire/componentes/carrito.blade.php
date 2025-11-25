<div>
    <div wire:click="VerCarrito()" class="flex cursor-pointer relative">
        <img src="{{ asset('imgs/img_sistema/carrito.svg') }}" alt="Carrito de compras" class="w-[2rem] h-[2rem]">
        <div class="flex flex-col">
            <span class="text-md hidden md:block font-bold">Carrito</span>
            <span class="md:hidden absolute -top-[20px] text-black {{ strlen($totalCantidad) < 2 ? 'right-[10px]' : 'right-[7px]' }}">{{ $totalCantidad }}</span>
            <span class="hidden md:block text-md">$ {{ number_format($totalPrecio, 2, '.', ',') }}</span>
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
        @if ($totalPrecio >= 0)
            <div class="ventanaInterna_1">
                <img src="{{ asset('imgs/img_sistema/cancelar.png' ) }}" 
                    alt="Cancelar"
                    wire:click="CerrarForm()"
                    class="cursor-pointer absolute right-6 h-[2rem] w-[2rem]">

                <div class="mt-[2rem] md:h-full m-[0.5rem] grid grid-cols-1 md:grid-cols-[55%_auto]">
                    <!-- Columna de artículos -->
                    <div class="h-auto md:h-[70vh] overflow-visible md:overflow-y-auto flex flex-col">
                        @foreach ($carrito as $it)
                            @livewire('componentes.itemcarrito', ['item' => $it], key( sha1(json_encode($it)) ))
                        @endforeach
                    </div>                        
                    
                    <!-- Columna del resumen -->
                    <div class="p-[1rem] pl-0 md:pl-[3rem] h-auto md:h-[70vh] overflow-visible md:overflow-y-auto">
                        <div class="grid md:grid-cols-1 gap-y-4">
                            
                            <div class="grid grid-cols-2">
                                <div class="flex items-center">
                                    <span class="text-md" >Total compra:</span>
                                </div>
                                <div class="flex justify-end items-center">
                                    <span class="text-[15px] text-[#1F1F1F] md:text-[18px] font-bold">$ {{ number_format($totalPrecio, 2, '.', ',') }}</span>
                                </div>
                            </div>
                
                            <div>
                                <div class="flex items-center ml-2 mb-2">
                                    <img src="{{ asset('imgs/img_sistema/entrega-rapida.svg') }}" alt="Entregas" class="h-[2rem] w-auto">
                                    <span class="text-md ml-2">Envío a domicilio</span>
                                </div>
                                <div class="px-3 py-2 border border-[#E9E9E9] rounded-md mb-1">
                                    <div class="flex flex-col">
                                        <div>
                                            <input class="cursor-pointer mr-2" wire:model.live="tipEnvio" value="1" id="op1" type="radio" name="tipEnvio">
                                            <label for="op1" class="cursor-pointer text-md">Correo Argentino</label>
                                        </div>

                                        @if ($tipEnvio == 1)
                                            <div>
                                                <div class="grid grid-cols-[5.5rem_1fr] gap-2 my-1 items-center">
                                                    <label class="block text-md" for="dirProvincia">Provincia</label>
                                                    <select wire:model.live="dirProvincia" class="text-md py-1 w-full border-[1px] @error('dirProvincia') border-red-500 @else border-gray-400 @enderror " name="dirProvincia" id="dirProvincia">
                                                        <option value="0">Seleccionar Provincia...</option>
                                                        @foreach ($tb_provincias as $provincia)
                                                            <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>                                    
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="grid grid-cols-[5.5rem_1fr] gap-2 my-1 items-center">
                                                    <label for="dirCalleAltura" class="text-md">Dirección</label>
                                                    <input id="dirCalleAltura" maxlength="50" wire:model="dirCalleAltura" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dirCalleAltura') border-red-500 @else border-gray-400 @enderror  focus:outline-none focus:ring-0">
                                                </div>
                                                <div class="grid grid-cols-[5.5rem_1fr] gap-2 my-1 items-center">
                                                    <label class="block text-md" for="dirLocalidad">Localidad</label>
                                                    <input id="dirLocalidad" maxlength="50" wire:model="dirLocalidad" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dirLocalidad') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0">
                                                </div>
                                                <div class="grid grid-cols-[5.5rem_1fr] gap-2 my-1 items-center">
                                                    <label class="block text-md" for="dirCodPostal">CP</label>
                                                    <input id="dirCodPostal" maxlength="15" wire:model="dirCodPostal" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dirCodPostal') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0">
                                                </div>
                                                <div class="grid grid-cols-[5.5rem_1fr] gap-2 my-1 items-center">
                                                    <label class="block text-md" for="dirEntreCalles">E. Calles</label>
                                                    <input id="dirEntreCalles" maxlength="255" wire:model="dirEntreCalles" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dirEntreCalles') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0">
                                                </div>
                                            </div>
                                        @endif
                                    </div>                                    
                                </div>
                                <div class="px-3 py-2 border border-[#E9E9E9] rounded-md">
                                    <div class="flex flex-col">
                                        <div>
                                            <input class="cursor-pointer mr-2" wire:model.live="tipEnvio" value="2" id="op2" type="radio" name="tipEnvio">
                                            <label for="op2" class="cursor-pointer text-md">Moto solo en CABA</label>
                                        </div>

                                        @if ($tipEnvio == 2)
                                            <div>
                                                <div class="grid grid-cols-[5.5rem_1fr] gap-2 my-1 items-center">
                                                    <label for="dirCalleAltura" class="text-md">Dirección</label>
                                                    <input id="dirCalleAltura" maxlength="50" wire:model="dirCalleAltura" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dirCalleAltura') border-red-500 @else border-gray-400 @enderror  focus:outline-none focus:ring-0">
                                                </div>
                                                <div class="grid grid-cols-[5.5rem_1fr] gap-2 my-1 items-center">
                                                    <label class="block text-md " for="dirBarrio">Barrio</label>
                                                    <input id="dirBarrio" maxlength="50" wire:model="dirBarrio" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dirBarrio') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0">
                                                </div>
                                                <div class="grid grid-cols-[5.5rem_1fr] gap-2 my-1 items-center">
                                                    <label class="block text-md " for="dirCodPostal">C. P.</label>
                                                    <input id="dirCodPostal" maxlength="15" wire:model="dirCodPostal" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dirCodPostal') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0">
                                                </div>
                                                <div class="grid grid-cols-[5.5rem_1fr] gap-2 my-1 items-center">
                                                    <label class="block text-md " for="dirEntreCalles">E. Calles</label>
                                                    <input id="dirEntreCalles" maxlength="255" wire:model="dirEntreCalles" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dirEntreCalles') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0">
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                
                            <div>
                                <div class="flex items-center ml-2 mb-2">
                                    <img src="{{ asset('imgs/img_sistema/localizacion.svg') }}" alt="Entregas" class="h-[1.5rem] w-auto">
                                    <span class="text-md ml-2">Retirar en</span>
                                </div>
                                <div class="px-3 py-2 border border-[#E9E9E9] rounded-md flex justify-between items-center">
                                    <div class="flex items-center">
                                        <input class="cursor-pointer mr-2" wire:model.live="tipEnvio" value="3" id="op3" type="radio" name="tipEnvio">
                                        <label for="op3" class="cursor-pointer text-md">Antonio Machado 558 - Caballito - CABA</label>
                                    </div>
                                    <span>$ 0.00</span>
                                </div>
                            </div>
                
                            <div>
                                <div class="bg-[#FEF0E9] px-3 py-2 border border-[#E9E9E9] rounded-md flex justify-between items-center">
                                    <span class="text-md">Total a Pagar:</span>
                                    <span>$ {{ number_format($totalFinal, 2, '.', ',') }}</span>
                                </div>
                            </div>

                            <button 
                                wire:click="Confirmar()" 
                                class=" cursor-pointer 
                                        bg-[#5D7857] 
                                        hover:bg-[#405D39] 
                                        transition-colors 
                                        duration-200 
                                        font-bold 
                                        px-5 
                                        py-2 
                                        mt-[1rem]
                                        text-white 
                                        text-md">
                                Confirmar Compra
                            </button>
                
                        </div>
                    </div>
                                
                </div>
            </div>
        @endif
    </section>
    
</div>



