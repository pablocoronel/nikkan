@extends('layouts.sitio')

@section('titulo', 'inicio')

@section('scriptsParticulares')
  <link rel="stylesheet" href="{{asset('css/seccionHome.css')}}">

  {{-- destacados --}}
  <link rel="stylesheet" type="text/css" href="{{asset('plugins/carouselDestacados/slick-1.6.0/slick/slick.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('plugins/carouselDestacados/slick-1.6.0/slick/slick-theme.css')}}"/>
  <script type="text/javascript" src="{{asset('plugins/carouselDestacados/slick-1.6.0/slick/slick.min.js')}}"></script>

  <!-- carrousel de destacados -->
  <script type="text/javascript">
    $(document).ready(function(){
      $('#contenedorDestacados').slick({
        lazyLoad: 'ondemand',
        slidesToShow: 4,
        slidesToScroll: 1
      });
    });
  </script>
@endsection

@section('contenido')
@include('sitio.partial.menuPrincipal')
    {{-- slider --}}
    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="position: relative; z-index: 0;">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        @foreach($slider as $key => $value)
          @if($key == 0)
            @php($active = 'active')
          @else
            @php($active = '')
          @endif

          <li data-target="#myCarousel" data-slide-to="{{$key}}" class="{{$active}}"></li>
        @endforeach
      </ol>

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
            <div class="carousel-caption" id="cajaDeTexto">
              <h3>{{$value->texto}}</h3>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Left and right controls -->
      {{-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a> --}}
    </div>

    
    {{-- Destacados --}}
    <div class="container-fluid" id="contenedorDestacados" style="position: relative; z-index: 0;">
        @foreach($destacados as $cadaDestacado)
        <div class="">
          <a href="{{$cadaDestacado->vinculo}}" target="_blank">
            <img data-lazy="{{$cadaDestacado->ruta}}" class="img img-responsive"/>
          </a>
          <p>{{$cadaDestacado->texto}}</p>
        </div>
        @endforeach
    </div>

@include('sitio.partial.footer')
@endsection
