<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" href="{{URL::asset('images/favicon.jpg')}}">
    <link rel="apple-touch-icon" href="{{URL::asset('images/favicon.jpg')}}">

    
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
    {{-- <link rel="stylesheet" href="{{URL::asset('css/layout.css')}}"> --}}

    {{-- Archivo css de cada pagina --}}
    @yield('cssParticular')

    <!-- Archivos JS de bootstrap -->
    <script src="{{URL::asset('js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>

	<title>NIKKA-N @yield('titulo')</title>
</head>
<body>
	<div class="container">
		@yield('contenido')
	</div>
</body>
</html>