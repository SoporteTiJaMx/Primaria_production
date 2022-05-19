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

	<div class="mx-5 mt-3">
		<br>
		<div class="d-none d-lg-block row">
			<div class="btn-group btn-breadcrumb ml-2">
				<?php if ($_SESSION["subseccion_general"]>24) { ?>
				<a href="<?php echo $uri_sola . "=0"; ?>" class="btn btn-warning my-auto"><i class="fas fa-home fa-lg fa-fw"></i></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>30) { ?>
				<a href="<?php echo $uri_sola . "=1"; ?>" class="btn btn-warning <?php if($subseccion == 1) { echo "active"; } ?>">Prototipar <?php if (isset($_SESSION["sesion3_2"]) AND $_SESSION["sesion3_2"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>31) { ?>
				<a href="<?php echo $uri_sola . "=2"; ?>" class="btn btn-warning <?php if($subseccion == 2) { echo "active"; } ?>">Validación <?php if (isset($_SESSION["sesion3_3"]) AND $_SESSION["sesion3_3"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>32) { ?>
				<a href="<?php echo $uri_sola . "=3"; ?>" class="btn btn-warning <?php if($subseccion == 3) { echo "active"; } ?>">Actividades <?php if (isset($_SESSION["sesion3_4"]) AND $_SESSION["sesion3_4"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } /*?>
				<?php if ($_SESSION["subseccion_general"]>33) { ?>
				<a href="<?php echo $uri_sola . "=4"; ?>" class="btn btn-warning <?php if($subseccion == 4) { echo "active"; } ?>">Diseño Organizacional <?php if (isset($_SESSION["sesion3_5"]) AND $_SESSION["sesion3_5"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>34) { ?>
				<a href="<?php echo $uri_sola . "=5"; ?>" class="btn btn-warning <?php if($subseccion == 5) { echo "active"; } ?>">Gestión de la Empresa <?php if (isset($_SESSION["sesion3_6"]) AND $_SESSION["sesion3_6"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>35) { ?>
				<a href="<?php echo $uri_sola . "=6"; ?>" class="btn btn-warning <?php if($subseccion == 6) { echo "active"; } ?>">Financiando mi Empresa <?php if (isset($_SESSION["sesion3_7"]) AND $_SESSION["sesion3_7"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } */?>
			</div>
		</div>
		<div class="d-block d-lg-none row">
			<div class="btn-group btn-breadcrumb ml-2">
				<?php if ($_SESSION["subseccion_general"]>24) { ?>
				<a href="<?php echo $uri_sola . "=0"; ?>" class="btn btn-warning my-auto"><i class="fas fa-home fa-lg fa-fw"></i></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>30) { ?>
				<a href="<?php echo $uri_sola . "=1"; ?>" class="btn btn-warning <?php if($subseccion == 1) { echo "active"; } ?>">Proto <?php if (isset($_SESSION["sesion3_2"]) AND $_SESSION["sesion3_2"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>31) { ?>
				<a href="<?php echo $uri_sola . "=2"; ?>" class="btn btn-warning <?php if($subseccion == 2) { echo "active"; } ?>">Valid <?php if (isset($_SESSION["sesion3_3"]) AND $_SESSION["sesion3_3"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>32) { ?>
				<a href="<?php echo $uri_sola . "=3"; ?>" class="btn btn-warning <?php if($subseccion == 3) { echo "active"; } ?>">Activ <?php if (isset($_SESSION["sesion3_4"]) AND $_SESSION["sesion3_4"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } /*?>
				<?php if ($_SESSION["subseccion_general"]>33) { ?>
				<a href="<?php echo $uri_sola . "=4"; ?>" class="btn btn-warning <?php if($subseccion == 4) { echo "active"; } ?>">Diseño Organizacional <?php if (isset($_SESSION["sesion3_5"]) AND $_SESSION["sesion3_5"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>34) { ?>
				<a href="<?php echo $uri_sola . "=5"; ?>" class="btn btn-warning <?php if($subseccion == 5) { echo "active"; } ?>">Gestión de la Empresa <?php if (isset($_SESSION["sesion3_6"]) AND $_SESSION["sesion3_6"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>35) { ?>
				<a href="<?php echo $uri_sola . "=6"; ?>" class="btn btn-warning <?php if($subseccion == 6) { echo "active"; } ?>">Financiando mi Empresa <?php if (isset($_SESSION["sesion3_7"]) AND $_SESSION["sesion3_7"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } */?>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<?php
				if($subseccion == 0 AND $_SESSION["subseccion_general"]>24) {
					include_once('includes/3_1.php');
				} elseif($subseccion == 1 AND $_SESSION["subseccion_general"]>30) {
					include_once('includes/3_2.php');
				} elseif($subseccion == 2 AND $_SESSION["subseccion_general"]>31) {
					include_once('includes/3_3.php');
				} elseif($subseccion == 3 AND $_SESSION["subseccion_general"]>32) {
					include_once('includes/3_4.php');
				} /*elseif($subseccion == 4 AND $_SESSION["subseccion_general"]>33) {
					include_once('includes/3_5.php');
				} elseif($subseccion == 5 AND $_SESSION["subseccion_general"]>34) {
					include_once('includes/3_6.php');
				} elseif($subseccion == 6 AND $_SESSION["subseccion_general"]>35) {
					include_once('includes/3_7.php');
				} else {
					//include_once('includes/3_1.php');
				}*/
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
