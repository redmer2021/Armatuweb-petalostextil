<div>
    <img wire:click="VerForm()" title="Ver Pedido" src="{{ asset('imgs/img_sistema/ojo.png') }}" alt="Revisar" class="cursor-pointer h-[1.5rem] w-[1.5rem]"/>

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
                <span class="text-2xl font-bold mb-3">REVISIÓN DE DATOS</span>

                <div class="flex flex-col md:flex-row gap-3 mb-[5rem]">
                    <div class="p-2 md:p-[2rem] rounded-md border border-[#E9E9E9] md:w-1/2 h-[41rem] overflow-y-auto">

                        <div class="flex justify-between items-center mb-3">
                            <label for="dtosFacNombre" class="w-[12rem] text-sm">Número de Pedido:</label>
                            <input id="dtosFacNombre" wire:model="nroPedido" readonly type="text" class="input-1 text-xl">
                        </div>
                        <div class="flex justify-between items-center mb-[2rem]">
                            <label for="dtosFacNombre" class="w-[12rem] text-sm">Estado:</label>
                            <input id="dtosFacNombre" wire:model="estado" readonly type="text" class="input-1 text-xl">
                        </div>

                        <span class="mb-2 block text-lg font-bold">DATOS DE FACTURACIÓN</span> 

                        <div class="flex flex-col mb-3">
                            <label for="dtosFacNombre" class="text-sm">Nombre</label>
                            <input id="dtosFacNombre" wire:model="dtosFacNombre" readonly type="text" class="input-1 text-xl">
                        </div>
                        <div class="flex flex-col mb-3">
                            <label for="dtosFacApellido" class="text-sm">Apellido</label>
                            <input id="dtosFacApellido" wire:model="dtosFacApellido" type="text" class="input-1 text-xl" readonly>
                        </div>

                        <div class="flex flex-col mb-3">
                            <label for="dtosFacDireccion" class="text-sm">Dirección</label>
                            <input id="dtosFacDireccion" wire:model="dtosFacDireccion" type="text" class="input-1 text-xl" readonly>
                        </div>

                        <div class="flex flex-col mb-3">
                            <label for="dtosFacProvincia" class="text-sm">Provincia</label>
                            <input id="dtosFacProvincia" wire:model="dtosFacProvincia" type="text" class="input-1 text-xl" readonly>
                        </div>

                        <div class="grid grid-cols-[75%_auto] gap-2 mb-3">
                            <div class="flex flex-col">
                                <label for="dtosFacLocCiudad" class="text-sm">Localidad / Ciudad</label>
                                <input id="dtosFacLocCiudad" wire:model="dtosFacLocCiudad" type="text" class="input-1 text-xl" readonly>
                            </div>
                            <div class="flex flex-col">
                                <label for="dtosFacCodPostal" class="text-sm">C.P.</label>
                                <input id="dtosFacCodPostal" wire:model="dtosFacCodPostal" type="text" class="input-1 text-xl" readonly>
                            </div>
                        </div>

                        <div class="flex flex-col mb-3">
                            <label for="dtosFacTelefono" class="text-sm">Teléfono</label>
                            <input id="dtosFacTelefono"  wire:model="dtosFacTelefono" type="text" class="input-1 text-xl" readonly>
                        </div>

                        <div class="flex flex-col mb-3">
                            <label for="dtosFacCorreoE" class="text-sm">Correo Electrónico</label>
                            <input id="dtosFacCorreoE" wire:model="dtosFacCorreoE" type="text" class="input-1 text-xl" readonly>
                        </div>

                        <span class="text-lg font-bold block mb-2 mt-[2rem]">DIRECCIÓN ALTERNATIVA</span>

                        <div class="flex flex-col mb-3">
                            <label for="dtosAltNombre" class="text-sm">Nombre</label>
                            <input id="dtosAltNombre"  wire:model="dtosAltNombre" type="text" class="input-1 text-xl" readonly>
                        </div>
                        <div class="flex flex-col mb-3">
                            <label for="dtosAltApellido" class="text-sm">Apellido</label>
                            <input id="dtosAltApellido" wire:model="dtosAltApellido" type="text" class="input-1 text-xl" readonly>
                        </div>
                        
                        <div class="flex flex-col mb-3">
                            <label for="dtosAltDireccion" class="text-sm">Dirección</label>
                            <input id="dtosAltDireccion" wire:model="dtosAltDireccion" type="text" class="input-1 text-xl" readonly>
                        </div>
                        
                        <div class="flex flex-col mb-3">
                            <label for="dtosAltProvincia" class="text-sm">Provincia</label>
                            <input id="dtosAltProvincia" wire:model="dtosAltProvincia" type="text" class="input-1 text-xl" readonly>
                        </div>
                        
                        <div class="grid grid-cols-[75%_auto] gap-2 mb-3">
                            <div class="flex flex-col">
                                <label for="dtosAltLocCiudad" class="text-sm">Localidad / Ciudad</label>
                                <input id="dtosAltLocCiudad" wire:model="dtosAltLocCiudad" type="text" class="input-1 text-xl" readonly>
                            </div>
                            <div class="flex flex-col">
                                <label for="dtosAltCodPostal" class="text-sm">C.P.</label>
                                <input id="dtosAltCodPostal" wire:model="dtosAltCodPostal" type="text" class="input-1 text-xl" readonly>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <label for="dtosFacNotas" class="text-sm">Notas y/o aclaraciones sobre este pedido</label>
                            <textarea maxlength="1500" id="dtosFacNotas" wire:model="dtosFacNotas" class="textarea-1 text-xl"></textarea>
                        </div>
                        
                    </div>

                    <div class="flex flex-col gap-3 md:w-1/2">
                        <div class="p-2 md:p-[2rem] rounded-md border border-[#E9E9E9]">
                            <span class="mb-2 block text-lg font-bold ">RESUMEN DE TU PEDIDO</span>
                            <div class="grid grid-cols-[65%_10%_auto] gap-1">
                                <div class="text-md px-1 p-1 bg-[#fef0e9]">Producto</div>
                                <div class="text-md px-1 p-1 bg-[#fef0e9] text-center">Un</div>
                                <div class="text-md px-1 p-1 bg-[#fef0e9] text-right">Subtotal</div>
                    
                                @foreach ($carrito as $item)
                                    <div class="bg-gray-100 text-xl p-1">{{ $item->nombre }}</div>
                                    <div class="bg-gray-100 text-xl p-1 text-center"> {{ $item->cantidad }}</div>
                                    <div class="bg-gray-100 text-xl p-1 text-right">$ {{ number_format(($item->cantidad * $item->precioUnit), 2, '.', ',') }}</div>
                                @endforeach
                    
                                <div class="bg-gray-300 col-span-2 p-1 text-lg ">Total Productos</div>
                                <div class="bg-gray-300 text-right p-1 text-lg">$ {{ number_format(($totalProductos), 2, '.', ',') }}</div> 
                    
                                <div class="col-span-3">
                                    <span class="mt-10 mb-2 block text-lg font-bold">FORMA DE ENVÍO</span>
                                </div>
                    
                                @if ($enviarPor==1)
                                    <div class="col-span-3">
                                        <div class="flex justify-between">
                                            <label class="text-lg">Correo Argentino</label>
                                            <div class="text-right text-lg">$ {{ number_format(($totalEnvio), 2, '.', ',') }}</div>                
                                        </div>
                                    </div>
                                @endif

                                @if ($enviarPor==2)
                                    <div class="col-span-3">
                                        <div class="flex justify-between">
                                            <label class="text-lg">Moto</label>
                                            <div class="text-right text-lg">$ {{ number_format(($totalEnvio), 2, '.', ',') }}</div>                
                                        </div>
                                    </div>
                                @endif

                                @if ($enviarPor==3)
                                    <div class="col-span-3">
                                        <div class="flex justify-between">
                                            <label class="text-lg">Punto de Entrega</label>
                                            <div class="text-right text-lg">$ {{ number_format(($totalEnvio), 2, '.', ',') }}</div>                
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="text-lg bg-gray-300 p-1 mt-4 col-span-2" >Total descuento por transfer:</div>
                                <div class="text-lg bg-gray-300 p-1 mt-4 text-right">$ {{ number_format(($totalDescTransfer), 2, '.', ',') }}</div>
                                <div class="text-lg bg-gray-300 p-1 col-span-2" >Total:</div>
                                <div class="text-lg bg-gray-300 p-1 text-right">$ {{ number_format(($totalPedido), 2, '.', ',') }}</div>
                                
                            </div>
                    
                        </div>
                        <div class="p-2 md:px-[2rem] md:py-[1rem] rounded-md border border-[#E9E9E9]">
                            <span class="mb-2 block text-lg font-bold">FORMA DE PAGO</span>

                            @if ($formaDePago==1)
                                <div class="col-span-3">
                                    <label class="text-lg">Transferencia</label>
                                </div>
                            @endif
                            @if ($formaDePago==2)
                                <div class="col-span-3">
                                    <label class="text-lg">Mercado Pago</label>
                                </div>
                            @endif
                                                                
                        </div>
                    </div>

                </div>

        </div>
    </section>
</div>
