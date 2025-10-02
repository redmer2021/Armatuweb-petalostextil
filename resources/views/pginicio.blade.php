@extends('layouts.pltgral')

@section('contenidosPrincipales')

    <header class="w-full fixed top-0 left-0 z-50">
        <div class="w-auto bg-[#ccd5ae] py-2  border-b border-b-gray-300">
            <div class="max-w-6xl mx-auto h-full flex items-center justify-between px-4">
                <div>                    
                    @livewire('componentes.logo')
                </div>
                <div class="flex gap-6">
                    @livewire('componentes.nuevousr')
                    @livewire('componentes.carrito')
                </div>
            </div>
        </div>
    </header>
    <div class="h-[5.5rem] md:h-[9rem]"></div>
    @livewire('componentes.catalogo')
    @livewire('componentes.suscriptores')
    @livewire('componentes.piedepaginas')
@endsection

