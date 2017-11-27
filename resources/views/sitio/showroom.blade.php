@extends('layouts.sitio')

@section('titulo', 'Showroom')

@section('scriptsParticulares')
  <link rel="stylesheet" href="{{asset('css/seccionShowroom.css')}}">
@endsection

@section('contenido')
@include('sitio.partial.menuPrincipal')
  <img src="{{asset($portada->ruta)}}" alt="" class="img img-responsive">

  {{-- slider --}}
    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="position: relative; z-index: 0;">
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

    <div class="container" id="contenedorTextoCentral">
      <div class="col-xs-12 col-sm-6 col-sm-offset-3">
        <h1>{{ $portada->titulo }}</h1>
        
        <div class="col-xs-5">
          <hr>
        </div>
        <div class="col-xs-2">
          <img src="{{asset('images/varios/gato.png')}}" alt="">
        </div>
        <div class="col-xs-5">
          <hr>
        </div>

        <p>{{ strip_tags($portada->texto) }}</p>
      </div>
    </div>
@include('sitio.partial.footer')
@endsection