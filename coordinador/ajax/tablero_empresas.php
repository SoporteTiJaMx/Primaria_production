<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../../scripts/conexion.php');
	include_once('../../scripts/conexion2.php');
	include_once('../../scripts/funciones.php');
	if(session_status() !== PHP_SESSION_ACTIVE) session_start();

	$Licencia_ID = $_SESSION['Licencia_ID'];
	$Escuela_ID = $_SESSION['Escuela_ID'];
	$hoy = date("Y-m-d H:i:s");
	//$hoy = date("2021-03-08 07:59:59");
	$arr_sesiones = array();
	$datos_sesiones = mysqli_query($con, "SELECT * FROM eventos WHERE Licencia_ID=" . $Licencia_ID . " AND Sesiones_ID > 1 AND Eventos_fin < '".$hoy."'");
	while ($row_sesiones = mysqli_fetch_array($datos_sesiones, MYSQLI_ASSOC)) {
		if ($row_sesiones["Sesiones_ID"] > 0) {
			array_push($arr_sesiones, $row_sesiones["Sesiones_ID"]);
			$sesion_max = $row_sesiones["Sesiones_ID"];
		}
	}
	$query = "SELECT * FROM empresas_puntos WHERE Empresa_ID IN (SELECT Empresa_ID FROM licencia_empresa WHERE Licencia_ID=? AND Escuela_ID=?)";
	if($stmt = $con->prepare($query)){
		$stmt->bind_param("ii", $Licencia_ID, $Escuela_ID);
		$stmt->execute();
		$stmt->bind_result($empresas_puntos_ID, $Empresa_ID, $Puntos, $Sesion1, $Sesion2, $Sesion3, $Sesion4, $Sesion5, $Sesion6, $Sesion7, $Sesion8, $Sesion9, $Sesion10, $Sesion11, $Sesion12, $Sesion13, $Sesion14, $Sesion15);
		$tabla = "
			<table id='Datos-filtrados3' class='table table-hover' style='width:100%'>
				<thead>
					<tr>
						<th class='align-middle'>Empresa</th>
						<th class='align-middle text-center'>Estrellas</th>
						<th class='align-middle text-center'>Promedio Estrellas Alumnos</th>";
						if (in_array("2", $arr_sesiones)) {$tabla.= "<th class='align-middle text-center'>Sesión 1 - Conviértete en emprendedor</th>";}
						if (in_array("3", $arr_sesiones)) {$tabla.= "<th class='align-middle text-center'>Sesión 2 - El arte de crear I</th>";}
						if (in_array("4", $arr_sesiones)) {$tabla.= "<th class='align-middle text-center'>Sesión 3 - El arte de crear II</th>";}
						if (in_array("5", $arr_sesiones)) {$tabla.= "<th class='align-middle text-center'>Sesión 4 - Seleción de Roles</th>";}
						if (in_array("6", $arr_sesiones)) {$tabla.= "<th class='align-middle text-center'>Sesión 5 - La Identidad Empresarial</th>";}
						if (in_array("7", $arr_sesiones)) {$tabla.= "<th class='align-middle text-center'>Sesión 6 - Factibilidad Técnica</th>";}
						if (in_array("8", $arr_sesiones)) {$tabla.= "<th class='align-middle text-center'>Sesión 7</th>";}
						if (in_array("9", $arr_sesiones)) {$tabla.= "<th class='align-middle text-center'>Sesión 8</th>";}
						if (in_array("10", $arr_sesiones)) {$tabla.= "<th class='align-middle text-center'>Sesión 9</th>";}
						if (in_array("11", $arr_sesiones)) {$tabla.= "<th class='align-middle text-center'>Sesión 10</th>";}
						if (in_array("12", $arr_sesiones)) {$tabla.= "<th class='align-middle text-center'>Sesión 11</th>";}
						if (in_array("13", $arr_sesiones)) {$tabla.= "<th class='align-middle text-center'>Sesión 12</th>";}
						if (in_array("14", $arr_sesiones)) {$tabla.= "<th class='align-middle text-center'>Sesión 13</th>";}
						if (in_array("15", $arr_sesiones)) {$tabla.= "<th class='align-middle text-center'>Sesión 14</th>";}
						if (in_array("16", $arr_sesiones)) {$tabla.= "<th class='align-middle text-center'>Sesión 15</th>";}
		$tabla.= "</tr>
			</thead>
		<tbody>";
		while ($stmt->fetch()) {
			$datos_empresa = mysqli_fetch_array(mysqli_query($con2, "SELECT empresas.Empresa_nombre, escuelas.Escuela_nombre FROM empresas INNER JOIN escuelas ON empresas.Escuela_ID=escuelas.Escuela_ID WHERE empresas.Empresa_ID =".$Empresa_ID), MYSQLI_ASSOC);
			$promedio_alumnos = mysqli_fetch_array(mysqli_query($con2, "SELECT AVG(Alumno_score) AS promedio FROM alumnos WHERE Alumno_estatus<2 AND Empresa_ID =".$Empresa_ID), MYSQLI_ASSOC);
			$tabla.="<tr>
				<td class='align-middle'>" . $datos_empresa["Empresa_nombre"] . " de " . $datos_empresa["Escuela_nombre"] . "</td>
				<td class='align-middle text-center'>" . $Puntos . "</td>
				<td class='text-center'>" . round($promedio_alumnos["promedio"], 2) . "</td>";
				if (in_array("2", $arr_sesiones)) {$tabla.= "<td class='text-center'>" . $Sesion2 . "</td>";}
				if (in_array("3", $arr_sesiones)) {$tabla.= "<td class='text-center'>" . $Sesion3 . "</td>";}
				if (in_array("4", $arr_sesiones)) {$tabla.= "<td class='text-center'>" . $Sesion4 . "</td>";}
				if (in_array("5", $arr_sesiones)) {$tabla.= "<td class='text-center'>" . $Sesion5 . "</td>";}
				if (in_array("6", $arr_sesiones)) {$tabla.= "<td class='text-center'>" . $Sesion6 . "</td>";}
				if (in_array("7", $arr_sesiones)) {$tabla.= "<td class='text-center'>" . $Sesion7 . "</td>";}
				if (in_array("8", $arr_sesiones)) {$tabla.= "<td class='text-center'>" . $Sesion8 . "</td>";}
				if (in_array("9", $arr_sesiones)) {$tabla.= "<td class='text-center'>" . $Sesion9 . "</td>";}
				if (in_array("10", $arr_sesiones)) {$tabla.= "<td class='text-center'>" . $Sesion10 . "</td>";}
				if (in_array("11", $arr_sesiones)) {$tabla.= "<td class='text-center'>" . $Sesion11 . "</td>";}
				if (in_array("12", $arr_sesiones)) {$tabla.= "<td class='text-center'>" . $Sesion12 . "</td>";}
				if (in_array("13", $arr_sesiones)) {$tabla.= "<td class='text-center'>" . $Sesion13 . "</td>";}
				if (in_array("14", $arr_sesiones)) {$tabla.= "<td class='text-center'>" . $Sesion14 . "</td>";}
				if (in_array("15", $arr_sesiones)) {$tabla.= "<td class='text-center'>" . $Sesion15 . "</td>";}
				if (in_array("16", $arr_sesiones)) {$tabla.= "<td class='text-center'>" . $Sesion16 . "</td>";}
		$tabla.= "</tr>";
		}
		$tabla.="</tbody>
			</table>";
		$stmt->close();
	} else {
		$tabla = "No hay datos para mostrar";
	}
	echo $tabla;
}
?>