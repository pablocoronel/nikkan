@extends('layouts.sitio')

@section('titulo', $nombreDeSeccion)

@section('scriptsParticulares')
  <link rel="stylesheet" href="{{asset('css/seccionTienda.css')}}">
@endsection

@section('contenido')
@include('sitio.partial.menuPrincipal')
	<img src="{{asset($portada->ruta)}}" alt="" class="img img-responsive">

	<div class="container" id="contenedorFamilia">
		<div class="row">
			{{-- seguir aca --}}
			{{ Form::open(['action' => ['PaginaTiendaController@'], 'method' => 'get'])}}
			<p>Filtrar por: </p>
			{{ Form::select('elegirCategoria', $listadoCategorias) }}
		</div>
		<div class="row">
			@foreach($productos as $cadaProducto)
				<div class="col-xs-12 col-sm-3" id="cajaFamilia">
					{{-- <a href="{{url($nombreDeSeccion.'/familia/'.$cadaProducto->fk_familia.'/categoria/'.$cadaProducto->fk_categoria.'/producto/'.$cadaProducto->id)}}"> --}}
					<a href="{{url($nombreDeSeccion.'/producto/'.$cadaProducto->id)}}">
						<img src="{{asset($cadaProducto->ruta)}}" class="img img-responsive" alt="">
						<div id="contenedorNombreProducto">
							<p>{{$cadaProducto->nombre}}</p>
						</div>
						<div id="contenedorPrecio">
							<p>
								@if($cadaProducto->descuento > 0)
									<span id="precioTachado">${{$cadaProducto->precio_original}}</span>
									<span>${{$cadaProducto->precio_con_descuento}}</span>
								@else
									<span>${{$cadaProducto->precio_con_descuento}}</span>
								@endif
							</p>
						</div>
					</a>
				</div>
			@endforeach
		</div>
	</div>
@include('sitio.partial.footer')
@endsection