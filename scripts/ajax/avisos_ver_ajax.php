<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../conexion.php');

	$Aviso_ID = $_POST['Aviso_ID'];

	$query = "SELECT * FROM avisos WHERE avisos_ID=?";
	$arr = array('Avisos_inicio' => '', 'Avisos_fin' => '', 'Avisos_asunto' => '', 'Avisos_aviso' => '', 'Avisos_estatus' => '');
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("i", $Aviso_ID);
		$stmt->execute();
		$stmt->bind_result($avisos_ID, $Centro_ID, $Licencia_ID, $Avisos_inicio, $Avisos_fin, $Avisos_asunto, $Avisos_aviso, $Avisos_estatus);

		while ($stmt->fetch()) {
			$arr = array('Avisos_inicio' => $Avisos_inicio, 'Avisos_fin' => $Avisos_fin, 'Avisos_asunto' => $Avisos_asunto, 'Avisos_aviso' => $Avisos_aviso, 'Avisos_estatus' => $Avisos_estatus);
		}

		$stmt->close();
	} else {
		$arr = array('Avisos_inicio' => '', 'Avisos_fin' => '', 'Avisos_asunto' => '', 'Avisos_aviso' => '', 'Avisos_estatus' => '');
	}
	echo json_encode($arr);

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