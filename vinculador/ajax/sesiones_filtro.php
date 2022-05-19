<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$query = "SELECT Sesiones_ID, Sesion_nombre, Sesion_descripcion FROM sesiones";
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