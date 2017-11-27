@extends('layouts.sitio')

@section('titulo', $tipoDeColeccion)

@section('scriptsParticulares')
  <link rel="stylesheet" href="{{asset('css/seccionTienda.css')}}">
@endsection

@section('contenido')
@include('sitio.partial.menuPrincipal')
	<img src="{{asset($portada->ruta)}}" alt="" class="img img-responsive">

	<div class="container" id="contenedorFamilia" style="position: relative; z-index: 0;">
		<div class="row" id="contenedorFiltro">
			{{-- seguir aca --}}
			{{ Form::open(['action' => ['PaginaTiendaController@filtrarPorCategoria', $tipoDeColeccion, $idFamilia], 'method' => 'post'])}}
				{{csrf_field()}}
				<p>
					<span>Filtrar por:</span> 
					{{ Form::select('idCategoria', $listadoCategorias, null, ['onchange' => 'this.form.submit()', 'placeholder' => 'Categorías']) }}
				</p>
			{!! Form::close() !!}
		</div>
		<div class="row">
			@foreach($productos as $cadaProducto)
				<div class="col-xs-12 col-sm-3">
					<a href="{{url('tienda/'.$tipoDeColeccion.'/producto/'.$cadaProducto->id)}}">
						<div  id="cajaFamilia">
							<img src="{{asset($cadaProducto->ruta)}}" class="img img-responsive" alt="">
						</div>
						<div id="contenedorNombreProducto">
							<p>{{$cadaProducto->nombre}}</p>
						</div>

						<div id="linitaProducto">
							<hr>
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