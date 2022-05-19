<?php
include_once('../conexion.php');
include_once('../funciones.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$institucion = (isset($_POST["institucion"])) ? sanitizar($_POST["institucion"]) : null;
	$nombre = (isset($_POST["nombre"])) ? sanitizar($_POST["nombre"]) : null;
	$estado = (isset($_POST["estado"])) ? sanitizar($_POST["estado"]) : null;
	$web = (isset($_POST["web"])) ? sanitizar($_POST["web"]) : null;
	$estatus = (isset($_POST["estatus"])) ? sanitizar($_POST["estatus"]) : null;
	$maps = (isset($_POST["maps"])) ? sanitizar($_POST["maps"]) : null;
	$Centro_ID = $_SESSION['centro_ID'];


	if (isset($_POST["csrf"]) && $_POST["csrf"] == $_SESSION["token"]) {
		if ($estatus==1) {
			$estatus_text = "Activa";
		} else if ($estatus==2) {
			$estatus_text = "Inactiva";
		}
		$query = "INSERT INTO escuelas (Centro_ID, Institucion_ID, Escuela_nombre, Escuela_estado, Escuela_maps, Escuela_web, Escuela_estatus) VALUES (?, ?, ?, ?, ?, ?, ?)";
		if ($stmt = $con->prepare($query)) {
			$stmt->bind_param("iisisss", $Centro_ID, $institucion, $nombre, $estado, $maps, $web, $estatus_text);
			$estado = $stmt->execute();
		}
		if ($estado) {
			$ultimo_id = $stmt->insert_id;
			$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/escuelas/";
			$image_name = $ultimo_id . ".jpg";
			if ($_FILES['upload']['tmp_name'] == "") {
				$file_tmp = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/escuelas/perfil.png";
			} else {
				$file_tmp = $_FILES['upload']['tmp_name'];
			}
			$file_real = $target_dir . $image_name;
			move_uploaded_file($file_tmp, $file_real);
			$stmt->close();

			echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/escuelas.php'>";

  			include_once('../../includes/header.php');
?>
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<div class="card shadow">
							<div class="card-body">
								<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Datos guardados exitosamente.</h5>
								<p class="card-text">La nueva escuela se guardó exitosamente. En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
								<div class="text-right mt-5"><a href="../../admin/escuelas.php" class="btn btn-warning">Ir</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php
  			include_once('../../includes/footer.php');
		} else {

			echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/escuelas.php'>";

  			include_once('../../includes/header.php');
?>
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<div class="card shadow">
							<div class="card-body">
								<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ha ocurrido un error.</h5>
								<p class="card-text">En unos segundos serás redirigido, para que vuelvas a intentarlo. Da click en el botón para hacerlo de inmediato.</p>
								<div class="text-right mt-5"><a href="../../admin/escuelas.php" class="btn btn-warning">Ir</a></div>
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