<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');
	include_once('../../scripts/conexion2.php');

	$Licencia_ID = $_POST['Licencia_ID'];
	$valor_Accion = $_POST['valor_Accion'];
	$r = mysqli_fetch_array(mysqli_query($con2, "SELECT valor_accion FROM variables WHERE Licencia_ID=$Licencia_ID"));
	if ($r[0] != null AND $r[0]>0) {
		$query = "UPDATE variables SET valor_accion=? WHERE Licencia_ID=?";
	} else {
		$query = "INSERT INTO variables (valor_accion, Licencia_ID) VALUES (?, ?)";
	}
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("ii", $valor_Accion, $Licencia_ID);
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