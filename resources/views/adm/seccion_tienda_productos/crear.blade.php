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
				{{ Form::open(['action' => ['SeccionTiendaProductoController@'.$accion], 'method' => $verbo, 'class' => 'form-horizontal', 'files' => true]) }}
					{{csrf_field()}}
				    <fieldset>
				    	<div class="form-group">
				    		{!! Form::label('nombre', 'Nombre', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('nombre', '', ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
							</div>
				        </div> 

				        
				        <div class="form-group">
				        	{!! Form::label('fk_categoria', 'Categoría', ['class' => 'col-sm-3 control-label']) !!}
							<div class="col-sm-7">
								{!! Form::select('fk_categoria', $arrayListado) !!}
				        	</div>
				        </div>

				        <div class="form-group">
				        	{!! Form::label('imagen', 'Imagen (400x400px)', ['class' => 'col-sm-3 control-label']) !!}
				            <div class="col-sm-7">
				        		{!! Form::file('imagen') !!}
					        </div>
				        </div>

				        <div class="form-group">
				    		{!! Form::label('descripcion', 'Descripción', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('descripcion', '', ['class' => 'form-control', 'placeholder' => 'Descripción']) !!}
							</div>
				        </div> 

				        <div class="form-group">
				    		{!! Form::label('precio_original', 'Precio original', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('precio_original', '', ['class' => 'form-control', 'placeholder' => 'Precio original']) !!}
							</div>
				        </div> 

				        <div class="form-group">
				    		{!! Form::label('descuento', 'Descuento (0% por defecto)', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('descuento', '0', ['class' => 'form-control', 'placeholder' => '0']) !!}
							</div>
				        </div> 

				        <div class="form-group">
				        	{!! Form::label('coleccion', 'Colección', ['class' => 'col-sm-3 control-label']) !!}
							<div class="col-sm-7">
								{!! Form::select('coleccion', ['coleccion' => 'Colección', 'discontinuo' => 'Discontinuo']) !!}
				        	</div>
				        </div>

				        <div class="form-group">
				        	{!! Form::label('guia_de_talle', 'Guia de talles (400x400px)', ['class' => 'col-sm-3 control-label']) !!}
				            <div class="col-sm-7">
				        		{!! Form::file('guia_de_talle') !!}
					        </div>
				        </div>

				        <div class="form-group">
				    		{!! Form::label('peso', 'Peso (gr.)', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('peso', '', ['class' => 'form-control', 'placeholder' => 'Peso (gr.)']) !!}
							</div>
				        </div> 

				        <div class="form-group">
				    		{!! Form::label('orden', 'Orden', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('orden', '', ['class' => 'form-control', 'placeholder' => 'Orden']) !!}
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