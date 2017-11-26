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
				{{ Form::open(['action' => ['SeccionTiendaCuponController@'.$accion, $objeto->id], 'method' => $verbo, 'class' => 'form-horizontal', 'files' => true]) }}
					{{csrf_field()}}
				    <fieldset>
				    	<input name="_method" type="hidden" value="PATCH">
						<input name="id" type="hidden" value="{{$objeto->id}}">
						
				    	<div class="form-group">
				    		{!! Form::label('codigo_cupon', 'Código de cupón', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('codigo_cupon', $objeto->codigo_cupon, ['class' => 'form-control', 'placeholder' => $objeto->codigo_cupon]) !!}
								{{-- {!! Form::text('codigo_cupon', $objeto->codigo_cupon, ['class' => 'form-control', 'placeholder' => 'Código de cupón']) !!} --}}
							</div>
				        </div>

				        <div class="form-group">
				    		{!! Form::label('vigencia_inicio', 'Vigencia inicio', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('vigencia_inicio', $objeto->vigencia_inicio, ['class' => 'form-control', 'placeholder' => 'aaaa-mm-dd']) !!}
							</div>
				        </div>

				        <div class="form-group">
				    		{!! Form::label('vigencia_fin', 'Vigencia fin', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('vigencia_fin', $objeto->vigencia_fin, ['class' => 'form-control', 'placeholder' => 'aaaa-mm-dd']) !!}
							</div>
				        </div>

				        <div class="form-group">
				        	{!! Form::label('tipo_descuento', 'Tipo de descuento', ['class' => 'col-sm-3 control-label']) !!}
							<div class="col-sm-7">
								{!! Form::select('tipo_descuento', ['porcentual' => 'Porcentual', 'monetario' => 'Monetario'], $objeto->tipo_descuento) !!}
				        	</div>
				        </div>

				        <div class="form-group">
				    		{!! Form::label('descuento_porcentual', 'Descuento porcentual', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('descuento_porcentual', $objeto->descuento_porcentual, ['class' => 'form-control', 'placeholder' => 'Descuento porcentual']) !!}
							</div>
				        </div>

				        <div class="form-group">
				    		{!! Form::label('descuento_monetario', 'Descuento monetario', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('descuento_monetario', $objeto->descuento_monetario, ['class' => 'form-control', 'placeholder' => 'Descuento monetario']) !!}
							</div>
				        </div>

				        {{-- productos --}}
				        <div class="form-group">
				        	{!! Form::label('producto_asignado', 'Productos válidos', ['class' => 'col-sm-3 control-label']) !!}
				        	<div class="col-sm-9">
					        	<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Elegir productos válidos</button>
								
								<div class="collapse" id="collapseExample">
									  	@foreach($productos as $key => $cadaProducto)
									  		<div class="col-xs-4 col-sm-3">
									  			<div class="row" style="border: 1px solid #EEEEEE;padding-bottom: 5px;">
									  				<div class="col-xs-2">
															{!! Form::checkbox("producto[$key]", $cadaProducto->id, $cadaProducto->tildado) !!}
									  				</div>
									  				<div class="col-xs-2">
									  					<span>{{$cadaProducto->nombre}}</span>
									  				</div>
									  			</div>
									  		</div>
								  		@endforeach
								</div>
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