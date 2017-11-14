@extends('layouts.sitio')

@section('titulo', 'Carrito')

@section('scriptsParticulares')
  <link rel="stylesheet" href="{{asset('css/seccionCarrito.css')}}">
@endsection

@section('contenido')
@include('sitio.partial.menuPrincipal')
  <img src="{{$portada->ruta}}" alt="" class="img img-responsive">

	<a href="{{url('carrito/vaciar')}}" class="btn btn-info">Vaciar carrito</a>

  @if(Session::has('stockNoDisponible'))
    <div class="alert alert-warning">
      <p>{{Session::get('stockNoDisponible')}}</p>
    </div>
  @endif

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

      @foreach($versionUnica as $item)
        @foreach($contenidoCarrito as $versionEnCarrito)
          @if($item->id == $versionEnCarrito->id)
              @php($rowId= $versionEnCarrito->rowId)
              @php($cantidadActual= $versionEnCarrito->qty)
          @endif
        @endforeach

  	  <div class="row">
	  		<div class="col-xs-12 col-sm-2">
	  			<img src="{{asset($item->rutaProducto)}}" alt="">
	  		</div>
	  		<div class="col-xs-12 col-sm-2">
          <p>Nombre: {{$item->nombreProducto}} {{$item->nombreColor}}</p>
          <p>Talle: {{$item->nombreTalle}}</p>
          <p>Código: {{$item->codigo_producto}}</p>
	  		</div>
	  		<div class="col-xs-12 col-sm-2">
	  			${{$item->precioConDescuento}}
	  		</div>
	  		<div class="col-xs-12 col-sm-2">
	  			
          <form action="{{url('carrito/actualizarCantidadItem')}}" method="post">
             {{csrf_field()}}
             <input name="rowId" type="hidden" value="{{$rowId}}">
             <input name="idVersion" type="hidden" value="{{$item->id}}">
             
             <input type="number" name="nuevaCantidad" value="{{$cantidadActual}}" min="1">
             <button class="btn btn-xs btn-success" type="submit">cambiar</button>
          </form>
          <a href=""></a>
	  		</div>
	  		<div class="col-xs-12 col-sm-2">
	  			<form action="{{url('carrito/quitarItem')}}" method="post">
             {{csrf_field()}}
             <input name="_method" type="hidden" value="DELETE">
             <input name="rowId" type="hidden" value="{{$rowId}}">
             
             <button class="btn btn-xs btn-danger" type="submit">X</button>
          </form>
	  		</div>
	  		<div class="col-xs-12 col-sm-2">
	  			${{$item->precioConDescuento * $cantidadActual}}
	  		</div>
	  	</div>
      @endforeach

      {{-- total --}}
      <div class="row">
        <div class="col-xs-12 col-sm-8">
          
        </div>
        <div class="col-xs-12 col-sm-2">
          Total:
        </div>
        <div class="col-xs-12 col-sm-2">
          {{Cart::total()}}
        </div>
      </div>

      <div class="row">
        @if(Auth::check())
          {{-- <a href="{{url('elegir-direccion')}}" class="btn btn-primary">Siguiente</a> --}}
        @else
          <a href="{{url('iniciar-sesion')}}" class="btn btn-primary">Siguiente</a>
        @endif
      </div>
  </div>
@include('sitio.partial.footer')
@endsection