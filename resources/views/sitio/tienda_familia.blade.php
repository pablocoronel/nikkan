@extends('layouts.sitio')

@section('titulo', $tipoDeColeccion)

@section('scriptsParticulares')
  <link rel="stylesheet" href="{{asset('css/seccionTienda.css')}}">
@endsection

@section('contenido')
@include('sitio.partial.menuPrincipal')
	<img src="{{asset($portada->ruta)}}" alt="" class="img img-responsive">

	<div class="container" id="contenedorFamilia">
		<div class="row">
			@foreach($familias as $cadaFamilia)
				<div class="col-xs-12 col-sm-3" id="cajaFamilia">
					<a href="{{$tipoDeColeccion}}/familia/{{$cadaFamilia->id}}">
						<img src="{{asset($cadaFamilia->ruta)}}" class="img img-responsive" alt="">
						<div id="contenedorNombreFamilia">
							<p>{{$cadaFamilia->nombre}}</p>
						</div>
					</a>
				</div>
			@endforeach
		</div>
	</div>
@include('sitio.partial.footer')
@endsection