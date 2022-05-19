<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$tipo = "Alumn";
	$Empresa_ID = $_SESSION["Empresa_ID"];
	$query = "SELECT usuarios.User_ID, usuarios.Usuario, usuarios.Num_accesos, usuarios.UltimoAcceso, alumnos.Alumno_ID, alumnos.Alumno_nombre, alumnos.Alumno_ap_paterno, alumnos.Alumno_ap_materno, alumnos.Alumno_cumple, alumnos.Alumno_email, alumnos.Alumno_cel, alumnos.Alumno_score, alumnos.Alumno_estatus, puestos.Puesto_nombre, puestos.Puesto_ID FROM usuarios INNER JOIN alumnos ON usuarios.User_ID = alumnos.User_ID INNER JOIN empresas ON empresas.Empresa_ID = alumnos.Empresa_ID INNER JOIN puestos ON alumnos.Puesto_ID = puestos.puesto_ID WHERE usuarios.Tipo=? AND alumnos.Empresa_ID=? ORDER BY puestos.Puesto_ID";
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("si", $tipo, $Empresa_ID);
		$stmt->execute();
		$stmt->bind_result($User_ID, $Usuario, $Num_accesos, $UltimoAcceso, $Alumno_ID, $Alumno_nombre, $Alumno_ap_paterno, $Alumno_ap_materno, $Alumno_cumple, $Alumno_email, $Alumno_cel, $Alumno_score, $Alumno_estatus, $Puesto_nombre, $Puesto_ID);

		$tabla = "
			<table id='empresas_juveniles_table' class='table table-hover dt-responsive' style='width:100%'>
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Puesto</th>
						<th>Email</th>
						<th>Accesos a la plataforma</th>
						<th>Último Acceso</th>
						<th>Estrellas</th>
						<th>Estatus</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>";

		while ($stmt->fetch()) {
			if ($Alumno_estatus == 0) {
				$Estatus = "Pendiente de perfil";
			} else if ($Alumno_estatus == 1) {
				$Estatus = "Activo";
			} else if ($Alumno_estatus == 2) {
				$Estatus = "Suspendido";
			} else if ($Alumno_estatus == 3) {
				$Estatus = "Cancelado";
			}
			$tabla.="<tr><td>" . $Alumno_nombre . "</td><td>" . $Alumno_ap_paterno . " " . $Alumno_ap_materno . "</td><td>" . $Puesto_nombre . "</td><td>" . $Alumno_email . "</td><td class='text-center'>" . $Num_accesos . "</td><td>" . $UltimoAcceso . "</td><td class='text-center'>" . $Alumno_score . "&nbsp;&nbsp;&nbsp;<i class='far fa-star fa-lg fa-fw faa-tada faa-fast animated'></i></td><td>" . $Estatus . "</td>
			<td class='text-center'>
				<a class='select_nuevo_estatus' data-target='#modalEstatus' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit text-dark-gray' data-toggle='tooltip' data-placement='top' data-estatus=" . $Alumno_estatus . " data-user_id=" . $User_ID . " data-nombre='" . $Alumno_nombre . " " . $Alumno_ap_paterno . "' data-tipo=" . $tipo . " title='Cambiar estatus'></i></a>
			</td>
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
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../alumnos.php'>";
	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../alumnos.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once('../../includes/footer.php');
}

?>