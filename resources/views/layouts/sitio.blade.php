@extends('layouts.principal')

@section('scriptsSuperior')
    <link rel="stylesheet" href="{{asset('css/layout.css')}}">
@endsection

@section('contenidoPadre')
	@yield('contenido')
@endsection

@section('scriptsInferior')

@endsection