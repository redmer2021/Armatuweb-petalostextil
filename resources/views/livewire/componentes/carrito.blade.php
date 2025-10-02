<div class="items-center">
    <div wire:click="VerCarrito()" class="flex flex-col items-center cursor-pointer">
        <img src="{{ asset('imgs/carrito.png') }}" alt="Carrito de compras" class="w-[1.5rem] h-[1.5rem] md:h-[1.5rem]">
        <span class="text-[10px] md:text-xs">{{ $totalCantidad }}</span>
        <span class="text-[10px] md:text-xs font-bold">$ {{ number_format($totalPrecio, 2, '.', ',') }}</span>
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
                    class="cursor-pointer absolute right-2 h-[1.5rem] w-[1.5rem]">
                <div class="mt-[2rem] md:h-full m-[0.5rem] grid grid-cols-1 md:grid-cols-[60%_auto]">
    
                    <!-- Columna de artículos -->
                    <div class="md:h-full md:overflow-y-auto flex flex-col">
                        @foreach ($carrito as $it)
                            @livewire('componentes.itemcarrito', ['item' => $it], key('carrito-'.$it->id))
                        @endforeach
                    </div>
                
                    <!-- Columna del resumen -->
                    <div class="p-[1rem] pl-0 md:pl-[3rem]">
                        <div class="grid md:grid-cols-1 gap-y-4">
                            
                            <div class="grid grid-cols-2">
                                <div class="flex items-center">
                                    <span>El total de tu compra es:</span>
                                </div>
                                <div class="flex justify-end items-center">
                                    <span class="text-[15px] md:text-2xl font-bold">$ {{ number_format($totalPrecio, 2, '.', ',') }}</span>
                                </div>
                            </div>
                
                            <div class="mt-[2rem]">
                                <div class="flex items-center ml-2 mb-2">
                                    <img src="{{ asset('imgs/entrega-rapida.png') }}" alt="Entregas" class="h-[2rem] w-auto">
                                    <span class="text-xs ml-2">Envío a domicilio</span>
                                </div>
                                <div class="px-3 py-4 border border-[#D4A373] rounded-md flex justify-between items-center">
                                    <div class="flex items-center">
                                        <input class="cursor-pointer mr-2" wire:model.live="tipEnvio" value="1" id="op1" type="radio" name="tipEnvio">
                                        <label for="op1" class="cursor-pointer text-xs">Correo Argentino</label>
                                    </div>
                                    <span>$ 9,350.00</span>
                                </div>
                            </div>
                
                            <div class="mt-[2rem]">
                                <div class="flex items-center ml-2 mb-2">
                                    <img src="{{ asset('imgs/localizacion.png') }}" alt="Entregas" class="h-[2rem] w-auto">
                                    <span class="text-xs ml-2">Retirar en</span>
                                </div>
                                <div class="px-3 py-4 border border-[#D4A373] rounded-md flex justify-between items-center">
                                    <div class="flex items-center">
                                        <input class="cursor-pointer mr-2" wire:model.live="tipEnvio" value="2" id="op2" type="radio" name="tipEnvio">
                                        <label for="op2" class="cursor-pointer text-xs">Sucursal Centenario</label>
                                    </div>
                                    <span>$ 7,250.00</span>
                                </div>
                            </div>
                
                            <div class="mt-[2rem]">
                                <div class="px-3 py-2 border border-[#D4A373] rounded-md flex justify-between items-center">
                                    <span class="text-xs">Total a Pagar:</span>
                                    <span>$ {{ number_format($totalFinal, 2, '.', ',') }}</span>
                                </div>
                            </div>
                
                            <div class="mt-[1rem]">
                                <div class="px-3 py-2 border border-[#D4A373] rounded-md flex justify-between items-center">
                                    <span class="text-xs font-bold">¡¡Con dinero en cuenta, {{ $pjeDescTransfer }}% de descuento:</span>
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
                            </div>
                
                        </div>
                    </div>
                
                </div>
            </div>
        @endif
    </section>
    
</div>

