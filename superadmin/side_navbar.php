<script>
	$(function() {
		$('#sidebarCollapse').on('click', function() {
			$('#sidebar, #content, #footer').toggleClass('active');
		});
	});
</script>

<?php
	$var = explode('/', $_SERVER['REQUEST_URI']);
	$seccion = current(explode('.', end($var)));
	$es_sesion = $var[2];

	$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/perfiles/";
	if (is_file($target_dir . $_SESSION["User_ID"] . '.jpg')) {
		$avatar = $RAIZ_SITIO . "images/perfiles/" . $_SESSION["User_ID"] . '.jpg';
	} else {
		$avatar = $RAIZ_SITIO . "images/perfiles/" . 'perfil.png';
	}
?>

<div class="vertical-nav background_gradient_new navbar-expand-lg" id="sidebar">
	<div class="py-3 px-3 mb-3">
		<div class="media d-flex align-items-center"><img src="<?php echo $avatar . "?x=" . md5(time()); ?>" alt="foto de perfil" width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm">
			<div class="media-body">
				<h4 class="m-0 text-white"><?php echo $_SESSION["nombre"] . " " . $_SESSION["ap_paterno"]; ?></h4>
				<p class="text-white w200 mb-0">Superadministrador</p>
			</div>
		</div>
	</div>

	<ul class="nav flex-column mb-0">
		<li class="nav-item <?php	if ($seccion == 'perfil') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>superadmin/perfil.php" class="nav-link text-white ml-3">
				<i class="fas fa-user-edit fa-fw mr-3"></i>Perfil <?php if ($_SESSION["estatus"]==0) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
			</a>
		</li>
	</ul>
	<hr class="hr-white">

	<p class="text-white font-weight-bold text-uppercase px-3 small py-1 mb-0">Configuración</p>
	<ul class="nav flex-column mb-0">
		<li class="nav-item <?php	if ($seccion == 'patrocinadores') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>superadmin/patrocinadores.php" class="nav-link text-white ml-3">
				<i class="fas fa-building fa-fw mr-3"></i>Patrocinadores
			</a>
		</li>
		<li class="nav-item <?php	if ($seccion == 'centros') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>superadmin/centros.php" class="nav-link text-white ml-3">
				<i class="fas fa-chalkboard-teacher fa-fw mr-3"></i>Centros
			</a>
		</li>
		<li class="nav-item <?php	if ($seccion == 'usuarios') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>superadmin/usuarios.php" class="nav-link text-white ml-3">
				<i class="fas fa-users fa-fw mr-3"></i>Usuarios
			</a>
		</li>
		<li class="nav-item <?php	if ($seccion == 'licencias') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>superadmin/licencias.php" class="nav-link text-white ml-3">
				<i class="fas fa-user-check fa-fw mr-3"></i>Licencias
			</a>
		</li>
	</ul>
	<hr class="hr-white">

	<p class="text-white font-weight-bold text-uppercase px-3 small py-1 mb-0" data-toggle="collapse" data-target="#collapse_sesions">Sesiones <i class="fas fa-angle-right fa-fw mr-3"></i></p>
	<div id="collapse_sesions" class="collapse.show">
		<ul class="nav flex-column mb-0">
			<li class="nav-item <?php	if ($seccion == '1') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/1.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>1 - Primero de Primaria
				</a>
			</li>
			<li class="nav-item <?php	if ($seccion == '2') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/2.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>2 - Segundo de Primaria
				</a>
			</li>
			<li class="nav-item <?php	if ($seccion == '3') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/3.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>3 - Tercero de Primaria
				</a>
			</li>
			<li class="nav-item <?php	if ($seccion == '4') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/4.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>4 - Cuarto de Primaria
				</a>
			</li>
			<li class="nav-item <?php	if ($seccion == '5') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/5.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>5 - Quinto de Primaria
				</a>
			</li>
			<li class="nav-item <?php	if ($seccion == '6') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/6.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>6 - Sexto de Primaria
				</a>
			</li>
			<div class="d-none d-lg-block separar-cintillo"></div>
			<div class="d-none d-lg-block band-sponsors text-center text-black-green">
				<label>Agradecemos a:</label>
				<div id="band-sponnal" class="carousel slide mt-1 mb-2" data-ride="carousel"></div>
				<div id="band-sponloc" class="carousel slide mb-2" data-ride="carousel"></div>
			</div>
		</ul>
	</div>
	<hr class="hr-white">

	<!-- <ul class="nav flex-column mb-0">
		<li class="nav-item">
			<a href="<?php echo $RAIZ_SITIO; ?>superadmin/reportes.php" class="nav-link text-white ml-3">
				<i class="fas fa-file-alt fa-fw mr-3"></i>Reportes
			</a>
		</li>
	</ul> -->

</div>

<script>
	$(document).ready(function(){
		<?php
			if ($es_sesion == "sesiones") {
		?>
			$('#collapse_sesions').collapse();
		<?php
			}
		?>
	});
</script>
