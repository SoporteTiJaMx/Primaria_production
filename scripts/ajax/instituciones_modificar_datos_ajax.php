<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$Institucion_ID_nuevo_estatus = $_POST['Institucion_ID_nuevo_estatus'];
	$nombre_nuevo = $_POST['nombre_nuevo'];
	$director_nuevo = $_POST['director_nuevo'];
	$web_nuevo = $_POST['web_nuevo'];
	$nuevo_estatus = $_POST['nuevo_estatus'];
	if ($nuevo_estatus==1) {
		$estatus_text = "Activa";
	} else if ($nuevo_estatus==2) {
		$estatus_text = "Inactiva";
	}
	$query = "UPDATE instituciones SET Institucion_nombre=?, Institucion_director=?, Institucion_web=?, Institucion_estatus=? WHERE Institucion_ID=?";
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("ssssi", $nombre_nuevo, $director_nuevo, $web_nuevo, $estatus_text, $Institucion_ID_nuevo_estatus);
		$stmt->execute();
		$stmt->close();
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