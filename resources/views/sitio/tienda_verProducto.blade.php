@extends('layouts.sitio')

@section('titulo', $tipoDeColeccion)

@section('scriptsParticulares')
  <link rel="stylesheet" href="{{asset('css/seccionTiendaVerProducto.css')}}">
@endsection

@section('contenido')
@include('sitio.partial.menuPrincipal')
	<img src="{{asset($portada->ruta)}}" alt="" class="img img-responsive">

	<div class="container" id="contenedorProducto">
		<div class="col-xs-12 col-sm-6" id="contenedorGaleriaProductoDetalle">
             <div class="col-xs-12">
                <div id="contenedorImagenGrande">
                  <img id="imagenGrande" src="{{asset($galeria[0]->ruta)}}" alt="" class="img img-responsive">
                </div>
              </div>

              @foreach($galeria as $cadaGaleria)
                <div class="col-xs-4 col-sm-2_personalizado">
                  <div id="contenedorImagenChica">
                    <img src="{{asset($cadaGaleria->ruta)}}" alt="" class="img img-responsive" id="imagenChica{{$cadaGaleria->id}}" onClick="javascript: verImagenEnGrande(this);">
                  </div>
                </div>
              @endforeach
        </div>

        <div class="col-xs-12 col-sm-6">
        	<h1>{{$producto->nombre}}</h1>

        	@if($producto->descuento > 0)
        		<h2>
        			<span id="precioTachado">${{$producto->precio_original}}</span>
        			<span>${{$producto->precio_con_descuento}}</span>
        		</h2>
        	@else
				<h2>
        			<span>${{$producto->precio_con_descuento}}</span>
        		</h2>
        	@endif

        	<p>{{$producto->descripcion}}</p>

			<div class="col-xs-12 col-sm-6">
        		<img src="{{asset($producto->guia_de_talle)}}" alt="">
			</div>

			<div class="col-xs-12 col-sm-6">
				@if(Session::has('noExisteVersion'))
					<div class="alert alert-error">
						<p>{{Session::get('noExisteVersion')}}</p>
					</div>
        @elseif(Session::has('stockNoDisponible'))
          <div class="alert alert-warning">
            <p>{{Session::get('stockNoDisponible')}}</p>
          </div>
				@endif

   			{{ Form::open(['action' => ['PaginaCarritoController@agregarAlCarrito'], 'method' => 'post', 'class' => 'form-horizontal']) }}
        		{{csrf_field()}}

            {{ Form::hidden('idProducto', $producto->id) }}
        		<h3>Talles</h3>
				    {{ Form::select('talle', $listadoTalles) }}
				
        		<h3>Colores</h3>
        		{{ Form::select('color', $listadoColores) }}

        		{{ Form::number('cantidadElegidos', 1, ['min' => '1']) }}

        		{{ Form::submit('Añadir al carrito') }}

			{!! Form::close() !!}
			</div>

        </div>
	</div>
@include('sitio.partial.footer')
@endsection

@section('scriptsInferior')
	<script>
        function verImagenEnGrande(img){
            var imagenChica= img.src;
            var imagenGrande= document.getElementById('imagenGrande');
            
            imagenGrande.setAttribute("src", imagenChica);
        }
    </script>
@endsection