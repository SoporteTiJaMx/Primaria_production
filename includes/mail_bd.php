<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../scripts/conexion.php');

	$valor = $_POST['valor'];

	$datos1 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM alumnos WHERE Alumno_email='" . $valor . "'"));
	if ($datos1[0] == 0) {
		$datos2 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM asesores WHERE Asesor_email='" . $valor . "'"));
		if ($datos2[0] == 0) {
			$datos3 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM coordinadores WHERE Coord_email='" . $valor . "'"));
			if ($datos3[0] == 0) {
				$datos4 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM administradores WHERE Admin_email='" . $valor . "'"));
				if ($datos4[0] == 0) {
					$datos5 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM superadmins WHERE Sadmin_email='" . $valor . "'"));
					if ($datos5[0] == 0) {
						echo "ok";
					} else {
						echo "erro";
					}
				} else {
					echo "erro";
				}
			} else {
				echo "erro";
			}
		} else {
			echo "erro";
		}
	} else {
		echo "erro";
	}

} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin.php'>";
	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../admin.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once('../../includes/footer.php');
}

?>