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
	                <h3 class="panel-title">{{$nombreDeAccion}} - Producto: {{$producto->nombre}}</h3>
	            </div>
	            {{-- Mensajes --}}
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-sm-offset-2">
						{{-- De error --}}
						@if ($errors->any())
						    <div class="alert alert-danger">
						        <ul>
						            @foreach ($errors->all() as $error)
						                <li>{{ $error }}</li>
						            @endforeach
						        </ul>
						    </div>
						@endif
						
						{{-- De exito --}}
						@if(Session::has('guardado'))
							<div class="alert alert-success" role="alert">
								{{Session::get('guardado', '')}}
							</div>
						@endif
					</div>	
				</div>

				{{-- Formulario --}}
				{{ Form::open(['action' => ['SeccionTiendaVersionController@'.$accion, $producto->id], 'method' => $verbo, 'class' => 'form-horizontal', 'files' => true]) }}
					{{csrf_field()}}
				    <fieldset>

				        <div class="form-group">
				        	{!! Form::label('fk_color', 'Color', ['class' => 'col-sm-3 control-label']) !!}
							<div class="col-sm-7">
								{!! Form::select('fk_color', $arrayListadoColor) !!}
				        	</div>
				        </div>

				        <div class="form-group">
				        	{!! Form::label('fk_talle', 'Talle', ['class' => 'col-sm-3 control-label']) !!}
							<div class="col-sm-7">
								{!! Form::select('fk_talle', $arrayListadoTalle) !!}
				        	</div>
				        </div>

				        <div class="form-group">
				    		{!! Form::label('stock', 'Stock', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('stock', '', ['class' => 'form-control', 'placeholder' => 'Stock']) !!}
							</div>
				        </div>

				        <div class="col-sm-4 col-sm-offset-4">
				        	{!! Form::submit('Guardar', ['class' => 'btn btn-lg btn-success btn-block']) !!}
					    </div>
				    </fieldset>
				{!! Form::close() !!}
			</div>
	    </div>
	</div>
@endsection