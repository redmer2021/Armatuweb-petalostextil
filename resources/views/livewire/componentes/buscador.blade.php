<div class="border-1 rounded-[50px] flex items-center px-[1rem]">
    <input wire:model="txtabuscar" type="text" class="bg-transparent block w-full px-2 text-[16px] focus:outline-none focus:ring-0" placeholder="¿Que buscabas...? ">
    <button wire:click="BuscarPorNombre()" class="p-2 cursor-pointer">
        <img src="{{ asset('imgs/lupa.png') }}" alt="Buscar" class="w-8">
    </button>
</div>
