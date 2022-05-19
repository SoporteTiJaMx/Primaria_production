<?php
include_once('../conexion.php');
include_once('../funciones.php');

$pantalla_exito = "
					<div class='container h-100'>
						<div class='row align-items-center h-100'>
							<div class='col-6 mx-auto'>
								<div class='card shadow'>
									<div class='card-body'>
										<h5 class='card-title mb-5 align-middle'><i class='fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green'></i>Datos guardados exitosamente.</h5>
										<p class='card-text'>El nuevo usuario se guardó exitosamente.</p>
										<p class='card-text'>Se le ha enviado un correo para que acceda al portal.</p>
										<p class='card-text'>En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
										<div class='text-right mt-5'><a href='../../superadmin/usuarios.php' class='btn btn-warning'>Ir</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$nombre = (isset($_POST["nombre"])) ? sanitizar($_POST["nombre"]) : null;
	$apellido = (isset($_POST["ap_paterno"])) ? sanitizar($_POST["ap_paterno"]) : null;
	$correo = (isset($_POST["correo"])) ? sanitizar($_POST["correo"]) : null;
	$tipo = (isset($_POST["tipo"])) ? sanitizar($_POST["tipo"]) : null;
	if (isset($_POST["centro"])) {
		$centro = sanitizar($_POST["centro"]);
	}
	if($tipo == 1){
		$tipo_text = "Sadmin";
	} else if($tipo == 2){
		$tipo_text = "Admin";
	} else if($tipo == 3){
		$tipo_text = "Coord";
	} else if($tipo == 4){
		$tipo_text = "Volun";
	} else if($tipo == 5){
		$tipo_text = "Alumn";
	} else if($tipo == 6){
		$tipo_text = "Vincu";
	}

	if (isset($_POST["csrf"]) && $_POST["csrf"] == $_SESSION["token"]) {
		$temp = md5(uniqid(mt_rand(), true));
		$creado = date("Y-n-j H:i:s");
		$lang = "ES-MX";
		$query = "INSERT INTO usuarios (Tipo, Creado, lang, Temp_usr_pss) VALUES (?, ?, ?, ?)";
		if ($stmt = $con->prepare($query)) {
			$stmt->bind_param("ssss", $tipo_text, $creado, $lang, $temp);
			$estado = $stmt->execute();
		}

		$User_ID = mysqli_insert_id($con);
		if($tipo == 1){ //Superadministrador
			$query2 = "INSERT INTO superadmins (User_ID, Sadmin_nombre, Sadmin_ap_paterno, Sadmin_email) VALUES (?, ?, ?, ?)";
			if ($stmt2 = $con->prepare($query2)) {
				$stmt2->bind_param("isss", $User_ID, $nombre, $apellido, $correo);
				$subject = "Bienvenido como Superadministrador de Emprendedores y Empresarios.";
				$html_title = "Ahora eres Superadministrador del portal de Emprendedores y Empresarios.";
			} else {
				echo "Falló la preparación: (" . $stmt2->errno . ") " . $stmt2->error . "<br>";
				echo "Favor de reportarlo al administrador.";
			}
		} else if ($tipo == 2){ //Administrador
			$query2 = "INSERT INTO administradores (User_ID, Centro_ID, Admin_nombre, Admin_ap_paterno, Admin_email) VALUES (?, ?, ?, ?, ?)";
			if ($stmt2 = $con->prepare($query2)) {
				$stmt2->bind_param("iisss", $User_ID, $centro, $nombre, $apellido, $correo);
				$subject = "Bienvenido como Administrador de Emprendedores y Empresarios";
				$html_title = "Ahora eres Administrador del portal de Emprendedores y Empresarios";
			} else {
				echo "Falló la preparación: (" . $stmt2->errno . ") " . $stmt2->error . "<br>";
				echo "Favor de reportarlo al administrador.";
			}
		} else if ($tipo == 3){ //Coordinador
		} else if ($tipo == 4){ //Asesor
		} else if ($tipo == 5){ //Alumno
		} else if ($tipo == 6){ //Vinculador escolar
		}
		$html_parr1 = "En este portal podrás gestionar diversos elementos de este exitoso programa de JA México. Puedes acceder desde esta <a href='http://emprendedoresyempresarios.org.mx/' target='_blank'>liga</a> (http://emprendedoresyempresarios.org.mx/).";
		$html_parr2 = "Pero primero tienes que personalizar tus datos de acceso dando click <a href='http://emprendedoresyempresarios.org.mx/usr_pss.php?ID=" . $temp . "' target='_blank'>aquí</a>.";
		$html_parr3 = "¡Deseamos que disfrutes la experiencia!";

		if (!$stmt2->execute()) {
			echo "Falló la ejecución: (" . $stmt2->errno . ") " . $stmt2->error . "<br>";
			echo "Favor de reportarlo al administrador.";
		} else {
			//mailer($to,$nombre,$subject,$html_title,$html_parr1,$html_parr2,$html_parr3)
			$_SESSION["to_mail"] = $correo;
			$_SESSION["nombre_mail"] = $nombre . " " . $apellido;
			$_SESSION["subject"] = $subject;
			$_SESSION["html_title"] = $html_title;
			$_SESSION["html_parr1"] = $html_parr1;
			$_SESSION["html_parr2"] = $html_parr2;
			$_SESSION["html_parr3"] = $html_parr3;
			include_once('../mailer.php');

			$stmt->close();
			$stmt2->close();
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../superadmin/usuarios.php'>";
  			include_once('../../includes/header.php');
				echo $pantalla_exito;
  			include_once('../../includes/footer.php');
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
							<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ha ocurrido un error.</h5>
							<p class="card-text">En unos segundos serás redirigido, para que vuelvas a intentarlo. Da click en el botón para hacerlo de inmediato.</p>
							<div class="text-right mt-5"><a href="../../superadmin.php" class="btn btn-warning">Ir</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php

		include_once('../../includes/footer.php');

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
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ha ocurrido un error.</h5>
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