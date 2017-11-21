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
				{{-- {{ Form::open(['action' => ['SeccionContactoMapaController@'.$accion, $objeto->id], 'method' => $verbo, 'class' => 'form-horizontal', 'files' => true]) }}
					{{csrf_field()}}
				    <fieldset>
				    	<input name="_method" type="hidden" value="PATCH">

				    	<div class="form-group">
				    		{!! Form::label('codigo', 'Código Google maps', ['class' => 'col-sm-3 control-label']) !!}
				    		<div class="col-sm-7">
								{!! Form::text('codigo', $objeto->codigo, ['class' => 'form-control', 'placeholder' => 'Codigo de Google maps']) !!}
							</div>
				        </div>

				        <div class="col-sm-4 col-sm-offset-4">
				        	{!! Form::submit('Guardar', ['class' => 'btn btn-lg btn-success btn-block']) !!}
					    </div>
				    </fieldset>
				{!! Form::close() !!} --}}
				<table class="table">
					<thead>
						<tr>
							<td>Producto</td>
							<td>Precio/U</td>
							<td>Descuento</td>
							<td>Precio con desc.</td>
							<td>Cantidad</td>
							<td>Precio subtotal</td>
						</tr>
					</thead>
					<tbody>
						@foreach($variable as $cadaCompra)
							<tr>
								<td>
									<p>
										Nombre: {{$cadaCompra['productoNombre']}}
									</p>
									<p>
										Talle: {{$cadaCompra['talleNombre']}}
									</p>
									<p>
										Color: {{$cadaCompra['colorNombre']}}
									</p>
								</td>
								<td>
									${{$cadaCompra['productoPrecioOriginal']}}
								</td>
								<td>
									{{$cadaCompra['productoDescuento']}}%
								</td>
								<td>
									${{$cadaCompra['productoPrecioConDescuento']}}
								</td>
								<td>
									{{$cadaCompra['cantidad']}}
								</td>
								<td>
									${{$cadaCompra['productoPrecioConDescuento'] * $cadaCompra['cantidad']}}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>

			</div>
	    </div>
	</div>

@endsection