<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');
	echo $accion = (isset($_GET['accion']))?$_GET['accion']:'leer';

	switch($accion){
		case'agregar':
			include_once('../../scripts/conexion2.php');

			$Licencia_ID = $_SESSION['licencia_activa'];
			$Sesiones_ID = $_POST['Sesiones_ID'];
			$Eventos_inicio = date ("Y-m-d H:i:s", strtotime($_POST['Eventos_inicio']));

			$r = mysqli_fetch_array(mysqli_query($con2, "SELECT * FROM sesiones WHERE Sesiones_ID=$Sesiones_ID"));
			$Eventos_nombre = $r[2];
			$Eventos_descripcion = $r[3];
			if ($Sesiones_ID>0) {
				$Eventos_nombre = $Eventos_nombre . ": " . $Eventos_descripcion;
			}

			$query = "INSERT INTO eventos (Eventos_ID, Licencia_ID, Sesiones_ID, Eventos_nombre, Eventos_descripcion, Eventos_inicio, Eventos_fin) VALUES(?, ?, ?, ?, ?, ?, ?)";
			if ($stmt = $con->prepare($query)) {
				$Eventos_ID = "";
				$stmt->bind_param("iiissss", $Eventos_ID, $Licencia_ID, $Sesiones_ID, $Eventos_nombre, $Eventos_descripcion, $Eventos_inicio, $Eventos_inicio);
				$stmt->execute();
				$stmt->close();
			}
			break;
		case'resize':
			$Eventos_ID = $_POST['Eventos_ID'];
			//$Eventos_fin = date ("Y-m-d H:i:s", strtotime($_POST['Eventos_fin']));
			$Eventos_fin = date ("Y-m-d H:i:s", strtotime($_POST['Eventos_fin']));

			$query = "UPDATE eventos SET Eventos_fin=? WHERE Eventos_ID=?";
			if ($stmt = $con->prepare($query)) {
				$stmt->bind_param("si", $Eventos_fin, $Eventos_ID);
				$stmt->execute();
				$stmt->close();
			}
			break;
		case'mover':
			$Eventos_ID = $_POST['Eventos_ID'];
			$Eventos_inicio = date ("Y-m-d H:i:s", strtotime($_POST['Eventos_inicio']));
			//$Eventos_fin = date ("Y-m-d H:i:s", strtotime($_POST['Eventos_fin']));
			$Eventos_fin = date ("Y-m-d H:i:s", strtotime($_POST['Eventos_fin']));

			$query = "UPDATE eventos SET Eventos_inicio=?, Eventos_fin=? WHERE Eventos_ID=?";
			if ($stmt = $con->prepare($query)) {
				$stmt->bind_param("ssi", $Eventos_inicio, $Eventos_fin, $Eventos_ID);
				$stmt->execute();
				$stmt->close();
			}
			break;
		default:
			break;
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

