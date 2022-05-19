<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../../scripts/conexion.php');
	include_once('../../scripts/conexion2.php');
	include_once('../../scripts/funciones.php');
	if(session_status() !== PHP_SESSION_ACTIVE) session_start();

	$Empresa_ID=$_POST['Empresa_ID'];
	$Licencia_activa = $_SESSION['licencia_activa'];
	if ($Empresa_ID > 0) {
		$query = "SELECT alumnos.Alumno_nombre, alumnos.Alumno_ap_paterno, alumnos.Alumno_ap_materno, alumnos.Alumno_score, alumnos.Alumno_subseccion, alumnos.Alumno_estatus, puestos.Puesto_nombre FROM alumnos INNER JOIN puestos ON alumnos.Puesto_ID=puestos.Puesto_ID WHERE Empresa_ID =? ORDER BY alumnos.Alumno_score DESC";
	} else if ($Empresa_ID < 0) {
		$query = "SELECT alumnos.Alumno_nombre, alumnos.Alumno_ap_paterno, alumnos.Alumno_ap_materno, alumnos.Alumno_score, alumnos.Alumno_subseccion, alumnos.Alumno_estatus, puestos.Puesto_nombre, empresas.Empresa_ID, empresas.Empresa_nombre, escuelas.Escuela_nombre FROM empresas LEFT JOIN escuelas ON escuelas.Escuela_ID = empresas.Escuela_ID LEFT JOIN licencia_empresa ON licencia_empresa.Empresa_ID = empresas.Empresa_ID INNER JOIN alumnos ON empresas.Empresa_ID = alumnos.Empresa_ID INNER JOIN puestos ON alumnos.Puesto_ID=puestos.Puesto_ID WHERE licencia_empresa.Empresa_ID IN (SELECT Empresa_ID FROM licencia_empresa WHERE LIcencia_ID=?) AND empresas.Empresa_estatus='Activa' ORDER BY alumnos.Alumno_score DESC";
	} else {
		$query = "";
	}
	if($stmt = $con->prepare($query)){
		if ($Empresa_ID > 0) {
			$stmt->bind_param("i", $Empresa_ID);
			$stmt->execute();
			$stmt->bind_result($Alumno_nombre, $Alumno_ap_paterno, $Alumno_ap_materno, $Alumno_score, $Alumno_subseccion, $Alumno_estatus, $Puesto_nombre);
			$tabla = "
				<table id='Datos-filtrados2' class='table table-hover nowrap' style='width:100%'>
					<thead>
						<tr>
							<th class='align-middle'>Alumno</th>
							<th class='align-middle'>Estrellas</th>
							<th class='align-middle'>Estatus</th>
							<th class='align-middle'>Puesto</th>
							<th class='align-middle'>Subsección</th>";
			$tabla.= "</tr>
				</thead>
			<tbody>";
			while ($stmt->fetch()) {
				$Subseccion = Subseccion($Alumno_subseccion);
				$bckgrnd_color = "";
				if($Alumno_estatus==0){
					$Estatus="Pendiente de perfil";
				} else if($Alumno_estatus==1){
					$Estatus="Activo";
				} else if($Alumno_estatus==2){
					$Estatus="Suspendido";
					$bckgrnd_color = "bg-danger text-white";
				} else if($Alumno_estatus==3){
					$Estatus="Cancelado";
					$bckgrnd_color = "bg-danger text-white";
				}
				$tabla.="<tr>
					<td class='align-middle " . $bckgrnd_color . "'>" . ucwords(strtolower($Alumno_nombre)) . " " . ucwords(strtolower($Alumno_ap_paterno)) . " " . ucwords(strtolower($Alumno_ap_materno)) . "</td>
					<td class='align-middle " . $bckgrnd_color . "'>" . $Alumno_score ."</td>
					<td class='align-middle " . $bckgrnd_color . "'>" . $Estatus ."</td>
					<td class='align-middle " . $bckgrnd_color . "'>" . $Puesto_nombre ."</td>
					<td class='align-middle " . $bckgrnd_color . "'>" . $Subseccion ."</td>";
			$tabla.= "</tr>";
			}

			$tabla.="</tbody>
				</table>";
			$stmt->close();
		} else if ($Empresa_ID < 0) {
			$stmt->bind_param("i", $Licencia_activa);
			$stmt->execute();
			$stmt->bind_result($Alumno_nombre, $Alumno_ap_paterno, $Alumno_ap_materno, $Alumno_score, $Alumno_subseccion, $Alumno_estatus, $Puesto_nombre, $Empresa_ID, $Empresa_nombre, $Escuela_nombre);
			$tabla = "
				<table id='Datos-filtrados2' class='table table-hover nowrap' style='width:100%'>
					<thead>
						<tr>
							<th class='align-middle'>Alumno</th>
							<th class='align-middle'>Estrellas</th>
							<th class='align-middle'>Estatus</th>
							<th class='align-middle'>Puesto</th>
							<th class='align-middle'>Empresa</th>
							<th class='align-middle'>Escuela</th>
							<th class='align-middle'>Subsección</th>";
			$tabla.= "</tr>
				</thead>
			 <tbody>";
			 while ($stmt->fetch()) {
				$Subseccion = Subseccion($Alumno_subseccion);
				$bckgrnd_color = "";
				if($Alumno_estatus==0){
					$Estatus="Pendiente de perfil";
				} else if($Alumno_estatus==1){
					$Estatus="Activo";
				} else if($Alumno_estatus==2){
					$Estatus="Suspendido";
					$bckgrnd_color = "bg-danger text-white";
				} else if($Alumno_estatus==3){
					$Estatus="Cancelado";
					$bckgrnd_color = "bg-danger text-white";
				}
				$tabla.="<tr>
					<td class='align-middle " . $bckgrnd_color . "'>" . ucwords(strtolower($Alumno_nombre)) . " " . ucwords(strtolower($Alumno_ap_paterno)) . " " . ucwords(strtolower($Alumno_ap_materno)) . "</td>
					<td class='align-middle " . $bckgrnd_color . "'>" . $Alumno_score ."</td>
					<td class='align-middle " . $bckgrnd_color . "'>" . $Estatus ."</td>
					<td class='align-middle " . $bckgrnd_color . "'>" . $Puesto_nombre ."</td>
					<td class='align-middle " . $bckgrnd_color . "'>" . $Empresa_nombre ."</td>
					<td class='align-middle " . $bckgrnd_color . "'>" . $Escuela_nombre ."</td>
					<td class='align-middle " . $bckgrnd_color . "'>" . $Subseccion ."</td>";
			$tabla.= "</tr>";
			}
			$tabla.="</tbody>
				</table>";
			$stmt->close();
		}
	} else {
		$tabla = "No hay datos para mostrar";
	}
	echo $tabla;
}
?>