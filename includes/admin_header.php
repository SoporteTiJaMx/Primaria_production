<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>JA Primaria</title>
	<link rel="icon" type="image/ico" href="../images/favicon.ico">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/fontawesome.css">
	<link rel="stylesheet" href="../css/font-awesome-animation.css">
	<link rel="stylesheet" href="../css/animate.css">
	<link rel="stylesheet" href="../css/estilos.css?version=<?php echo rand();?>">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400" rel="stylesheet">
	<script src="../js/popper.min.js" crossorigin="anonymous"></script>
	<script src="../js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
	<script src="../js/bootstrap.bundle.js" crossorigin="anonymous"></script>
	<script src="../js/bootstrap.js" crossorigin="anonymous"></script>
	<meta http-equiv="content-type" content="application/vnd.ms-Excel; charset=UTF-8">
</head>

<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
	$var = explode('/', $_SERVER['REQUEST_URI']);
	$seccion = current(explode('.', end($var)));
?>

<body class="background_gray text-dark-gray">

	<div class="page-content" id="content">

		<nav class="navbar background_gray">
			<a class="nav-link d-none d-lg-block" id="sidebarCollapse" href="#"><i class="fas fa-bars fa-lg fa-fw mr-2 text-orange"></i></a>
			<a class="navbar-brand text-dark-gray font-weight-bold">EMPRENDEDORES Y EMPRESARIOS</a>
			<div class="my-2 my-lg-0">
				<a class="nav-link d-sm-block d-lg-inline" href="../admin.php"><i class="fas fa-home fa-lg fa-fw mr-1 text-orange"></i></a>
				<a class="nav-link d-sm-block d-lg-inline" href="../salir.php"><i class="fas fa-sign-out-alt fa-lg fa-fw mr-1 text-orange"></i></a>
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
						<i class="fas fa-angle-right fa-fw mr-3"></i>2 -  Segundo de Primaria <?php if (isset($_SESSION["sesion2"]) AND $_SESSION["sesion2"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
						</a>
					</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>24) { ?>
					<li class="nav-item <?php	if ($seccion == '3') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/3.php?id=0" class="nav-link text-white ml-3">
							<i class="fas fa-angle-right fa-fw mr-3"></i>3 -  Tercero de Primaria <?php if (isset($_SESSION["sesion3"]) AND $_SESSION["sesion3"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
						</a>
					</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>32) { ?>
					<li class="nav-item <?php	if ($seccion == '4') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/4.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>4 -  Cuarto de Primaria <?php if (isset($_SESSION["sesion4"]) AND $_SESSION["sesion4"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
					</a>
					</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>43) { ?>
					<li class="nav-item <?php	if ($seccion == '5') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/5.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>5 - Quinto de Primaria <?php if (isset($_SESSION["sesion5"]) AND $_SESSION["sesion5"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
					</a>
					</li>
			<?php } ?>
			<?php if ($_SESSION["subseccion_general"]>53) { ?>
					<li class="nav-item <?php	if ($seccion == '6') { echo 'active'; } ?>">
						<a href="<?php echo $RAIZ_SITIO; ?>sesiones/6.php?id=0" class="nav-link text-white ml-3">
						<i class="fas fa-angle-right fa-fw mr-3"></i>6 - Sexto de Primaria <?php if (isset($_SESSION["sesion6"]) AND $_SESSION["sesion6"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
						</a>
					</li>
			<?php }  ?>
					<hr class="hr-white">
					<div class="band-sponsors-resp text-center text-black-green">
						<label>Agradecemos a:</label>
						<div id="band-sponnal2" class="carousel slide mt-1 mb-2" data-ride="carousel"></div>
						<div id="band-sponloc2" class="carousel slide mb-2" data-ride="carousel"></div>
					</div>
				</ul>
			</div>
		</nav>
<script>
	$(document).ready(function(){
		$.ajax({
			url: "/admin/ajax/cintillo_sponsors_nacionales.php",
			success: function(data)
			{
				console.log(data);
				$("#band-sponnal2").html(data);
			}
		});

		$('#band-sponnal2').carousel({
			interval: 3000,
		})

		$.ajax({
			url: "/admin/ajax/cintillo_sponsors_locales.php",
			success: function(data)
			{
				$("#band-sponloc2").html(data);
			}
		});

		$('#band-sponloc2').carousel({
			interval: 2500,
		})
	})
</script>