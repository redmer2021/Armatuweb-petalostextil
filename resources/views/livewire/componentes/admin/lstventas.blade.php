<div>
    <button wire:click="VerForm()" class="btn-uno">Ventas</button>

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
            <span class="text-2xl mb-3">LISTADO DE VENTAS</span>
            <div class="h-[30rem] overflow-x-auto overflow-y-auto">
                <!--                                        1    2     3     4     5     6     7     8     9 -->
                <div class="mt-[1rem] grid gap-1 grid-cols-[90px_100px_110px_150px_200px_200px_250px_150px_150px]">
                    <div class="grillas-celdas-1">ACCIONES</div>        <!-- 1 -->
                    <div class="grillas-celdas-1">FECHA</div>           <!-- 2 -->
                    <div class="grillas-celdas-1">NRO-VENTA</div>       <!-- 3 -->
                    <div class="grillas-celdas-1">ESTADO</div>          <!-- 4 -->
                    <div class="grillas-celdas-1">NOMBRE</div>          <!-- 5 -->
                    <div class="grillas-celdas-1">APELLIDO</div>        <!-- 6 -->
                    <div class="grillas-celdas-1">EMAIL</div>           <!-- 7 -->
                    <div class="grillas-celdas-1">FORMA DE PAGO</div>   <!-- 8 -->
                    <div class="grillas-celdas-1">TOTAL</div>           <!-- 9 -->

                    @foreach ($listVentas as $it)
                        <div class="grillas-celdas-2 flex justify-center space-x-2">
                            @livewire('componentes.admin.pedidover', ['id' => $it->id], key(uniqid()))
                            @livewire('componentes.admin.pedidoconfirmaenvio', ['id' => $it->id], key(uniqid()))
                        </div>
                        <div class="grillas-celdas-2 justify-center items-center">{{ $it->fecVenta  ? \Carbon\Carbon::parse($it->fecVenta)->format('d/m/Y') : '' }}</div>
                        <div class="grillas-celdas-2 justify-center items-center">{{ $it->nroVenta }}</div>
                        <div class="grillas-celdas-2 items-center">{{ $it->estadoDesc }}</div>
                        <div class="grillas-celdas-2 items-center">{{ $it->dtosFacNombre }}</div>
                        <div class="grillas-celdas-2 items-center">{{ $it->dtosFacApellido }}</div>
                        <div class="grillas-celdas-2 items-center">{{ $it->dtosFacCorreoE }}</div>
                        <div class="grillas-celdas-2 items-center">{{ $it->formaDePagoDesc }}</div>
                        <div class="grillas-celdas-2 items-center justify-end">$ {{ number_format($it->totalPedido, 2, '.', ',') }}</div>
                    @endforeach 
        
                </div>
            </div>  
        </div>
    </section>

</div>
