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
              @if(Session::has('guardado'))
                  <div class="alert alert-success" role="alert">
                      {{Session::get('guardado', '')}}
                  </div>
              @endif            
              
              
          </div>  
      </div>

      <div class="panel-body">
       

        <div class="col-xs-12">
          <h2>Seleccione una opción de envío</h2>

          {{ Form::open(['action' => ['PaginaCarritoController@almacenarTransporte'], 'method' => 'post', 'class' => 'form-horizontal']) }}
            {{csrf_field()}}
              <fieldset>
                  {{-- 1 --}}
                  <div class="form-group">
                      <div class="col-xs-12 col-sm-1">
                        {!! Form::radio('transporte', 1, ['class' => 'form-control']) !!}
                      </div>
                      <div class="col-xs-12 col-sm-2">
                        <img src="{{asset('images/varios/transporte.jpg')}}" class="img img-responsive" alt="" style="max-width: 50px; ">
                      </div>
                      
                      <div class="col-xs-12 col-sm-6">
                        <p>TIERRA DEL FUEGO </p>
                        <p>Delivery time: Entre 7 y 10 días hábiles desde el despacho notificado por mail</p>
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <p>738,10 ARS (tasas incluídas)</p>
                      </div>
                  </div>

                  {{-- 2 --}}
                  <div class="form-group">
                      <div class="col-xs-12 col-sm-1">
                        {!! Form::radio('transporte', 2, ['class' => 'form-control']) !!}
                      </div>
                      <div class="col-xs-12 col-sm-2">
                        <img src="{{asset('images/varios/transporte.jpg')}}" class="img img-responsive" alt="" style="max-width: 50px; ">
                      </div>
                      
                      <div class="col-xs-12 col-sm-6">
                        <p>NEU- RN- CHB- SCRUZ- CHCO- JUY- SALTA- CRTES- MIS</p>
                        <p>Delivery time: Entre 7 y 10 días hábiles desde el despacho notificado por mail</p>
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <p>350,90 ARS (tasas incluídas)</p>
                      </div>
                  </div>

                  {{-- 3 --}}
                  <div class="form-group">
                      <div class="col-xs-12 col-sm-1">
                        {!! Form::radio('transporte', 3, ['class' => 'form-control']) !!}
                      </div>
                      <div class="col-xs-12 col-sm-2">
                        <img src="{{asset('images/varios/transporte.jpg')}}" class="img img-responsive" alt="" style="max-width: 50px; ">
                      </div>
                      
                      <div class="col-xs-12 col-sm-6">
                        <p>SAN LUIS- LA PAMPA- FORMOSA- CATAMARCA- LA RIOJA- TUCUMAN- SGO </p>
                        <p>Delivery time: Entre 7 y 10 días hábiles desde el despacho notificado por mail </p>
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <p>292,82 ARS (tasas incluídas)</p>
                      </div>
                  </div>

                  {{-- 4 --}}
                  <div class="form-group">
                      <div class="col-xs-12 col-sm-1">
                        {!! Form::radio('transporte', 4, ['class' => 'form-control']) !!}
                      </div>
                      <div class="col-xs-12 col-sm-2">
                        <img src="{{asset('images/varios/transporte.jpg')}}" class="img img-responsive" alt="" style="max-width: 50px; ">
                      </div>
                      
                      <div class="col-xs-12 col-sm-6">
                        <p>CORDOBA- MENDOZA- SAN JUAN- ENTRE RIOS- SANTA FE  </p>
                        <p>Delivery time: Entre 7 y 10 días hábiles desde el despacho notificado por mail </p>
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <p>260,15 ARS (tasas incluídas)</p>
                      </div>
                  </div>

                  {{-- 5 --}}
                  <div class="form-group">
                      <div class="col-xs-12 col-sm-1">
                        {!! Form::radio('transporte', 5, ['class' => 'form-control']) !!}
                      </div>
                      <div class="col-xs-12 col-sm-2">
                        <img src="{{asset('images/varios/transporte.jpg')}}" class="img img-responsive" alt="" style="max-width: 50px; ">
                      </div>
                      
                      <div class="col-xs-12 col-sm-6">
                        <p>GBA  </p>
                        <p>Delivery time: 3 día hábil desde el despacho notificado por mail </p>
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <p>223,85 ARS (tasas incluídas)</p>
                      </div>
                  </div>

                  {{-- 6 --}}
                  <div class="form-group">
                      <div class="col-xs-12 col-sm-1">
                        {!! Form::radio('transporte', 6, ['class' => 'form-control']) !!}
                      </div>
                      <div class="col-xs-12 col-sm-2">
                        <img src="{{asset('images/varios/transporte.jpg')}}" class="img img-responsive" alt="" style="max-width: 50px; ">
                      </div>
                      
                      <div class="col-xs-12 col-sm-6">
                        <p>CABA  </p>
                        <p>Delivery time: 1 día hábil desde el despacho notificado por mail </p>
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <p>181,50 ARS (tasas incluídas)</p>
                      </div>
                  </div>

                  {{-- 7 --}}
                  <div class="form-group">
                      <div class="col-xs-12 col-sm-1">
                        {!! Form::radio('transporte', 7, ['class' => 'form-control']) !!}
                      </div>
                      <div class="col-xs-12 col-sm-2">
                        <img src="{{asset('images/varios/transporte.jpg')}}" class="img img-responsive" alt="" style="max-width: 50px; ">
                      </div>
                      
                      <div class="col-xs-12 col-sm-6">
                        <p>Retiro Por Showroom  </p>
                        <p>Delivery time: Retiro en showroom, consultar disponibilidad, el mejor precio y tiempo</p>
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <p>No tiene costo adicional</p>
                      </div>
                  </div>

                  <div class="col-xs-12 col-sm-12">
                    <p>{{ Form::checkbox('terminos') }} He leído y acepto las <a href="{{url('elegir-transporte/terminos')}}" target="_blank">condiciones generales de venta</a></p>
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