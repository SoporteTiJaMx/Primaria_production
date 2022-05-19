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
?>

<link rel="stylesheet" href="../css/breadcrumbs.css">

	<div class="mx-5 mt-3">
		<br>
		<div class="row">
			<div class="btn-group btn-breadcrumb ml-2">
				<a href="<?php echo $uri_sola . "=0"; ?>" class="btn btn-warning my-auto"><i class="fas fa-home fa-lg fa-fw"></i>   <?php if (isset($_SESSION["carta_compromiso"]) AND $_SESSION["carta_compromiso"]==0) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php if ($_SESSION["subseccion_general"]>0) { ?>
				<a href="<?php echo $uri_sola . "=1"; ?>" class="btn btn-warning <?php if($subseccion == 1) { echo "active"; } ?>">Integrantes</a>
				<?php } ?>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<?php
				if($subseccion == 0) {
					include_once('includes/0_1.php');
				} elseif($subseccion == 1 AND $_SESSION["subseccion_general"]>0) {
					include_once('includes/0_2.php');
				} else {
					include_once('includes/0_1.php');
				}
				?>
				<br><br><br>
			</div>
		</div>
		<br>
	</div>


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
