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
										<p class='card-text'>La empresa se registró exitosamente.</p>
										<p class='card-text'>Se le ha enviado un correo al alumno para que acceda al portal y pueda registrar a sus demás compañeros para iniciar los trabajos de la Empresa Juvenil.</p>
										<p class='card-text'>En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
										<div class='text-right mt-5'><a href='../../coordinador/empresas.php' class='btn btn-warning'>Ir</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$tipo = (isset($_POST["tipo"])) ? sanitizar($_POST["tipo"]) : null;
	$nombre = (isset($_POST["nombre"])) ? sanitizar($_POST["nombre"]) : null;
	$apellido = (isset($_POST["ap_paterno"])) ? sanitizar($_POST["ap_paterno"]) : null;
	$correo = (isset($_POST["correo"])) ? sanitizar($_POST["correo"]) : null;
	$tipo_text = "Alumn";

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
		if($tipo == 5){
			$nombre_empresa = (isset($_POST["nombre_empresa"])) ? sanitizar($_POST["nombre_empresa"]) : null;
			$Escuela_ID = $_SESSION["Escuela_ID"];
			$ID_licencia = (isset($_POST["licencia"])) ? sanitizar($_POST["licencia"]) : null;
			$Centro_ID = $_SESSION["Centro_ID"];

			$query2 = "INSERT INTO empresas (Escuela_ID, Empresa_nombre, Empresa_estatus) VALUES (?, ?, 'Activa')";
			if ($stmt2 = $con->prepare($query2)) {
				$stmt2->bind_param("is", $Escuela_ID, $nombre_empresa);
				$estado = $stmt2->execute();
			} else {
			    echo "Falló la preparación: (2 " . $stmt2->errno . ") " . $stmt2->error . "<br>";
			    echo "Favor de reportarlo al administrador.";
			}
			$Empresa_ID = mysqli_insert_id($con);

			$query3 = "INSERT INTO licencia_empresa (Licencia_ID, escuela_ID, Empresa_ID) VALUES (?, ?, ?)";
			if ($stmt3 = $con->prepare($query3)) {
				$stmt3->bind_param("iii", $ID_licencia, $Escuela_ID, $Empresa_ID);
				$estado = $stmt3->execute();
			} else {
			    echo "Falló la preparación: (3 " . $stmt3->errno . ") " . $stmt3->error . "<br>";
			    echo "Favor de reportarlo al administrador.";
			}

			$query4 = "INSERT INTO alumnos (User_ID, Centro_ID, Empresa_ID, Puesto_ID, Alumno_nombre, Alumno_ap_paterno, Alumno_email) VALUES (?, ?, ?, ?, ?, ?, ?)";
			$Puesto_ID = 1;
			if ($stmt4 = $con->prepare($query4)) {
				$stmt4->bind_param("iiiisss", $User_ID, $Centro_ID, $Empresa_ID, $Puesto_ID, $nombre, $apellido, $correo);
				$subject = "Bienvenido a Emprendedores y Empresarios.";
				$html_title = "¡Bienvenido a Emprendedores y Empresarios!";
			} else {
			    echo "Falló la preparación: (4 " . $stmt4->errno . ") " . $stmt4->error . "<br>";
			    echo "Favor de reportarlo al administrador.";
			}

			$html_parr1 = "Ahora eres parte del programa de Formación Emprendedora más exitoso del mundo, desde 1919. Puedes acceder a la administración del programa desde esta <a href='http://emprendedoresyempresarios.org.mx/' target='_blank'>liga</a> (http://emprendedoresyempresarios.org.mx/).";
			$html_parr2 = "Pero primero tienes que personalizar tus datos de acceso dando click <a href='http://emprendedoresyempresarios.org.mx/usr_pss.php?ID=" . $temp . "' target='_blank'>aquí</a>.";
			$html_parr3 = "¡Deseamos que disfrutes la experiencia y te conviertas en un destacado emprendedor!";

		}

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
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='10;URL=../../coordinador/empresas.php'>";
  			include_once('../../includes/header.php');
				echo $pantalla_exito;
  			include_once('../../includes/footer.php');
		}

	} else {

		echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../coordinador/empresas.php'>";

		include_once('../../includes/header.php');
?>
		<div class="container h-100">
			<div class="row align-items-center h-100">
				<div class="col-6 mx-auto">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ha ocurrido un error.</h5>
							<p class="card-text">En unos segundos serás redirigido, para que vuelvas a intentarlo. Da click en el botón para hacerlo de inmediato.</p>
							<div class="text-right mt-5"><a href="../../coordinador/empresas.php" class="btn btn-warning">Ir</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php

		include_once('../../includes/footer.php');

	}
} else {

	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../coordinador/empresas.php'>";

	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ha ocurrido un error.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../coordinador/empresas.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php

	include_once('../../includes/footer.php');

}
?>