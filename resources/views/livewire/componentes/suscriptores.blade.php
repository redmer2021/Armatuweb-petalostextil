<section class="bg-[#FEF0E9]  flex flex-col px-5 py-[5rem] md:px-20 md:py-[5rem]"
    x-data="{ mostrarMensaje: false }"
    x-init="@this.on('mensaje-enviado', () => { 
        mostrarMensaje = true; 
        setTimeout(() => mostrarMensaje = false, 5000); 
    })">
    <p class="text-[#1F1F1F] text-[1.5rem] md:text-[2.5rem] ">Recibe en tu mail todas nuestras ofertas</p>
    <p class="text-[#1F1F1F] text-md mb-[1rem] ">Déjanos tu e-mail y te enviaremos todas nuestras ofertas, promos y nuevos productos</p>
    <div class="w-[95%] md:w-[50%] flex items-start rounded-md">
        <div class="flex flex-col flex-1 mr-[1rem]"> 
            <input wire:model="txtEmail" 
                type="text" 
                class="block p-2 w-full bg-[#FEF0E9] border-[#1F1F1F] 
                    @error('txtEmail') border-red-500 @else border-[#1F1F1F] @enderror 
                    border-[1px] rounded-md text-lg focus:outline-none focus:ring-0" 
                    placeholder="Ingresa tu email...">
    
            @error('txtEmail')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>                        
            @enderror
        </div>
    
        <button wire:click="GrabarMail()" 
            class="self-start h-[45px] p-2 text-white px-[2rem] cursor-pointer bg-[#5D7857] hover:bg-[#405D39]">
            Enviar
        </button>
    </div>
        <div 
        x-show="mostrarMensaje"
        x-transition
        class="text-[#405D39] mt-3 text-lg font-semibold">
        {{ $mensajeConfirmacion }}
    </div>    

</section>


