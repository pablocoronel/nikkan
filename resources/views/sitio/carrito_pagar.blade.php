@extends('layouts.sitio')

@section('titulo', 'Carrito')

@section('scriptsParticulares')
  <link rel="stylesheet" href="{{asset('css/seccionCarrito.css')}}">
@endsection

@section('contenido')
@include('sitio.partial.menuPrincipal')
  <img src="{{asset($portada->ruta)}}" alt="" class="img img-responsive">

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
          <h2>Seleccione el medio de pago</h2>
          
        <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-2">
                producto
              </div>
              <div class="col-xs-12 col-sm-2">
                descripción
              </div>
              <div class="col-xs-12 col-sm-2">
                precio unitario
              </div>
              <div class="col-xs-12 col-sm-2">
                cantidad
              </div>
              <div class="col-xs-12 col-sm-2">
                total
              </div>
            </div>

              @foreach($versionUnica as $item)
                @foreach($contenidoCarrito as $versionEnCarrito)
                  @if($item->id == $versionEnCarrito->id)
                      @php($rowId= $versionEnCarrito->rowId)
                      @php($cantidadActual= $versionEnCarrito->qty)
                  @endif
                @endforeach

              <div class="row">
                <div class="col-xs-12 col-sm-2">
                  <img src="{{asset($item->rutaProducto)}}" alt="">
                </div>
                <div class="col-xs-12 col-sm-2">
                  <p>Nombre: {{$item->nombreProducto}} {{$item->nombreColor}}</p>
                  <p>Talle: {{$item->nombreTalle}}</p>
                  <p>Código: {{$item->codigo_producto}}</p>
                </div>
                <div class="col-xs-12 col-sm-2">
                  ${{$item->precioConDescuento}}
                </div>
                <div class="col-xs-12 col-sm-2">
                  {{$cantidadActual}}
                </div>
                <div class="col-xs-12 col-sm-2">
                  ${{$item->precioConDescuento * $cantidadActual}}
                </div>
              </div>
              @endforeach

              {{-- subtotal productos --}}
              <div class="row">
                <div class="col-xs-12 col-sm-8">
                  
                </div>
                <div class="col-xs-12 col-sm-2">
                  Total productos:
                </div>
                <div class="col-xs-12 col-sm-2">
                  {{Cart::total()}}
                </div>
              </div>

              <div class="row">
                <div class="col-xs-12 col-sm-8">
                  
                </div>
                <div class="col-xs-12 col-sm-2">
                  Envío:
                </div>
                <div class="col-xs-12 col-sm-2">
                  ${{$precio_envio}}
                </div>
              </div>

              <div class="row">
                <div class="col-xs-12 col-sm-8">
                  
                </div>
                <div class="col-xs-12 col-sm-2">
                  Total:
                </div>
                <div class="col-xs-12 col-sm-2">
                  ${{$totalFinal}}
                </div>
              </div>

              <div class="row">
              
              </div>

              <div class="row">
                  <a href="{{url('carrito/elegir/transporte')}}" class="btn btn-primary">Atrás</a>
              </div>
          </div>

        </div>
      </div>
  </div>
  
  <div class="container">
    <a href="{{url('carrito/elegir/pago-guardar')}}" class="btn btn-primary">Simular pago</a>
  </div>
</div>
@include('sitio.partial.footer')
@endsection