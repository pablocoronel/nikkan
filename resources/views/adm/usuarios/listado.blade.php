<!-- Titulo de seccion -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
        	@yield('nombreDeAccion')
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <div class="panel panel-default">
        	<div class="panel-heading">
                <h3 class="panel-title">@yield('nombreDeAccion')</h3>
            </div>
            
			{{-- Tabla --}}
			<table class="table table-striped table-bordered table-responsive">
				<thead>
					<td>Usuario</td>
					{{-- <td>Clave</td> --}}
					<td>Nombre</td>
					<td>Editar</td>
					<td>Eliminar</td>
				</thead>
				<tbody>
					@foreach($listaDeUsuarios as $usr)
					<tr>
						<td>{{ $usr["usuario"] }}</td>
						{{-- <td>{{ $usr["password"] }}</td> --}}
						<td>{{ $usr["nombre"] }}</td>
						<td><a href="{{action('UsuarioController@edit', $usr['id'])}}" class="btn btn-primary">Editar</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
    </div>
</div>
