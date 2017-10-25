<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" href="{{asset('images/favicon.jpg')}}">
    <link rel="apple-touch-icon" href="{{asset('images/favicon.jpg')}}">

    
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    {{-- Archivo particulares de cada pagina --}}
    @yield('scriptsSuperior')

    <!-- Archivos JS de bootstrap -->
    <script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

	<title>NIKKA-N @yield('titulo')</title>
</head>
<body>
	@yield('plantillaHija')

    @yield('scriptsInferior')
</body>
</html>