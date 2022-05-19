<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$Escuela_ID = $_SESSION['Escuela_ID'];

	$query = mysqli_query($con, "SELECT licencia_escuela.Licencia_ID, licencia_escuela.Num_empresas, licencias.Licencia_nombre, COUNT(DISTINCT(licencia_empresa.Empresa_ID)) AS Registradas, (SELECT COUNT(Empresa_estatus) FROM empresas WHERE Empresa_estatus != 'Cancelada' AND Escuela_ID = licencia_escuela.Escuela_ID) AS Utilizadas FROM licencia_escuela LEFT JOIN licencias ON licencia_escuela.Licencia_ID = licencias.Licencia_ID LEFT JOIN escuelas ON licencia_escuela.Escuela_ID = escuelas.Escuela_ID LEFT JOIN licencia_empresa ON licencia_empresa.Escuela_ID = escuelas.Escuela_ID WHERE licencia_escuela.Escuela_ID=$Escuela_ID");
	$arr = array('Licencia_ID' => '', 'Num_empresas' => '', 'Licencia_nombre' => '', 'Registradas' => '', 'Utilizadas' => '', 'Faltantes' => '');
	while ($fila = mysqli_fetch_array($query)) {
		$Faltantes = $fila[1] - $fila[4];
		$arr = array('Licencia_ID' => $fila[0], 'Num_empresas' => $fila[1], 'Licencia_nombre' => $fila[2], 'Registradas' => $fila[3], 'Utilizadas' => $fila[4], 'Faltantes' => $Faltantes);
	}
	echo json_encode($arr);
} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../coordinador.php'>";
	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../coordinador.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once('../../includes/footer.php');
}

?>