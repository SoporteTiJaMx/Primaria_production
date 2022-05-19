<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$Centro_ID = $_POST['Centro_ID'];
	$Licencia_ID = $_POST['Licencia_ID'];

	$query = "SELECT empresas.Empresa_ID, empresas.Empresa_nombre, empresas.Empresa_producto, empresas.Empresa_estatus, escuelas.Escuela_nombre, empresas.Asesor_ID FROM empresas LEFT JOIN escuelas ON escuelas.Escuela_ID = empresas.Escuela_ID LEFT JOIN asesores ON asesores.Asesor_ID = empresas.Asesor_ID WHERE empresas.Empresa_ID IN (SELECT Empresa_ID FROM licencia_empresa WHERE Licencia_ID=?) order by Empresa_nombre";
		$query_asesores = "SELECT Asesor_ID, Asesor_nombre, Asesor_ap_paterno FROM asesores WHERE Centro_ID=? AND Asesor_estatus<'2' order by Asesor_nombre";
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("i", $Licencia_ID);
		$stmt->execute();
		$stmt->bind_result($Empresa_ID, $Empresa_nombre, $Empresa_producto, $Empresa_estatus, $Escuela_nombre, $Asesor_ID);

		$tabla = "
			<table id='empresas_juveniles_table' class='table table-hover' style='width:100%'>
		        <thead>
		            <tr>
		                <th>Acciones</th>
		                <th>Empresa</th>
		                <th>Escuela</th>
		                <th>Producto</th>
		                <th>Asesor</th>
		                <th>Estatus</th>
		            </tr>
		        </thead>
		        <tbody>";

		while ($stmt->fetch()) {
			if ($Empresa_estatus == "Activa") {
				$estatus = 1;
			} else if ($Empresa_estatus == "Inactiva") {
				$estatus = 2;
			} else if ($Empresa_estatus == "Cancelada") {
				$estatus = 0;
			}

			include_once('../../scripts/conexion2.php');
			$resultado = mysqli_query($con2, "SELECT Asesor_ID, Asesor_nombre, Asesor_ap_paterno FROM asesores WHERE Centro_ID=$Centro_ID AND Asesor_estatus<'2' order by Asesor_nombre");
			$select_asesores = "<select name='asesor_" . $Empresa_ID . "' type='text' id='asesor_" . $Empresa_ID . "' class='form-control rounded select_asesores'>";
			$select_asesores.= "<option value='0'>Selecciona asesor</option>";
			while ($fila = mysqli_fetch_array($resultado)) {
				if ($fila[0] == $Asesor_ID) {
					$selected = "selected";
				} else {
					$selected = "";
				}
				$select_asesores.="<option value=" . $fila[0] . " " . $selected . ">" . $fila[1] . " " . $fila[2] . "</option>";
			}
			$select_asesores.="</select>";

			if ($estatus > 0) {
				$acciones = "<td class='align-middle text-center'>
					<a class='select_nuevo_estatus' data-target='#modalModificar' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit text-dark-gray' data-toggle='tooltip' data-placement='top' data-empresa=" . $Empresa_ID . " data-nombre='" . $Empresa_nombre . "'' data-estatus=" . $estatus . " title='Modificar estatus'></i></a>
				</td>";
				$asesores = "<td class='align-middle'>" . $select_asesores . "</td>";
			} else {
				$acciones = "<td class='align-middle text-center'></td>";
				$asesores = "<td class='align-middle'>N / A</td>";
			}

			$tabla.="<tr>
				" . $acciones . "
				<td class='align-middle'>" . $Empresa_nombre . "</td>
				<td class='align-middle'>" . $Escuela_nombre . "</td>
				<td class='align-middle'>" . $Empresa_producto . "</td>
				" . $asesores . "
				<td class='align-middle'>" . $Empresa_estatus . "</td>
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