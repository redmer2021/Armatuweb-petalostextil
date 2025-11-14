@extends('layouts.pltgral')

@section('contenidosPrincipales')
    @livewire('componentes.usuarios.generarpassword', ['token' => $token])
@endsection

