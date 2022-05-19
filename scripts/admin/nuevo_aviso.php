<?php
include_once('../conexion.php');
include_once('../funciones.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$accion = (isset($_POST["accion"])) ? sanitizar($_POST["accion"]) : null;

	if (isset($_POST["csrf"]) && $_POST["csrf"] == $_SESSION["token"]) {
		if ($accion == "nueva") {
			$fecha_ini = (isset($_POST["fecha_ini"])) ? sanitizar($_POST["fecha_ini"]) : null;
			$fecha_fin = (isset($_POST["fecha_fin"])) ? sanitizar($_POST["fecha_fin"]) : null;
		    $fecha_ini = date ("Y-m-d H:i:s", strtotime($fecha_ini));
		    $fecha_fin = date ("Y-m-d H:i:s", strtotime($fecha_fin));
			$asunto = (isset($_POST["asunto"])) ? sanitizar($_POST["asunto"]) : null;
			$aviso = (isset($_POST["aviso"])) ? sanitizar($_POST["aviso"]) : null;

			$query = "INSERT INTO avisos (Centro_ID, Licencia_ID, Avisos_inicio, Avisos_fin, Avisos_asunto, Avisos_aviso, Avisos_estatus) VALUES (?, ?, ?, ?, ?, ?, ?)";
			if ($stmt = $con->prepare($query)) {
				$estatus = 1;
				$stmt->bind_param("iissssi", $_SESSION["centro_ID"], $_SESSION["licencia_activa"], $fecha_ini, $fecha_fin, $asunto, $aviso, $estatus);
			}
		} else if ($accion == "actualizacion") {
			$avisos_ID = (isset($_POST["select_avisos"])) ? sanitizar($_POST["select_avisos"]) : null;
			$estatus = (isset($_POST["estatus"])) ? sanitizar($_POST["estatus"]) : null;
			$fecha_ini_act = (isset($_POST["fecha_ini_act"])) ? sanitizar($_POST["fecha_ini_act"]) : null;
			$fecha_fin_act = (isset($_POST["fecha_fin_act"])) ? sanitizar($_POST["fecha_fin_act"]) : null;
		    $fecha_ini = date ("Y-m-d H:i:s", strtotime($fecha_ini_act));
		    $fecha_fin = date ("Y-m-d H:i:s", strtotime($fecha_fin_act));
			$asunto = (isset($_POST["asunto_act"])) ? sanitizar($_POST["asunto_act"]) : null;
			$aviso = (isset($_POST["aviso_act"])) ? sanitizar($_POST["aviso_act"]) : null;

			$query = "UPDATE avisos SET Avisos_inicio=?, Avisos_fin=?, Avisos_asunto=?, Avisos_aviso=?, Avisos_estatus=? WHERE avisos_ID=?";
			if ($stmt = $con->prepare($query)) {
				$stmt->bind_param("ssssii", $fecha_ini, $fecha_fin, $asunto, $aviso, $estatus, $avisos_ID);
			}
		}

		if ($stmt->execute()) {
			$stmt->close();

			echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/avisos.php'>";

  			include_once('../../includes/header.php');
?>
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<div class="card shadow">
							<div class="card-body">
								<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Datos guardados exitosamente.</h5>
								<p class="card-text">El aviso se guardó exitosamente. Le aparecerá a todos los usuarios en las fechas establecidas, al ingresar al portal. En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
								<div class="text-right mt-5"><a href="../../admin/avisos.php" class="btn btn-warning">Ir</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php
  			include_once('../../includes/footer.php');
		} else {

			echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/avisos.php'>";

  			include_once('../../includes/header.php');
?>
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<div class="card shadow">
							<div class="card-body">
								<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ha ocurrido un error.</h5>
								<p class="card-text">En unos segundos serás redirigido, para que vuelvas a intentarlo. Da click en el botón para hacerlo de inmediato.</p>
								<div class="text-right mt-5"><a href="../../admin/avisos.php" class="btn btn-warning">Ir</a></div>
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