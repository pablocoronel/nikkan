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
				{{ Form::open(['action' => ['SeccionTiendaProductoController@'.$accion, $objeto->id], 'method' => $verbo, 'class' => 'form-horizontal', 'files' => true]) }}
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
				        	{!! Form::label('fk_categoria', 'Categoría', ['class' => 'col-sm-3 control-label']) !!}
							<div class="col-sm-7">
								{!! Form::select('fk_categoria', $arrayListado, $objeto->fk_categoria) !!}
				        	</div>
				        </div>

				        <div class="form-group">
				        	{!! Form::label('imagen', 'Imagen (400x400px)', ['class' => 'col-sm-3 control-label']) !!}
				            <div class="col-sm-7">
				            	<img src="{{ asset($objeto->ruta)}}" alt="" style="max-width: 100px;" class="img img-responsive">
				        		{!! Form::file('imagen') !!}
					        </div>
				        </div>

				        <div class="form-group">
				    		{!! Form::label('descripcion', 'Descripción', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('descripcion', $objeto->descripcion, ['class' => 'form-control', 'placeholder' => 'Descripción']) !!}
							</div>
				        </div> 

				        <div class="form-group">
				    		{!! Form::label('precio_original', 'Precio original', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('precio_original', $objeto->precio_original, ['class' => 'form-control', 'placeholder' => 'Precio original']) !!}
							</div>
				        </div> 

				        <div class="form-group">
				    		{!! Form::label('descuento', 'Descuento (0% por defecto)', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('descuento', $objeto->descuento, ['class' => 'form-control', 'placeholder' => '0']) !!}
							</div>
				        </div> 

				        <div class="form-group">
				        	{!! Form::label('coleccion', 'Colección', ['class' => 'col-sm-3 control-label']) !!}
							<div class="col-sm-7">
								{!! Form::select('coleccion', ['coleccion' => 'Colección', 'discontinuo' => 'Discontinuo'], $objeto->coleccion) !!}
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