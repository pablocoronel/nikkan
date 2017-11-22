<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <!-- <p>Secciones del sitio</p> -->
            </li>
        
        {{-- home --}}
            <li>
                <a href="#"><i class="glyphicon glyphicon-picture"></i> Home<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{URL::asset('adm/home/slider/crear')}}">Crear slider</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('adm/home/slider/')}}">Ver slider</a>
                    </li>

                    <li>
                        <a href="{{URL::asset('adm/home/destacado/crear')}}">Crear destacado</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('adm/home/destacado/')}}">Ver destacado</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        {{-- empresa --}}
            <li>
                <a href="#"><i class="glyphicon glyphicon-picture"></i> Empresa<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{URL::asset('adm/empresa/portada/')}}">Ver portada</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('adm/empresa/slider/crear')}}">Crear slider</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('adm/empresa/slider/')}}">Ver slider</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        {{-- coleccion --}}
            <li>
                <a href="#"><i class="glyphicon glyphicon-picture"></i> Colección<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{URL::asset('adm/coleccion/portada/')}}">Ver portada</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        {{-- productos --}}
            <li>
                <a href="#"><i class="glyphicon glyphicon-picture"></i> Productos<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{URL::asset('adm/tienda/familia/crear')}}">Crear familia</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('adm/tienda/familia/')}}">Ver familia</a>
                    </li>

                    <li>
                        <a href="{{URL::asset('adm/tienda/categoria/crear')}}">Crear categoria</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('adm/tienda/categoria/')}}">Ver categoria</a>
                    </li>

                    <li>
                        <a href="{{URL::asset('adm/tienda/producto/crear')}}">Crear producto</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('adm/tienda/producto/')}}">Ver producto</a>
                    </li>

                    <li>
                        <a href="{{URL::asset('adm/tienda/color/crear')}}">Crear color</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('adm/tienda/color/')}}">Ver color</a>
                    </li>

                    <li>
                        <a href="{{URL::asset('adm/tienda/talle/crear')}}">Crear talle</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('adm/tienda/talle/')}}">Ver talle</a>
                    </li>

                    <li>
                        <a href="{{URL::asset('adm/tienda/cupon/crear')}}">Crear cupón</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('adm/tienda/cupon/')}}">Ver cupón</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        {{-- campania --}}
            <li>
                <a href="#"><i class="glyphicon glyphicon-picture"></i> Campaña<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{URL::asset('adm/campania/slider/crear')}}">Crear slider</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('adm/campania/slider/')}}">Ver slider</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        {{-- discontinuo --}}
            <li>
                <a href="#"><i class="glyphicon glyphicon-picture"></i> Discontinuo<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{URL::asset('adm/discontinuo/portada/')}}">Ver portada</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        {{-- showroom --}}
            <li>
                <a href="#"><i class="glyphicon glyphicon-picture"></i> Showroom<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{URL::asset('adm/showroom/portada/')}}">Ver portada</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('adm/showroom/slider/crear')}}">Crear slider</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('adm/showroom/slider/')}}">Ver slider</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        {{-- contacto --}}
            <li>
                <a href="#"><i class="glyphicon glyphicon-picture"></i> Contacto<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{URL::asset('adm/contacto/portada/')}}">Ver portada</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('adm/contacto/mapa/')}}">Ver mapa</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        {{-- compras --}}
            <li>
                <a href="#"><i class="glyphicon glyphicon-picture"></i> Compras<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{URL::asset('adm/compra/')}}">Ver compras</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        {{-- logos --}}
            <li>
                <a href="#"><i class="glyphicon glyphicon-picture"></i> Logos<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{URL::asset('adm/logo/')}}">Ver logos</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        {{-- datos de empresa --}}
            <li>
                <a href="#"><i class="glyphicon glyphicon-list"></i> Datos de la empresa<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{URL::asset('adm/dato-empresa/')}}">Ver datos</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        {{-- pdf --}}
            <li>
                <a href="#"><i class="glyphicon glyphicon-picture"></i> Documentos <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{URL::asset('adm/documento/pdf/')}}">Constancia Afip</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('adm/terminos/texto/')}}">Términos y condiciones</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        {{-- redes sociales --}}
            <li>
                <a href="#"><i class="glyphicon glyphicon-globe"></i> Redes sociales<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{URL::asset('adm/redes-sociales/crear')}}">Crear red social</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('adm/redes-sociales/')}}">Ver redes sociales</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        {{-- metadatos --}}
            <li>
                <a href="#"><i class="glyphicon glyphicon-list-alt"></i> Metadatos<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{URL::asset('adm/metadato/')}}">Ver metadatos</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        {{-- usuarios --}}
        @if(Auth::check())
            <li>
                <a href="#"><i class="glyphicon glyphicon-user"></i> Usuarios<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{URL::asset('adm/usuario/crear')}}">Crear usuario</a>
                    </li>
                    <li>
                        <a href="{{URL::asset('adm/usuario/')}}">Ver usuarios</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        @endif        
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>