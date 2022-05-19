<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$Escuela_ID = $_SESSION['Escuela_ID'];

	$query = "SELECT empresas.Empresa_ID, empresas.Empresa_nombre, empresas.Empresa_producto, empresas.Empresa_estatus, asesores.Asesor_nombre, asesores.Asesor_ap_paterno, asesores.Asesor_email, asesores.Asesor_tel FROM empresas LEFT JOIN escuelas ON escuelas.Escuela_ID = empresas.Escuela_ID LEFT JOIN asesores ON asesores.Asesor_ID = empresas.Asesor_ID WHERE empresas.Empresa_ID IN (SELECT Empresa_ID FROM licencia_empresa WHERE Escuela_ID=?) order by Empresa_nombre";
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("i", $Escuela_ID);
		$stmt->execute();
		$stmt->bind_result($Empresa_ID, $Empresa_nombre, $Empresa_producto, $Empresa_estatus, $Asesor_nombre, $Asesor_ap_paterno, $Asesor_email, $Asesor_tel);

		$tabla = "
			<table id='empresas_juveniles_table' class='table table-hover dt-responsive nowrap' style='width:100%'>
		        <thead>
		            <tr>
		                <th>Empresa</th>
		                <th>Producto</th>
		                <th>Integrantes</th>
		                <th>Asesor</th>
		                <th>Estatus</th>
		            </tr>
		        </thead>
		        <tbody>";

		while ($stmt->fetch()) {
			$Datos_Alumnos = "";
			include_once('../../scripts/conexion2.php');
			$resultado = mysqli_query($con2, "SELECT alumnos.Alumno_ID, alumnos.Alumno_nombre, alumnos.Alumno_ap_paterno, alumnos.Alumno_ap_materno, alumnos.Puesto_ID, alumnos.Alumno_estatus, puestos.Puesto_nombre FROM alumnos LEFT JOIN puestos ON puestos.Puesto_ID = alumnos.Puesto_ID WHERE Empresa_ID=$Empresa_ID order by alumnos.Puesto_ID");
			while ($fila = mysqli_fetch_array($resultado)) {
				$Datos_Alumnos .= $fila[1] . " " . $fila[2] . " " . $fila[3] . "  - " . $fila[6] . "<br>";
			}

			if (isset($Asesor_nombre)) {
				$Datos_Asesor = $Asesor_nombre . " " . $Asesor_ap_paterno . "<br>E-mail: " . $Asesor_email . " <br>Tel: " . $Asesor_tel;
			} else {
				$Datos_Asesor = "No asignado";
			}

			$tabla.="<tr>
				<td class='align-middle'>" . $Empresa_nombre . "</td>
				<td class='align-middle'>" . $Empresa_producto . "</td>
				<td class='align-middle'>" . $Datos_Alumnos . "</td>
				<td class='align-middle'>" . $Datos_Asesor . "</td>
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