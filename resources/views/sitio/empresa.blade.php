@extends('layouts.sitio')

@section('titulo', 'NIKKA-N')

@section('scriptsParticulares')
  <link rel="stylesheet" href="{{asset('css/seccionEmpresa.css')}}">
@endsection

@section('contenido')
@include('sitio.partial.menuPrincipal')
	<img src="{{asset($portada->ruta)}}" alt="" class="img img-responsive">

	<div class="container-fluid" style="position: relative; z-index: 0;">
		<div class="col-xs-12 col-md-6">
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
		</div>
		<div class="col-xs-12 col-md-6" id="contenedorDescripcion">
			<h1>{{$portada->titulo}}</h1>
			<p>{{$portada->texto}}</p>
		</div>
	</div>	
@include('sitio.partial.footer')
@endsection