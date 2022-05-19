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

	if ($_SESSION["tipo"] != "Alumn") {
		header('Location: error.php');
	} else {

	include_once('alumno/side_navbar.php');
?>

<body class="background_gray text-dark-gray">

<?php
	$hoy = date("Y-m-d H:i:s");
	$datos_avisos = mysqli_query($con, "SELECT * FROM avisos WHERE Avisos_estatus=1 AND Centro_ID=" . $_SESSION["Centro_ID"] . " ORDER BY Avisos_inicio");

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
<?php } } ?>

	<div class="page-content" id="content">

		<nav class="navbar background_gray">
			<a class="nav-link d-none d-lg-block" id="sidebarCollapse" href="#"><i class="fas fa-bars fa-lg fa-fw mr-2 text-orange"></i></a>
			<a class="navbar-brand text-dark-gray font-weight-bold">PRIMARIA</a>
			<div class="my-2 my-lg-0">
				<a class="nav-link d-sm-block d-lg-inline" href="alumno.php"><i class="fas fa-home fa-lg fa-fw mr-1 text-orange"></i></a>
				<a class="nav-link d-sm-block d-lg-inline" href="salir.php"><i class="fas fa-sign-out-alt fa-lg fa-fw mr-1 text-orange"></i></a>
			</div>
		</nav>
		<nav class="navbar d-block d-lg-none navbar-light">
			<a class="navbar-brand" href="#">Sesiones</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse background_gradient_new" id="navbarNavAltMarkup">
				<ul class="nav flex-column mb-0">
					<?php if (isset($_SESSION["Sesion_2_inicio"]) AND strtotime($hoy) - strtotime($_SESSION["Sesion_2_inicio"]) > 0 AND $_SESSION["subseccion_general"]>0) { ?>
					<li class="nav-item <?php	if ($seccion == '1') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/1.php?id=0" class="nav-link text-white ml-3">
							<i class="fas fa-angle-right fa-fw mr-3"></i>1 - Primero de Primaria <?php if (isset($_SESSION["sesion1"]) AND $_SESSION["sesion1"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
						</a>
					</li>
			<?php } ?>
			<?php if (isset($_SESSION["Sesion_3_inicio"]) AND strtotime($hoy) - strtotime($_SESSION["Sesion_3_inicio"]) > 0 AND $_SESSION["subseccion_general"]>14) { ?>
					<li class="nav-item <?php	if ($seccion == '2') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/2.php?id=0" class="nav-link text-white ml-3">
							<i class="fas fa-angle-right fa-fw mr-3"></i>2 - Segundo de Primaria <?php if (isset($_SESSION["sesion2"]) AND $_SESSION["sesion2"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
						</a>
					</li>
			<?php } ?>
			<?php if (isset($_SESSION["Sesion_4_inicio"]) AND strtotime($hoy) - strtotime($_SESSION["Sesion_4_inicio"]) > 0 AND $_SESSION["subseccion_general"]>24) { ?>
					<li class="nav-item <?php	if ($seccion == '3') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/3.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>3 - Tercero de Primaria <?php if (isset($_SESSION["sesion3"]) AND $_SESSION["sesion3"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
						</a>
					</li>
			<?php } ?>
			<?php if (isset($_SESSION["Sesion_5_inicio"]) AND strtotime($hoy) - strtotime($_SESSION["Sesion_5_inicio"]) > 0 AND $_SESSION["subseccion_general"]>32) { ?>
					<li class="nav-item <?php	if ($seccion == '4') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/4.php?id=0" class="nav-link text-white ml-3">
							<i class="fas fa-angle-right fa-fw mr-3"></i>4 - Cuarto de Primaria <?php if (isset($_SESSION["sesion4"]) AND $_SESSION["sesion4"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
						</a>
					</li>
			<?php } ?>
			<?php if (isset($_SESSION["Sesion_6_inicio"]) AND strtotime($hoy) - strtotime($_SESSION["Sesion_6_inicio"]) > 0 AND $_SESSION["subseccion_general"]>32) { ?>
					<li class="nav-item <?php	if ($seccion == '5') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/4.php?id=0" class="nav-link text-white ml-3">
							<i class="fas fa-angle-right fa-fw mr-3"></i>5 - Quinto de Primaria <?php if (isset($_SESSION["sesion4"]) AND $_SESSION["sesion4"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
						</a>
					</li>
			<?php } ?>
			<?php if (isset($_SESSION["Sesion_7_inicio"]) AND strtotime($hoy) - strtotime($_SESSION["Sesion_7_inicio"]) > 0 AND $_SESSION["subseccion_general"]>32) { ?>
					<li class="nav-item <?php	if ($seccion == '6') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/4.php?id=0" class="nav-link text-white ml-3">
							<i class="fas fa-angle-right fa-fw mr-3"></i>6 - Sexto de Primaria <?php if (isset($_SESSION["sesion4"]) AND $_SESSION["sesion4"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
						</a>
					</li>
			<?php } ?>
			
					<hr class="hr-white">
					<div class="band-sponsors-resp text-center text-black-green">
						<label>Agradecemos a:</label>
						<div id="band-sponnal" class="carousel slide mt-1 mb-2" data-ride="carousel"></div>
						<div id="band-sponloc" class="carousel slide mb-2" data-ride="carousel"></div>
					</div>
				</ul>
			</div>
		</nav>
		<div class="container pt-2">
			<div class="row justify-content-center">
				<div class="col-lg-6 px-lg-5 text-center">
					<h5><span class="badge badge-success px-3 py-3"><i class="far fa-star fa-lg fa-fw faa-tada faa-fast animated"></i>&nbsp;&nbsp;&nbsp; Puntaje de empresa <span class="text-yellow"><?php echo $_SESSION["Empresa_nombre"] . ": " . $_SESSION["Empresa_score"] . " estrellas."?></span></span></h5>
				</div>
				<div class="col-auto px-lg-5 text-center">
					<h5><span class="badge badge-success px-3 py-3"><i class="far fa-star fa-lg fa-fw faa-tada faa-fast animated"></i>&nbsp;&nbsp;&nbsp;  Puntaje personal: <span class="text-yellow"><?php echo $_SESSION["alumno_score"] . " estrellas."?></span></span></h5>
				</div>
			</div>
		</div>

		<div class="mx-4 mx-lg-5 mt-3 mb-3">
			<div class="row">
				<div class="col">
					<div class="card shadow">
						<div class="card-header">
							¡Bienvenido Empresario Juvenil!
						</div>
						<div class="card-body">
							<h5 class="card-title">Como Participante del programa, a través de este portal podrás hacer lo siguiente:</h5>
							<div class="card-text pl-3"><i class="fas fa-check mr-1 text-pale-green"></i>Completar o modifica tu perfil.</div>
							<div class="card-text pl-3"><i class="fas fa-check mr-1 text-pale-green"></i>Conocer al asesor que te guiará en tu emprendimiento.</div>
							<div class="card-text pl-3"><i class="fas fa-check mr-1 text-pale-green"></i>Conocer el Calendario Operativo del Programa.</div>
							<div class="card-text pl-3"><i class="fas fa-check mr-1 text-pale-green"></i>Actualizar la información de tu Empresa.</div>
							<div class="card-text pl-3 mb-3"><i class="fas fa-check mr-1 text-pale-green"></i>Llevar paso a paso tu emprendimiento, a lo largo de las sesiones de trabajo establecidas.</div>
							<div class="card-text">Puedes acceder a estas funciones desde los controles de abajo o desde el menú lateral.</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-12 col-lg-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title"><i class="fas fa-user-edit mr-1 mr-3 text-pale-green"></i>Modifica tu perfil</h5>
							<p class="card-text">Modifica tu avatar, datos de contacto y demás información necesaria para usar el portal.</p>
							<div class="text-right"><a href="alumno/perfil.php" class="btn btn-warning">¡Adelante!</a></div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title"><i class="fas fa-user mr-1 mr-3 text-pale-green"></i>Conoce a tu asesor</h5>
							<p class="card-text">Con su conocimiento y experiencia, te guiará durante tu emprendimiento.</p>
							<div class="text-right"><a href="alumno/asesor.php" class="btn btn-warning">Asesor</a></div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title"><i class="fas fa-calendar-alt mr-1 mr-3 text-pale-green"></i>Calendario</h5>
							<p class="card-text">Conoce el calendario operativo del programa.</p>
							<div class="text-right"><a href="alumno/calendario.php" class="btn btn-warning">Calendario</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-12 col-lg-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title"><i class="fas fa-industry mr-1 mr-3 text-pale-green"></i>Empresa</h5>
							<p class="card-text">Información sobre tu empresa juvenil.</p>
							<div class="text-right"><a href="alumno/empresas.php" class="btn btn-warning">Empresas</a></div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title"><i class="fas fa-chalkboard-teacher mr-1 mr-3 text-pale-green"></i>Sesiones</h5>
							<p class="card-text">Sesiones de trabajo para avanzar en tu emprendimiento.</p>
							<div class="text-right"><a href="sesiones/0.php?id=0" class="btn btn-warning">Sesiones</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br><br><br>
		<div class="bottom-fixed text-center py-1" id="footer">
			<span class="text-dark-gray pr-2">Un Programa de </span>
			<img class="img-fluid" src="images/logo_ja_gris_oscuro.png" alt="Logo JA México">
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