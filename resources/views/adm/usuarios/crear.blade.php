@extends('layouts.administracion')

@section('nombreDeAccion', 'Crear usuario')

@section('contenido')
    @include('adm.usuarios.formulario')
@endsection