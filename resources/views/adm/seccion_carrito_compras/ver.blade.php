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

	


	{{-- compras --}}
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
							<td>Precio c/desc.</td>
							<td>Cantidad</td>
							<td>Desc p/cupón</td>
							<td>Precio final</td>
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
									${{ ($cadaCompra['productoPrecioConDescuento'] - $cadaCompra['precio_final_cupon']) * $cadaCompra['cantidad']}}
								</td>
								<td>
									${{$cadaCompra['precio_final_cupon']}}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>

			</div>
	    </div>
	</div>

	{{-- datos de cliente --}}
	<div class="row">
	    <div class="col-xs-12 col-md-8 col-md-offset-2">
	        <div class="panel panel-default">
	        	<div class="panel-heading">
	                <h3 class="panel-title">Datos de cliente</h3>
	            </div>
	            
				<table class="table">
					<tbody>
						<tr>
							<td>Usuario</td>
							<td>{{$cliente[0]['usuario']}}</td>
						</tr>

						<tr>
							<td>Nombre</td>
							<td>{{$cliente[0]['nombre']}}</td>
						</tr>

						<tr>
							<td>Apellido</td>
							<td>{{$cliente[0]['apellido']}}</td>
						</tr>

						<tr>
							<td>Email</td>
							<td>{{$cliente[0]['email']}}</td>
						</tr>

						<tr>
							<td>Fecha de nacimiento</td>
							<td>{{$cliente[0]['fecha_nacimiento']}}</td>
						</tr>
					</tbody>
				</table>

			</div>
	    </div>
	</div>

	{{-- direccion de envio --}}
	<div class="row">
	    <div class="col-xs-12 col-md-8 col-md-offset-2">
	        <div class="panel panel-default">
	        	<div class="panel-heading">
	                <h3 class="panel-title">Dirección de entrega</h3>
	            </div>
	            
				<table class="table">
					<tbody>
						<tr>
							<td>Dirección 1</td>
							<td>{{$direccionEntrega[0]['direccion']}}</td>
						</tr>

						<tr>
							<td>Dirección 2</td>
							<td>{{$direccionEntrega[0]['direccion2']}}</td>
						</tr>

						<tr>
							<td>Código postal</td>
							<td>{{$direccionEntrega[0]['codigo_postal']}}</td>
						</tr>

						<tr>
							<td>Ciudad</td>
							<td>{{$direccionEntrega[0]['ciudad']}}</td>
						</tr>

						<tr>
							<td>Provincia</td>
							<td>{{$direccionEntrega[0]['provincia']}}</td>
						</tr>
						<tr>
							<td>País</td>
							<td>{{$direccionEntrega[0]['pais']}}</td>
						</tr>
						<tr>
							<td>Teléfono celular</td>
							<td>{{$direccionEntrega[0]['telefono_celular']}}</td>
						</tr>
						<tr>
							<td>Teléfono de domicilio</td>
							<td>{{$direccionEntrega[0]['telefono_domicilio']}}</td>
						</tr>
						<tr>
							<td>Comentarios</td>
							<td>{{$direccionEntrega[0]['comentario']}}</td>
						</tr>
					</tbody>
				</table>

			</div>
	    </div>
	</div>

	{{-- direccion de envio --}}
	<div class="row">
	    <div class="col-xs-12 col-md-8 col-md-offset-2">
	        <div class="panel panel-default">
	        	<div class="panel-heading">
	                <h3 class="panel-title">Dirección de facturación</h3>
	            </div>
	            
				<table class="table">
					<tbody>
						<tr>
							<td>Dirección 1</td>
							<td>{{$direccionFacturacion[0]['direccion']}}</td>
						</tr>

						<tr>
							<td>Dirección 2</td>
							<td>{{$direccionFacturacion[0]['direccion2']}}</td>
						</tr>

						<tr>
							<td>Código postal</td>
							<td>{{$direccionFacturacion[0]['codigo_postal']}}</td>
						</tr>

						<tr>
							<td>Ciudad</td>
							<td>{{$direccionFacturacion[0]['ciudad']}}</td>
						</tr>

						<tr>
							<td>Provincia</td>
							<td>{{$direccionFacturacion[0]['provincia']}}</td>
						</tr>
						<tr>
							<td>País</td>
							<td>{{$direccionFacturacion[0]['pais']}}</td>
						</tr>
						<tr>
							<td>Teléfono celular</td>
							<td>{{$direccionFacturacion[0]['telefono_celular']}}</td>
						</tr>
						<tr>
							<td>Teléfono de domicilio</td>
							<td>{{$direccionFacturacion[0]['telefono_domicilio']}}</td>
						</tr>
						<tr>
							<td>Comentarios</td>
							<td>{{$direccionFacturacion[0]['comentario']}}</td>
						</tr>
					</tbody>
				</table>

			</div>
	    </div>
	</div>


@endsection