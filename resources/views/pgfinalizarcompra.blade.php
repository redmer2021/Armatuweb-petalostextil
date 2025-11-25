@extends('layouts.pltgral')

@section('contenidosPrincipales')
    <header class="bg-[#FEF0E9] w-full fixed top-0 left-0 z-50 flex flex-col pr-6 md:pr-0">
        <div class="md:mx-[5rem] pt-3 pb-4 md:pb-0 flex flex-row my-4 md:my-1 items-center">
            <div class="hidden md:block">
                @livewire('componentes.logo')
            </div>
            <span class="text-[20px] md:text-4xl absolute left-[7rem] md:left-1/2 transform -translate-x-1/2">Finalizar Compra</span>
            <div class="ml-auto">
                <a class="cursor-pointer 
                    bg-[#5D7857] 
                    hover:bg-[#405D39] 
                    transition-colors 
                    duration-200 
                    font-bold 
                    px-5 
                    py-3 
                    text-white 
                    text-md" href="{{url('/')}}">
                Volver a la tienda
                </a>
            </div>
        </div>
    </header>
    <div class="h-[12rem]"></div>
    @livewire('componentes.dtosfacturacion')
    @livewire('componentes.piedepaginas')

@endsection
