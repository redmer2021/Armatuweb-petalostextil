<section class="bg-white">
    <!--Barra de búsqueda por categorías o por nombre -->
    <div class="pt-[8rem] py-1 px-5 md:px-20">
        <p class="border-[#1F1F1F] border-b-[2px] mb-[2rem] text-[#1F1F1F] text-2xl md:text-3xl font-bold">Catálogo</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 md:gap-0 md:px-10">
            @foreach ($listCatalogo as $it)
                <div wire:click="IniciarCompra({{ $it->id }})" class="cursor-pointer flex flex-col h-[40rem] overflow-hidden hover:shadow-md shadow-[#405D39] p-4">
                    
                    <!-- Imagen -->
                    <div class="flex-shrink-0 h-2/3">
                        <img src="{{ asset('imgs/' . $it->nomFoto )}}"
                            alt="Pétalos Textil"
                            class="h-full w-full object-cover rounded-lg">
                    </div>

                    <div class="flex-grow p-2 flex flex-col justify-between">
                        <div>
                            <p class="text-[#1F1F1F] text-[25px] font-bold">{{ $it->nombre }}</p>
                            <p class="text-[#1F1F1F] text-[20px]">$ {{ number_format($it->precio, 2, '.', ',') }}</p>
                            <p class="text-[#1F1F1F] text-[15px] italic">{{ $it->cuotas }}</p>
                        </div>

                        <!-- Botón -->
                        <button 
                                class="cursor-pointer w-full bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200 py-2 text-white">
                            Ver más
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <section 
        class="ventanaModal" 
        x-cloak 
        x-show="verForm = $wire.verForm" 
        x-transition.duration.0ms
        x-effect="document.body.classList.toggle('overflow-hidden', $wire.verForm)"
    >
        <div class="ventanaInterna_1">
            <img src="{{ asset('imgs/cancelar.png' ) }}" 
                alt="Cancelar"
                wire:click="CerrarForm()"
                class="absolute right-6 cursor-pointer h-[2rem] w-[2rem]">

            <div class="mt-[3rem] grid grid-rows-[16%_40%_auto]  md:grid-cols-[12%_40%_auto] md:grid-rows-1 h-full gap-6">
                <!-- 🔹 Contenedor de miniaturas -->
                <div class="flex flex-row items-center md:flex-col 
                    space-x-2 md:space-x-0 md:space-y-2 
                    overflow-x-auto md:overflow-y-auto 
                    scrollbar-hide h-full">

                    @foreach ($item_fotosOtras as $item_foto)
                        <div class="cursor-pointer h-[7rem] w-[7rem] shrink-0">
                            <img 
                                src="{{ asset('imgs/' . $item_foto->nomFoto) }}" 
                                alt="Pétalos Textil" 
                                class="w-full h-full object-cover"
                                wire:click="SeleccionaFoto('{{ $item_foto->nomFoto }}')"
                            >
                        </div>
                    @endforeach
                </div>

                <!-- 🔹 Imagen principal -->
                <div class="h-full flex items-center justify-center overflow-hidden">
                    <img 
                        src="{{ asset('imgs/' . $item_fotoPrincipal) }}" 
                        alt="Pétalos Textil" 
                        class="w-full h-full object-cover"
                    >
                </div>

                <!-- 🔹 Otro contenido -->
                <div class="h-full">
                    <span class="mb-4 block text-3xl font-bold">{{ $item_nombre }}</span>
                    <span class="mb-2 block text-2xl">$ {{ number_format($item_precio, 2, '.', ',') }}</span>
                    @if($item_descTransfer != '')
                        <span class="mb-2 block text-md italic">Pagando con transferencia: {{ $item_descTransfer }}% de descuento!!</span>
                    @endif

                    <span class="px-3 py-1 text-md italic bg-[#FEF0E9]">¡¡Tenemos disponible <strong>{{ $item_stock_actual }}</strong> unidades!!</span>

                    @if ($item_descrip)
                        <p class="max-h-[11rem] overflow-y-auto mt-2 text-md" >{!! nl2br(e($item_descrip)) !!}</p>
                    @endif

                    <div class="mt-[2rem] grid grid-cols-[30%_auto] md:gap-3">
                        <div class="flex justify-center items-center border border-[#E9E9E9] rounded-md mr-2">
                            <img src="{{ asset('imgs/restar.png') }}" alt="Restar" wire:click="Restar()" class="cursor-pointer h-[1.5rem] md:h-[1.3rem] w-auto">
                            <span class="text-lg font-bold mx-4">{{ $cantItemsComprados }}</span>
                            <img src="{{ asset('imgs/sumar.png') }}" alt="Sumar" wire:click="Sumar()" class="cursor-pointer h-[1.5rem] md:h-[1.3rem] w-auto">
                        </div>
                        <div>
                            <button wire:click="AgregarAlCarito()" class="cursor-pointer bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200 px-[4rem] h-full py-3 text-white">Agregar al carrito</button>
                        </div>                        
                    </div>

                    <div class="mt-[2rem]">
                        <div class="flex items-center ml-2 mb-2">
                            <img src="{{ asset('imgs/entrega-rapida.png') }}" alt="Entregas" class="h-[2rem] w-auto">
                            <span class="font-bold text-md ml-2">Envío a domicilio</span>
                        </div>
                        <div class="px-3 py-2 border border-[#E9E9E9] rounded-md flex justify-between items-center">
                            <span class="text-md" >Por Correo Argentino</span>
                            <span>$ 9,350.00</span>
                        </div>
                    </div>
                    <div class="pl-2 my-[2rem] flex items-center bg-[#FEF0E9]">
                        <img src="{{ asset('imgs/ojo.png') }}" alt="Entregas" class="h-[1rem] w-auto">
                        <span class="px-3 py-1 text-md italic ">¡¡Este artículo lo vieron <strong>{{ $item_visitas }}</strong> personas!!</span>
                    </div>

                </div>
            </div>
        </div>
    </section>


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

    @section('scriptsJava')
        <script>
            window.addEventListener('guardar-uuid', event => {
                const uuid = event.detail.uuid; 
                localStorage.setItem('carrito_uuid', uuid);
            });
        </script>
    @endsection
    
</section>
