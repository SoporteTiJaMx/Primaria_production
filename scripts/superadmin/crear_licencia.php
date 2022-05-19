<?php
include_once('../conexion.php');
include_once('../funciones.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$centro = (isset($_POST["centro"])) ? sanitizar($_POST["centro"]) : null;
	$duracion = (isset($_POST["duracion"])) ? sanitizar($_POST["duracion"]) : null;

	if (isset($_POST["csrf"]) && $_POST["csrf"] == $_SESSION["token"]) {
		$query = "INSERT INTO licencias (Centro_ID, Licencia_duracion, Licencia_estatus) VALUES (?, ?, ?)";
		if ($stmt = $con->prepare($query)) {
			$estatus = "Inactiva";
			$stmt->bind_param("iss", $centro, $duracion, $estatus);
			$estado = $stmt->execute();
		}

		$stmt->close();
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../superadmin/licencias.php'>";

		include_once('../../includes/header.php');
?>
		<div class="container h-100">
			<div class="row align-items-center h-100">
				<div class="col-6 mx-auto">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Datos guardados exitosamente.</h5>
							<p class="card-text">La nueva licencia se guardó exitosamente.</p>
							<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
							<div class="text-right mt-5"><a href="../../superadmin/licencias.php" class="btn btn-warning">Ir</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php

		include_once('../../includes/footer.php');

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