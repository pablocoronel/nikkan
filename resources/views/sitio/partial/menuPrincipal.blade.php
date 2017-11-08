{{-- cabecera --}}
<div id="contendorCabeceraMenu">
  <div class="container hidden-xs" id="cabecera">
    <div id="datosEmpresa">
      <div id="telefono">
        <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
        
        {{ $telefonoEmpresa->texto}}
      </div>

      <div id="correo">
        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
        {{ $correoEmpresa->texto}}
      </div>    
    </div>


    <div id="redesSocialesSuperior" class="pull-right">
      @foreach($redesSuperior as $cadaRed)
        <div id="cadaRed">
          <a href="{{ $cadaRed->vinculo}}">
            <img src="{{ asset($cadaRed->ruta)}}" alt="" class="img img-responsive">
          </a>        
        </div>
      @endforeach
    </div>
  </div>

  {{-- menu --}}
  <nav class="navbar" data-spy="affix" data-offset-top="47">
     <div class="container" id="contenedorMenuPrincipal">
        <!-- Brand and toggle get grouped for better mobile display -->
        <!-- Logo y boton hamburguesa -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menuPrincipal" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{URL::asset('/')}}"><img src="{{asset($logoPrincipal->ruta)}}" id="logoMenuPrincipal" class="img img-responsive" alt="Logo"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <!-- links, botones e inputs -->
        <div class="collapse navbar-collapse" id="menuPrincipal">
          <!-- lado comun -izquierdo- -->
          <ul class="nav navbar-nav" id="listaSecciones">
            <li><a href="{{URL::asset('empresa')}}">NIKKA</a></li>
            <li><a href="{{URL::asset('coleccion')}}">COLECCIÓN</a></li>
            <li><a href="{{URL::asset('campania')}}">CAMPAÑA</a></li>
            <li><a href="{{URL::asset('discontinuos')}}">DISCONTINUOS</a></li>
            <li><a href="{{URL::asset('showroom')}}">SHOWROOM</a></li>
            <li><a href="{{URL::asset('contacto')}}">CONTACTO</a></li>
          </ul>
            
          <!-- lado derecho -->
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{URL::asset('carrito')}}"><img src="{{asset('images/varios/shopping-bag.png')}}" alt="" id="imagenBolsa"></a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
  </nav>
</div>