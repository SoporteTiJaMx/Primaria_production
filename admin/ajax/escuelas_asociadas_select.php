<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$Licencia_ID = $_POST['Licencia_ID'];

	$query = "SELECT licencia_escuela.Escuela_ID, escuelas.Escuela_nombre, licencia_escuela.Num_Empresas, COUNT(DISTINCT(licencia_empresa.Empresa_ID)) AS Registradas, (SELECT COUNT(Empresa_estatus) FROM empresas WHERE Empresa_estatus != 'Cancelada' AND Escuela_ID = licencia_escuela.Escuela_ID) AS Utilizadas FROM licencia_escuela LEFT JOIN escuelas ON licencia_escuela.Escuela_ID = escuelas.Escuela_ID LEFT JOIN licencia_empresa ON licencia_empresa.Escuela_ID = escuelas.Escuela_ID WHERE licencia_escuela.Licencia_ID=? and Num_Empresas>0 GROUP BY licencia_escuela.Escuela_ID";

	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("i", $Licencia_ID);
		$stmt->execute();
		$stmt->bind_result($Escuela_ID, $Escuela_nombre, $Num_empresas, $Registradas, $Utilizadas);

		$tabla = "<option value='0'>Selecciona escuela</option>";
		while ($stmt->fetch()) {
			$disponibles = $Num_empresas - $Utilizadas;
			if ($disponibles > 0) {
				$tabla.="<option value=" . $Escuela_ID . ">" . $Escuela_nombre . "</option>";
			}
		}
		$stmt->close();
	} else {
		$tabla = "<option value='0'>No hay datos por mostrar</option>";
	}

    echo $tabla;
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