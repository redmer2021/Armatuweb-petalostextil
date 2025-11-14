<div>
    <button wire:click="VerForm()" class="btn-uno">Modificar</button>

    <section 
        class="ventanaModal" 
        x-cloak 
        x-show="$wire.verForm"
        x-transition.duration.0ms
        x-effect="document.body.classList.toggle('overflow-hidden', $wire.verForm)"
    >
        <div class="ventanaInterna_6">
            <h3 class="text-2xl mb-3">MODIFICANDO PRECIO DE ENVÍO</h3>
            <p class="text-lg break-words whitespace-normal w-full mb-3">Precio de envío a {{ $dtosProvincia->nombre }}  </p>

            <div class="flex space-x-[2rem] items-center">
                <label for="impoEnvio" class="whitespace-nowrap">Nuevo Precio: </label>
                @error('impoEnvio') 
                    <input 
                        id="impoEnvio" 
                        wire:model="impoEnvio" 
                        type="text" 
                        maxlength="20" 
                        class="input-1-err text-right">
                @else
                    <input
                        id="impoEnvio" 
                        wire:model="impoEnvio" 
                        type="text" 
                        class="input-1 text-right" 
                        maxlength="20"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(',', '.');">
                @enderror                        
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

            <div class="flex justify-end space-x-3 mt-[2rem]">
                <button wire:click.stop="Cancelar()" class="btn-uno">Cancelar</button>
                <button wire:click.stop="Confirmar()" class="btn-uno">Confirmar</button>
            </div>

        </div>

    </section>

</div>
