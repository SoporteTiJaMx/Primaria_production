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

	<div class="mx-5 mt-3">
		<br>
		<div class="d-none d-lg-block row">
			<div class="btn-group btn-breadcrumb ml-2">
				<?php if ($_SESSION["subseccion_general"]>13) { ?>
				<a href="<?php echo $uri_sola . "=0"; ?>" class="btn btn-warning my-auto"><i class="fas fa-home fa-lg fa-fw"></i></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>20) { ?>
				<a href="<?php echo $uri_sola . "=1"; ?>" class="btn btn-warning <?php if($subseccion == 1) { echo "active"; } ?>">Design Thinking</a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>21) { ?>
				<a href="<?php echo $uri_sola . "=2"; ?>" class="btn btn-warning <?php if($subseccion == 2) { echo "active"; } ?>">Empatía <?php if (isset($_SESSION["sesion2_2"]) AND $_SESSION["sesion2_2"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>22) { ?>
				<a href="<?php echo $uri_sola . "=3"; ?>" class="btn btn-warning <?php if($subseccion == 3) { echo "active"; } ?>">Definición <?php if (isset($_SESSION["sesion2_3"]) AND $_SESSION["sesion2_3"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>23) { ?>
				<a href="<?php echo $uri_sola . "=4"; ?>" class="btn btn-warning <?php if($subseccion == 4) { echo "active"; } ?>">Ideación <?php if (isset($_SESSION["sesion2_4"]) AND $_SESSION["sesion2_4"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>24) { ?>
				<a href="<?php echo $uri_sola . "=5"; ?>" class="btn btn-warning <?php if($subseccion == 5) { echo "active"; } ?>">Actividades <?php if (isset($_SESSION["sesion2_5"]) AND $_SESSION["sesion2_5"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php /*if ($_SESSION["subseccion_general"]>24) { ?>
				<a href="<?php echo $uri_sola . "=5"; ?>" class="btn btn-warning <?php if($subseccion == 5) { echo "active"; } ?>">Prototipado <?php if (isset($_SESSION["sesion2_6"]) AND $_SESSION["sesion2_6"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>25) { ?>
				<a href="<?php echo $uri_sola . "=6"; ?>" class="btn btn-warning <?php if($subseccion == 6) { echo "active"; } ?>">Encuesta de Mercado <?php if (isset($_SESSION["sesion2_7"]) AND $_SESSION["sesion2_7"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>26) { ?>
				<a href="<?php echo $uri_sola . "=7"; ?>" class="btn btn-warning <?php if($subseccion == 7) { echo "active"; } ?>">Validación <?php if (isset($_SESSION["sesion2_8"]) AND $_SESSION["sesion2_8"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>27) { ?>
				<a href="<?php echo $uri_sola . "=8"; ?>" class="btn btn-warning <?php if($subseccion == 8) { echo "active"; } ?>">Mi Producto <?php if (isset($_SESSION["sesion2_9"]) AND $_SESSION["sesion2_9"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php }*/ ?>
			</div>
		</div>
		<div class="d-block d-lg-none row">
			<div class="btn-group btn-breadcrumb ml-2">
				<?php if ($_SESSION["subseccion_general"]>13) { ?>
				<a href="<?php echo $uri_sola . "=0"; ?>" class="btn btn-warning my-auto"><i class="fas fa-home fa-lg fa-fw"></i></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>20) { ?>
				<a href="<?php echo $uri_sola . "=1"; ?>" class="btn btn-warning <?php if($subseccion == 1) { echo "active"; } ?>">Design</a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>21) { ?>
				<a href="<?php echo $uri_sola . "=2"; ?>" class="btn btn-warning <?php if($subseccion == 2) { echo "active"; } ?>">Emp <?php if (isset($_SESSION["sesion2_2"]) AND $_SESSION["sesion2_2"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>22) { ?>
				<a href="<?php echo $uri_sola . "=3"; ?>" class="btn btn-warning <?php if($subseccion == 3) { echo "active"; } ?>">Def <?php if (isset($_SESSION["sesion2_3"]) AND $_SESSION["sesion2_3"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>23) { ?>
				<a href="<?php echo $uri_sola . "=4"; ?>" class="btn btn-warning <?php if($subseccion == 4) { echo "active"; } ?>">Idea <?php if (isset($_SESSION["sesion2_4"]) AND $_SESSION["sesion2_4"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>24) { ?>
				<a href="<?php echo $uri_sola . "=5"; ?>" class="btn btn-warning <?php if($subseccion == 5) { echo "active"; } ?>">Activ <?php if (isset($_SESSION["sesion2_5"]) AND $_SESSION["sesion2_5"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php /*if ($_SESSION["subseccion_general"]>24) { ?>
				<a href="<?php echo $uri_sola . "=5"; ?>" class="btn btn-warning <?php if($subseccion == 5) { echo "active"; } ?>">Prototipado <?php if (isset($_SESSION["sesion2_6"]) AND $_SESSION["sesion2_6"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>25) { ?>
				<a href="<?php echo $uri_sola . "=6"; ?>" class="btn btn-warning <?php if($subseccion == 6) { echo "active"; } ?>">Encuesta de Mercado <?php if (isset($_SESSION["sesion2_7"]) AND $_SESSION["sesion2_7"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>26) { ?>
				<a href="<?php echo $uri_sola . "=7"; ?>" class="btn btn-warning <?php if($subseccion == 7) { echo "active"; } ?>">Validación <?php if (isset($_SESSION["sesion2_8"]) AND $_SESSION["sesion2_8"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>27) { ?>
				<a href="<?php echo $uri_sola . "=8"; ?>" class="btn btn-warning <?php if($subseccion == 8) { echo "active"; } ?>">Mi Producto <?php if (isset($_SESSION["sesion2_9"]) AND $_SESSION["sesion2_9"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?></a>
				<?php }*/ ?>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<?php
				if($subseccion == 0 AND $_SESSION["subseccion_general"]>13) {
					include_once('includes/2_0.php');
				} elseif($subseccion == 1 AND $_SESSION["subseccion_general"]>20) {
					include_once('includes/2_1.php');
				} elseif($subseccion == 2 AND $_SESSION["subseccion_general"]>21) {
					include_once('includes/2_2.php');
				} elseif($subseccion == 3 AND $_SESSION["subseccion_general"]>22) {
					include_once('includes/2_3.php');
				} elseif($subseccion == 4 AND $_SESSION["subseccion_general"]>23) {
					include_once('includes/2_4.php');
				} elseif($subseccion == 5 AND $_SESSION["subseccion_general"]>24) {
					include_once('includes/2_5.php');
				} /*elseif($subseccion == 6 AND $_SESSION["subseccion_general"]>25) {
					include_once('includes/2_7.php');
				} elseif($subseccion == 7 AND $_SESSION["subseccion_general"]>26) {
					include_once('includes/2_8.php');
				} elseif($subseccion == 8 AND $_SESSION["subseccion_general"]>27) {
					include_once('includes/2_9.php');
				} else {
					//include_once('includes/2_1.php');
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
