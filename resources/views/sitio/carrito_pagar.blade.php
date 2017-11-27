@extends('layouts.sitio')

@section('titulo', 'Carrito')

@section('scriptsParticulares')
  <link rel="stylesheet" href="{{asset('css/seccionCarrito.css')}}">
@endsection

@section('contenido')
@include('sitio.partial.menuPrincipal')
  <img src="{{asset($portada->ruta)}}" alt="" class="img img-responsive">

<div class="container" style="position: relative; z-index: 0;">
  
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

      <div class="row">
        <h2>Seleccione el medio de pago</h2>
      </div>
          
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <th>
            {{-- <td>Producto</td> --}}
            <td>Descripción</td>
            <td>Precio unitario</td>
            <td>Cantidad</td>
            <td>Desc. cupón/U</td>
            <td>Total</td>
          </th>
        </thead>

        <tbody>
              @foreach($versionUnica as $item)
                @foreach($contenidoCarrito as $versionEnCarrito)
                  @if($item->id == $versionEnCarrito->id)
                      @php($rowId= $versionEnCarrito->rowId)
                      @php($cantidadActual= $versionEnCarrito->qty)
                  @endif
                @endforeach

            <tr>
              <td>
                <img src="{{asset($item->rutaProducto)}}" class="img img-responsive" alt="">
              </td>
              
              <td>
                <p>Nombre: {{$item->nombreProducto}} {{$item->nombreColor}}</p>
                <p>Talle: {{$item->nombreTalle}}</p>
                <p>Código: {{$item->codigo_producto}}</p>              
              </td>
              <td>
                ${{$item->precioConDescuento}}
              </td>
              <td>
                {{$cantidadActual}}
              </td>
              <td>
                @if(Session::has('descuentosAplicados'))
                @if(isset(Session::get('descuentosAplicados')[$item->id]))
                  @if(in_array($item->id, Session::get('descuentosAplicados')[$item->id]))
                    ${{Session::get("descuentosAplicados")[$item->id]['descuento_cupon']}}
                  @endif
                @endif
              @endif
              </td>
              <td>
                @php($producto= Cart::get($rowId))
                @php($precio_con_cupon= $producto->price)
                ${{$precio_con_cupon * $cantidadActual}}
              </td>
            </tr>
              @endforeach

              {{-- subtotal productos --}}
              <tr id="filaTotal">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  Total productos:
                </td>
                <td>
                  {{Cart::total()}}
                </td>
              </tr>

              <tr id="filaTotal">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  Envío:
                </td>
                <td>
                  ${{$precio_envio}}
                </td>
              </tr>


              <tr id="filaTotal">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  Total:
                </td>
                <td>
                  ${{$totalFinal}}
                </td>
              </tr>


              {{-- <tr id="filaTotal">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr> --}}
          </tbody>
      </table>
      </div>
  
              <div class="row">
                  <a href="{{url('carrito/elegir/transporte')}}" class="btn btn-primary" id="btn-siguiente">Atrás</a>
              </div>

  <div class="container">
    <a href="{{url('carrito/elegir/pago-guardar')}}" class="btn btn-primary">Simular pago en administrador</a>
  </div>

  <div class="container">
    <a href="<?php echo $preference['response']['sandbox_init_point']; ?>" target="_blank">Pagar con MercadoPago</a>
  </div>
</div>
@include('sitio.partial.footer')
@endsection