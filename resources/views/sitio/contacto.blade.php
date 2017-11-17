@extends('layouts.sitio')

@section('titulo', 'Contacto')

@section('scriptsParticulares')
  <link rel="stylesheet" href="{{asset('css/seccionContacto.css')}}">
@endsection

@section('contenido')
@include('sitio.partial.menuPrincipal')
  <img src="{{asset($portada->ruta)}}" alt="" class="img img-responsive">

  <div class="container">
    <iframe src="{{$mapa->codigo}}" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
  
    <div class="row">
      <div class="col-xs-12">
        @if(Session::has('enviado'))
          <div class="alert alert-success">
            {{ Session::get('enviado', '') }}
          </div>
        @endif
      </div>
    </div>

    <div class="col-xs-12 col-md-6">
      <h1>ENVIANOS UN MENSAJE</h1>
    </div>

    <div class="col-xs-12 col-md-6">
      {{-- formulario --}}
      {{ Form::open(['url' => 'contacto/email', 'method' => 'post', 'class' => 'form-horizontal']) }}
        {{csrf_field()}}
          <fieldset>
            <div class="form-group">
              {{-- {!! Form::label('nombre', 'Nombre', ['class' => 'col-sm-3 control-label']) !!} --}}
              <div class="col-xs-12">
                {!! Form::text('nombre', '', ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
              </div>
            </div>

            <div class="form-group">
              {{-- {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!} --}}
                <div class="col-xs-12">
                  {!! Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email']) !!}
              </div>
            </div>

            <div class="form-group">
              {{-- {!! Form::label('asunto', 'Asunto', ['class' => 'col-sm-3 control-label']) !!} --}}
              <div class="col-xs-12">
                {!! Form::text('asunto', '', ['class' => 'form-control', 'placeholder' => 'Asunto']) !!}
              </div>
            </div>

            <div class="form-group">
              {{-- {!! Form::label('mensaje', 'Mensaje', ['class' => 'col-sm-3 control-label']) !!} --}}
              <div class="col-xs-12">
                {!! Form::textarea('mensaje', '', ['class' => 'form-control', 'placeholder' => 'Mensaje']) !!}
              </div>
            </div>

            <div class="form-group">
              <div class="col-xs-12">
                {!! Form::submit('ENVIAR', ['class' => 'btn btn-lg btn-success btn-block']) !!}
              </div>
            </div>
          </fieldset>
      {!! Form::close() !!}
    </div>
  </div>
@include('sitio.partial.footer')
@endsection