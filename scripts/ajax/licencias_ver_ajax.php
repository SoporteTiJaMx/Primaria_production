<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$query = "SELECT * FROM licencias LEFT JOIN centros ON licencias.Centro_ID = centros.Centro_ID order by Licencia_estatus";
	if ($stmt = $con->prepare($query)) {
		$stmt->execute();
		$stmt->bind_result($Licencia_ID, $Centro_ID, $Licencia_nombre, $Licencia_duracion, $Licencia_estatus, $Licencia_inicio, $Licencia_fin, $Centro_ID2, $Centro_nombre);

		$tabla = "
			<table id='licencias_table' class='table table-hover dt-responsive nowrap' style='width:100%'>
		        <thead>
		            <tr>
		                <th>Inicio</th>
		                <th>Fin</th>
		                <th>Duración</th>
		                <th>Centro</th>
		                <th>Nombre</th>
		                <th>Estatus</th>
		            </tr>
		        </thead>
		        <tbody>";

		while ($stmt->fetch()) {
			$tabla.="<tr>
				<td class='align-middle'>" . $Licencia_inicio . "</td>
				<td class='align-middle'>" . $Licencia_fin . "</td>
				<td class='align-middle'>" . $Licencia_duracion . " meses</td>
				<td class='align-middle'>" . $Centro_nombre . "</td>
				<td class='align-middle'>" . $Licencia_nombre . "</td>
				<td class='align-middle'>" . $Licencia_estatus . "</td>
			</tr>";
		}
	    $tabla.="</tbody>
	        </table>";
		$stmt->close();
	} else {
		$tabla = "No hay datos por mostrar";
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