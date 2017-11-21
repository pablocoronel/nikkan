@extends('layouts.administracion')

@section('contenido')
	
	<!-- Titulo de seccion -->
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	        	{{$nombreDeAccion}}
	        </h1>
	    </div>
	    <!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->

	<div class="row">
	    <div class="col-xs-12 col-md-8 col-md-offset-2">
	        <div class="panel panel-default">
	        	<div class="panel-heading">
	                <h3 class="panel-title">{{$nombreDeAccion}}</h3>
	            </div>
	            
				{{-- Tabla --}}
				<table class="table table-bordered table-responsive">
					<thead>
						<td>Id</td>
						<td>Fecha</td>
						<td>Envio</td>
						<td>Costo de envio</td>
						<td>Estado</td>
						<td>Total</td>
						<td>Detalle</td>
					</thead>
					<tbody>
						@foreach($variable as $key)
						<tr class="active">
							<td>{{$key['id']}}</td>
							<td>{{$key['fecha_compra']}}</td>
							<td>Pcia: {{$key['provincia']}}, Ciudad/barrio: {{$key['ciudad']}}</td>
							<td>${{$key['precio_envio']}}</td>
							
							{{ Form::open(['action' => ['SeccionCarritoCompraController@update', $key['id']], 'method' => 'post']) }}
								{{csrf_field()}}
								<input name="_method" type="hidden" value="PATCH">

								<td>{!! Form::select('estado_compra', $arrayEstadoCompra, $key['estado_compra'], ['onchange' => 'this.form.submit()']) !!}</td>
							{!! Form::close() !!}

							<td>${{$key['precio_total']}}</td>
							<td><a class="btn btn-primary" target="_blank" href="{{action('SeccionCarritoCompraController@show', $key['id'])}}">Ver artículos</a></td>
						</tr>

						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td></td>
							<td></td>
							<td>{{$variable->links()}}</td>
							<td></td>
							<td></td>
							<td></td>					
						</tr>
					</tfoot>
				</table>
			</div>
	    </div>
	</div>

	{{-- <script>
	  	function mostrarVersiones(version){
		  		if (version.style.display == 'block') {
		  			version.style.display= 'none';
		  		}else{
		  			version.style.display= 'block';
		  		}	
	  	}

	</script> --}}
@endsection