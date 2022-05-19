<?php
	include_once('../scripts/funciones.php');
	$Error = 0;
	$_SESSION["enable_disable"] = "disabled";
	$_SESSION["enable_disable_asesor"] = "disabled";
	if ($_SESSION["tipo"] == "Sadmin") {
		include_once('../includes/superadmin_header.php');
		include_once('../superadmin/side_navbar.php');
	} else if ($_SESSION["tipo"] == "Admin") {
		include_once('../includes/admin_header.php');
		include_once('../admin/side_navbar.php');
	} else if ($_SESSION["tipo"] == "Vincu") {
		include_once('../includes/vinculador_header.php');
		include_once('../vinculador/side_navbar.php');
	} else if ($_SESSION["tipo"] == "Coord") {
		include_once('../includes/coordinador_header.php');
		include_once('../coordinador/side_navbar.php');
	} else if ($_SESSION["tipo"] == "Volun") {
		include_once('../includes/asesor_header.php');
		include_once('../asesor/side_navbar.php');
		$_SESSION["enable_disable_asesor"] = "";
	} else if ($_SESSION["tipo"] == "Alumn") {
		include_once('../includes/alumno_header.php');
		include_once('../alumno/side_navbar.php');
		$_SESSION["enable_disable"] = "";
	} else {
		$Error = 1;
	}
	$_SESSION["token"] = md5(uniqid(mt_rand(), true));

	if ($Error == 1) {
		header('Location: ../error.php');
	} else {

		$subseccion = $_GET['id'];
		$data = explode("=", $_SERVER['REQUEST_URI']);
		$uri_sola = $data[0];
		setlocale(LC_TIME, "es_ES.UTF-8");
?>

<link rel="stylesheet" href="../css/breadcrumbs.css">
<script src="../js/jquery.maphilight.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="../css/responsive.bootstrap4.css">
<script src="../js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.responsive.min.js" crossorigin="anonymous"></script>
<script src="../js/responsive.bootstrap4.min.js" crossorigin="anonymous"></script>

	<div class="mx-5 mt-3">
		<br>
		<div class="d-none d-lg-block row">
			<div class="btn-group btn-breadcrumb ml-2">
				<?php if ($_SESSION["subseccion_general"]>0) { ?>
				<a href="<?php echo $uri_sola . "=0"; ?>" class="btn btn-warning my-auto"><i class="fas fa-home fa-lg fa-fw"></i></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>10) { ?>
				<a href="<?php echo $uri_sola . "=1"; ?>" class="btn btn-warning <?php if($subseccion == 1) { echo "active"; } ?>">Actividad 1</a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>11) { ?>
				<a href="<?php echo $uri_sola . "=2"; ?>" class="btn btn-warning <?php if($subseccion == 2) { echo "active"; } ?>">Actividad 2</a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>12) { ?>
				<a href="<?php echo $uri_sola . "=3"; ?>" class="btn btn-warning <?php if($subseccion == 3) { echo "active"; } ?>">Actividad 3</a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>13) { ?>
				<a href="<?php echo $uri_sola . "=4"; ?>" class="btn btn-warning <?php if($subseccion == 4) { echo "active"; } ?>">Actividad 4 <?php if (isset($_SESSION["sesion1_5"]) AND $_SESSION["sesion1_5"]==1 AND $_SESSION["tipo"] == "Alumn") { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>14 AND $_SESSION["tipo"] != "Alumn") { ?>
				<a href="<?php echo $uri_sola . "=5"; ?>" class="btn btn-warning <?php if($subseccion == 5) { echo "active"; } ?>">Actividad 5 <?php if (isset($_SESSION["sesion1_5"]) AND $_SESSION["sesion1_5"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
			</div>
		</div>
		<div class="d-block d-lg-none row">
			<div class="btn-group btn-breadcrumb ml-2">
				<?php if ($_SESSION["subseccion_general"]>0) { ?>
				<a href="<?php echo $uri_sola . "=0"; ?>" class="btn btn-warning my-auto"><i class="fas fa-home fa-lg fa-fw"></i></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>10) { ?>
				<a href="<?php echo $uri_sola . "=1"; ?>" class="btn btn-warning <?php if($subseccion == 1) { echo "active"; } ?>">A 1</a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>11) { ?>
				<a href="<?php echo $uri_sola . "=2"; ?>" class="btn btn-warning <?php if($subseccion == 2) { echo "active"; } ?>">A 2</a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>12) { ?>
				<a href="<?php echo $uri_sola . "=3"; ?>" class="btn btn-warning <?php if($subseccion == 3) { echo "active"; } ?>">A 3</a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>13) { ?>
				<a href="<?php echo $uri_sola . "=4"; ?>" class="btn btn-warning <?php if($subseccion == 4) { echo "active"; } ?>">A 4 <?php if (isset($_SESSION["sesion1_5"]) AND $_SESSION["sesion1_5"]==1 AND $_SESSION["tipo"] == "Alumn") { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>14 AND $_SESSION["tipo"] != "Alumn") { ?>
				<a href="<?php echo $uri_sola . "=5"; ?>" class="btn btn-warning <?php if($subseccion == 5) { echo "active"; } ?>">A 5 <?php if (isset($_SESSION["sesion1_5"]) AND $_SESSION["sesion1_5"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<?php
				if($subseccion == 0 AND $_SESSION["subseccion_general"]>0) {
					include_once('includes/1_0.php');
				} elseif($subseccion == 1 AND $_SESSION["subseccion_general"]>10) {
					include_once('includes/1_1.php');
				} elseif($subseccion == 2 AND $_SESSION["subseccion_general"]>11) {
					include_once('includes/1_2.php');
				} elseif($subseccion == 3 AND $_SESSION["subseccion_general"]>12) {
					include_once('includes/1_3.php');
				} elseif($subseccion == 4 AND $_SESSION["subseccion_general"]>13) {
					include_once('includes/1_4.php');
				} elseif($subseccion == 5 AND $_SESSION["subseccion_general"]>14 AND $_SESSION["tipo"] != "Alumn") {
					include_once('includes/1_5.php');
				} else {
					//header("Location: /sesiones/0.php?id=0");
					//include_once('includes/0_1.php');
				}
				?>
				<br><br><br>
			</div>
		</div>
		<br>
	</div>

<?php if ($_SESSION['tipo'] == "Alumn") { ?>
	<script type="text/javascript">
		function siguiente_seccion(num){
			var parametros = {
				"num" : num,
				"id" : <?php echo $_SESSION["Alumno_ID"]; ?>
			};

			$.ajax({
			  data:  parametros,
			  url: '../alumno/ajax/siguiente.php',
			  type: 'post',
			  success: function(data)
			  {
			  }
			});
		}

	</script>
<?php } ?>

<?php
		if ($_SESSION["tipo"] == "Sadmin") {
			include_once('../includes/superadmin_footer.php');
		} else if ($_SESSION["tipo"] == "Admin") {
			include_once('../includes/admin_footer.php');
		} else if ($_SESSION["tipo"] == "Vincu") {
			include_once('../includes/vinculador_footer.php');
		} else if ($_SESSION["tipo"] == "Coord") {
			include_once('../includes/coordinador_footer.php');
		} else if ($_SESSION["tipo"] == "Volun") {
			include_once('../includes/asesor_footer.php');
		} else if ($_SESSION["tipo"] == "Alumn") {
			include_once('../includes/alumno_footer.php');
		}
	}
?>
