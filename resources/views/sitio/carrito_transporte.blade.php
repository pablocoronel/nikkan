@extends('layouts.sitio')

@section('titulo', 'Carrito')

@section('scriptsParticulares')
  <link rel="stylesheet" href="{{asset('css/seccionCarrito.css')}}">
@endsection

@section('contenido')
@include('sitio.partial.menuPrincipal')
  <img src="{{$portada->ruta}}" alt="" class="img img-responsive">

<div class="container">
  
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

              
              {{-- exito --}}
              @if(Session::has('guardadoDireccionEntrega'))
                  <div class="alert alert-success" role="alert">
                      {{Session::get('guardadoDireccionEntrega', '')}}
                  </div>
              @endif            
              
              
          </div>  
      </div>

      <div class="panel-body">
       

        <div class="col-x-12">
          <h2>Seleccione una opción de envío</h2>

          {{ Form::open(['action' => ['PaginaCarritoController@almacenarDireccionDeEntrega'], 'method' => 'post', 'class' => 'form-horizontal']) }}
            {{csrf_field()}}
              <fieldset>
                  <div class="form-group">
                      <div class="col-xs-12 col-sm-1">
                        {!! Form::radio('transporte','', ['class' => 'form-control']) !!}
                      </div>
                      <div class="col-xs-12 col-sm-2">
                        <img src="{{asset('images/varios/transporte.jpg')}}" class="img img-responsive" alt="">
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <p>ARS (tasas incluídas)</p>
                      </div>
                  </div>

                  <div class="col-xs-12 col-sm-12">
                    <p>{{ Form::checkbox('terminos', '') }} He leído y acepto las <a href="">condiciones generales de venta</a></p>
                  </div>
                      
                  <div class="col-sm-4 col-sm-offset-4">
                    {!! Form::submit('Guardar', ['class' => 'btn btn-lg btn-success btn-block']) !!}
                  </div>
              </fieldset>
          {!! Form::close() !!}
        </div>
      </div>
  </div>
  
  <div class="container">
    {{-- <a href="{{url('elegir-transporte')}}" class="btn btn-primary">Siguiente</a> --}}
  </div>
</div>
@include('sitio.partial.footer')
@endsection