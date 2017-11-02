@extends('layouts.principal')
@section('titulo', 'Panel de administración')

@section('scriptsSuperior')
	<!-- MetisMenu CSS -->
	<link href="{{asset('/plugins/templateAdm/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="{{asset('/plugins/templateAdm/dist/css/sb-admin-2.css')}}" rel="stylesheet">

	<!-- Morris Charts CSS -->
	<link href="{{asset('/plugins/templateAdm/vendor/morrisjs/morris.css')}}" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="{{asset('/plugins/templateAdm/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
@endsection

@section('contenidoPadre')
@yield('nombreDeAccion')
<div id="wrapper">
        <!-- Barra superior -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            @include('adm.partial.menuSuperior')
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
	<script src="{{asset('/plugins/templateAdm/vendor/jquery/jquery.min.js')}}"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="{{asset('/plugins/templateAdm/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="{{asset('/plugins/templateAdm/vendor/metisMenu/metisMenu.min.js')}}"></script>

	<!-- Morris Charts JavaScript -->
	<script src="{{asset('/plugins/templateAdm/vendor/raphael/raphael.min.js')}}"></script>
	<script src="{{asset('/plugins/templateAdm/vendor/morrisjs/morris.min.js')}}"></script>
	<script src="{{asset('/plugins/templateAdm/data/morris-data.js')}}"></script>

	<!-- Custom Theme JavaScript -->
	<script src="{{asset('/plugins/templateAdm/dist/js/sb-admin-2.js')}}"></script>
@endsection