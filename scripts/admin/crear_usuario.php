<?php
include_once('../conexion.php');
include_once('../funciones.php');

$tipo = (isset($_POST["tipo"])) ? sanitizar($_POST["tipo"]) : null;
if ($tipo == 5) {
	$link = "configuracion.php#nav-empresas";
} else {
	$link = "usuarios.php";
}

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
										<div class='text-right mt-5'><a href='../../admin/" . $link . "' class='btn btn-warning'>Ir</a></div>
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
	if (isset($_POST["centro_ID"])) {
		$centro_ID = sanitizar($_POST["centro_ID"]);
	} else {
		$centro_ID = $_SESSION['centro_ID'];
	}
	if (isset($_POST["institucion"])) {
		$institucion_ID = sanitizar($_POST["institucion"]);
	}
	if (isset($_POST["escuela"])) {
		$escuela_ID = sanitizar($_POST["escuela"]);
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
		} else if ($tipo == 2){ //Administrador
		} else if ($tipo == 6){ //Vinculador escolar
			$query2 = "INSERT INTO vinculadores (User_ID, Centro_ID, Institucion_ID, Vincul_nombre, Vincul_ap_paterno, Vincul_email) VALUES (?, ?, ?, ?, ?, ?)";
			if ($stmt2 = $con->prepare($query2)) {
				$stmt2->bind_param("iiisss", $User_ID, $centro_ID, $institucion_ID, $nombre, $apellido, $correo);
				$subject = "Vinculador Escolar, bienvenido a JA México Primaria.";
				$html_title = "Ahora tienes acceso al portal de JA México Primaria.";
			} else {
				echo "Falló la preparación: (" . $stmt2->errno . ") " . $stmt2->error . "<br>";
				echo "Favor de reportarlo al administrador.";
			}
		} else if ($tipo == 3){ //Coordinador escolar
			$query2 = "INSERT INTO coordinadores (User_ID, Centro_ID, Escuela_ID, Coord_nombre, Coord_ap_paterno, Coord_email) VALUES (?, ?, ?, ?, ?, ?)";
			if ($stmt2 = $con->prepare($query2)) {
				$stmt2->bind_param("iiisss", $User_ID, $centro_ID, $escuela_ID, $nombre, $apellido, $correo);
				$subject = "Coordinador Escolar, bienvenido a JA México Primaria.";
				$html_title = "Ahora tienes acceso al portal de JA México Primaria.";
			} else {
				echo "Falló la preparación: (" . $stmt2->errno . ") " . $stmt2->error . "<br>";
				echo "Favor de reportarlo al administrador.";
			}
		} else if ($tipo == 4){ //Asesores
			$query2 = "INSERT INTO asesores (User_ID, Centro_ID, Asesor_nombre, Asesor_ap_paterno, Asesor_email) VALUES (?, ?, ?, ?, ?)";
			if ($stmt2 = $con->prepare($query2)) {
				$stmt2->bind_param("iisss", $User_ID, $centro_ID, $nombre, $apellido, $correo);
				$subject = "Estimado Asesor, bienvenido a JA México Primaria.";
				$html_title = "Ahora tienes acceso al portal de JA México Primaria.";
			} else {
				echo "Falló la preparación: (" . $stmt2->errno . ") " . $stmt2->error . "<br>";
				echo "Favor de reportarlo al administrador.";
			}
		} else if ($tipo == 5){ //Alumnos
			$nombre_empresa = (isset($_POST["nombre_empresa"])) ? sanitizar($_POST["nombre_empresa"]) : null;
			$id_escuela_nueva_empresa = (isset($_POST["select_escuela_nueva_empresa"])) ? sanitizar($_POST["select_escuela_nueva_empresa"]) : null;
			$ID_licencia = $_SESSION["licencia_activa"];

			$query2 = "INSERT INTO empresas (Escuela_ID, Empresa_nombre, Empresa_estatus) VALUES (?, ?, 'Activa')";
			if ($stmt2 = $con->prepare($query2)) {
				$stmt2->bind_param("is", $id_escuela_nueva_empresa, $nombre_empresa);
				$estado = $stmt2->execute();
			} else {
				echo "Falló la preparación: (2 " . $stmt2->errno . ") " . $stmt2->error . "<br>";
				echo "Favor de reportarlo al administrador.";
			}
			$Empresa_ID = mysqli_insert_id($con);

			$query3 = "INSERT INTO licencia_empresa (Licencia_ID, Escuela_ID, Empresa_ID) VALUES (?, ?, ?)";
			if ($stmt3 = $con->prepare($query3)) {
				$stmt3->bind_param("iii", $ID_licencia, $id_escuela_nueva_empresa, $Empresa_ID);
				$estado = $stmt3->execute();
			} else {
				echo "Falló la preparación: (3 " . $stmt3->errno . ") " . $stmt3->error . "<br>";
				echo "Favor de reportarlo al administrador.";
			}

			$query4 = "INSERT INTO alumnos (User_ID, Centro_ID, Empresa_ID, Puesto_ID, Alumno_nombre, Alumno_ap_paterno, Alumno_email) VALUES (?, ?, ?, ?, ?, ?, ?)";
			$Puesto_ID = 1;
			if ($stmt4 = $con->prepare($query4)) {
				$stmt4->bind_param("iiiisss", $User_ID, $centro_ID, $Empresa_ID, $Puesto_ID, $nombre, $apellido, $correo);
				$subject = "Bienvenido a JA México Primaria.";
				$html_title = "¡Bienvenido a JA México Primaria!";
			} else {
				echo "Falló la preparación: (4 " . $stmt4->errno . ") " . $stmt4->error . "<br>";
				echo "Favor de reportarlo al administrador.";
			}
		}
		if ($tipo != 5){
			$html_parr1 = "En este portal podrás administrar y revisar el desempeño de las empresas juveniles que te asigne JA México. Puedes acceder desde esta <a href='http://jamexicoprimaria.org.mx/' target='_blank'>liga</a> (http://jamexicoprimaria.org.mx/).";
			$html_parr2 = "Pero primero tienes que personalizar tus datos de acceso dando click <a href='http://jamexicoprimaria.org.mx/usr_pss.php?ID=" . $temp . "' target='_blank'>aquí</a>.";
			$html_parr3 = "¡Deseamos que disfrutes la experiencia!";
		} else if ($tipo == "Alumn"){
			$html_parr1 = "Ahora eres parte del programa de Formación Emprendedora más exitoso del mundo, desde 1919. Puedes acceder a la administración del programa desde esta <a href='http://jamexicoprimaria.org.mx/' target='_blank'>liga</a> (http://jamexicoprimaria.org.mx/).";
			$html_parr2 = "Pero primero tienes que personalizar tus datos de acceso dando click <a href='http://jamexicoprimaria.org.mx/usr_pss.php?ID=" . $temp . "' target='_blank'>aquí</a>.";
			$html_parr3 = "¡Deseamos que disfrutes la experiencia y te conviertas en un destacado emprendedor!";
		}

		if ($tipo != 5) {
			if (!$stmt2->execute()) {
				echo "Falló la ejecución: (" . $stmt2->errno . ") " . $stmt2->error . "<br>";
				echo "Favor de reportarlo al administrador.";
			} else {
				$_SESSION["to_mail"] = $correo;
				$_SESSION["nombre_mail"] = $nombre . " " . $apellido;
				$_SESSION["subject"] = $subject;
				$_SESSION["html_title"] = $html_title;
				$_SESSION["html_parr1"] = $html_parr1;
				$_SESSION["html_parr2"] = $html_parr2;
				$_SESSION["html_parr3"] = $html_parr3;
				include_once('../mailer_pre.php');
				include_once('../mailer_post.php');

				$stmt->close();
				$stmt2->close();
				echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/usuarios.php'>";
	  			include_once('../../includes/header.php');
					echo $pantalla_exito;
	  			include_once('../../includes/footer.php');
			}
		} else {
			if (!$stmt4->execute()) {
				echo "Falló la ejecución: (" . $stmt4->errno . ") " . $stmt4->error . "<br>";
				echo "Favor de reportarlo al administrador.";
			} else {
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
				$stmt3->close();
				$stmt4->close();
				echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/configuracion.php#nav-empresas'>";
	  			include_once('../../includes/header.php');
					echo $pantalla_exito;
	  			include_once('../../includes/footer.php');
			}
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
							<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ha ocurrido un error.</h5>
							<p class="card-text">En unos segundos serás redirigido, para que vuelvas a intentarlo. Da click en el botón para hacerlo de inmediato.</p>
							<div class="text-right mt-5"><a href="../../admin.php" class="btn btn-warning">Ir</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php

		include_once('../../includes/footer.php');

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
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ha ocurrido un error.</h5>
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