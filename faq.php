<?php
	session_start();
	include_once('scripts/funciones.php');
	include_once('scripts/conexion.php');

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
	} else if ($_SESSION["tipo"] == "Alumn") {
		include_once('../includes/alumno_header.php');
		include_once('../alumno/side_navbar.php');
	}
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
?>
