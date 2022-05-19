<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');
	include_once('../../scripts/conexion2.php');
	$User_ID_resetear_datos = $_POST['User_ID_resetear_datos'];
	$tipo_resetear_datos = $_POST['tipo_resetear_datos'];
	$accion_resetear = $_POST['accion_resetear'];
	$temp = md5(uniqid(mt_rand(), true));
	$r1 = mysqli_fetch_array(mysqli_query($con2, "SELECT Tipo FROM usuarios WHERE User_ID=$User_ID_resetear_datos"));
	$tipo = $r1[0];
	if($tipo == "Sadmin"){
		$datos = mysqli_fetch_array(mysqli_query($con2, "SELECT Sadmin_nombre, Sadmin_ap_paterno, Sadmin_email FROM superadmins WHERE User_ID=" . $User_ID_resetear_datos));
	} else if ($tipo == "Admin"){
		$datos = mysqli_fetch_array(mysqli_query($con2, "SELECT Admin_nombre, Admin_ap_paterno, Admin_email FROM administradores WHERE User_ID=" . $User_ID_resetear_datos));
	} else if ($tipo == "Coord"){
		$datos = mysqli_fetch_array(mysqli_query($con2, "SELECT Coord_nombre, Coord_ap_paterno, Coord_email FROM coordinadores WHERE User_ID=" . $User_ID_resetear_datos));
	} else if ($tipo == "Volun"){
		$datos = mysqli_fetch_array(mysqli_query($con2, "SELECT Asesor_nombre, Asesor_ap_paterno, Asesor_email FROM asesores WHERE User_ID=" . $User_ID_resetear_datos));
	} else if ($tipo == "Alumn"){
		$datos = mysqli_fetch_array(mysqli_query($con2, "SELECT Alumno_nombre, Alumno_ap_paterno, Alumno_email FROM alumnos WHERE User_ID=" . $User_ID_resetear_datos));
	} else if ($tipo == "Vincu"){
		$datos = mysqli_fetch_array(mysqli_query($con2, "SELECT Vincul_nombre, Vincul_ap_paterno, Vincul_email FROM vinculadores WHERE User_ID=" . $User_ID_resetear_datos));
	}

	if ($accion_resetear == 1) { //Resetear usuario y contraseña
		$query = "UPDATE usuarios SET Temp_usr_pss=?, Temp_pss='' WHERE User_ID=?";
		$html_parr2 = "Pero primero tienes que personalizar tus datos de acceso dando click <a href='http://emprendedoresyempresarios.org.mx/usr_pss.php?ID=" . $temp . "' target='_blank'>aquí</a>.";
	} else if ($accion_resetear == 2) { //Resetear sólo contraseña
		$query = "UPDATE usuarios SET Temp_usr_pss='', Temp_pss=? WHERE User_ID=?";
		$html_parr2 = "Pero primero tienes que personalizar tus datos de acceso dando click <a href='http://emprendedoresyempresarios.org.mx/pss.php?ID=" . $temp . "' target='_blank'>aquí</a>.";
	}

	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("si", $temp, $User_ID_resetear_datos);
		$stmt->execute();
		$stmt->close();
		$subject = "Bienvenido a Emprendedores y Empresarios.";
		$html_title = "Ahora tienes acceso al portal de Emprendedores y Empresarios.";
		$html_parr1 = "Puedes acceder desde esta <a href='http://emprendedoresyempresarios.org.mx/' target='_blank'>liga</a> (http://emprendedoresyempresarios.org.mx/).";
		$html_parr3 = "¡Deseamos que disfrutes la experiencia!";

		$_SESSION["to_mail"] = $datos[2];
		$_SESSION["nombre_mail"] = $datos[0] . " " . $datos[1];
		$_SESSION["subject"] = $subject;
		$_SESSION["html_title"] = $html_title;
		$_SESSION["html_parr1"] = $html_parr1;
		$_SESSION["html_parr2"] = $html_parr2;
		$_SESSION["html_parr3"] = $html_parr3;
		include_once('../mailer.php');
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