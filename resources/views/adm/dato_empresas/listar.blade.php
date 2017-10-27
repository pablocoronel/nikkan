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
						<td>Tipo</td>
						<td>Texto actual</td>
						<td>Editar</td>
					</thead>
					<tbody>
						@foreach($variable as $key)
						<tr>
							<td>{{ $key["tipo"] }}</td>
							<td>{{ $key["texto"] }}</td>
							<td><a href="{{action('DatoEmpresaController@edit', $key['id'])}}" class="btn btn-primary">Editar</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
	    </div>
	</div>
@endsection