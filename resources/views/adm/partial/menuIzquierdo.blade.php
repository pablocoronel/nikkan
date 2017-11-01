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