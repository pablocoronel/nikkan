@extends('layouts.administracion')

@section('nombreDeAccion', 'Lista usuarios')

@section('contenido')
    @include('adm.usuarios.listado')
@endsection