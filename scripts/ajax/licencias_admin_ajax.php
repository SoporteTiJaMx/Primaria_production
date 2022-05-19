<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$query = "SELECT * FROM licencias WHERE centro_ID = ? order by Licencia_estatus";
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("i", $_SESSION["centro_ID"]);
		$stmt->execute();
		$stmt->bind_result($Licencia_ID, $Centro_ID, $Licencia_nombre, $Licencia_duracion, $Licencia_estatus, $Licencia_inicio, $Licencia_fin);
		$Licencia_activa = "";
		if (isset($_SESSION["licencia_activa"])) {
			$Licencia_activa = $_SESSION["licencia_activa"];
		}


		$tabla = "
			<table id='licencias_table' class='table table-hover dt-responsive nowrap' style='width:100%'>
		        <thead>
		            <tr>
		                <th>Acciones</th>
		                <th>Nombre</th>
		                <th>Duración</th>
		                <th>Inicio</th>
		                <th>Fin</th>
		                <th>Estatus</th>
		            </tr>
		        </thead>
		        <tbody>";

		while ($stmt->fetch()) {
			$Estatus = 2; //Inactiva
			if ($Licencia_estatus == "Activa") {
				$Estatus = 1;
			}

			if ($Licencia_ID == $Licencia_activa) {
				$activada = " (habilitada)";
				$habilitada = 1;
			} else {
				$activada = "";
				$habilitada = 0;
			}

			$tabla.="<tr>
				<td class='align-middle text-center'>
					<a class='modificar_licencia' data-target='#modalLicencia' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit text-dark-gray' data-toggle='tooltip' data-placement='top' data-licencia=" . $Licencia_ID . " data-nombre='" . $Licencia_nombre . "' data-estatus=" . $Estatus . " data-duracion=" . $Licencia_duracion . " data-habilitada=" . $habilitada . " data-inicio=" . $Licencia_inicio . "  title='Modificar / activar / habilitar licencia'></i></a>
				</td>
				<td class='align-middle'>" . $Licencia_nombre . "</td>
				<td class='align-middle'>" . $Licencia_duracion . " meses</td>
				<td class='align-middle'>" . $Licencia_inicio . "</td>
				<td class='align-middle'>" . $Licencia_fin . "</td>
				<td class='align-middle'>" . $Licencia_estatus . $activada . "</td>
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