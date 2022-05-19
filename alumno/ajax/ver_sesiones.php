<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$Licencia_ID = $_SESSION["Licencia_ID"];
	$query = "SELECT Sesiones_ID, Eventos_inicio FROM eventos WHERE Licencia_ID=?";
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("i", $Licencia_ID);
		$stmt->execute();
		$stmt->bind_result($Sesiones_ID, $Eventos_inicio);
		while ($stmt->fetch()) {
			
		}


/*		$resultado = $stmt->get_result();
		echo json_encode($resultado->fetch_all(),JSON_PRETTY_PRINT);*/
	}
} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../alumnos.php'>";
	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../alumnos.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once('../../includes/footer.php');
}

?>