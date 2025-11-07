<div class="pb-[1rem] shadow-md mb-[2rem]">
    <div class="grid grid-cols-12">
        <div class="col-span-2 row-span-2 flex justify-center">
            <div class="h[7rem] w-[7rem]">
                <img src="{{ asset('imgs/img_productos/' . $item->nomFoto) }}" 
                    alt="Pétalos Textil" 
                    class="object-cover">
            </div>
        </div>
        <div class="pl-[1rem] col-span-7 flex justify-start items-center">
            <span class="text-[1rem] font-bold block text-center">{{ $item->nombre }}</span>
        </div>
        <div class="col-span-3 flex items-center justify-end pr-2">
            <img src="{{ asset('imgs/img_sistema/eliminar.png') }}" alt="Eliminar" wire:click="Eliminar()" class="cursor-pointer h-[1.4rem] md:h-[2.5rem] w-auto">
        </div>

        <div class="pl-[1rem] col-span-7 flex justify-start items-center">

            <div class="flex-row justify-center items-center p-1 md:px-[2rem]">
                <div class="flex justify-center items-center">
                    <img src="{{ asset('imgs/img_sistema/restar.png') }}" alt="Restar" wire:click="Restar()" class="cursor-pointer h-[1.5rem] md:h-[1.3rem] w-auto">
                    <span class="text-lg font-bold mx-4">{{ $unidades }}</span>
                    <img src="{{ asset('imgs/img_sistema/sumar.png') }}" alt="Sumar" wire:click="Sumar()" class="cursor-pointer h-[1.5rem] md:h-[1.3rem] w-auto">
                    <span class="ml-2 text-xs" >Stock: {{ $item->stockActual }}</span>
                </div>
            </div>
        </div>
        <div class="col-span-3 flex justify-end items-center pr-2">
            <span class="text-[12px]" >$ {{ number_format($totalItems, 2, '.', ',') }}</span>
        </div>
    </div>
</div>
