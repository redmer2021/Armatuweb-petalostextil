<div>
    <img wire:click="VerForm()" title="Revisar" src="{{ asset('imgs/img_sistema/ojo.png') }}" alt="Revisar" class="cursor-pointer h-[1.5rem] w-[1.5rem]" />

    <section 
        class="ventanaModal" 
        x-cloak 
        x-show="verForm = $wire.verForm" 
        x-transition.duration.0ms
        x-effect="document.body.classList.toggle('overflow-hidden', $wire.verForm)"
    >
        <div class="ventanaInterna_1">
            <img src="{{ asset('imgs/img_sistema/cancelar.png' ) }}" 
                alt="Cancelar"
                wire:click="CerrarForm()"
                class="absolute right-6 cursor-pointer">
                <span class="text-2xl mb-3">REVISIÓN DE DATOS</span>
                
            <div class="grid grid-cols-[60%_auto] gap-2">
                <div class="grid grid-cols-[17%_auto]">
                    <div class="flex flex-col max-h-[65vh] overflow-x-hidden overflow-y-auto space-y-2">
                        @foreach ($fotos as $item_foto)
                            <div class="cursor-pointer h-[6rem] w-[6rem]">
                                <img 
                                    src="{{ asset('imgs/img_productos/' . $item_foto->nomFoto) }}" 
                                    alt="Pétalos Textil" 
                                    class="w-full h-full object-cover"
                                    wire:click="SeleccionaFoto('{{ $item_foto->nomFoto }}')"
                                >
                            </div>
                        @endforeach

                    </div>

                    <div class="max-h-[65vh]">
                            <img 
                            src="{{ asset('imgs/img_productos/' . $fotoPrincipal) }}" 
                            alt="Pétalos Textil" 
                            class="w-full h-full object-cover"
                        >    
                    </div>
                </div>
                
                <div class="max-h-[65vh] overflow-x-hidden overflow-y-auto">
                    <div class="grid grid-cols-[25%_auto] gap-2">
                        <div>
                            <label for="codigo">Código</label>
                            <input disabled id="codigo" wire:model="codigo" type="text" class="input-1 text-center">
                        </div>
                        <div>
                            <label for="categoria">Categoría</label>
                            <input disabled id="categoria" wire:model="categoria" type="text" class="input-1">
                        </div>    
                    </div>
                    <div class="mt-2">
                        <label for="nombre">Nombre</label>
                        <input disabled id="nombre" wire:model="nombre" type="text" class="input-1">
                    </div>
                    <div class="mt-2">
                        <label for="descrip">Descripción</label>
                        <textarea disabled id="descrip" wire:model="descrip" class="textarea-1"></textarea>
                    </div>                
                    <div class="mt-2">
                        <label for="compoKit">Compisición Kit</label>
                        <textarea disabled id="compoKit" wire:model="compoKit" class="textarea-1"></textarea>
                    </div>                
                    <div class="mt-2">
                        <label for="caracDest">Características destacadas</label>
                        <textarea disabled id="caracDest" wire:model="caracDest" class="textarea-1"></textarea>
                    </div>                
                    <div class="mt-2">
                        <label for="usosRec">Usos recomendados</label>
                        <textarea disabled id="usosRec" wire:model="usosRec" class="textarea-1"></textarea>
                    </div>                
                    <div class="mt-2">
                        <label for="medidas">Medidas</label>
                        <input disabled id="medidas" wire:model="medidas" type="text" class="input-1">
                    </div>                
                    <div class="mt-2">
                        <label for="peso">Peso</label>
                        <input disabled id="peso" wire:model="peso" type="text" class="input-1">
                    </div>                
                    
                    <div class="mt-2 grid grid-cols-2 gap-2">
                        <div>
                            <label for="precio">Precio</label>
                            <input disabled id="precio" wire:model="precio" type="text" class="input-1 text-right">
                        </div>                
                        <div>
                            <label for="descPorTransfer">% desc por transferencia</label>
                            <input disabled id="descPorTransfer" wire:model="descPorTransfer" type="text" class="input-1 text-center">
                        </div>                    
                    </div>

                    <div class="mt-2 grid grid-cols-3 gap-2">
                        <div>
                            <label for="stockActual">Stock</label>
                            <input disabled id="stockActual" wire:model="stockActual" type="text" class="input-1 text-center">
                        </div>                
                        <div>
                            <label for="visitas">Visitas</label>
                            <input disabled id="visitas" wire:model="visitas" type="text" class="input-1 text-center">
                        </div>                
                        <div class="flex flex-col">
                            <label for="visitas">Artículo Pausado</label>
                            @if ($pausado == 1)
                                <span class="input-1 block text-center">SI</span>
                            @else
                                <span class="input-1 block text-center">NO</span>
                            @endif
                        </div>
    
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</div>
