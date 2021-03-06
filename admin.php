<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>JA Primaria</title>
	<link rel="icon" type="image/ico" href="images/favicon.ico">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="css/fontawesome.css">
	<link rel="stylesheet" href="css/font-awesome-animation.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400" rel="stylesheet">
	<script src="js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
	<script src="js/bootstrap.bundle.js" crossorigin="anonymous"></script>
	<script src="js/bootstrap.js" crossorigin="anonymous"></script>
</head>

<?php
	session_start();
	include_once('scripts/funciones.php');
	include_once('scripts/conexion.php');

	if ($_SESSION["tipo"] != "Admin") {
		header('Location: error.php');
	} else {

	include_once('admin/side_navbar.php');
?>

<body class="background_gray text-dark-gray">

<?php
	$hoy = date("Y-m-d H:i:s");
	$datos_avisos = mysqli_query($con, "SELECT * FROM avisos WHERE Avisos_estatus=1 AND Centro_ID=" . $_SESSION["centro_ID"] . " ORDER BY Avisos_inicio");

	while ($row_avisos = mysqli_fetch_array($datos_avisos, MYSQLI_ASSOC)) {
		if ((strtotime($hoy) - strtotime($row_avisos["Avisos_inicio"])) > 0 AND (strtotime($row_avisos["Avisos_fin"]."+ 1 days") - strtotime($hoy)) > 0 ) { ?>
			<div class="modal fade" id="<?php echo "aviso_" . $row_avisos["avisos_ID"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"><?php echo $row_avisos["Avisos_asunto"]; ?></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<?php echo nl2br(htmlentities($row_avisos["Avisos_aviso"])); ?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$('#<?php echo "aviso_" . $row_avisos["avisos_ID"]; ?>').modal('show');
			</script>
		<?php } 
	} ?>

	<div class="page-content" id="content">
		<nav class="navbar background_gray">
			<a class="nav-link d-none d-lg-block" id="sidebarCollapse" href="#"><i class="fas fa-bars fa-lg fa-fw mr-2 text-orange"></i></a>
			<a class="navbar-brand text-dark-gray font-weight-bold">EMPRENDEDORES Y EMPRESARIOS</a>
			<div class="my-2 my-lg-0">
				<a class="nav-link d-sm-block d-lg-inline" href="admin.php"><i class="fas fa-home fa-lg fa-fw mr-1 text-orange"></i></a>
				<a class="nav-link d-sm-block d-lg-inline" href="salir.php"><i class="fas fa-sign-out-alt fa-lg fa-fw mr-1 text-orange"></i></a>
			</div>
		</nav>
		<nav class="navbar d-block d-lg-none navbar-light">
			<a class="navbar-brand" href="#">Sesiones</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse background_gradient_new" id="navbarNavAltMarkup">
				<ul class="nav flex-column mb-0">
			<?php if ($_SESSION["subseccion_general"]>0) { ?>
					<li class="nav-item <?php	if ($seccion == '1') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/1.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>1 - Primero de Primaria<?php if (isset($_SESSION["sesion1"]) AND $_SESSION["sesion1"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
						</a>
					</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>14) { ?>
					<li class="nav-item <?php	if ($seccion == '2') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/2.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>2 - Segundo de Priaria <?php if (isset($_SESSION["sesion2"]) AND $_SESSION["sesion2"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
						</a>
					</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>24) { ?>
					<li class="nav-item <?php	if ($seccion == '3') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/3.php?id=0" class="nav-link text-white ml-3">
							<i class="fas fa-angle-right fa-fw mr-3"></i>3 - Tercero de Primaria <?php if (isset($_SESSION["sesion3"]) AND $_SESSION["sesion3"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
						</a>
					</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>32) { ?>
					<li class="nav-item <?php	if ($seccion == '4') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/4.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>4 - Cuarto de Primaria <?php if (isset($_SESSION["sesion4"]) AND $_SESSION["sesion4"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
					</a>
					</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>43) { ?>
					<li class="nav-item <?php	if ($seccion == '5') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/5.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>5 - Quiinto de Primaria <?php if (isset($_SESSION["sesion5"]) AND $_SESSION["sesion5"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
					</a>
					</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>53) { ?>
					<li class="nav-item <?php	if ($seccion == '6') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/6.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>6 - Sexto de Primaria <?php if (isset($_SESSION["sesion6"]) AND $_SESSION["sesion6"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
						</a>
					</li>
			<?php } /*?>
			<?php /*
					<li class="nav-item <?php	if ($seccion == '7') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/7.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>Sesi??n 7
						</a>
					</li>
					<li class="nav-item <?php	if ($seccion == '8') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/8.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>Sesi??n 8
						</a>
					</li>
					<li class="nav-item <?php	if ($seccion == '9') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/9.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>Sesi??n 9
						</a>
					</li>
					<li class="nav-item <?php	if ($seccion == '10') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/10.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>Sesi??n 10
						</a>
					</li>
					<li class="nav-item <?php	if ($seccion == '11') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/11.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>Sesi??n 11
						</a>
					</li>
					<li class="nav-item <?php	if ($seccion == '12') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/12.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>Sesi??n 12
						</a>
					</li>
					<li class="nav-item <?php	if ($seccion == '13') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/13.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>Sesi??n 13
						</a>
					</li>
					<li class="nav-item <?php	if ($seccion == '14') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/14.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>Sesi??n 14
						</a>
					</li>
					<li class="nav-item <?php	if ($seccion == '15') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/15.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>Sesi??n 15
						</a>
					</li>
				*/ ?>
					<hr class="hr-white">
					<div class="band-sponsors-resp text-center text-black-green">
						<label>Agradecemos a:</label>
						<div id="band-sponnal" class="carousel slide mt-1 mb-2" data-ride="carousel"></div>
						<div id="band-sponloc" class="carousel slide mb-2" data-ride="carousel"></div>
					</div>
				</ul>
			</div>
		</nav>

		<div class="mx-5 mt-3">
			<div class="row">
				<div class="col">
					<div class="card shadow">
						<div class="card-header">
							??Bienvenido Administrador de Emprendedores y Empresarios!
						</div>
						<div class="card-body">
							<h5 class="card-title">Como Administrador podr??s hacer lo siguiente:</h5>
							<div class="card-text pl-3"><i class="fas fa-check mr-1 text-pale-green"></i>Completar o modifica tu perfil.</div>
							<div class="card-text pl-3"><i class="fas fa-check mr-1 text-pale-green"></i>Ingresar los patrocinadores locales del programa.</div>
							<div class="card-text pl-3"><i class="fas fa-check mr-1 text-pale-green"></i>Ingresar las instituciones y escuelas participantes.</div>
							<div class="card-text pl-3"><i class="fas fa-check mr-1 text-pale-green"></i>Crear los usuarios de los coordinadores, asesores y alumnos del programa.</div>
							<div class="card-text pl-3"><i class="fas fa-check mr-1 text-pale-green"></i>Administrar las "Licencias de Operaci??n" adquiridas.</div>
							<div class="card-text pl-3"><i class="fas fa-check mr-1 text-pale-green"></i>Configurar los detalles del Ciclo de Operaci??n del programa.</div>
							<div class="card-text pl-3"><i class="fas fa-check mr-1 text-pale-green"></i>Configurar el calendario operativo del programa.</div>
							<div class="card-text pl-3"><i class="fas fa-check mr-1 text-pale-green"></i>Generar los reportes necesarios.</div><br>
							<div class="card-text">Puedes acceder a estas funciones desde los controles de abajo o desde el men?? lateral.</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-12 col-lg-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title"><i class="fas fa-user-edit mr-1 mr-3 text-pale-green"></i>Modifica tu perfil</h5>
							<p class="card-text">Modifica tu avatar, datos de contacto y dem??s informaci??n necesaria para usar el portal.</p>
							<div class="text-right"><a href="admin/perfil.php" class="btn btn-warning">Perfil</a></div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title"><i class="fas fa-building mr-1 mr-3 text-pale-green"></i>Patrocinadores</h5>
							<p class="card-text">Ingresa los nombres y logotipos de quienes han hecho posible el programa.</p>
							<div class="text-right"><a href="admin/patrocinadores.php" class="btn btn-warning">Patrocinadores</a></div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title"><i class="fas fa-school mr-1 mr-3 text-pale-green"></i>Instituciones y Escuelas</h5>
							<p class="card-text">Ingresa a las instituciones educativas y sus escuelas que participan en el programa.</p>
							<div class="text-right"><a href="admin/instituciones.php" class="btn btn-warning">Instituciones</a>&nbsp;&nbsp;<a href="admin/escuelas.php" class="btn btn-warning">Escuelas</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-12 col-lg-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title"><i class="fas fa-users mr-1 mr-3 text-pale-green"></i>Administrar usuarios</h5>
							<p class="card-text">Crea y administra los usuarios necesarios para la operaci??n del programa.</p>
							<div class="text-right"><a href="admin/usuarios.php" class="btn btn-warning">Usuarios</a></div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title"><i class="fas fa-user-check mr-1 mr-3 text-pale-green"></i>Licencias</h5>
							<p class="card-text">Administra las licencias adquiridas para el uso del portal.</p>
							<div class="text-right"><a href="admin/licencias.php" class="btn btn-warning">Licencias</a></div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title"><i class="fas fa-cog mr-1 mr-3 text-pale-green"></i>Configuraci??n</h5>
							<p class="card-text">Configura los etalles operativos del programa.</p>
							<div class="text-right"><a href="admin/configuracion.php" class="btn btn-warning">Configuraci??n</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-2 mb-5 pb-5">
				<div class="col-12 col-lg-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title"><i class="fas fa-calendar-alt mr-1 mr-3 text-pale-green"></i>Calendario</h5>
							<p class="card-text">Configura el calendario operativo del programa.</p>
							<div class="text-right"><a href="admin/calendario.php" class="btn btn-warning">Calendario</a></div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title"><i class="fas fa-file-alt mr-1 mr-3 text-pale-green"></i>Reportes</h5>
							<p class="card-text">Genera reportes detallados de la operaci??n del Programa.</p>
							<div class="text-right"><a href="admin/reportes.php" class="btn btn-warning">Reportes</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="bottom-fixed text-center py-1" id="footer">
			<span class="text-dark-gray pr-2">Un Programa de </span>
			<img class="img-fluid" src="images/logo_ja_gris_oscuro.png" alt="Logo JA M??xico">
		</div>

	</div>
</body>
</html>

<script>
	$(document).ready(function(){
		var width =$('.navbar').width();
		var parametros = {
			"width" : width
		};
		$.ajax({
			data:	parametros,
			url: 'scripts/size.php',
			type: 'post',
			success: function(){}
		});
	});
</script>
<?php
	}
?>