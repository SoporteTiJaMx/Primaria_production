<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$Asesor_ID = $_POST['Asesor_ID'];

	$query = "SELECT grupos.Grupo_ID, grupos.Grupo_nombre, grupos.Proyecto_ID, grupos.Grupo_estatus, grupos.Escuela_ID, escuelas.Escuela_nombre FROM asesores_x_grupo LEFT JOIN grupos ON asesores_x_grupo.Grupo_ID = grupos.Grupo_ID LEFT JOIN escuelas ON escuelas.Escuela_ID = grupos.Escuela_ID WHERE asesores_x_grupo.Asesor_ID=? order by grupos.Grupo_nombre";
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("i", $Asesor_ID);
		$stmt->execute();
		$stmt->bind_result($Grupo_ID, $Grupo_nombre, $Proyecto_ID, $Grupo_estatus, $Escuela_ID, $Escuela_nombre);

		$tabla = "
			<table id='grupos_asignados_table' class='table table-hover dt-responsive nowrap' style='width:100%'>
				<thead>
					<tr>
						<th>Grupo</th>
						<th>Escuela</th>
						<th>Integrantes</th>
						<th>Accesos al portal / Último acceso</th>
					</tr>
				</thead>
				<tbody>";

		while ($stmt->fetch()) {
			/*
			if ($Grupo_estatus == "Activa") {
				$estatus = 1;
			} else if ($Grupo_estatus == "Inactiva") {
				$estatus = 2;
			} else if ($Grupo_estatus == "Cancelada") {
				$estatus = 0;
			}*/

			$Datos_Alumnos = "<br>";
			$Datos_accesos = "<br>";
			include_once('../../scripts/conexion2.php');
			$resultado = mysqli_query($con2, "SELECT alumnos.Alumno_ID, alumnos.Alumno_nombre, alumnos.Alumno_ap_paterno, alumnos.Alumno_ap_materno, alumnos.Alumno_estatus, usuarios.Num_accesos, usuarios.UltimoAcceso FROM alumnos INNER JOIN usuarios ON alumnos.User_ID=usuarios.User_ID WHERE Grupo_ID=$Grupo_ID order by alumnos.Alumno_nombre");
			while ($fila = mysqli_fetch_array($resultado)) {
				$Datos_Alumnos .= $fila[1] . " " . $fila[2] . " " . $fila[3] . "<br>";
				if ($fila[8] != "") {
					$Datos_accesos .= $fila[5] . " / " . $fila[6] . "<br>";
				} else {
					$Datos_accesos .= $fila[6] . " / Sin acceso aún<br>";
				}
			}

			/*if ($estatus > 0) {
				$acciones = "<td class='align-middle text-center'> "  . $Grupo_estatus . "
					<a class='select_nuevo_estatus' data-target='#modalModificar' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit text-dark-gray' data-toggle='tooltip' data-placement='top' data-empresa=" . $Grupo_ID . " data-nombre='" . $Grupo_nombre . "'' data-estatus=" . $estatus . " title='Modificar estatus'></i></a>
				</td>";
			} else {
				$acciones = "<td class='align-middle text-center'></td>";
			}*/

			$tabla.=
				"<tr>
					<td class='align-middle'>" . $Grupo_nombre . "</td>
					<td class='align-middle'>" . $Escuela_nombre . "</td>
					<td class='align-middle no-wrap'>" . $Datos_Alumnos . "</td>
					<td class='align-middle wrap'>" . $Datos_accesos . "</td>
				</tr>";
		}
		$tabla.="</tbody>
			</table>";
		$stmt->close();
	} else {
		$tabla = "No tienes grupos asignados actualmente, revisa con la oficina de Junior Achivement.";
	}

	echo $tabla;
} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../asesor.php'>";
	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../asesor.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once('../../includes/footer.php');
}

?>