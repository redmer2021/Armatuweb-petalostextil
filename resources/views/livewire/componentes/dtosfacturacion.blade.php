<div class="mx-2 md:mx-[15rem] flex flex-col md:flex-row gap-7 mb-[5rem]">
    <div class="p-2 md:p-[2rem] rounded-md border border-[#E9E9E9] md:w-1/2">
        <span class="mb-4 block text-md">DATOS DE FACTURACIÓN</span> 

        <div class="grid grid-cols-2 gap-2">
            <div>
                <label for="dtosFacNombre" class="text-md">Nombre</label>
                <input id="dtosFacNombre" maxlength="100" wire:model="dtosFacNombre" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dtosFacNombre') border-red-500 @else border-gray-400 @enderror  focus:outline-none focus:ring-0">
            </div>
            <div>
                <label for="dtosFacApellido" class="text-md">Apellido</label>
                <input id="dtosFacApellido" maxlength="50" wire:model="dtosFacApellido" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dtosFacApellido') border-red-500 @else border-gray-400 @enderror  focus:outline-none focus:ring-0">
            </div>
        </div>

        <div class="grid grid-cols-1 mt-4">
            <div>
                <label for="dtosFacDireccion" class="text-md">Dirección (indicar calle y altura)</label>
                <input id="dtosFacDireccion" maxlength="150" wire:model="dtosFacDireccion" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dtosFacDireccion') border-red-500 @else border-gray-400 @enderror  focus:outline-none focus:ring-0">
            </div>
        </div>

        <div class="grid grid-cols-1 mt-4">
            <div>
                <label for="dtosFacProvincia" class="text-md">Provincia</label>
                <select wire:model.live="dtosFacProvincia" class="text-md py-1 w-full border-[1px] @error('dtosFacProvincia') border-red-500 @else border-gray-400 @enderror " name="dtosFacProvincia" id="dtosFacProvincia">
                    <option value="0">Seleccionar Provincia...</option>
                    @foreach ($tb_provincias as $provincia)
                        <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>                                    
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-[75%_auto] gap-2 mt-4">
            <div>
                <label for="dtosFacLocCiudad" class="text-md">Localidad / Ciudad</label>
                <input id="dtosFacLocCiudad" maxlength="150" wire:model="dtosFacLocCiudad" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dtosFacLocCiudad') border-red-500 @else border-gray-400 @enderror  focus:outline-none focus:ring-0">
            </div>
            <div>
                <label for="dtosFacCodPostal" class="text-md">C.P.</label>
                <input id="dtosFacCodPostal" maxlength="8" wire:model="dtosFacCodPostal" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dtosFacCodPostal') border-red-500 @else border-gray-400 @enderror  focus:outline-none focus:ring-0">
            </div>
        </div>

        <div class="grid grid-cols-1 mt-4">
            <div>
                <label for="dtosFacTelefono" class="text-md">Teléfono</label>
                <input id="dtosFacTelefono" maxlength="100" wire:model="dtosFacTelefono" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dtosFacTelefono') border-red-500 @else border-gray-400 @enderror  focus:outline-none focus:ring-0">
            </div>
        </div>

        <div class="grid grid-cols-1 mt-4">
            <div>
                <label for="dtosFacCorreoE" class="text-md">Correo Electrónico</label>
                <input id="dtosFacCorreoE" maxlength="150" wire:model="dtosFacCorreoE" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dtosFacCorreoE') border-red-500 @else border-gray-400 @enderror  focus:outline-none focus:ring-0">
            </div>
        </div>

        <label class="inline-flex items-center cursor-pointer mt-[2rem] mb-2">
            <input wire:model.live="usarDireccionAlternativa" type="checkbox" class="form-checkbox h-5 w-5" id="altAddress" name="altAddress">
            <span class="ml-3">Enviar a una dirección alternativa</span>
        </label>

        <div x-data x-cloak>
            @if($usarDireccionAlternativa)
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label for="dtosAltNombre" class="text-md">Nombre</label>
                        <input id="dtosAltNombre" maxlength="100" wire:model="dtosAltNombre" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dtosAltNombre') border-red-500 @else border-gray-400 @enderror  focus:outline-none focus:ring-0">
                    </div>
                    <div>
                        <label for="dtosAltApellido" class="text-md">Apellido</label>
                        <input id="dtosAltApellido" maxlength="50" wire:model="dtosAltApellido" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dtosAltApellido') border-red-500 @else border-gray-400 @enderror  focus:outline-none focus:ring-0">
                    </div>
                </div>
        
                <div class="grid grid-cols-1 mt-4">
                    <div>
                        <label for="dtosAltDireccion" class="text-md">Dirección (indicar calle y altura)</label>
                        <input id="dtosAltDireccion" maxlength="150" wire:model="dtosAltDireccion" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dtosAltDireccion') border-red-500 @else border-gray-400 @enderror  focus:outline-none focus:ring-0">
                    </div>
                </div>
        
                <div class="grid grid-cols-1 mt-4">
                    <div>
                        <label for="dtosAltProvincia" class="text-md">Provincia</label>
                        <select wire:model.live="dtosAltProvincia" class="text-md py-1 w-full border-[1px] @error('dtosAltProvincia') border-red-500 @else border-gray-400 @enderror " name="dtosAltProvincia" id="dirProvincia">
                            <option value="0">Seleccionar Provincia...</option>
                            @foreach ($tb_provincias as $provincia)
                                <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>                                    
                            @endforeach
                        </select>
                    </div>
                </div>
        
                <div class="grid grid-cols-[75%_auto] gap-2 mt-4">
                    <div>
                        <label for="dtosAltLocCiudad" class="text-md">Localidad / Ciudad</label>
                        <input id="dtosAltLocCiudad" maxlength="150" wire:model="dtosAltLocCiudad" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dtosAltLocCiudad') border-red-500 @else border-gray-400 @enderror  focus:outline-none focus:ring-0">
                    </div>
                    <div>
                        <label for="dtosAltCodPostal" class="text-md">C.P.</label>
                        <input id="dtosAltCodPostal" maxlength="8" wire:model="dtosAltCodPostal" type="text" class="w-full px-2 py-1 text-md border-[1px] @error('dtosAltCodPostal') border-red-500 @else border-gray-400 @enderror  focus:outline-none focus:ring-0">
                    </div>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 mt-4">
            <div>
                <label for="dtosFacNotas" class="text-md">Notas y/o aclaraciones sobre este pedido</label>
                <textarea maxlength="1500" id="dtosFacNotas" wire:model="dtosFacNotas" class="textarea-1"></textarea>
            </div>
        </div>
        
    </div>

    <div class="flex flex-col gap-7 md:w-1/2">
        <div class="p-2 md:p-[2rem] rounded-md border border-[#E9E9E9]">
            <span class="mb-4 block text-md">RESUMEN DE TU PEDIDO</span>
            <div class="grid grid-cols-[65%_10%_auto] gap-1">
                <div class="text-md px-1 p-1 bg-[#fef0e9]">Producto</div>
                <div class="text-md px-1 p-1 bg-[#fef0e9] text-center">Un</div>
                <div class="text-md px-1 p-1 bg-[#fef0e9] text-right">Subtotal</div>
    
                @foreach ($carrito as $item)
                    <div class="bg-gray-100 text-md p-1">{{ $item->nombre }}</div>
                    <div class="bg-gray-100 text-md p-1 text-center"> {{ $item->cantidad }}</div>
                    <div class="bg-gray-100 text-md p-1 text-right">$ {{ number_format(($item->cantidad * $item->precioUnit), 2, '.', ',') }}</div>
                @endforeach
    
                <div class="bg-gray-300 col-span-2 p-1 ">Total Productos</div>
                <div class="bg-gray-300 text-right p-1">$ {{ number_format(($totalPrecio), 2, '.', ',') }}</div>
    
                <div class="col-span-3">
                    <span class="mt-10 mb-2 block text-md">FORMA DE ENVÍO</span>
                </div>
    
                <div class="col-span-2">
                    <div class="flex flex-col">
                        <div>
                            <input class="cursor-pointer mr-2" wire:model.live="tipEnvio" value="1" id="op1" type="radio" name="tipEnvio">
                            <label for="op1" class="cursor-pointer text-md">Correo Argentino</label>
                        </div>
                    </div>
                </div>
                @if ($tipEnvio==1)
                    <div class="text-right">$ {{ number_format(($totEnvioDom), 2, '.', ',') }}</div>                
                @endif
    
                <div class="col-span-2">
                    <div class="flex flex-col">
                        <div>
                            <input class="cursor-pointer mr-2" wire:model.live="tipEnvio" value="2" id="op2" type="radio" name="tipEnvio">
                            <label for="op2" class="cursor-pointer text-md">Moto solo en CABA</label>
                        </div>
                    </div>
                </div>
                @if ($tipEnvio==2)
                    <div class="text-right">$ {{ number_format(($totEnvioDom), 2, '.', ',') }}</div>                
                @endif
    
                <div class="col-span-2 mb-3">
                    <div class="flex flex-col">
                        <div>
                            <input class="cursor-pointer mr-2" wire:model.live="tipEnvio" value="3" id="op3" type="radio" name="tipEnvio">
                            <label for="op3" class="cursor-pointer text-md">Punto de Entrega - Caballito - CABA</label>
                        </div>
                    </div>
                </div>
    
                @if ($tipEnvio==3)
                    <div class="text-right">$ {{ number_format(($totEnvioDom), 2, '.', ',') }}</div>                
                @endif
                
                <div class="col-span-3">
                    @if ($msgError!='')
                        <p class="px-2 py-1 bg-red-400 text-white font-bold rounded-md"> {{ $msgError }}</p>
                    @endif
                </div>
    
                @if ($totDescuTransfer > 0)
                    <div class="bg-gray-300 p-1 mt-4 col-span-2" >Descuento por transferencia:</div>
                    <div class="bg-gray-300 p-1 mt-4 text-right">$ {{ number_format(($totDescuTransfer), 2, '.', ',') }}</div>
                @endif

                <div class="bg-gray-300 p-1 col-span-2" >Total:</div>
                <div class="bg-gray-300 p-1 text-right">$ {{ number_format(($totalFinal - $totDescuTransfer), 2, '.', ',') }}</div>
                
            </div>
    
        </div>
        <div class="p-2 md:p-[2rem] rounded-md border border-[#E9E9E9]">
            <span class="mb-4 block text-md">FORMA DE PAGO</span>
    
            <div class="mb-[2rem] md:mb-0">
                <div class="px-3 py-4 border border-[#E9E9E9] rounded-md flex flex-col">
                    <div class="flex justify-between items-center">
                        <div class="flex justify-start items-center">
                            <input class="cursor-pointer mr-2" wire:model.live="tipPago" value="1" id="tipPago" type="checkbox" name="tipPago">
                            <label for="tipPago" class="cursor-pointer text-md">Transferencia</label>
                        </div>
                        <span class="text-md">{{ $pjeDescTransfer }}% de descuento</span>
                    </div>
                    @if ($tipPago)
                        <span class="pl-[1rem] text-md mt-[1rem]">CBU: 0110599530000045849333</span>
                        <span class="pl-[1rem] text-md">Alias: rene.merlo</span>
                        <span class="pl-[1rem] text-md">A nombre de: MERLO RENE DANIEL</span>
                        <span class="pl-[1rem] text-md">CUIL: 20-20073000-4</span>
                        <span class="pl-[1rem] text-md">Enviar comprobante a rmerlo@gmail.com</span>
                        <span class="px-3 mt-[1rem] font-bold italic text-[#405D39] text-md">¡¡Por favor, transferir el monto exacto. Una vez que se acredite el importe, te avisaremos por e-mail!!</span>
                        <button wire:click="Aceptar()" class="mt-[1rem] cursor-pointer bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200 font-bold px-5 py-2 text-white text-md">Aceptar</button>
                    @endif
                </div>
    
                @if (!$tipPago)
                    <div wire:click="IniciarPago2()" class="p-4 border border-[#E9E9E9] rounded-md flex items-center mt-3">
                        <img src="{{ asset('imgs/img_sistema/Mercado_Pago.png') }}" alt="Pagar" class="h-[2rem] w-auto">
                        <button class="flex-1 cursor-pointer bg-[#5D7857] hover:bg-[#405D39] transition-colors duration-200 font-bold px-5 py-2 text-white text-md">Mercado Pago</button>
                    </div>
                @endif        
            </div>
    
            @if ($errors->any())
                <ul class="text-red-600 text-sm font-semibold mt-[2rem] list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
    
        </div>
    </div>
</div>

@script
    <script>
        window.addEventListener('eliminar-uuid', event => {
            localStorage.setItem('carrito_uuid', '');
        });
    </script>
@endscript
