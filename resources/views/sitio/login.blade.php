@extends('layouts.sitio')

@section('titulo', 'Iniciar sesión')

@section('scriptsParticulares')
  <link rel="stylesheet" href="{{asset('css/seccionCarritoLogin.css')}}">
@endsection

@section('contenido')
@include('sitio.partial.menuPrincipal')
  <img src="{{$portada->ruta}}" alt="" class="img img-responsive">

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

              {{-- De error --}}
              @if(Session::has('mensajeError'))
                  <div class="alert alert-danger" role="alert">
                      {{Session::get('mensajeError', '')}}
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

      <div class="panel-body">
        <div class="col-xs-12 col-sm-5">
          <h2>Ingresar</h2>
          {!!Form::open(['action' => ['LoginController@iniciarCliente', 'method'=>'POST']])!!}

          {{csrf_field()}}
              <fieldset>
                  <div class="form-group">
                      <input class="form-control" placeholder="Correo" name="email" autofocus>
                  </div>
                  <div class="form-group">
                      <input class="form-control" placeholder="Clave" name="clave" type="password">
                  </div>
                  <input type="submit" value="Ingresar" class="btn btn-lg btn-success btn-block">
              </fieldset>
          {!!Form::close()!!}
        </div>

        <div class="col-xs-12 col-sm-2">
          
        </div>

        <div class="col-xs-12 col-sm-5">
          <h2>Registrarse</h2>

          {{ Form::open(['action' => ['LoginController@registrarCliente'], 'method' => 'post', 'class' => 'form-horizontal']) }}
            {{csrf_field()}}
              <fieldset>
                  <div class="form-group">
                    {!! Form::label('usuario', 'Usuario', ['class' => 'col-sm-3 control-label']) !!}
                      <div class="col-sm-7">
                        {!! Form::text('usuario', '', ['class' => 'form-control', 'placeholder' => 'Usuario']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('clave', 'Clave', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-7">
                      {!! Form::password('clave', ['class' => 'form-control', 'placeholder' => 'Clave']) !!}
                    </div>
                  </div>

                <div class="form-group">
                  {!! Form::label('nombre', 'Nombre', ['class' => 'col-sm-3 control-label']) !!}
                  <div class="col-sm-7">
                  {!! Form::text('nombre', '', ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                </div>
                  </div>

                  <div class="form-group">
                  {!! Form::label('apellido', 'Apellido', ['class' => 'col-sm-3 control-label']) !!}
                  <div class="col-sm-7">
                  {!! Form::text('apellido', '', ['class' => 'form-control', 'placeholder' => 'Apellido']) !!}
                </div>
                  </div>

                  <div class="form-group">
                  {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
                  <div class="col-sm-7">
                  {!! Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                </div>
                  </div>

              <div class="form-group">
                  {!! Form::label('fecha_nacimiento', 'Fecha de nacimiento', ['class' => 'col-sm-3 control-label']) !!}
                  <div class="col-sm-7">
                  {!! Form::text('fecha_nacimiento', '', ['class' => 'form-control', 'placeholder' => 'aaaa-mm-dd']) !!}
                </div>
                  </div>

                  <div class="form-group">
                  {!! Form::label('tratamiento', 'Tratamiento', ['class' => 'col-sm-3 control-label']) !!}
                  <div class="col-sm-7">
                  Sr. {!! Form::radio('tratamiento', 'Sr.') !!}
                  Sra. {!! Form::radio('tratamiento', 'Sra.') !!}
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
@include('sitio.partial.footer')
@endsection