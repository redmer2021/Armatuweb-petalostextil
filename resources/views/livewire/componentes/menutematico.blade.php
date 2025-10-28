<div x-data="{ open: false }" class="bg-[#FEF0E9] py-1 md:w-full">
    <!-- 🔹 Botón hamburguesa (solo visible en móviles) -->
    <div class="flex items-center justify-center md:hidden">
        <button 
            @click="open = !open" 
            class="flex flex-col justify-center items-center w-10 h-10 border border-gray-400 rounded-lg"
        >
            <span class="block w-5 h-0.5 bg-black mb-1 transition-all duration-300" 
                  :class="open ? 'rotate-45 translate-y-1.5' : ''"></span>
            <span class="block w-5 h-0.5 bg-black mb-1 transition-all duration-300" 
                  :class="open ? 'opacity-0' : ''"></span>
            <span class="block w-5 h-0.5 bg-black transition-all duration-300" 
                  :class="open ? '-rotate-45 -translate-y-1.5' : ''"></span>
        </button>
    </div>

    <!-- 🔹 Menú horizontal (solo visible en escritorio) -->
    <div class="hidden md:flex md:space-x-6 md:justify-center">
        @foreach ($categorias as $categ)
            <button 
                wire:click="SelecCat({{ $categ->id }})"
                class="uppercase cursor-pointer hover:text-[#5D7857] h-auto p-2 text-md text-[#1F1F1F]"
            >
                {{ $categ->nombre }}
            </button>
        @endforeach
    </div>

    <!-- 🔹 Menú desplegable (solo visible cuando open=true en móvil) -->
    <div 
        x-show="open" 
        x-transition 
        class="absolute left-0 top-full w-full bg-[#FEF0E9] flex flex-col items-center space-y-4 py-4 z-50"
    >
        @foreach ($categorias as $categ)
            <button 
                wire:click="SelecCat({{ $categ->id }})" 
                class="uppercase cursor-pointer hover:text-[#5D7857] text-md text-[#1F1F1F]"
                @click="open = false"
            >
                {{ $categ->nombre }}
            </button>
        @endforeach
    </div>
</div>
