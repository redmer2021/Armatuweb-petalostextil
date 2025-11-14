<div>
    <img wire:click="VerForm()" title="Eliminar" src="{{ asset('imgs/img_sistema/eliminar.png') }}" alt="Revisar" class="cursor-pointer h-[1.5rem] w-[1.5rem]" />

    <section 
        class="ventanaModal" 
        x-cloak 
        x-show="verForm = $wire.verForm" 
        x-transition.duration.0ms
        x-effect="document.body.classList.toggle('overflow-hidden', $wire.verForm)"
    >
    <div class="ventanaInterna_6">
        <h3 class="text-2xl mb-3">ELIMINANDO ARTÍCULO</h3>
        <p class="text-lg break-words whitespace-normal w-full mb-3">Ha indicado ELIMINAR el artículo {{ $articulo->codigo }} - {{ $articulo->nombre }}. ¿Confirma esta solicitud?</p>

        @if ($msgUsr != '')
            <p class="text-lg break-words whitespace-normal w-full italic text-red-500">{{ $msgUsr }} </p>
        @endif

        <div class="flex justify-end space-x-3 mt-[2rem]">
            <button wire:click.stop="Si()" class="btn-uno">Si</button>
            <button wire:click.stop="No()" class="btn-uno">No</button>
        </div>
    </div>
</section>
</div>
