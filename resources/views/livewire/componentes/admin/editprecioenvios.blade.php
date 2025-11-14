<div>
    <button wire:click="VerForm()" class="btn-uno">Editar Precios de Envíos</button>

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
            <span class="text-2xl mb-3">EDICIÓN DE LOS PRECIOS DE ENVÍOS</span>
            <div class="h-[30rem] overflow-x-hidden overflow-y-auto">
                <div class="mt-[1rem] grid gap-1 grid-cols-[130px_100px_auto_150px_150px]">
                    <div class="grillas-celdas-1">ACCIONES</div>
                    <div class="grillas-celdas-1">ID-PROV</div>
                    <div class="grillas-celdas-1">NOMBRE</div>
                    <div class="grillas-celdas-1">IMPORTE ENV</div>
                    <div class="grillas-celdas-1">ULT-ACT</div>
    
                    @foreach ($tb_provincias as $provincia)
                        <div class="flex justify-center">
                            @livewire('componentes.admin.modifprecioenvio', ['idProvincia' => $provincia->id], key(uniqid()))
                        </div>
                        <div class="grillas-celdas-2 justify-center items-center">{{ $provincia->id }}</div>
                        <div class="grillas-celdas-2 items-center">{{ $provincia->nombre }}</div>
                        <div class="grillas-celdas-2 items-center justify-end">{{ number_format($provincia->impoEnvio, 2, '.', ',') }}</div>
                        <div class="grillas-celdas-2 items-center justify-center">{{ $provincia->updated_at ? \Carbon\Carbon::parse($provincia->updated_at)->format('d/m/Y') : '' }}</div>
                    @endforeach
        
                </div>
            </div>  
        </div>
    </section>

</div>
