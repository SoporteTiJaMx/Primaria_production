<?php
date_default_timezone_set("America/Mexico_City");
session_start();
$TiempoOnline = $_SESSION["TiempoOnline"];
$fechaGuardada = $_SESSION["ultimoAcceso"];
$ahora = date("Y-n-j H:i:s");
$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
$TiempoOnline += $tiempo_transcurrido;
//date("i:s", $TiempoOnline);
include_once('scripts/conexion.php');
$User_ID = $_SESSION['User_ID'];
$query = "UPDATE usuarios SET TiempoOnline=? WHERE User_ID=?";
if ($stmt = $con->prepare($query)) {
	$stmt->bind_param("ii", $TiempoOnline,$User_ID);
	$stmt->execute();
	$stmt->close();
}
session_unset();
session_destroy();
echo "<META HTTP-EQUIV='REFRESH' CONTENT='500;URL=index.php'>";

  include_once('includes/header.php');
?>

	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5"><i class="fas fa-exclamation-triangle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Sesión terminada.</h5>
						<p class="card-text">Has terminado tu sesión exitosamente.</p>
						<p class="card-text">En unos segundos serás redirigido a la página de inicio. Da click en el botón para hacerlo de inmediato.</p>
						<p class="card-text mb-5">¡Gracias por participar en Emprendedores y Empresarios!</p>
						<div class="text-right mt-5"><a href="index.php" class="btn btn-warning">Ir al inicio</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
  include_once('includes/footer.php');
?>