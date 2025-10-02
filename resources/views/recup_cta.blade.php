@extends('layouts.pltgral')

@section('contenidosPrincipales')
    @livewire('componentes.generarpassword', ['token' => $token])
@endsection

