<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" href="{{$favicon->ruta}}">
    <link rel="apple-touch-icon" href="{{asset('images/favicon.jpg')}}">

    
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    {{-- Archivo particulares de cada pagina --}}
    @yield('scriptsSuperior')

	<title>NIKKA-N @yield('titulo')</title>
</head>
<body>
	@yield('contenidoPadre')

    @yield('scriptsInferior')
</body>
</html>