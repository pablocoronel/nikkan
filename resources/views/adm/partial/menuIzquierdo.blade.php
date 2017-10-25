<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <!-- <p>Secciones del sitio</p> -->
            </li>

            <li>
                <a href="#"><i class="glyphicon glyphicon-home"></i> Home<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="index.php?seccion=homeSliderCrear">Crear slider</a>
                    </li>
                    <li>
                        <a href="index.php?seccion=homeSliderEditar">Editar/Eliminar slider</a>
                    </li>
                    <li>
                        <a href="index.php?seccion=homeDestacadoEditar">Editar/Eliminar destacado</a>
                    </li>
                    <li>
                        <a href="index.php?seccion=homeInstitucionalEditar">Editar texto central</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="glyphicon glyphicon-briefcase"></i> Bufete<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="index.php?seccion=empresaSliderCrear">Crear slider</a>
                    </li>
                    <li>
                        <a href="index.php?seccion=empresaSliderEditar">Editar/Eliminar slider</a>
                    </li>
                    <li>
                        <a href="index.php?seccion=empresaDestacadoEditarIndividual">Editar/Eliminar institucional</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="glyphicon glyphicon-object-align-vertical"></i> Servicios Legales<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="index.php?seccion=productoSliderCrear">Crear slider</a>
                    </li>
                    <li>
                        <a href="index.php?seccion=productoSliderEditar">Editar/Eliminar slider</a>
                    </li>
                    <li>
                        <a href="index.php?seccion=productoProductoCrear">Crear servicio</a>
                    </li>
                    <li>
                        <a href="index.php?seccion=productoProductoEditar">Editar/Eliminar servicio</a>
                    </li>
                    <li>
                        <a href="index.php?seccion=productoTextoCentralEditar">Editar texto central</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="glyphicon glyphicon-object-align-vertical"></i> Enlaces<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="index.php?seccion=enlaceSliderCrear">Crear slider</a>
                    </li>
                    <li>
                        <a href="index.php?seccion=enlaceSliderEditar">Editar/Eliminar slider</a>
                    </li>
                    <li>
                        <a href="index.php?seccion=enlaceEnlaceCrear">Crear enlace</a>
                    </li>
                    <li>
                        <a href="index.php?seccion=enlaceEnlaceEditar">Editar/Eliminar enlace</a>
                    </li>
                    <li>
                        <a href="index.php?seccion=enlaceTextoCentralEditar">Editar t&iacute;tulo</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <!-- <p>Estructura General</p> -->
            </li>
            <li>
                <a href="#"><i class="glyphicon glyphicon-picture"></i> Logos<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="index.php?seccion=logoEditar">Editar logos</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="glyphicon glyphicon-list"></i> Datos de la empresa<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="index.php?seccion=datoEmpresaEditar">Editar datos</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="glyphicon glyphicon-globe"></i> Redes sociales<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="index.php?seccion=redSocialCrear">Crear red social</a>
                    </li>
                    <li>
                        <a href="index.php?seccion=redSocialEditar">Editar/Eliminar red social</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="glyphicon glyphicon-list-alt"></i> Metadatos<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="index.php?seccion=metadatoEditar">Editar metadatos</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            

            <li>
                <!-- <p>Usuarios</p> -->
            </li>

            <?php if(isset($_SESSION["nivel"]) && $_SESSION["nivel"] == "administrador"){ ?>
            <li>
                <a href="#"><i class="glyphicon glyphicon-user"></i> Usuarios<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="index.php?seccion=usuarioCrear">Crear usuario</a>
                    </li>
                    <li>
                        <a href="index.php?seccion=usuarioEditar">Editar/Eliminar usuario</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <?php } ?>

            
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>