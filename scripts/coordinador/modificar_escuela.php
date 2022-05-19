<?php
include_once('../conexion.php');
include_once('../funciones.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$nombre = (isset($_POST["nombre"])) ? sanitizar($_POST["nombre"]) : null;
	$estado_id = (isset($_POST["estado"])) ? sanitizar($_POST["estado"]) : null;
	$web = (isset($_POST["web"])) ? sanitizar($_POST["web"]) : null;
	$maps = (isset($_POST["maps"])) ? sanitizar($_POST["maps"]) : null;

	$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/escuelas/";
	$image_name = $_SESSION["Escuela_ID"] . ".jpg";
	$file_tmp = $_FILES['upload']['tmp_name'];
	$file_real = $target_dir . $image_name;

	if (isset($_POST["csrf"]) && $_POST["csrf"] == $_SESSION["token"]) {
		$query = "UPDATE escuelas SET Escuela_nombre=?, Escuela_estado=?, Escuela_web=?, Escuela_maps=? WHERE Escuela_ID=?";
		if ($stmt = $con->prepare($query)) {
			$stmt->bind_param("sissi", $nombre,$estado_id,$web,$maps,$_SESSION["Escuela_ID"]);
			$estado = $stmt->execute();
		}
		if ($estado) {
			move_uploaded_file($file_tmp, $file_real);
			$_SESSION["Escuela_nombre"] = $nombre;
			$_SESSION["Escuela_estado"] = $estado_id;
			$_SESSION["Escuela_web"] = $web;
			$_SESSION["Escuela_maps"] = $maps;
			$stmt->close();

			echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../coordinador/escuela.php'>";

  			include_once('../../includes/header.php');
?>
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<div class="card shadow">
							<div class="card-body">
								<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Datos guardados exitosamente.</h5>
								<p class="card-text">Los datos de la Escuela se guardaron exitosamente. En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
								<div class="text-right mt-5"><a href="../../coordinador/escuela.php" class="btn btn-warning">Ir</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php

  			include_once('../../includes/footer.php');

		} else {

			echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../coordinador.php'>";

  			include_once('../../includes/header.php');
?>
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<div class="card shadow">
							<div class="card-body">
								<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ha ocurrido un error.</h5>
								<p class="card-text">En unos segundos serás redirigido, para que vuelvas a intentarlo. Da click en el botón para hacerlo de inmediato.</p>
								<div class="text-right mt-5"><a href="../../coordinador.php" class="btn btn-warning">Ir</a></div>
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

	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../coordinador.php'>";

	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../coordinador.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php

	include_once('../../includes/footer.php');

}

?>