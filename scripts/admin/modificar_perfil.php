<?php
include_once('../conexion.php');
include_once('../funciones.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$nombre = (isset($_POST["nombre"])) ? sanitizar($_POST["nombre"]) : null;
	$ap_paterno = (isset($_POST["ap_paterno"])) ? sanitizar($_POST["ap_paterno"]) : null;
	$ap_materno = (isset($_POST["correo"])) ? sanitizar($_POST["ap_materno"]) : null;
	$correo = (isset($_POST["correo"])) ? sanitizar($_POST["correo"]) : null;
	$tel = (isset($_POST["tel"])) ? sanitizar($_POST["tel"]) : null;
	if (isset($_POST["cel"])) {
		$cel = sanitizar($_POST["cel"]);
	} else {
		$cel = "";
	}
	if (isset($_POST["dir"])) {
		$dir = sanitizar($_POST["dir"]);
	} else {
		$dir = "";
	}

	$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/perfiles/";
	$image_name = $_SESSION["User_ID"] . ".jpg";
	$file_tmp = $_FILES['upload']['tmp_name'];
	$file_real = $target_dir . $image_name;

	if (isset($_POST["csrf"]) && $_POST["csrf"] == $_SESSION["token"]) {
		$query = "UPDATE administradores SET Admin_nombre=?, Admin_ap_paterno=?, Admin_ap_materno=?, Admin_email=?, Admin_tel=?, Admin_cel=?, Admin_dir=?, Admin_estatus=? WHERE User_ID=?";
		if ($stmt = $con->prepare($query)) {
			$estatus = 1;
			$stmt->bind_param("sssssssii", $nombre,$ap_paterno,$ap_materno,$correo,$tel,$cel,$dir,$estatus,$_SESSION["User_ID"]);
			$estado = $stmt->execute();
		}
		if ($estado) {
			move_uploaded_file($file_tmp, $file_real);
			$_SESSION["nombre"] = $nombre;
			$_SESSION["ap_paterno"] = $ap_paterno;
			$_SESSION["ap_materno"] = $ap_materno;
			$_SESSION["email"] = $correo;
			$_SESSION["tel"] = $tel;
			$_SESSION["cel"] = $cel;
			$_SESSION["dir"] = $dir;
			$_SESSION["estatus"] = 1;
			$stmt->close();

			echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/perfil.php'>";

  			include_once('../../includes/header.php');
?>
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<div class="card shadow">
							<div class="card-body">
								<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Datos guardados exitosamente.</h5>
								<p class="card-text">Tus datos de perfil se guardaron exitosamente. En unos segundos ser??s redirigido. Da click en el bot??n para hacerlo de inmediato.</p>
								<div class="text-right mt-5"><a href="../../admin/perfil.php" class="btn btn-warning">Ir</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php

  			include_once('../../includes/footer.php');

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
								<p class="card-text">En unos segundos ser??s redirigido, para que vuelvas a intentarlo. Da click en el bot??n para hacerlo de inmediato.</p>
								<div class="text-right mt-5"><a href="../../admin.php" class="btn btn-warning">Ir</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php

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
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta secci??n.</h5>
						<p class="card-text">En unos segundos ser??s redirigido. Da click en el bot??n para hacerlo de inmediato.</p>
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