<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../scripts/conexion.php');

	$Centro_ID = $_SESSION['centro_ID'];

	$query = "SELECT Escuela_ID, Escuela_nombre FROM escuelas INNER JOIN centros ON escuelas.Centro_ID = centros.Centro_ID WHERE centros.Centro_ID=? AND Escuela_estatus='Activa' ORDER BY Escuela_nombre";
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("i", $Centro_ID);
		$stmt->execute();
		$stmt->bind_result($Escuela_ID, $Escuela_nombre);
		$select="";
		while ($stmt->fetch()) {
			$select.="<option value=" . $Escuela_ID . ">" . $Escuela_nombre . "</option>";
		}
		$stmt->close();
	} else {
		$select = "<option value=''>No hay datos por mostrar</option>";
	}
    echo $select;
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