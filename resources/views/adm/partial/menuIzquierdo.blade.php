<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <!-- <p>Secciones del sitio</p> -->
            </li>
        
        {{-- datos de empresa --}}
            <li>
                <a href="#"><i class="glyphicon glyphicon-user"></i> Redes sociales<span class="fa arrow"></span></a>
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

        {{-- datos de empresa --}}
            <li>
                <a href="#"><i class="glyphicon glyphicon-user"></i> Datos de la empresa<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{URL::asset('adm/dato-empresa/')}}">Ver datos</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        {{-- metadatos --}}
            <li>
                <a href="#"><i class="glyphicon glyphicon-user"></i> Metadatos<span class="fa arrow"></span></a>
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