<?php
if(
	true
){
	include_once('scripts/conexion.php');

	$tipo_cambio = $_POST['tipo_cambio']; //usr_pss o pss
	$inputEmail = $_POST['inputEmail'];

	function verificar($stmt, $inputEmail){
		$stmt->bind_param("s", $inputEmail);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($User_ID);
		$stmt->fetch();
		return array ($stmt->num_rows, $User_ID);
	}

	$query = "SELECT User_ID FROM alumnos WHERE Alumno_email=? and Alumno_estatus<2 LIMIT 1";
	$stmt = $con->prepare($query);
	list ($rows, $User_ID) = verificar($stmt, $inputEmail);
	if ($rows == 0) {
		$query = "SELECT User_ID FROM asesores WHERE Asesor_email=? and Asesor_estatus<2 LIMIT 1";
		$stmt = $con->prepare($query);
		list ($rows, $User_ID) = verificar($stmt, $inputEmail);
		if ($rows == 0) {
			$query = "SELECT User_ID FROM coordinadores WHERE Coord_email=? and Coord_estatus<2 LIMIT 1";
			$stmt = $con->prepare($query);
			list ($rows, $User_ID) = verificar($stmt, $inputEmail);
			if ($rows == 0) {
				$query = "SELECT User_ID FROM administradores WHERE Admin_email=? and Admin_estatus<2 LIMIT 1";
				$stmt = $con->prepare($query);
				list ($rows, $User_ID) = verificar($stmt, $inputEmail);
				if ($rows == 0) {
				$query = "SELECT User_ID FROM superadmins WHERE Sadmin_email=? and Sadmin_estatus<2 LIMIT 1";
				$stmt = $con->prepare($query);
				list ($rows, $User_ID) = verificar($stmt, $inputEmail);
					if ($rows == 0) {
						$msg = "No existe este mail";
					} else {
						$msg = "Superadministrador: ";
					}
				} else {
					$msg = "Administrador: ";
				}
			} else {
				$msg = "Coordinador: ";
			}
		} else {
			$msg = "Asesor: ";
		}
	} else {
		$msg = "Alumno: ";
	}
	$stmt->close();

	$temp = md5(uniqid(mt_rand(), true));
	if ($tipo_cambio == "usr_pss") { //Resetear usuario y contraseña
		$query = "UPDATE usuarios SET Temp_usr_pss=?, Temp_pss='' WHERE User_ID=?";
		$subject = "Se ha solicitado un reseteo de tu usuario y contraseña.";
		$html_title = "Emprendedores y Empresarios - Reseteo de Usuario y Contraseña";
		$html_parr2 = "Si tu lo hiciste, en la siguiente liga podrás realizar esta actualización de tu usuario y contraseña: <a href='https://emprendedoresyempresarios.org.mx/usr_pss.php?ID=" . $temp . "' target='_blank'>actualizar datos</a>. De lo contrario, haz caso omiso de este comunicado.";
	} else if ($tipo_cambio == "pss") { //Resetear sólo contraseña
		$query = "UPDATE usuarios SET Temp_usr_pss='', Temp_pss=? WHERE User_ID=?";
		$subject = "Se ha solicitado un reseteo de tu contraseña.";
		$html_title = "Emprendedores y Empresarios - Reseteo de Contraseña";
		$html_parr2 = "Si tu lo hiciste, en la siguiente liga podrás realizar esta actualización de tu contraseña: <a href='https://emprendedoresyempresarios.org.mx/pss.php?ID=" . $temp . "' target='_blank'>actualizar datos</a>. De lo contrario, haz caso omiso de este comunicado.";
	}
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("si", $temp, $User_ID);
		$html_parr1 = "Se ha solicitado modificar o actualizar tus datos de acceso para el portal de Emprendedores y Empresarios.";
		$html_parr3 = "JA México agradece tu confianza y te desea mucho éxito en tu emprendimiento.";
		if (!$stmt->execute()) {
		    echo "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error . "<br>";
		    echo "Favor de reportarlo al administrador.";
		} else {
			$_SESSION["to_mail"] = $inputEmail;
			$_SESSION["nombre_mail"] = "Emprendedores y Empresarios";
			$_SESSION["subject"] = $subject;
			$_SESSION["html_title"] = $html_title;
			$_SESSION["html_parr1"] = $html_parr1;
			$_SESSION["html_parr2"] = $html_parr2;
			$_SESSION["html_parr3"] = $html_parr3;
			include_once('scripts/mailer_pre.php');
			include_once('scripts/mailer_post.php');

			$stmt->close();
		}


	}

	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1000;URL=index.php'>";
	include_once('includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Proceso de recuperación de acceso completado.</h5>
						<p class="card-text">Si te encuentras registrado en el portal, recibirás un correo electrónico con los pasos a seguir para recuperar tu acceso.</p>
						<p class="card-text">Si no es así, ponte en contacto con el coordinador local de JA México en tu estado.</p>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="index.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once('includes/footer.php');

} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=index.php'>";
	include_once('includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="index.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once('includes/footer.php');
}

?>