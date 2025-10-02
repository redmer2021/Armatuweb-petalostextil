<section>

    <!--Barra de búsqueda por categorías o por nombre -->
    <div class="w-auto bg-[#d4a373] h-[3rem]">
        <div class="max-w-6xl mx-auto h-full flex items-center justify-between px-4">
            <div class="hidden w-full md:grid grid-cols-[80%_20%] h-[3rem]">
                <div class="grid grid-cols-9">

                    @foreach ($categorias as $categ)
                        <div class="flex justify-center text-center items-center hover:bg-[#FEFAE0] transition-colors duration-200">
                            <button wire:click="SelecCat({{ $categ->id }})" class="cursor-pointer h-auto p-2 text-xs">{{ $categ->nombre }}</button>
                        </div>
                    @endforeach

                </div>

                <div class="flex justify-center text-center">
                    <input wire:model="txtabuscar" type="text" class="bg-transparent block w-full px-2 text-xs focus:outline-none focus:ring-0" placeholder="¿Que estas buscando...? ">
                    <button wire:click="Buscar()" class="p-2 cursor-pointer">
                        <img src="{{ asset('imgs/lupa.png') }}" alt="Buscar" class="h-4 w-4">
                    </button>
                </div>
            </div>

            <div class="w-full md:hidden grid grid-cols-[100%] h-[3rem]">

                <div class="flex justify-center text-center">
                    <input wire:model="txtabuscar" type="text" class="bg-transparent block w-full px-2 text-xs focus:outline-none focus:ring-0" placeholder="¿Que estas buscando...? ">
                    <button wire:click="Buscar()" class="p-2 cursor-pointer">
                        <img src="{{ asset('imgs/lupa.png') }}" alt="Buscar" class="h-4 w-4">
                    </button>
                </div>
            </div>

        </div>
    </div>


    <!--Renderización del Banner Central -->

    @if($RenderizarBanner)
        @livewire('componentes.slider')
    @endif
    
    {{-- @if($RenderizarBanner)
        <div class="w-full flex overflow-hidden">
            <img src="{{ asset('imgs/527238038_17862335967444131_3999704133648464046_n.webp') }}" 
                alt="Pétalos Textil" 
                class="flex-1 h-full object-contain min-w-0">

            <!-- Contenedor relativo para la segunda imagen y el texto -->
            <div class="relative flex-1 min-w-0">
                <img src="{{ asset('imgs/527292099_17862335976444131_2310943107417420591_n.webp') }}" 
                    alt="Pétalos Textil" 
                    class="h-full w-full object-contain">

                <!-- Texto superpuesto -->
                <div class="hidden md:flex flex-col items-end absolute w-[45rem] top-[10rem] left-[5rem] space-y-[-30px]">
                    <span class="text-gray-700 text-[7rem] font-bold">MANTELES</span>
                    <span class="text-gray-700 text-[3rem] font-bold">IMPERMEABLES</span>
                    <button class="bg-[#D4A373] mt-[2rem] px-6 py-2 text-black hover:bg-[#E9EDC9] transition-colors duration-200 font-bold text-2xl rounded-lg cursor-pointer" >Comprar!!</button>
                </div>
            </div>        
        </div>
    @endif --}}

    <!--Artículos-->
    <div class="pt-[3rem] max-w-[95%] md:max-w-[70%] mx-auto mb-[3rem]">
        <span class="block mb-[1rem] text-2xl md:text-3xl font-bold">{{ $titCatalogo }}</span>
        <div class="grid grid-cols[100%] md:grid-cols-4 md:gap-4">

            @foreach ($listCatalogo as $it)
                <div class="h-[33rem] flex flex-col transform transition-transform duration-300 hover:scale-105">
                    <div class="h-[70%]">
                        <img src="{{ asset('imgs/' . $it->nomFoto )}}"
                        alt="Pétalos Textil" 
                        class="h-full w-full object-cover rounded-md">
                    </div>
                    <div class="h-[20%] md:p-1">
                        <p class="text-md mb-2">{{ $it->nombre }}</p>
                        <p class="text-xs text-right">$ {{ number_format($it->precio, 2, '.', ',') }}</p>
                        <p class="text-xs font-bold text-right">{{ $it->cuotas }}</p>
                    </div>
                    <div class="h-[10%] flex justify-end items-center">
                        <button wire:click="IniciarCompra({{ $it->id }})" class="cursor-pointer bg-[#D4A373] hover:bg-[#E9EDC9] transition-colors duration-200 font-bold px-5 py-1 rounded-md text-black">Comprar</button>
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
                class="absolute right-2 cursor-pointer h-[1.5rem] w-[1.5rem]">

            <div class="grid md:grid-cols-[10%_50%_auto] md:gap-2">
                <div>
                    {{-- Aquí van las otras fotos --}}
                </div>
                <div>
                    <img src="{{ asset('imgs/' . $item_fotoPrincipal) }}" 
                        alt="Pétalos Textil" 
                        class="h-[90%] w-full object-cover">
                </div>
                <div class="md:px-4 pt-2">
                    <span class="mb-4 block text-3xl font-bold">{{ $item_nombre }}</span>
                    <span class="mb-2 block text-2xl">$ {{ number_format($item_precio, 2, '.', ',') }}</span>

                    @if($item_cuotas != '')
                        <span class="block font-bold text-md">{{ $item_cuotas }}</span>
                    @endif

                    <span class="mt-2 block text-md">¡¡Tenemos disponible <strong>{{ $item_stock_actual }}</strong> unidades!!</span>
                    
                    <div class="mt-[2rem] grid md:grid-cols-[30%_auto] md:gap-3">
                        <div class="flex justify-center items-center border border-[#D4A373] rounded-md">
                            <img src="{{ asset('imgs/restar.png') }}" alt="Restar" wire:click="Restar()" class="cursor-pointer h-[1.5rem] md:h-[1.3rem] w-auto">
                            <span class="text-lg font-bold mx-4">{{ $cantItemsComprados }}</span>
                            <img src="{{ asset('imgs/sumar.png') }}" alt="Sumar" wire:click="Sumar()" class="cursor-pointer h-[1.5rem] md:h-[1.3rem] w-auto">
                        </div>
                        <div>
                            <button wire:click="AgregarAlCarito()" class="cursor-pointer bg-[#D4A373] hover:bg-[#E9EDC9] transition-colors duration-200 font-bold mt-[1rem] md:mt-0 px-5 py-2 md:py-4 rounded-md text-black w-full">Agregar al carrito</button>
                        </div>                        
                    </div>
                    
                    <div class="mt-[2rem]">
                        <div class="flex items-center ml-2 mb-2">
                            <img src="{{ asset('imgs/entrega-rapida.png') }}" alt="Entregas" class="h-[2rem] w-auto">
                            <span class="text-xs ml-2">Envío a domicilio</span>
                        </div>
                        <div class="px-3 py-4 border border-[#D4A373] rounded-md flex justify-between items-center">
                            <span class="text-xs" >Correo Argentino</span>
                            <span>$ 9,350.00</span>
                        </div>
                    </div>

                    <div class="mt-[2rem]">
                        <div class="flex items-center ml-2 mb-2">
                            <img src="{{ asset('imgs/localizacion.png') }}" alt="Entregas" class="h-[2rem] w-auto">
                            <span class="text-xs ml-2">Retirar en</span>
                        </div>
                        <div class="px-3 py-4 border border-[#D4A373] rounded-md flex justify-between items-center">
                            <span class="text-xs" >Sucursal Santa Rita</span>
                            <span>$ 7,250.00</span>
                        </div>
                    </div>

                    <div class="bg-[#D4A373] mt-[2rem] flex justify-center font-bold px-5 py-4 rounded-md text-black w-full">
                        ¡¡Este artículo lo vieron {{ $item_visitas }} personas!!
                    </div>
                </div>
            </div>

            <div class="mt-[2rem] ml-[2rem] w-auto h-auto">
                @if ($item_descrip)
                    <span class="block font-bold mb-[0.2rem]" >Descripción</span>
                    <p>{!! nl2br(e($item_descrip)) !!}</p>
                @endif

                @if ($item_compo_kit)
                    <span class="block font-bold mb-[0.2rem] mt-[2rem]" >Que te enviamos</span>
                    <p>{!! nl2br(e($item_compo_kit)) !!}</p>
                @endif

                @if ($item_carac_dest)
                    <span class="block font-bold mb-[0.2rem] mt-[2rem]" >Características destacadas</span>
                    <p>{!! nl2br(e($item_carac_dest)) !!}</p>                    
                @endif

                @if ($item_usos_rec)
                    <span class="block font-bold mb-[0.2rem] mt-[2rem]" >Usos recomendados</span>
                    <p>{!! nl2br(e($item_usos_rec)) !!}</p>                    
                @endif

                @if ($item_notas)
                    <span class="text-red-700 block font-bold mb-[0.2rem] mt-[2rem]" >¡¡Aclaración importante:!!</span>
                    <p>{!! nl2br(e($item_notas)) !!}</p>
                @endif
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
