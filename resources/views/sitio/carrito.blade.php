@extends('layouts.sitio')

@section('titulo', 'Carrito')

@section('scriptsParticulares')
  <link rel="stylesheet" href="{{asset('css/seccionCarrito.css')}}">
@endsection

@section('contenido')
@include('sitio.partial.menuPrincipal')
  <img src="{{$portada->ruta}}" alt="" class="img img-responsive">

  <div class="container">
      @foreach($contenidoCarrito as $item)
          <p>{{$item->stock}}</p>
      @endforeach
  </div>
@include('sitio.partial.footer')
@endsection