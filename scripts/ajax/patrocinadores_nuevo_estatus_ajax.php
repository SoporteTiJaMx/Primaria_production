<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	echo $Patroc_ID_nuevo_estatus = $_POST['Patroc_ID_nuevo_estatus'];
	echo $nuevo_estatus = $_POST['nuevo_estatus'];
	if ($nuevo_estatus==1) {
		$estatus_text = "Activo";
	} else if ($nuevo_estatus==2) {
		$estatus_text = "Inactivo";
	}
	echo $estatus_text;
	$query = "UPDATE patrocinadores SET Patroc_estatus=? WHERE Patroc_ID=?";
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("si", $estatus_text, $Patroc_ID_nuevo_estatus);
		$stmt->execute();
		$stmt->close();
	}
	echo "Exitoso";
} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../superadmin.php'>";
	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
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