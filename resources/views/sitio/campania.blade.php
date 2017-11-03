@extends('layouts.sitio')

@section('titulo', 'Campaña')

@section('scriptsParticulares')
  {{-- <link rel="stylesheet" href="{{asset('css/seccionEmpresa.css')}}"> --}}
@endsection

@section('contenido')
@include('sitio.partial.menuPrincipal')
	{{-- slider --}}
    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="position: relative; z-index: -1;">
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        @foreach($slider as $key => $value)
          @if($key == 0)
            @php($active = 'active')
          @else
            @php($active = '')
          @endif

          <div class="item {{$active}}">
            <img src="{{$value->ruta}}" alt="">
          </div>
        @endforeach
      </div>
    </div>
@include('sitio.partial.footer')
@endsection