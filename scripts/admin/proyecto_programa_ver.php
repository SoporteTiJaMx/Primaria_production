<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$Centro_ID = $_SESSION['centro_ID'];
	$Licencia_ID = $_SESSION['licecnia_activa'];

	$query = "SELECT proyectos.Proyecto_ID, proyectos.Proyecto_nombre, proyectos.Proyecto_estatus FROM proyectos LEFT JOIN centro_proyecto ON proyectos.Proyecto_ID = centro_proyecto.Proyecto_ID WHERE Proyecto_estatus = 'activo' AND Centro_ID = $Centro_ID ORDER BY Proyecto_nombre";
	
	if ($stmt = $con->prepare($query)) {
		//$stmt->bind_param("i", $Licencia_ID);
		$stmt->execute();
		$stmt->bind_result($Proyecto_ID, $Proyecto_nombre, $Proyecto_estatus);
		$num_int=0;
		$tabla = "
			<table id='proyecto_programa_tabla' class='table table-hover' style='width:100%'>
		        <thead>
		            <tr>
						<th>Proyecto</th>
		                <th>Programa</th>
		                <th>Modificar</th>
		            </tr>
		        </thead>
		        <tbody>";

		while ($stmt->fetch()) {
			/* if ($Empresa_estatus == "Activa") {
				$estatus = 1;
			} else if ($Empresa_estatus == "Inactiva") {
				$estatus = 2;
			} else if ($Empresa_estatus == "Cancelada") {
				$estatus = 0;
			} */ 

			/* Select Nuevo MC */

			include_once('../../scripts/conexion2.php');
			$resultado = mysqli_query($con2, "SELECT proyecto_programa.Proyecto_ID, programas.programa_id, programas.programa_nombre FROM programas LEFT JOIN proyecto_programa ON programas.programa_id = proyecto_programa.programa_id order by programas.programa_nombre");
			$select_asesores = "<select name='empresa_" . $num_int . "' type='text' id='empresa_" . $num_int . "' class='form-control rounded select_asesores'>";
			$select_asesores.= "<option value='0'>Selecciona un programa</option>";
			while ($fila = mysqli_fetch_array($resultado)) {
				if ($fila[0] == $Proyecto_ID) {
					$selected = "selected";
				} else {
					$selected = "";
				}
				$select_asesores.="<option value=" . $fila[1] . " " . $selected . ">" . $fila[2] . "</option>";
			}
			$select_asesores.="</select>";

			/* Termina Select nuevo */
			 /*
			if ($estatus > 0) {
				$acciones = "<td class='align-middle text-center'>
					<a class='select_nuevo_estatus' data-target='#modalModificar' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit text-dark-gray' data-toggle='tooltip' data-placement='top' data-empresa=" . $Grupo_ID . " data-nombre='" . $Grupo_nombre . "'' data-estatus=" . $estatus . " title='Modificar estatus'></i></a>
				</td>";
				$asesores = "<td class='align-middle'>" . $select_asesores . "</td>";
			} else {
				$acciones = "<td class='align-middle text-center'></td>";
				$asesores = "<td class='align-middle'>N / A</td>";
			}

			$tabla.="<tr>
				" . $acciones . "
				<td class='align-middle'>" . $Grupo_nombre . "</td>
				<td class='align-middle'>" . $Escuela_nombre . "</td>
				<td class='align-middle'>" . $Empresa_producto . "</td>
				" . $asesores . "
				<td class='align-middle'>" . $Empresa_estatus . "</td>
			</tr>"; */
			$tabla.="<tr>
				<td class='align-middle'>".$Proyecto_nombre."
					<input type='hidden' name='ases_id_".$num_int."' id='ases_id_".$num_int."' value='".$Proyecto_ID."'>
				</td>
				<td class='align-middle'>".$select_asesores."</td>
				<td class='align-middle'>
					<select class='form-control' name='asignar_".$num_int."' id='asignar_".$num_int."'>
						<option value='1'>No modificado</option>
						<option value='2'>Asignar</option>
					</select>
				</td>
			</tr>
			";
			$num_int++;
		}
	    $tabla.="</tbody>
				<input type='hidden' name='integrantes_2' id='num_int_2' value='".$num_int."'>
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