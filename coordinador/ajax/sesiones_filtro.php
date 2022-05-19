<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');
	$hoy = date("Y-m-d H:i:s");
	$Licencia_activa = $_SESSION['Licencia_ID'];

	$query = "SELECT sesiones.Sesiones_ID, sesiones.Sesion_nombre, sesiones.Sesion_descripcion FROM sesiones INNER JOIN eventos ON sesiones.Sesiones_ID=eventos.Sesiones_ID WHERE eventos.Eventos_inicio < '" . $hoy . "' AND eventos.Licencia_ID = " . $Licencia_activa . " ORDER BY sesiones.Sesiones_ID ASC";
	if ($stmt = $con->prepare($query)) {
		$stmt->execute();
		$stmt->bind_result($Sesiones_ID, $Sesion_nombre, $Sesion_descripcion);
		$select_sesion = "<option value='0'>Información General</option>";
		while ($stmt->fetch()) {
			$select_sesion.="<option value=". $Sesiones_ID .">".$Sesion_nombre." - " . $Sesion_descripcion . "</option>";
		}
		$stmt->close();
	}
    echo $select_sesion;

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