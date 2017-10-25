@extends('layouts.principal')

@section('scriptsSuperior')
	<!-- Archivos JS de bootstrap -->
    <script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection

@section('contenidoPadre')
	@yield('contenido')
@endsection

@section('scriptsInferior')

@endsection