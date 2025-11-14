@extends('layouts.pltgral')

@section('contenidosPrincipales')
    <header class="bg-[#FEF0E9] w-full fixed top-0 left-0 z-50 flex flex-col">
        <div class="border-b-[2px] border-[#E9E9E9] md:mx-[5rem] pt-3 pb-4 md:pb-0 flex flex-row my-4 md:my-1 justify-between md:justify-end md:items-center">
            <div class="hidden md:block">
                @livewire('componentes.logo')
            </div>
            <div class="ml-[15px] w-[55%] md:w-[20%] md:ml-auto md:mr-4">
                @livewire('componentes.buscador')
            </div>
            <div class="flex items-center space-x-2 mr-[15px]">
                @livewire('componentes.usuarios.nuevousr')
                @livewire('componentes.carrito')
            </div>
        </div>
        <div class="flex items-center justify-between mx-4">
            <div class="md:hidden py-2">
                @livewire('componentes.logocel')
            </div>
            @livewire('componentes.Menutematico')
        </div>
    </header>
    <div class="h-[5.5rem] md:h-[11.6rem]"></div>
    @livewire('componentes.slider1', ['renderizar' => true])
    @livewire('componentes.catalogo', ['idCategoria' => 0])

    @livewire('componentes.suscriptores')
    @livewire('componentes.piedepaginas')

@endsection

