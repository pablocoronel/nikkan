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
				{{ Form::open(['action' => ['SeccionTiendaTransporteController@'.$accion, $objeto->id], 'method' => $verbo, 'class' => 'form-horizontal', 'files' => true]) }}
					{{csrf_field()}}
				    <fieldset>
				    	<input name="_method" type="hidden" value="PATCH">

				    	<div class="form-group">
				        	{!! Form::label('provincia', 'Provincia', ['class' => 'col-sm-3 control-label']) !!}
							<div class="col-sm-7">
								{!! Form::select('provincia', $listadoProvincia, $objeto->provincia) !!}
				        	</div>
				        </div>

				        <div class="form-group">
				        	{!! Form::label('peso', 'Peso', ['class' => 'col-sm-3 control-label']) !!}
							<div class="col-sm-7">
								{!! Form::select('peso', ['0-1000' => 'Hasta 1Kg', '1000-2000' => '1 a 2Kg', '2000-3000' => '2 a 3Kg'], $objeto->peso_minimo.'-'.$objeto->peso_maximo) !!}
				        	</div>
				        </div>

				        {{-- <div class="form-group">
				    		{!! Form::label('peso_minimo', 'Peso mínimo (gr.)', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('peso_minimo', $objeto->peso_minimo, ['class' => 'form-control', 'placeholder' => 'Peso mínimo`` (gr.)']) !!}
							</div>
				        </div>

				        <div class="form-group">
				    		{!! Form::label('peso_maximo', 'Peso máximo (gr.)', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('peso_maximo', $objeto->peso_maximo, ['class' => 'form-control', 'placeholder' => 'Peso máximo (gr.)']) !!}
							</div>
				        </div> --}}

				    	<div class="form-group">
				    		{!! Form::label('precio', 'Precio', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('precio', $objeto->precio, ['class' => 'form-control', 'placeholder' => 'Precio']) !!}
							</div>
				        </div>

				        {{-- <div class="form-group">
				    		{!! Form::label('orden', 'Orden', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('orden', $objeto->orden, ['class' => 'form-control', 'placeholder' => 'Orden']) !!}
							</div>
				        </div> --}}

				        <div class="col-sm-4 col-sm-offset-4">
				        	{!! Form::submit('Guardar', ['class' => 'btn btn-lg btn-success btn-block']) !!}
					    </div>
				    </fieldset>
				{!! Form::close() !!}
			</div>
	    </div>
	</div>

@endsection