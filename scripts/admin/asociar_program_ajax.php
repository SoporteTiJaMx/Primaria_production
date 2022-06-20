<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../conexion.php');

	$Proyecto_ID = $_POST['Proyecto_ID'];
	$Array_asociar_proyec = $_POST['Array_asociar_proyec'];
	$Asociar = $_POST['Asociar'];
	$No_IDs = sizeof($Array_asociar_proyec);

	if ($Asociar == "Si") {
		$stmt=$con->prepare("INSERT INTO proyecto_programa (Proyecto_ID, programa_id) VALUES (?, ?)");
	} else if ($Asociar == "No"){
		$stmt=$con->prepare("DELETE FROM proyecto_programa WHERE Proyecto_ID=? and programa_id=?");
	}
	for ($i=0; $i < $No_IDs; $i++) {
		//$stmt->execute(array(':Proyecto_ID'=>$Proyecto_ID, ':Patroc_ID'=>$Array_asociar_proyec[$i]));
		$stmt ->bind_param('ii', $Proyecto_ID, $Array_asociar_proyec[$i]);
		$stmt->execute();
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