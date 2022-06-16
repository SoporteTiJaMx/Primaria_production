<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$Centro_ID = $_POST['Centro_ID'];
	$Licencia_ID = $_POST['Licencia_ID'];
	$estatus = "activo";

	$query = "SELECT asesores.Asesor_ID, asesores.Asesor_nombre, asesores.Asesor_ap_paterno FROM asesores WHERE asesores.Asesor_estatus < 2 AND asesores.Centro_ID = ?";
	//$query_grupos = "SELECT grupos.Grupo_ID, grupos.Proyecto_ID, grupos.Grupo_nombre FROM grupos LEFT JOIN centro_proyecto ON centro_proyecto.Proyecto_ID = grupos.Proyecto_ID LEFT JOIN licencia_grupo ON licencia_grupo.Grupo_ID = grupos.Grupo_ID WHERE Centro_ID=? AND Licencia_ID = ? AND grupos.Grupo_estatus = ? ORDER BY grupos.Grupo_nombre";
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("i", $Centro_ID);
		$stmt->execute();
		$stmt->bind_result($Asesor_ID, $Asesor_nombre, $Asesor_ap_paterno);

		$tabla = "
			<table id='empresas_juveniles_table' class='table table-hover' style='width:100%'>
		        <thead>
		            <tr>
		                <th>Asesor ID</th>
		                <th>Asesor</th>
		                <th>Grupo Asignado</th>
		            </tr>
		        </thead>
		        <tbody>";

		while ($stmt->fetch()) {
			include_once('../../scripts/conexion2.php');
			$resultado = mysqli_query($con2, "SELECT grupos.Grupo_ID, grupos.Proyecto_ID, grupos.Grupo_nombre FROM grupos LEFT JOIN centro_proyecto ON centro_proyecto.Proyecto_ID = grupos.Proyecto_ID LEFT JOIN licencia_grupo ON licencia_grupo.Grupo_ID = grupos.Grupo_ID WHERE Centro_ID=$Centro_ID AND Licencia_ID = $Licencia_ID AND grupos.Grupo_estatus = 'activo' ORDER BY grupos.Grupo_nombre");
			$select_asesores = "<select name='asesor_" . $Asesor_ID . "' type='text' id='asesor_" . $Asesor_ID . "' class='form-control rounded select_asesores'>";
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