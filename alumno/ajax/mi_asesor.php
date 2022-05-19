<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$Asesor_ID = $_SESSION['Asesor_ID'];

	$fila = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM asesores WHERE Asesor_ID=$Asesor_ID"));
	if ($fila[6]>0) {
		$fila2 = mysqli_fetch_array(mysqli_query($con, "SELECT Carrera_nombre FROM carreras WHERE Carrera_ID=$fila[6]"));
		$carrera = $fila2[0];
	} else {
		$carrera = "Sin definir";
	}

	$arr = array('nombre' => $fila[3], 'ap_paterno' => $fila[4], 'ap_materno' => $fila[5], 'carrera' => $carrera, 'cumple' => $fila[7], 'correo' => $fila[8], 'tel' => $fila[9], 'cel' => $fila[10], 'trabajo' => $fila[11], 'puesto' => $fila[12]);

	echo json_encode($arr);

} else {

	$page = "alumno";
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../" . $page . ".php'>";
	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../<?php echo $page; ?>.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once('../../includes/footer.php');
}

?>