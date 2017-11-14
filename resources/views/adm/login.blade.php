@extends('layouts.principal')
@section('titulo', '- Administrador')

{{-- CSS --}}
@section('cssParticular')
<link rel="stylesheet" href="{{URL::asset('css/admLogin.css')}}">
@endsection


{{-- contenido --}}
@section('contenidoPadre')
	<div class="row">
            <div class="col-md-4 col-md-offset-4 logoEnLogin">
                <img src="" alt="" class="img img-responsive center-block">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Panel de Administraci&oacute;n</h3>
                    </div>

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
                            @if(Session::has('mensajeOk'))
                                <div class="alert alert-success" role="alert">
                                    {{Session::get('mensajeOk', '')}}
                                </div>
                            @endif
                        </div>  
                    </div>

                    <div class="panel-body">
                        {!!Form::open(['action' => ['LoginController@iniciarAdmin', 'method'=>'POST']])!!}

                        {{csrf_field()}}
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="usuario" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Clave" name="clave" type="password">
                                </div>
                                <input type="submit" value="Ingresar" class="btn btn-lg btn-success btn-block">
                            </fieldset>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
@endsection