@extends('layouts.basico')
@section('titulo', 'Panel de administración')

@section('scriptsSuperior')
	<!-- MetisMenu CSS -->
	<link href="{{asset('templateAdm/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="{{asset('templateAdm/dist/css/sb-admin-2.css')}}" rel="stylesheet">

	<!-- Morris Charts CSS -->
	<link href="{{asset('templateAdm/vendor/morrisjs/morris.css')}}" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="{{asset('templateAdm/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
@endsection

@section('plantillaHija')
<div id="wrapper">
        <!-- Barra superior -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Panel de administraci&oacute;n</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               <li><a href="../index.php">Ir al sitio</a></li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php /*echo($_SESSION["usuario"])*/ ?> <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="php/loguot.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

			<!-- Menu derecho -->
			@include('adm.partial.menuIzquierdo')
            <!-- /.navbar-static-side -->
        </nav>
		
		<div id="page-wrapper">
			@yield('contenido')
		</div>

        <!-- /#page-wrapper -->
</div>
@endsection

@section('scriptsInferior')
	<!-- jQuery -->
	<script src="{{asset('templateAdm/vendor/jquery/jquery.min.js')}}"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="{{asset('templateAdm/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="{{asset('templateAdm/vendor/metisMenu/metisMenu.min.js')}}"></script>

	<!-- Morris Charts JavaScript -->
	<script src="{{asset('templateAdm/vendor/raphael/raphael.min.js')}}"></script>
	<script src="{{asset('templateAdm/vendor/morrisjs/morris.min.js')}}"></script>
	<script src="{{asset('templateAdm/data/morris-data.js')}}"></script>

	<!-- Custom Theme JavaScript -->
	<script src="{{asset('templateAdm/dist/js/sb-admin-2.js')}}"></script>
@endsection