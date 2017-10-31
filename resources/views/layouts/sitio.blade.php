@extends('layouts.principal')

@section('scriptsSuperior')
	<!-- Archivos JS de bootstrap -->
    <script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('css/layout.css')}}">
@endsection

@section('contenidoPadre')
	@yield('contenido')
@endsection

@section('scriptsInferior')

@endsection