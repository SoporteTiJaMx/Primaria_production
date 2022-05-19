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
				<p class="text-white w200 mb-0">Asesor de Empresas Juveniles</p>
			</div>
		</div>
	</div>

	<p class="text-white font-weight-bold text-uppercase px-3 small py-1 mb-0">Perfil</p>
	<ul class="nav flex-column mb-0">
		<li class="nav-item <?php	if ($seccion == 'perfil') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>asesor/perfil.php" class="nav-link text-white ml-3">
				<i class="fas fa-user-edit fa-fw mr-3"></i>Perfil <?php if ($_SESSION["estatus"]==0) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
			</a>
		</li>
	</ul>
	<hr class="hr-white">

	<p class="text-white font-weight-bold text-uppercase px-3 small py-1 mb-0">Gestión</p>
	<ul class="nav flex-column mb-0">
		<li class="nav-item <?php	if ($seccion == 'calendario') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>asesor/calendario.php" class="nav-link text-white ml-3">
				<i class="fas fa-calendar-alt fa-fw mr-3"></i>Calendario
			</a>
		</li>
		<li class="nav-item <?php	if ($seccion == 'empresas') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>asesor/empresas.php" class="nav-link text-white ml-3">
				<i class="fas fa-industry fa-fw mr-3"></i>Empresas Juveniles
			</a>
		</li>
		<li class="nav-item <?php	if ($seccion == 'tablero_control') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>asesor/tablero_control.php" class="nav-link text-white ml-3">
				<i class="fas fa-digital-tachograph fa-fw mr-3"></i>Tablero de Control
			</a>
		</li>
		<?php /*
		<li class="nav-item <?php	if ($seccion == 'accesos_rapidos') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>asesor/accesos_rapidos.php" class="nav-link text-white ml-3">
				<i class="fas fa-sign-in-alt fa-fw mr-3"></i>Accesos Rápidos
			</a>
		</li>
		*/ ?>
	</ul>
	<hr class="hr-white">
	<?php /*
	<ul class="nav flex-column mb-0">
		<li class="nav-item <?php	if ($seccion == 'capacitaciones') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>sesiones/capacitaciones.php" class="nav-link text-white ml-3">
				<i class="fas fa-chalkboard-teacher fa-fw mr-3"></i>Capacitaciones
			</a>
		</li>
	</ul>
	*/ ?>
		<ul class="nav flex-column mb-0">
			<li class="nav-item <?php	if ($seccion == 'top3') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>asesor/top3.php" class="nav-link text-white ml-3">
					<i class="fas fa-star fa-fw mr-3"></i>TOP 3 EMPRESAS
				</a>
			</li>
			<li class="nav-item <?php	if ($seccion == 'financiamiento') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>asesor/financiamiento.php" class="nav-link text-white ml-3">
					<i class="fas fa-funnel-dollar fa-fw mr-3"></i>Accionistas/Donantes
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
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion1"]) AND $_SESSION["sesion1"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Sesión 1 - Conviértete en emprendedor
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>14) { ?>
			<li class="nav-item <?php	if ($seccion == '2') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/2.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion2"]) AND $_SESSION["sesion2"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Sesión 2 - El arte de crear I
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>24) { ?>
			<li class="nav-item <?php	if ($seccion == '3') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/3.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion3"]) AND $_SESSION["sesion3"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Sesión 3 - El arte de crear II
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>32) { ?>
			<li class="nav-item <?php	if ($seccion == '4') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/4.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion4"]) AND $_SESSION["sesion4"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Sesión 4 - Selección de Roles
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>43) { ?>
			<li class="nav-item <?php if ($seccion == '5') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/5.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion5"]) AND $_SESSION["sesion5"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Sesión 5 - La Identidad Empresarial
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>43) { ?>
			<li class="nav-item <?php if ($seccion == '6') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/6.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion5"]) AND $_SESSION["sesion5"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Sesión 6 - Factibilidad Técnica
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>43) { ?>
			<li class="nav-item <?php if ($seccion == '7') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/7.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion5"]) AND $_SESSION["sesion5"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Sesión 7 - ABC de las Finanzas I
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>43) { ?>
			<li class="nav-item <?php if ($seccion == '8') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/8.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion5"]) AND $_SESSION["sesion5"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Sesión 8 - ABC de las Finanzas II
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>43) { ?>
			<li class="nav-item <?php if ($seccion == '9') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/9.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion5"]) AND $_SESSION["sesion5"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Sesión 9 - Marketing y Ventas
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>94) { ?>
			<li class="nav-item <?php	if ($seccion == '10') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/10.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion10"]) AND $_SESSION["sesion10"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Sesión 10 - Presentación de la idea
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>94) { ?>
			<li class="nav-item <?php	if ($seccion == '11') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/11.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion11"]) AND $_SESSION["sesion11"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Sesión 11 - El Simulador de Ventas
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>94) { ?>
			<li class="nav-item <?php	if ($seccion == '12') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/12.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion12"]) AND $_SESSION["sesion12"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Sesión 12 - La Jugada II
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>94) { ?>
			<li class="nav-item <?php	if ($seccion == '13') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/13.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion13"]) AND $_SESSION["sesion13"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Sesión 13 - La Jugada III
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>94) { ?>
			<li class="nav-item <?php	if ($seccion == '14') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/14.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion14"]) AND $_SESSION["sesion14"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Sesión 14 - Últimos Movimientos
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>94) { ?>
			<li class="nav-item <?php	if ($seccion == '15') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/15.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion15"]) AND $_SESSION["sesion15"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Sesión 15 - Reporte Final
				</a>
			</li>
			<?php } ?>
			<?php /*if ($_SESSION["subseccion_general"]>53) { ?>
			<li class="nav-item <?php	if ($seccion == '6') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/6.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion6"]) AND $_SESSION["sesion6"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Sesión 6 - Factibilidad Técnica
				</a>
			</li>
			<?php } /*?>
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
		</ul>
	</div>
	<hr class="hr-white">

	<div class="d-none d-lg-block separar-cintillo"></div>
	<div class="d-none d-lg-block band-sponsors text-center text-black-green">
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
			url: <?php echo "'" . $RAIZ_SITIO_nohttp . "asesor/ajax/cintillo_sponsors_nacionales.php'";?>,
			success: function(data)
			{
				$("#band-sponnal").html(data);
			}
		});

		$('#band-sponnal').carousel({
			interval: 3000,
		})

		$.ajax({
			url: <?php echo "'" . $RAIZ_SITIO_nohttp . "asesor/ajax/cintillo_sponsors_locales.php'";?>,
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