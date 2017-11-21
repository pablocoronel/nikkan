@extends('layouts.sitio')

@section('titulo', 'Carrito')

@section('scriptsParticulares')
  <link rel="stylesheet" href="{{asset('css/seccionCarrito.css')}}">
@endsection

@section('contenido')
@include('sitio.partial.menuPrincipal')
  <img src="{{asset($portada->ruta)}}" alt="" class="img img-responsive">

<div class="container" style="position: relative; z-index: 0;">
  
  <div class="row">
    <a href="{{url('carrito/vaciar')}}" class="btn btn-info" id="btn-vaciar">Vaciar carrito</a>
  </div>

  @if(Session::has('stockNoDisponible'))
    <div class="alert alert-warning">
      <p>{{Session::get('stockNoDisponible')}}</p>
    </div>
  @endif

  <div class="container">
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <th>
            {{-- <td>Producto</td> --}}
            <td>Descripción</td>
            <td>Precio unitario</td>
            <td>Cantidad</td>
            <td>Quitar</td>
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
              <form action="{{url('carrito/actualizarCantidadItem')}}" method="post">
                 {{csrf_field()}}
                 <input name="rowId" type="hidden" value="{{$rowId}}">
                 <input name="idVersion" type="hidden" value="{{$item->id}}">
                 
                 <input type="number" name="nuevaCantidad" value="{{$cantidadActual}}" min="1">
                 <button class="btn btn-xs btn-success" type="submit" id="btn-cantidad">cambiar</button>
              </form>
              <a href=""></a>
            </td>  
            
            <td>
              <form action="{{url('carrito/quitarItem')}}" method="post">
                 {{csrf_field()}}
                 <input name="_method" type="hidden" value="DELETE">
                 <input name="rowId" type="hidden" value="{{$rowId}}">
                 
                 <button class="btn btn-xs btn-danger" type="submit">X</button>
              </form>
            </td>
            <td>
              ${{$item->precioConDescuento * $cantidadActual}}
            </td>
          </tr>
          @endforeach

          {{-- total --}}
          <tr id="filaTotal">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
              Total:
            </td>
            <td>
              {{Cart::total()}}
            </td>
          </tr>
        </tbody>
      </table>
    </div>

      <div class="row">
        @if(Auth::check())
          <a href="{{url('carrito/elegir/direccion')}}" class="btn btn-primary" id="btn-siguiente">Dirección</a>
        @else
          <a href="{{url('login/iniciar-sesion')}}" class="btn btn-primary" id="btn-siguiente">Ingresar</a>
        @endif
      </div>
  </div>
</div>
@include('sitio.partial.footer')
@endsection