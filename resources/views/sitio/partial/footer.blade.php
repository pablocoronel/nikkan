<footer>
	<div class="container" id="contenedorFooter">
		<div class="col-xs-12 col-md-4" id="contenedorDatos">
			<h4>CONTACTANOS</h4>
			<ul>
				<li>
					<span class="glyphicon glyphicon-phone"></span>
					<p>{{$telefonoEmpresa->texto}}</p>
				</li>
				<li>
					<span class="glyphicon glyphicon-envelope"></span>
					<p>
						<a href="mailto:{{$correoEmpresa->texto}}">
							{{$correoEmpresa->texto}}
						</a>
					</p>
				</li>
				<li>
					<span class="glyphicon glyphicon-map-marker"></span>
					<p>{{$direcionEmpresa->texto}}</p>
				</li>
			</ul>
		</div>
		<div class="col-xs-12 col-md-4" id="sitemap">
			<img src="{{asset($logoFooter->ruta)}}" class="img img-responsive" alt="">
			<ul>
				<li><a href="{{asset('/')}}">HOME</a></li>
				<li><a href="{{asset('empresa')}}">NIKKA</a></li>
				<li><a href="{{asset('coleccion')}}">COLECCION</a></li>
				<li><a href="{{asset('campania')}}">CAMPAÑA</a></li>
				<li><a href="{{asset('discontinuos')}}">DISCONTINUOS</a></li>
				<li><a href="{{asset('contacto')}}">CONTACTO</a></li>
			</ul>
		</div>
		<div class="col-xs-12 col-md-4" id="redes">
			<h4>SEGUINOS</h4>
			<ul>
				@foreach($redesInferior as $cadaRed)
					<li>
						<a href="{{$cadaRed->vinculo}}">
							<img src="{{asset($cadaRed->ruta)}}" class="img img-responsive" alt="">
						</a>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</footer>