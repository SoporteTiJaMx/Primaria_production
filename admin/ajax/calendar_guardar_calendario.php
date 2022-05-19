<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$Licencia_ID = $_SESSION['licencia_activa'];
	$Eventos_ID = $_POST['id'];
	$Eventos_nombre = $_POST['title'];
	$Eventos_descripcion = $_POST['descripcion'];
	$Eventos_color = $_POST['color'];
	$Eventos_textColor = $_POST['textColor'];
	$Eventos_inicio = date ("Y-m-d H:i:s", strtotime($_POST['start']));
	$Eventos_fin = date ("Y-m-d H:i:s", strtotime('-1 hour', strtotime($_POST['end'])));
	$accion = (isset($_GET['accion']))?$_GET['accion']:'leer';

	switch($accion){
		case'agregar':
			if ($Eventos_nombre!="" AND $Eventos_descripcion!="" AND $Eventos_inicio!="") {
				$Sesiones_ID = 0;
				$query = "INSERT INTO eventos (Eventos_ID, Licencia_ID, Sesiones_ID, Eventos_nombre, Eventos_descripcion, Eventos_color, Eventos_textColor, Eventos_inicio, Eventos_fin) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
				if ($stmt = $con->prepare($query)) {
					$stmt->bind_param("iiissssss", $Eventos_ID, $Licencia_ID, $Sesiones_ID, $Eventos_nombre, $Eventos_descripcion, $Eventos_color, $Eventos_textColor, $Eventos_inicio, $Eventos_fin);
					$stmt->execute();
				}
				$stmt->close();
			}
			break;
		case'eliminar':
			$query = "DELETE FROM eventos WHERE Eventos_ID=?";
			if ($stmt = $con->prepare($query)) {
				$stmt->bind_param("i", $Eventos_ID);
				$stmt->execute();
			}
			$stmt->close();
			break;
		case'modificar':
			if ($Eventos_nombre!="" AND $Eventos_descripcion!="" AND $Eventos_inicio!="") {
				$query = "UPDATE eventos SET Eventos_nombre=?, Eventos_descripcion=?, Eventos_color=?, Eventos_inicio=?, Eventos_fin=? WHERE Eventos_ID=?";
				if ($stmt = $con->prepare($query)) {
					$stmt->bind_param("sssssi", $Eventos_nombre, $Eventos_descripcion, $Eventos_color, $Eventos_inicio, $Eventos_fin, $Eventos_ID);
					$stmt->execute();
				}
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

