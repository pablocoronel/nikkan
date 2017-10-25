<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <!-- <p>Secciones del sitio</p> -->
            </li>

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