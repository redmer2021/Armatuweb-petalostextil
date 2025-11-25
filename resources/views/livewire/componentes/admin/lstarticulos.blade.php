<div class="mx-[1rem] md:mx-[4rem] overflow-x-auto pb-[10px]">

    <h1 class="text-2xl md:text-4xl font-bold mt-[1rem] mb-[3rem]">PANEL DE CONTROL</h1>

    <div class="flex space-x-2">
        @livewire('componentes.admin.articnuevo')
        @livewire('componentes.admin.editprecioenvios')
        @livewire('componentes.admin.lstventas')
        <button wire:click="CerrarSesion()" class="btn-uno">Cerrar Sesion</button>
    </div>

    <div class="mt-[1rem] grid gap-1 grid-cols-[140px_100px_100px_100px_300px_300px_300px_250px_100px_100px_80px_80px_80px_80px_100px]">
        <div class="grillas-celdas-1">ACCIONES</div>
        <div class="grillas-celdas-1">COD</div>
        <div class="grillas-celdas-1">CATEGORÍA</div>
        <div class="grillas-celdas-1">FOTO</div>
        <div class="grillas-celdas-1">NOMBRE</div>
        <div class="grillas-celdas-1">DESCRIPCIÓN</div>
        <div class="grillas-celdas-1">DESTACAR</div>
        <div class="grillas-celdas-1">COMPOSICIÓN KIT</div>
        <div class="grillas-celdas-1">MEDIDAS</div>
        <div class="grillas-celdas-1">PRECIO</div>
        <div class="grillas-celdas-1">PESO</div>
        <div class="grillas-celdas-1">% DESC</div>
        <div class="grillas-celdas-1">STOCK</div>
        <div class="grillas-celdas-1">VISITAS</div>
        <div class="grillas-celdas-1">PAUSADO</div>

        @foreach ($listArticulos as $it)
            <div class="grillas-celdas-2">
                <div class="flex space-x-2 h-[2rem] items-center">
                    @livewire('componentes.admin.articrevisar', ['id' => $it->id], key(uniqid()))
                    @livewire('componentes.admin.articeditar', ['id' => $it->id], key(uniqid()))
                    @livewire('componentes.admin.articpausar', ['id' => $it->id], key(uniqid()))
                    @livewire('componentes.admin.articeliminar', ['id' => $it->id], key(uniqid()))
                </div>
            </div>
            <div class="grillas-celdas-2">{{ $it->codigo }}</div>
            <div class="grillas-celdas-2">{{ $it->nomCategoria }}</div>
            <div class="grillas-celdas-2">
                @if ($it->nomFoto != '')
                    <img src="{{ asset('imgs/img_productos/' . $it->nomFoto )}}"
                    alt="Pétalos Textil"
                    class="h-[5rem] w-full object-cover rounded-lg">
                @else
                    <img 
                    src="{{ asset('imgs/img_sistema/sin_foto.jpg') }}" 
                    alt="Pétalos Textil" 
                    class="w-full h-full object-cover">
                @endif
            </div>
            <div class="grillas-celdas-2">{{ $it->nombre }}</div>
            <div class="grillas-celdas-3">{{ $it->descrip }}</div>
            <div class="grillas-celdas-3">{{ $it->caracDest }}</div>
            <div class="grillas-celdas-3">{{ $it->compoKit }}</div>
            <div class="grillas-celdas-2">{{ $it->medidas }}</div>
            <div class="grillas-celdas-2 justify-end">{{ number_format($it->precio, 2, '.', ',') }}</div>
            <div class="grillas-celdas-2 justify-center">{{ $it->peso }}</div>
            <div class="grillas-celdas-2 justify-center">{{ $it->descPorTransfer }}</div>
            <div class="grillas-celdas-2 justify-center">{{ $it->stockActual }}</div>
            <div class="grillas-celdas-2 justify-center">{{ $it->visitas }}</div>
            <div class="grillas-celdas-2 justify-center">
                {{ $it->pausado == 1 ? 'Sí' : 'No' }}
            </div>            
        @endforeach

    </div>

</div>
