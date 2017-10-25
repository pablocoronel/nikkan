<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{{URL::asset('adm')}}">Panel de administraci&oacute;n</a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
   <li><a href="{{URL::asset('/')}}">Ir al sitio</a></li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <?php /*echo($_SESSION["usuario"])*/ ?> <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="{{URL::asset('login.loguot')}}"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>