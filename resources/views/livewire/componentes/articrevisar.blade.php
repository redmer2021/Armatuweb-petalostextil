<div>
    <img wire:click="VerForm()" title="Revisar" src="{{ asset('imgs/ojo.png') }}" alt="Revisar" class="cursor-pointer h-[1.5rem] w-[1.5rem]" />

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
                class="absolute right-6 cursor-pointer">
                <span>REVISIÓN DE DATOS</span>
        </div>
    </section>
</div>
