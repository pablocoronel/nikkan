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
				{{ Form::open(['action' => ['UsuarioController@'.$accion, $objeto->id], 'method' => $verbo, 'class' => 'form-horizontal']) }}
					{{csrf_field()}}
				    <fieldset>
				    	<input name="_method" type="hidden" value="PATCH">

				    	<div class="form-group">
				    		{!! Form::label('nombre', 'Nombre', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('nombre', $objeto->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
							</div>
				        </div>

				        <div class="form-group">
				        	{!! Form::label('usuario', 'Usuario', ['class' => 'col-sm-3 control-label']) !!}
				            <div class="col-sm-7">
				            	{!! Form::text('usuario', $objeto->usuario, ['class' => 'form-control', 'placeholder' => 'Usuario']) !!}
					        </div>
				        </div>

{{-- 				        <div class="form-group">
				        	{!! Form::label('clave', 'Clave', ['class' => 'col-sm-3 control-label']) !!}
					        <div class="col-sm-7">
					        	{!! Form::password('clave', ['class' => 'form-control', 'placeholder' => 'Clave']) !!}
					        </div>
				        </div> --}}

				        <div class="form-group">
				        	{!! Form::label('nivel', 'Nivel', ['class' => 'col-sm-3 control-label']) !!}
							<div class="col-sm-7">
								{!! Form::select('nivel', [$objeto->nivel => $objeto->nivel, 'administrador' => 'Administrador', 'usuario_normal' => 'Usuario normal']) !!}
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