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

	$hoy = date("F j, Y, g:i a");
?>
<div class="vertical-nav background_gradient_new navbar-expand-lg" id="sidebar">
	<div class="py-3 px-3 mb-3">
		<div class="media d-flex align-items-center"><img src="<?php echo $avatar . "?x=" . md5(time()); ?>" alt="foto de perfil" width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm">
			<div class="media-body">
				<h4 class="m-0 text-white"><?php echo $_SESSION["nombre"] . " " . $_SESSION["ap_paterno"]; ?></h4>
				<h6 class="m-0 text-white"><?php echo $_SESSION["Empresa_nombre"]; ?></h6>
				<h6 class="m-0 text-white"><?php echo $_SESSION["Puesto_nombre"]; ?></h6>
			</div>
		</div>
	</div>

	<p class="text-white font-weight-bold text-uppercase px-3 small py-1 mb-0">Perfiles</p>
	<ul class="nav flex-column mb-0">
		<li class="nav-item <?php	if ($seccion == 'perfil') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>alumno/perfil.php" class="nav-link text-white ml-3">
				<i class="fas fa-user-edit fa-fw mr-3"></i><?php if ($_SESSION["estatus"]==0) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Mi perfil
			</a>
		</li>
		<li class="nav-item <?php	if ($seccion == 'asesor') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>alumno/asesor.php" class="nav-link text-white ml-3">
				<i class="fas fa-user fa-fw mr-3"></i>Mi asesor
			</a>
		</li>
	</ul>
	<hr class="hr-white">
	<p class="text-white font-weight-bold text-uppercase px-3 small py-1 mb-0">Gestión</p>
	<ul class="nav flex-column mb-0">
		<li class="nav-item <?php	if ($seccion == 'calendario') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>alumno/calendario.php" class="nav-link text-white ml-3">
				<i class="fas fa-calendar-alt fa-fw mr-3"></i>Calendario
			</a>
		</li>
		<li class="nav-item <?php	if ($seccion == 'empresas') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>alumno/empresas.php" class="nav-link text-white ml-3">
				<i class="fas fa-industry fa-fw mr-3"></i>Empresa Juvenil
			</a>
		</li>
		<?php /*
		<li class="nav-item <?php	if ($seccion == 'accesos_rapidos') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>alumno/accesos_rapidos.php" class="nav-link text-white ml-3">
				<i class="fas fa-sign-in-alt fa-fw mr-3"></i>Accesos Rápidos
			</a>
		</li>
		*/ ?>
	</ul>
	<hr class="hr-white">
	<ul class="nav flex-column mb-0">
		<li class="nav-item <?php	if ($seccion == 'capacitaciones') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>sesiones/capacitaciones.php" class="nav-link text-white ml-3">
				<i class="fas fa-chalkboard-teacher fa-fw mr-3"></i>Capacitaciones
			</a>
		</li>
        <li class="nav-item <?php	if ($seccion == 'financiamiento') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>alumno/financiamiento.php" class="nav-link text-white ml-3">
				<i class="fas fa-funnel-dollar fa-fw mr-3"></i>Accionistas/Donantes
			</a>
		</li>
		<li class="nav-item <?php if ($seccion == 'simulador') { echo 'active'; } ?>">
			<a href="<?php echo $RAIZ_SITIO; ?>alumno/simulador.php" class="nav-link text-white ml-3">
				<i class="fas fa-dice fa-fw mr-3"></i>Simulador
			</a>
		</li>
	</ul>
	<p class="text-white font-weight-bold text-uppercase px-3 small py-1 mb-0" data-toggle="collapse" data-target="#collapse_sesions">Sesiones <i class="fas fa-angle-right fa-fw mr-3"></i></p>
	<div id="collapse_sesions" class="collapse.show">
		<ul class="nav flex-column mb-0">
			<!-- <li class="nav-item <?php	if ($seccion == '0') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/0.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["carta_compromiso"]) AND $_SESSION["carta_compromiso"]==0) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> Bienvenida y Registro
				</a>
			</li> -->
			<?php if (isset($_SESSION["Sesion_2_inicio"]) AND strtotime($hoy) - strtotime($_SESSION["Sesion_2_inicio"]) > 0 AND $_SESSION["subseccion_general"]>0) { ?>
			<li class="nav-item <?php	if ($seccion == '1') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/1.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion1"]) AND $_SESSION["sesion1"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> 1 - Primero de Primaria
				</a>
			</li>
			<?php } ?>
			<?php if (isset($_SESSION["Sesion_3_inicio"]) AND strtotime($hoy) - strtotime($_SESSION["Sesion_3_inicio"]) > 0 AND $_SESSION["subseccion_general"]>13) { ?>
			<li class="nav-item <?php	if ($seccion == '2') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/2.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion2"]) AND $_SESSION["sesion2"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> 2 - Segundo de Primaria
				</a>
			</li>
			<?php } ?>
			<?php if (isset($_SESSION["Sesion_4_inicio"]) AND strtotime($hoy) - strtotime($_SESSION["Sesion_4_inicio"]) > 0 AND $_SESSION["subseccion_general"]>24) { ?>
			<li class="nav-item <?php	if ($seccion == '3') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/3.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion3"]) AND $_SESSION["sesion3"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> 3 - Tercero de Primaria
				</a>
			</li>
			<?php } ?>
			<?php if (isset($_SESSION["Sesion_5_inicio"]) AND strtotime($hoy) - strtotime($_SESSION["Sesion_5_inicio"]) > 0 AND $_SESSION["subseccion_general"]>32) { ?>
			<li class="nav-item <?php	if ($seccion == '4') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/4.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion4"]) AND $_SESSION["sesion4"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> 4 - Cuarto de Primaria
				</a>
			</li>
			<?php } ?>
			<?php if (isset($_SESSION["Sesion_6_inicio"]) AND strtotime($hoy) - strtotime($_SESSION["Sesion_6_inicio"]) > 0 AND $_SESSION["subseccion_general"]>43) { ?>
			<li class="nav-item <?php if ($seccion == '5') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/5.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion5"]) AND $_SESSION["sesion5"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> 5 - Quitno de Primaria
				</a>
			</li>
			<?php } ?>
			<?php if (isset($_SESSION["Sesion_7_inicio"]) AND strtotime($hoy) - strtotime($_SESSION["Sesion_7_inicio"]) > 0 AND $_SESSION["subseccion_general"]>55) { ?>
			<li class="nav-item <?php	if ($seccion == '6') { echo 'active'; } ?>">
				<a href="<?php echo $RAIZ_SITIO; ?>sesiones/6.php?id=0" class="nav-link text-white ml-3">
					<i class="fas fa-angle-right fa-fw mr-3"></i><?php if (isset($_SESSION["sesion6"]) AND $_SESSION["sesion6"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?> 6 - Sexto de Primaria
				</a>
			</li>
			<?php } ?>
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
			url: <?php echo "'" . $RAIZ_SITIO_nohttp . "alumno/ajax/cintillo_sponsors_nacionales.php'";?>,
			success: function(data)
			{
				$("#band-sponnal").html(data);
			}
		});

		$('#band-sponnal').carousel({
			interval: 3000,
		})

		$.ajax({
			url: <?php echo "'" . $RAIZ_SITIO_nohttp . "alumno/ajax/cintillo_sponsors_locales.php'";?>,
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