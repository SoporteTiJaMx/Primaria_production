<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$User_ID_nuevo_mail = $_POST['User_ID_nuevo_mail'];
	$tipo_UpdateMail = $_POST['tipo_UpdateMail'];
	$mail_registrado = $_POST['mail_registrado'];
	if ($tipo_UpdateMail == 1) {
		$tabla_tipo = "superadmins";
		$columna = "Sadmin_email";
	} else if ($tipo_UpdateMail == 2) {
		$tabla_tipo = "administradores";
		$columna = "Admin_email";
	} else if ($tipo_UpdateMail == 3) {
		$tabla_tipo = "coordinadores";
		$columna = "Coord_email";
	} else if ($tipo_UpdateMail == 4) {
		$tabla_tipo = "asesores";
		$columna = "Asesor_email";
	} else if ($tipo_UpdateMail == 5) {
		$tabla_tipo = "alumnos";
		$columna = "Alumno_email";
	} else if ($tipo_UpdateMail == 6) {
		$tabla_tipo = "vinculadores";
		$columna = "Vincul_email";
	} else {
	}

	$query = "UPDATE " . $tabla_tipo . " SET " . $columna . "=? WHERE User_ID=?";
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("si", $mail_registrado, $User_ID_nuevo_mail);
		$stmt->execute();
		$stmt->close();
	}
} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../superadmin.php'>";
	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../superadmin.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once('../../includes/footer.php');
}

?>