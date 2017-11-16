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

              @if(Session::has('completar_entrega'))
                <div class="alert alert-danger">
                  {{Session::get('completar_entrega', '')}}
                </div>
              @elseif(Session::has('completar_facturacion'))
                <div class="alert alert-danger">
                  {{Session::get('completar_facturacion', '')}}
                </div>
              @endif
          </div>  
      </div>

      <div class="panel-body">
        <div class="row">
            {{-- de entrega --}}
            <div class="col-xs-12 col-sm-6">
              {{-- Entrega --}}
              @if(Session::has('guardadoDireccionEntrega'))
                  <div class="alert alert-success" role="alert">
                      {{Session::get('guardadoDireccionEntrega', '')}}
                  </div>
              @endif            
          </div>
          <div class="col-xs-12 col-sm-6">
            {{-- facturacion --}}
            @if(Session::has('guardadoDireccionFacturacion'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('guardadoDireccionFacturacion', '')}}
                </div>
            @endif
          </div>
        </div>

        <div class="col-xs-12 col-sm-6">
          <h2>Dirección de entrega</h2>

          {{ Form::open(['action' => ['PaginaCarritoController@almacenarDireccionDeEntrega'], 'method' => 'post', 'class' => 'form-horizontal']) }}
            {{csrf_field()}}
              <fieldset>
                  <div class="form-group">
                    {!! Form::label('direccion', 'Dirección', ['class' => 'col-sm-3 control-label']) !!}
                      <div class="col-sm-7">
                        {!! Form::text('direccion','', ['class' => 'form-control', 'placeholder' => 'Dirección']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('direccion2', 'Dirección 2', ['class' => 'col-sm-3 control-label']) !!}
                      <div class="col-sm-7">
                        {!! Form::text('direccion2', '', ['class' => 'form-control', 'placeholder' => 'Dirección 2']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('codigo_postal', 'Código postal', ['class' => 'col-sm-3 control-label']) !!}
                      <div class="col-sm-7">
                        {!! Form::text('codigo_postal', '', ['class' => 'form-control', 'placeholder' => 'Código postal']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('ciudad', 'Ciudad', ['class' => 'col-sm-3 control-label']) !!}
                      <div class="col-sm-7">
                        {!! Form::text('ciudad', '', ['class' => 'form-control', 'placeholder' => 'Ciudad']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('provincia', 'Provincia', ['class' => 'col-sm-3 control-label']) !!}
                      <div class="col-sm-7">
                        {!! Form::select('provincia', $listadoProvincia, '', ['class' => 'form-control', 'placeholder' => '-']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('pais', 'País', ['class' => 'col-sm-3 control-label']) !!}
                      <div class="col-sm-7">
                        {!! Form::select('pais', $listadoPais, '', ['class' => 'form-control', 'placeholder' => '-']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('telefono_domicilio', 'Teléfono de domicilio', ['class' => 'col-sm-3 control-label']) !!}
                      <div class="col-sm-7">
                        {!! Form::text('telefono_domicilio', '', ['class' => 'form-control', 'placeholder' => 'Teléfono de domicilio']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('telefono_celular', 'Teléfono celular', ['class' => 'col-sm-3 control-label']) !!}
                      <div class="col-sm-7">
                        {!! Form::text('telefono_celular', '', ['class' => 'form-control', 'placeholder' => 'Teléfono celular']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('comentario', 'Comentario', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-7">
                      {!! Form::textarea('comentario', '', ['class' => 'form-control', 'placeholder' => 'Comentario']) !!}
                    </div>
                  </div>

                  <div class="col-sm-4 col-sm-offset-4">
                    {!! Form::submit('Guardar', ['class' => 'btn btn-lg btn-success btn-block']) !!}
                </div>
              </fieldset>
          {!! Form::close() !!}
        </div>

        {{-- de facturacion --}}
        <div class="col-xs-12 col-sm-6">
          <h2>Dirección de facturación</h2>

          {{ Form::open(['action' => ['PaginaCarritoController@almacenarDireccionDeFacturacion'], 'method' => 'post', 'class' => 'form-horizontal']) }}
            {{csrf_field()}}
              <fieldset>
                  <div class="form-group">
                    {!! Form::label('direccion', 'Dirección', ['class' => 'col-sm-3 control-label']) !!}
                      <div class="col-sm-7">
                        {!! Form::text('direccion', '', ['class' => 'form-control', 'placeholder' => 'Dirección']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('direccion2', 'Dirección 2', ['class' => 'col-sm-3 control-label']) !!}
                      <div class="col-sm-7">
                        {!! Form::text('direccion2', '', ['class' => 'form-control', 'placeholder' => 'Dirección 2']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('codigo_postal', 'Código postal', ['class' => 'col-sm-3 control-label']) !!}
                      <div class="col-sm-7">
                        {!! Form::text('codigo_postal', '', ['class' => 'form-control', 'placeholder' => 'Código postal']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('ciudad', 'Ciudad', ['class' => 'col-sm-3 control-label']) !!}
                      <div class="col-sm-7">
                        {!! Form::text('ciudad', '', ['class' => 'form-control', 'placeholder' => 'Ciudad']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('provincia', 'Provincia', ['class' => 'col-sm-3 control-label']) !!}
                      <div class="col-sm-7">
                        {!! Form::select('provincia', $listadoProvincia, ['class' => 'form-control', 'placeholder' => '-']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('pais', 'País', ['class' => 'col-sm-3 control-label']) !!}
                      <div class="col-sm-7">
                        {!! Form::select('pais', $listadoPais, ['class' => 'form-control', 'placeholder' => '-']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('telefono_domicilio', 'Teléfono de domicilio', ['class' => 'col-sm-3 control-label']) !!}
                      <div class="col-sm-7">
                        {!! Form::text('telefono_domicilio', '', ['class' => 'form-control', 'placeholder' => 'Teléfono de domicilio']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('telefono_celular', 'Teléfono celular', ['class' => 'col-sm-3 control-label']) !!}
                      <div class="col-sm-7">
                        {!! Form::text('telefono_celular', '', ['class' => 'form-control', 'placeholder' => 'Teléfono celular']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('comentario', 'Comentario', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-7">
                      {!! Form::textarea('comentario', '', ['class' => 'form-control', 'placeholder' => 'Comentario']) !!}
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
  
  <div class="container">
    <a href="{{url('elegir-transporte')}}" class="btn btn-primary">Siguiente</a>
  </div>
</div>
@include('sitio.partial.footer')
@endsection