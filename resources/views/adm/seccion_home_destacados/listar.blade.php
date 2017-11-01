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
				<table class="table table-striped table-bordered table-responsive">
					<thead>
						<td>Imagen</td>
						<td>Editar</td>
						<td>Eliminar</td>
					</thead>
					<tbody>
						@foreach($variable as $key)
						<tr>
							<td><img src="{{ asset($key["ruta"]) }}" class="img img-responsive" alt="" style="max-width: 100px;"></td>
							<td><a href="{{action('SeccionHomeDestacadoController@edit', $key['id'])}}" class="btn btn-primary">Editar</a></td>
							<td>
								<form action="{{action('SeccionHomeDestacadoController@destroy', $key['id'])}}" method="post">
						           {{csrf_field()}}
						           <input name="_method" type="hidden" value="DELETE">
						           <button class="btn btn-danger" type="submit">Borrar</button>
						        </form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
	    </div>
	</div>
@endsection