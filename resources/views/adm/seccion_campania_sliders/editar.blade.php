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
				{{ Form::open(['action' => ['SeccionCampaniaSliderController@'.$accion, $objeto->id], 'method' => $verbo, 'class' => 'form-horizontal', 'files' => true]) }}
					{{csrf_field()}}
				    <fieldset>
				    	<input name="_method" type="hidden" value="PATCH">

				    	{{-- <div class="form-group">
				    		{!! Form::label('texto', 'Texto', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('texto', $objeto->texto, ['class' => 'form-control', 'placeholder' => 'Texto']) !!}
							</div>
				        </div>

				        <div class="form-group">
				        	{!! Form::label('vinculo', 'Vinculo', ['class' => 'col-sm-3 control-label']) !!}
				            <div class="col-sm-7">
				            	{!! Form::text('vinculo', $objeto->vinculo, ['class' => 'form-control', 'placeholder' => 'Vinculo']) !!}
					        </div>
				        </div> --}}

				        <div class="form-group">
				        	{!! Form::label('imagen', 'Imagen (1900x750px)', ['class' => 'col-sm-3 control-label']) !!}
				            <div class="col-sm-7">
				            	<img src="{{ asset($objeto->ruta)}}" alt="" style="max-width: 100px;" class="img img-responsive">
				        		{!! Form::file('imagen') !!}
					        </div>
				        </div>

				        <div class="form-group">
				    		{!! Form::label('orden', 'Orden', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('orden', $objeto->orden, ['class' => 'form-control', 'placeholder' => 'Orden']) !!}
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