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

<div class="vertical-nav background_gradient navbar-expand-lg" id="sidebar">
	<div class="py-3 px-3 mb-3">
		<div class="media d-flex align-items-center"><img src="<?php echo $avatar . "?x=" . md5(time()); ?>" alt="foto de perfil" width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm">
			<div class="media-body">
				<h4 class="m-0 text-white"><?php echo $_SESSION["nombre"] . " " . $_SESSION["ap_paterno"]; ?></h4>
				<p class="text-white w200 mb-0">Vinculador de <?php echo $_SESSION["Institucion_nombre"]; ?></p>
			</div>
		</div>
	</div>

	<p class="text-white font-weight-bold text-uppercase px-3 small py-1 mb-0">Perfil e institución</p>
	<ul class="nav flex-column mb-0">
		<li class="nav-item <?php	if ($seccion == 'perfil') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>vinculador/perfil.php" class="nav-link text-white ml-3">
				<i class="fas fa-user-edit fa-fw mr-3"></i>Perfil personal <?php if ($_SESSION["estatus"]==0) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
			</a>
		</li>
		<li class="nav-item <?php	if ($seccion == 'institucion') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>vinculador/institucion.php" class="nav-link text-white ml-3">
				<i class="fas fa-place-of-worship fa-fw mr-3"></i>Datos de Institución
			</a>
		</li>
	</ul>
	<hr class="hr-white">

	<p class="text-white font-weight-bold text-uppercase px-3 small py-1 mb-0">Operación del proyecto</p>
	<ul class="nav flex-column mb-0">
		<li class="nav-item <?php	if ($seccion == 'calendario') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>vinculador/calendario.php" class="nav-link text-white ml-3">
				<i class="fas fa-calendar-alt fa-fw mr-3"></i>Calendario
			</a>
		</li>
		<li class="nav-item <?php	if ($seccion == 'empresas') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>vinculador/empresas.php" class="nav-link text-white ml-3">
				<i class="fas fa-industry fa-fw mr-3"></i>Empresas Juveniles
			</a>
		</li>
		<li class="nav-item <?php	if ($seccion == 'accesos_rapidos') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>vinculador/accesos_rapidos.php" class="nav-link text-white ml-3">
				<i class="fas fa-sign-in-alt fa-fw mr-3"></i>Accesos Rápidos
			</a>
		</li>
		<li class="nav-item <?php if ($seccion == 'tablero_control') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>vinculador/tablero_control.php" class="nav-link text-white ml-3">
				<i class="fas fa-digital-tachograph fa-fw mr-3"></i>Tablero de Control
			</a>
		</li>
	</ul>
	<hr class="hr-white">

	<ul class="nav flex-column mb-0">
		<li class="nav-item <?php	if ($seccion == 'capacitaciones') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>sesiones/capacitaciones.php" class="nav-link text-white ml-3">
				<i class="fas fa-chalkboard-teacher fa-fw mr-3"></i>Capacitaciones
			</a>
		</li>
	</ul>

	<p class="text-white font-weight-bold text-uppercase px-3 small py-1 mb-0" data-toggle="collapse" data-target="#collapse_sesions">Sesiones <i class="fas fa-angle-right fa-fw mr-3"></i></p>
	<div id="collapse_sesions" class="collapse.show">
		<ul class="nav flex-column mb-0">
			<li class="nav-item <?php	if ($seccion == '0') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/0.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Bienvenida y Registro
				</a>
			</li>
			<?php if ($_SESSION["subseccion_general"]>0) { ?>
			<li class="nav-item <?php	if ($seccion == '1') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/1.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Sesión 1 - Conviértete en emprendedor <?php if (isset($_SESSION["sesion1"]) AND $_SESSION["sesion1"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>14) { ?>
			<li class="nav-item <?php	if ($seccion == '2') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/2.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Sesión 2 - El arte de crear I <?php if (isset($_SESSION["sesion2"]) AND $_SESSION["sesion2"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>24) { ?>
			<li class="nav-item <?php	if ($seccion == '3') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/3.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Sesión 3 - El arte de crear II <?php if (isset($_SESSION["sesion3"]) AND $_SESSION["sesion3"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>32) { ?>
			<li class="nav-item <?php	if ($seccion == '4') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/4.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Sesión 4 - Selección de Roles <?php if (isset($_SESSION["sesion4"]) AND $_SESSION["sesion4"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
				</a>
			</li>
			<?php } ?>
			<?php /*if ($_SESSION["subseccion_general"]>43) { ?>
			<li class="nav-item <?php	if ($seccion == '5') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/5.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Sesión 5 - La Identidad Empresarial <?php if (isset($_SESSION["sesion5"]) AND $_SESSION["sesion5"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>53) { ?>
			<li class="nav-item <?php	if ($seccion == '6') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/6.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Sesión 6 - Factibilidad Técnica <?php if (isset($_SESSION["sesion6"]) AND $_SESSION["sesion6"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
				</a>
			</li>
			<?php } /*?>
			<?php if ($_SESSION["subseccion_general"]>44) { ?>
			<li class="nav-item <?php	if ($seccion == '102') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/102.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Encuesta Final <?php if (isset($_SESSION["sesion102"]) AND $_SESSION["sesion102"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>44) { ?>
			<li class="nav-item <?php	if ($seccion == '103') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/103.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>GANADORES <?php if (isset($_SESSION["sesion103"]) AND $_SESSION["sesion103"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
				</a>
			</li>
			<?php } /*
			<?php if ($_SESSION["subseccion_general"]>44) { ?>
			<li class="nav-item <?php	if ($seccion == '5') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/5.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Sesión 5
				</a>
			</li>
			<?php } ?>
			<?php /*
			<li class="nav-item <?php	if ($seccion == '6') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/6.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Sesión 6
				</a>
			</li>
			<li class="nav-item <?php	if ($seccion == '7') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/7.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Sesión 7
				</a>
			</li>
			<li class="nav-item <?php	if ($seccion == '8') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/8.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Sesión 8
				</a>
			</li>
			<li class="nav-item <?php	if ($seccion == '9') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/9.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Sesión 9
				</a>
			</li>
			<li class="nav-item <?php	if ($seccion == '10') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/10.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Sesión 10
				</a>
			</li>
			<li class="nav-item <?php	if ($seccion == '11') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/11.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Sesión 11
				</a>
			</li>
			<li class="nav-item <?php	if ($seccion == '12') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/12.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Sesión 12
				</a>
			</li>
			<li class="nav-item <?php	if ($seccion == '13') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/13.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Sesión 13
				</a>
			</li>
			<li class="nav-item <?php	if ($seccion == '14') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/14.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Sesión 14
				</a>
			</li>
			<li class="nav-item <?php	if ($seccion == '15') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/15.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i>Sesión 15
				</a>
			</li>
			*/ ?>
			<div class="d-none d-lg-block separar-cintillo"></div>
			<div class="d-none d-lg-block band-sponsors text-center text-black-green">
				<label>Agradecemos a:</label>
				<div id="band-sponnal" class="carousel slide mt-1 mb-2" data-ride="carousel"></div>
				<div id="band-sponloc" class="carousel slide mb-2" data-ride="carousel"></div>
			</div>
		</ul>
	</div>
	<?php /*
	<hr class="hr-white">

	<ul class="nav flex-column mb-0">
		<li class="nav-item">
			<a href="<?php echo $RAIZ_SITIO; ?>vinculador/reportes.php" class="nav-link text-white ml-3">
				<i class="fas fa-file-alt fa-fw mr-3"></i>Reportes
			</a>
		</li>
	</ul>
*/?>
	<div class="separar-cintillo"></div>
	<div class="band-sponsors text-center text-black-green">
		<label>Agradecemos a:</label>
		<div id="band-sponnal" class="carousel slide mt-1 mb-2" data-ride="carousel"></div>
		<div id="band-sponloc" class="carousel slide mb-2" data-ride="carousel"></div>
	</div>


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

		$.ajax({
			url: <?php echo "'" . $RAIZ_SITIO_nohttp . "vinculador/ajax/cintillo_sponsors_nacionales.php'";?>,
			success: function(data)
			{
				$("#band-sponnal").html(data);
			}
		});

		$('#band-sponnal').carousel({
			interval: 3000,
		})

		$.ajax({
			url: <?php echo "'" . $RAIZ_SITIO_nohttp . "vinculador/ajax/cintillo_sponsors_locales.php'";?>,
			success: function(data)
			{
				$("#band-sponloc").html(data);
			}
		});

		$('#band-sponloc').carousel({
			interval: 2500,
		})


	});
</script>
