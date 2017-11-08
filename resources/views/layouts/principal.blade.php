<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" href="{{asset($favicon->ruta)}}">
    <link rel="apple-touch-icon" href="{{asset('images/favicon.jpg')}}">
    
    <!-- jQuery -->
    <script src="{{asset('/js/jquery-2.1.4.min.js')}}"></script>
    
    {{-- Bootstrap --}}
    <script src="{{asset('/js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    {{-- archivos para cada layout hijo --}}
    @yield('scriptsSuperior')

    {{-- Archivo particulares de cada pagina --}}
    @yield('scriptsParticulares')

	<title>NIKKA-N @yield('titulo')</title>
</head>
<body>
	@yield('contenidoPadre')

    @yield('scriptsInferior')
</body>
</html>