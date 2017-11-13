@extends('layouts.sitio')

@section('titulo', 'Carrito')

@section('scriptsParticulares')
  <link rel="stylesheet" href="{{asset('css/seccionCarrito.css')}}">
@endsection

@section('contenido')
@include('sitio.partial.menuPrincipal')
  <img src="{{$portada->ruta}}" alt="" class="img img-responsive">

	<a href="{{url('carrito/vaciar')}}" class="btn btn-info">Vaciar carrito</a>

  <div class="container">
  	<div class="row">
  		<div class="col-xs-12 col-sm-2">
  			producto
  		</div>
  		<div class="col-xs-12 col-sm-2">
  			descripción
  		</div>
  		<div class="col-xs-12 col-sm-2">
  			precio unitario
  		</div>
  		<div class="col-xs-12 col-sm-2">
  			cantidad
  		</div>
  		<div class="col-xs-12 col-sm-2">
  			quitar
  		</div>
  		<div class="col-xs-12 col-sm-2">
  			total
  		</div>
  	</div>
  	  @foreach($contenidoCarrito as $item)
  	  	<div class="row">
	  		<div class="col-xs-12 col-sm-2">
	  			{{$item->id}}
	  		</div>
	  		<div class="col-xs-12 col-sm-2">
	  			descripción
	  		</div>
	  		<div class="col-xs-12 col-sm-2">
	  			precio unitario
	  		</div>
	  		<div class="col-xs-12 col-sm-2">
	  			{{$item->qty}}
	  		</div>
	  		<div class="col-xs-12 col-sm-2">
	  			quitar
	  		</div>
	  		<div class="col-xs-12 col-sm-2">
	  			total
	  		</div>
	  	</div>
      @endforeach
  </div>
@include('sitio.partial.footer')
@endsection