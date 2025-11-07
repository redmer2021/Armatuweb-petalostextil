<div>
    <button wire:click="VerForm()" class="btn-uno">Nuevo Artículo</button>

    <section 
        class="ventanaModal" 
        x-cloak 
        x-show="$wire.verForm"
        x-transition.duration.0ms
        x-effect="document.body.classList.toggle('overflow-hidden', $wire.verForm)"
    >
    <div class="ventanaInterna_1">
        <img src="{{ asset('imgs/img_sistema/cancelar.png' ) }}" 
            alt="Cancelar"
            wire:click="CerrarForm()"
            class="absolute right-6 cursor-pointer">
            <span class="text-2xl mb-3">NUEVO ARTÍCULO</span>
            
        <div class="grid grid-cols-[60%_auto] gap-2 text-xs">
            <div class="grid grid-cols-[17%_auto] grid-rows-[2rem_1fr] h-[67vh] gap-2">
                <div class="col-span-2 flex">
                    <input 
                        wire:model="imagen" 
                        type="file" 
                        wire:key="{{$imgKey}}"
                        class="
                            mr-1
                            text-white 
                            border-gray-400 
                            p-2
                            bg-[#5D7857] 
                            cursor-pointer 
                            hover:bg-[#405D39]">
                    <button wire:click.stop="SubirImg()" class="btn-uno">Subir Imagen</button>
                    @if ($errorImagen)
                        <p class="text-red-600 text-sm mt-1 ml-2">{{ $errorImagen }}</p>
                    @endif                    
                </div>

                <div class="flex flex-col overflow-x-hidden overflow-y-auto space-y-2">
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

                <div class="max-h-[58vh] ">
                    @if ($fotoPrincipal != '')
                        <img 
                        src="{{ asset('imgs/img_productos/' . $fotoPrincipal) }}" 
                        alt="Pétalos Textil" 
                        class="w-full h-full object-cover">                        
                    @endif
                </div>

                <div class="col-span-2 flex justify-end">
                    @if ($fotoPrincipal != '')
                        <button wire:click.stop="EliminarImg()" class="btn-uno">Eliminar esta Imagen</button>
                    @endif
                </div>
        </div>
            
            <div class="max-h-[65vh] overflow-x-hidden overflow-y-auto">
                <div class="grid grid-cols-[25%_auto] gap-2">
                    <div>
                        <label for="codigo">Código</label>
                        @error('codigo') 
                            <input maxlength="6" id="codigo" wire:model="codigo" type="text" class="input-1-err text-center ">
                        @else 
                            <input maxlength="6" id="codigo" wire:model="codigo" type="text" class="input-1 text-center">
                        @enderror
                    </div>
                    <div>
                        @error('categoria')  
                            <label class="block" for="categoria">Categoría</label>
                            <select wire:model="categoria" class="text-md py-2 w-full border-[1px] border-red-500" name="dirProvincia" id="dirProvincia">
                                <option value="0">Seleccionar Categoría...</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>                                    
                                @endforeach
                            </select>
                        @else  
                            <label class="block" for="categoria">Categoría</label>
                            <select wire:model="categoria" class="text-md py-2 w-full border-[1px]" name="dirProvincia" id="dirProvincia">
                                <option value="0">Seleccionar Categoría...</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>                                    
                                @endforeach
                            </select>
                        @enderror
                    </div>    
                </div>
                <div class="mt-2">
                    <label for="nombre">Nombre</label>
                    @error('nombre') 
                        <input maxlength="50" id="nombre" wire:model="nombre" type="text" class="input-1-err">
                    @else 
                        <input maxlength="50" id="nombre" wire:model="nombre" type="text" class="input-1">
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="descrip">Descripción</label>
                    @error('descrip') 
                        <textarea maxlength="500" id="descrip" wire:model="descrip" class="textarea-1-err"></textarea>
                    @else 
                        <textarea maxlength="500" id="descrip" wire:model="descrip" class="textarea-1"></textarea>
                    @enderror
                </div>                
                <div class="mt-2">
                    <label for="compoKit">Composición Kit</label>
                    <textarea maxlength="500" id="compoKit" wire:model="compoKit" class="textarea-1"></textarea>
                </div>                
                <div class="mt-2">
                    <label for="caracDest">Características destacadas</label>
                    <textarea maxlength="500" id="caracDest" wire:model="caracDest" class="textarea-1"></textarea>
                </div>                
                <div class="mt-2">
                    <label for="usosRec">Usos recomendados</label>
                    <textarea maxlength="500" id="usosRec" wire:model="usosRec" class="textarea-1"></textarea>
                </div>                
                <div class="mt-2">
                    <label for="medidas">Medidas</label>
                    <input maxlength="255" id="medidas" wire:model="medidas" type="text" class="input-1">
                </div>                
                <div class="mt-2">
                    <label for="peso">Peso</label>
                    <input maxlength="255" id="peso" wire:model="peso" type="text" class="input-1">
                </div>                
                
                <div class="mt-2 grid grid-cols-2 gap-2">
                    <div>
                        <label for="precio">Precio</label>
                        @error('precio') 
                            <input maxlength="20" id="precio" wire:model="precio" type="text" class="input-1-err text-right">
                        @else 
                            <input 
                                id="precio" 
                                wire:model="precio" 
                                type="text" 
                                class="input-1 text-right" 
                                maxlength="20"
                                oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(',', '.');">
                        @enderror                        
                    </div>
                    <div>
                        <label for="descPorTransfer">% desc por transferencia</label>
                        <input 
                            id="descPorTransfer" 
                            wire:model="descPorTransfer" 
                            type="text" 
                            maxlength="3"
                            class="input-1 text-center"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    </div>
                </div>

                <div class="mt-2 grid grid-cols-2 gap-2">
                    <div>
                        <label for="stockActual">Stock</label>
                        @error('stockActual') 
                            <input maxlength="5" id="stockActual" wire:model="stockActual" type="text" class="input-1-err text-center">
                        @else 
                            <input maxlength="5" id="stockActual" wire:model="stockActual" type="text" class="input-1 text-center">
                        @enderror
                    </div>                
                    <div>
                        <label for="visitas">Visitas</label>
                        <input maxlength="5" id="visitas" wire:model="visitas" type="text" class="input-1 text-center">
                    </div>
                </div>
                
                <!--para que funcione correctamente, definir wire:model.live -->
                <div class="mt-2 p-2 border-gray-400 flex flex-row justify-center items-center border-[1px]">
                    <label class="mr-1 select-none">Pausado</label>
                    <input 
                        id="ck_pau" 
                        wire:model.live="pausado" 
                        type="checkbox"
                        class="bg-white border-gray-400 border-[1px] focus:ring-0 w-auto"
                    />
                </div>

                <!-- Mostrar un solo mensaje de error -->
                @if ($errors->any())
                    <div class="mt-3 p-3 bg-red-100 border border-red-400 rounded-lg text-red-700">
                        <p class="font-semibold">¡¡Completar la información pendiente!!</p>
                        <ul class="list-disc list-inside mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            
                <div class="mt-[1rem] flex justify-end space-x-2">
                    <button wire:click.stop="Cancelar()" class="btn-uno">Cancelar</button>
                    <button wire:click.stop="Grabar()" class="btn-uno">Grabar Datos</button>
                </div>
        
            </div>
                
        </div>
    </div>

</section>

</div>
