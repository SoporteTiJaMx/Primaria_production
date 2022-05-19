<?php
	//session_start();
	include_once('../scripts/conexion.php');
	include_once('../scripts/conexion2.php');

	$Escuela_ID = $_SESSION['Escuela_ID'];

	$query = mysqli_query($con2, "SELECT licencia_escuela.Licencia_ID, licencias.Licencia_nombre FROM licencia_escuela LEFT JOIN licencias ON licencia_escuela.Licencia_ID = licencias.Licencia_ID WHERE licencia_escuela.Escuela_ID=$Escuela_ID");
	while ($fila = mysqli_fetch_array($query)) {
		$_SESSION['licencia_activa'] = $fila[0];
		$_SESSION['licencia_nombre'] = $fila[1];
	}

	if (isset($_SESSION['licencia_activa'])) {
		$Licencia_ID = $_SESSION['licencia_activa'];
		$query = "SELECT * FROM eventos WHERE Licencia_ID=?";
		$r = mysqli_fetch_array(mysqli_query($con2, "SELECT COUNT(*) FROM eventos WHERE Licencia_ID=$Licencia_ID"));
		$registros = $r[0];
	    if ($stmt = $con->prepare($query)) {
	        $stmt->bind_param("i", $Licencia_ID);
	        $stmt->execute();
			$stmt->bind_result($Eventos_ID, $Licencia_ID, $Sesiones_ID, $Eventos_nombre, $Eventos_descripcion, $Eventos_color, $Eventos_textColor, $Eventos_inicio, $Eventos_fin);
			$resultado="[{";
			$i = 1;
			while ($stmt->fetch()) {
				$resultado.="id:'" . $Eventos_ID . "', title:'" . $Eventos_nombre . "', start:'" . $Eventos_inicio . "', end:'" . $Eventos_fin . "', backgroundColor:'" . $Eventos_color . "', borderColor:'" . $Eventos_color . "', textColor:'" . $Eventos_textColor . "', evento:'" . $Eventos_nombre . "', descripcion:'" . $Eventos_descripcion . "'";
				if ($i < $registros) {
					$resultado.="},{";
					$i++;
				}
			}
			$resultado.="}]";
			$stmt->close();
		}
		return $resultado;
    } else {
		return "[{}]";
    }

?>