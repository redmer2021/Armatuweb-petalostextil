<div>

    <img @if($estado == 1) wire:click="VerForm()" @endif title="Confirmar Envío" src="{{ asset('imgs/img_sistema/orden-confirmada.png') }}" alt="Revisar" class="@if($estado == 1) cursor-pointer @else cursor-not-allowed @endif  h-[1.4rem] w-[1.4rem]"/>

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
                <span class="text-2xl font-bold mb-3">CONFIRMACIÓN DE DESPACHO DEL PEDIDO</span>

            <div class="flex flex-col mt-[2rem]">
                <label for="msgComprador" class="text-sm">Mensajes al comprador</label>
                <textarea maxlength="1500" id="msgComprador" wire:model="msgComprador" class="textarea-1 text-xl"></textarea>
            </div>
            <div class="flex flex-col mt-[2rem]">
                <label for="linkSeguimiento" class="text-sm">Link de seguimiento</label>
                <textarea maxlength="1500" id="linkSeguimiento" wire:model="linkSeguimiento" class="textarea-1 text-xl"></textarea>
            </div>

            <div class="flex justify-end">
                <button wire:click="EnviarMail()" class="mt-[2rem] cursor-pointer bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200 px-[4rem] h-full py-3 text-white">Enviar Mail</button>
            </div>

        </div>
    </section>
</div>
