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
				<?php if ($_SESSION["subseccion_general"]>55) { ?>
				<a href="<?php echo $uri_sola . "=0"; ?>" class="btn btn-warning my-auto"><i class="fas fa-home fa-lg fa-fw"></i></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>60) { ?>
				<a href="<?php echo $uri_sola . "=1"; ?>" class="btn btn-warning <?php if($subseccion == 1) { echo "active"; } ?>">Factibilidad Técnica <?php if (isset($_SESSION["sesion6_1"]) AND $_SESSION["sesion6_1"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>61) { ?>
				<a href="<?php echo $uri_sola . "=2"; ?>" class="btn btn-warning <?php if($subseccion == 2) { echo "active"; } ?>">Recursos: materias primas <?php if (isset($_SESSION["sesion6_3"]) AND $_SESSION["sesion6_3"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>62) { ?>
				<a href="<?php echo $uri_sola . "=3"; ?>" class="btn btn-warning <?php if($subseccion == 3) { echo "active"; } ?>">Recursos: maquinaria y equipo <?php if (isset($_SESSION["sesion6_4"]) AND $_SESSION["sesion6_4"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>63) { ?>
				<a href="<?php echo $uri_sola . "=4"; ?>" class="btn btn-warning <?php if($subseccion == 4) { echo "active"; } ?>">Proceso de Producción <?php if (isset($_SESSION["sesion6_5"]) AND $_SESSION["sesion6_5"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>64) { ?>
				<a href="<?php echo $uri_sola . "=5"; ?>" class="btn btn-warning <?php if($subseccion == 5) { echo "active"; } ?>">Canales de Distribución <?php if (isset($_SESSION["sesion6_6"]) AND $_SESSION["sesion6_6"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>65) { ?>
				<a href="<?php echo $uri_sola . "=6"; ?>" class="btn btn-warning <?php if($subseccion == 6) { echo "active"; } ?>">Actividades <?php if (isset($_SESSION["sesion6_7"]) AND $_SESSION["sesion6_7"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
			</div>
		</div>
		<br>
		<div class="d-block d-lg-none row">
			<div class="btn-group btn-breadcrumb ml-2">
				<?php if ($_SESSION["subseccion_general"]>55) { ?>
				<a href="<?php echo $uri_sola . "=0"; ?>" class="btn btn-warning my-auto"><i class="fas fa-home fa-lg fa-fw"></i></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>60) { ?>
				<a href="<?php echo $uri_sola . "=1"; ?>" class="btn btn-warning <?php if($subseccion == 1) { echo "active"; } ?>">Fact <?php if (isset($_SESSION["sesion6_1"]) AND $_SESSION["sesion6_1"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>61) { ?>
				<a href="<?php echo $uri_sola . "=2"; ?>" class="btn btn-warning <?php if($subseccion == 2) { echo "active"; } ?>">Mat Prim <?php if (isset($_SESSION["sesion6_2"]) AND $_SESSION["sesion6_2"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>62) { ?>
				<a href="<?php echo $uri_sola . "=3"; ?>" class="btn btn-warning <?php if($subseccion == 3) { echo "active"; } ?>">Maq <?php if (isset($_SESSION["sesion6_3"]) AND $_SESSION["sesion6_3"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>63) { ?>
				<a href="<?php echo $uri_sola . "=4"; ?>" class="btn btn-warning <?php if($subseccion == 4) { echo "active"; } ?>">Prod <?php if (isset($_SESSION["sesion6_4"]) AND $_SESSION["sesion6_4"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>64) { ?>
				<a href="<?php echo $uri_sola . "=5"; ?>" class="btn btn-warning <?php if($subseccion == 5) { echo "active"; } ?>">Dist <?php if (isset($_SESSION["sesion6_5"]) AND $_SESSION["sesion6_5"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>65) { ?>
				<a href="<?php echo $uri_sola . "=6"; ?>" class="btn btn-warning <?php if($subseccion == 6) { echo "active"; } ?>">Activ <?php if (isset($_SESSION["sesion6_6"]) AND $_SESSION["sesion6_6"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<?php
				if($subseccion == 0 AND $_SESSION["subseccion_general"]>55) {
					include_once('includes/6_1.php');
				} elseif($subseccion == 1 AND $_SESSION["subseccion_general"]>60) {
					include_once('includes/6_2.php');
				} elseif($subseccion == 2 AND $_SESSION["subseccion_general"]>61) {
					include_once('includes/6_3.php');
				} elseif($subseccion == 3 AND $_SESSION["subseccion_general"]>62) {
					include_once('includes/6_4.php');
				} elseif($subseccion == 4 AND $_SESSION["subseccion_general"]>63) {
					include_once('includes/6_5.php');
				} elseif($subseccion == 5 AND $_SESSION["subseccion_general"]>64) {
					include_once('includes/6_6.php');
				} elseif($subseccion == 6 AND $_SESSION["subseccion_general"]>65) {
					include_once('includes/6_7.php');
				} else {
					//include_once('includes/6_1.php');
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