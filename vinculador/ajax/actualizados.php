<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');
	$Escuela_ID = $_SESSION['Escuela_ID'];


	$seccion = $_POST["seccion"];
	$alerta = '<i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i>';
	$solo_asesor = 1;
	switch ($seccion) {
		case "1_6": //problemas
			$query = "SELECT DISTINCT empresas_info_s1.Empresa_ID, empresas.Empresa_nombre, empresas_info_s1.act_alumno, empresas_info_s1.act_asesor FROM empresas_info_s1 LEFT JOIN empresas ON empresas_info_s1.Empresa_ID = empresas.Empresa_ID WHERE Escuela_ID=? AND empresas.Empresa_estatus='Activa' AND (empresas_info_s1.act_alumno=1 OR empresas_info_s1.act_asesor=1)";
			break;
		case "2_3": //Mapa de empatía
			$query = "SELECT DISTINCT empresas_info_s2_3.Empresa_ID, empresas.Empresa_nombre, empresas_info_s2_3.act_alumno, empresas_info_s2_3.act_asesor FROM empresas_info_s2_3 LEFT JOIN empresas ON empresas_info_s2_3.Empresa_ID = empresas.Empresa_ID WHERE Escuela_ID=? AND empresas.Empresa_estatus='Activa' AND (empresas_info_s2_3.act_alumno=1 OR empresas_info_s2_3.act_asesor=1)";
			break;
		case "2_4": //Mapa de trayectoria
			$query = "SELECT DISTINCT empresas_info_s2_4.Empresa_ID, empresas.Empresa_nombre, empresas_info_s2_4.act_alumno, empresas_info_s2_4.act_asesor FROM empresas_info_s2_4 LEFT JOIN empresas ON empresas_info_s2_4.Empresa_ID = empresas.Empresa_ID WHERE Escuela_ID=? AND empresas.Empresa_estatus='Activa' AND (empresas_info_s2_4.act_alumno=1 OR empresas_info_s2_4.act_asesor=1)";
			break;
		case "2_5": //Storyboards
			$query = "SELECT DISTINCT empresas_info_s2_5.Empresa_ID, empresas.Empresa_nombre, empresas_info_s2_5.act_alumno, empresas_info_s2_5.act_asesor FROM empresas_info_s2_5 LEFT JOIN empresas ON empresas_info_s2_5.Empresa_ID = empresas.Empresa_ID WHERE Escuela_ID=? AND empresas.Empresa_estatus='Activa' AND (empresas_info_s2_5.act_alumno=1 OR empresas_info_s2_5.act_asesor=1)";
			break;
		case "2_6": //Prototipos
			$query = "SELECT DISTINCT empresas_info_s2_6.Empresa_ID, empresas.Empresa_nombre, empresas_info_s2_6.act_alumno, empresas_info_s2_6.act_asesor FROM empresas_info_s2_6 LEFT JOIN empresas ON empresas_info_s2_6.Empresa_ID = empresas.Empresa_ID WHERE Escuela_ID=? AND empresas.Empresa_estatus='Activa' AND (empresas_info_s2_6.act_alumno=1 OR empresas_info_s2_6.act_asesor=1)";
			break;
		case "2_7": //Encuesta de Mercado
			$query = "SELECT DISTINCT empresas_info_s2_7.Empresa_ID, empresas.Empresa_nombre, empresas_info_s2_7.act_alumno, empresas_info_s2_7.act_asesor FROM empresas_info_s2_7 LEFT JOIN empresas ON empresas_info_s2_7.Empresa_ID = empresas.Empresa_ID WHERE Escuela_ID=? AND empresas.Empresa_estatus='Activa' AND (empresas_info_s2_7.act_alumno=1 OR empresas_info_s2_7.act_asesor=1)";
			break;
		case "2_8": //Validación de Encuesta de Mercado
			$query = "SELECT DISTINCT empresas_info_s2_8.Empresa_ID, empresas.Empresa_nombre, empresas_info_s2_8.act_alumno, empresas_info_s2_8.act_asesor FROM empresas_info_s2_8 LEFT JOIN empresas ON empresas_info_s2_8.Empresa_ID = empresas.Empresa_ID WHERE Escuela_ID=? AND empresas.Empresa_estatus='Activa' AND (empresas_info_s2_8.act_alumno=1 OR empresas_info_s2_8.act_asesor=1)";
			break;
		case "2_9": //Mi Producto
			$query = "SELECT DISTINCT empresas_info_s2_9.Empresa_ID, empresas.Empresa_nombre, empresas_info_s2_9.act_alumno, empresas_info_s2_9.act_asesor FROM empresas_info_s2_9 LEFT JOIN empresas ON empresas_info_s2_9.Empresa_ID = empresas.Empresa_ID WHERE Escuela_ID=? AND empresas.Empresa_estatus='Activa' AND (empresas_info_s2_9.act_alumno=1 OR empresas_info_s2_9.act_asesor=1)";
			break;
		case "3_2": //Perfil de la Empresa
			$query = "SELECT DISTINCT empresas_info_s3_2.Empresa_ID, empresas.Empresa_nombre, empresas_info_s3_2.act_alumno, empresas_info_s3_2.act_asesor FROM empresas_info_s3_2 LEFT JOIN empresas ON empresas_info_s3_2.Empresa_ID = empresas.Empresa_ID WHERE Escuela_ID=? AND empresas.Empresa_estatus='Activa' AND (empresas_info_s3_2.act_alumno=1 OR empresas_info_s3_2.act_asesor=1)";
			break;
		case "3_6": //Actas de la Empresa
			$query = "SELECT DISTINCT empresas_info_s3_6.Empresa_ID, empresas.Empresa_nombre, empresas_info_s3_6.act_alumno, empresas_info_s3_6.act_asesor FROM empresas_info_s3_6 LEFT JOIN empresas ON empresas_info_s3_6.Empresa_ID = empresas.Empresa_ID WHERE Escuela_ID=? AND empresas.Empresa_estatus='Activa' AND (empresas_info_s3_6.act_alumno=1 OR empresas_info_s3_6.act_asesor=1)";
			break;
		case "3_7": //Financiamiento de la Empresa
			$query = "SELECT DISTINCT empresas_info_s3_7.Empresa_ID, empresas.Empresa_nombre, empresas_info_s3_7.act_alumno, empresas_info_s3_7.act_asesor FROM empresas_info_s3_7 LEFT JOIN empresas ON empresas_info_s3_7.Empresa_ID = empresas.Empresa_ID WHERE Escuela_ID=? AND empresas.Empresa_estatus='Activa' AND (empresas_info_s3_7.act_alumno=1 OR empresas_info_s3_7.act_asesor=1)";
			break;
		case "4_4": //Materias primas
			$query = "SELECT DISTINCT empresas_info_s4_4.Empresa_ID, empresas.Empresa_nombre, empresas_info_s4_4.act_alumno, empresas_info_s4_4.act_asesor FROM empresas_info_s4_4 LEFT JOIN empresas ON empresas_info_s4_4.Empresa_ID = empresas.Empresa_ID WHERE Escuela_ID=? AND empresas.Empresa_estatus='Activa' AND (empresas_info_s4_4.act_alumno=1 OR empresas_info_s4_4.act_asesor=1)";
			break;
		case "4_5": //Proceso de Producción
			$query = "SELECT DISTINCT empresas_info_s4_5.Empresa_ID, empresas.Empresa_nombre, empresas_info_s4_5.act_alumno, empresas_info_s4_5.act_asesor FROM empresas_info_s4_5 LEFT JOIN empresas ON empresas_info_s4_5.Empresa_ID = empresas.Empresa_ID WHERE Escuela_ID=? AND empresas.Empresa_estatus='Activa' AND (empresas_info_s4_5.act_alumno=1 OR empresas_info_s4_5.act_asesor=1)";
			break;
		case "4_6": //Bloques 3 al 8 de CANVAS
			$query = "SELECT DISTINCT empresas_info_s4_6.Empresa_ID, empresas.Empresa_nombre, empresas_info_s4_6.act_alumno, empresas_info_s4_6.act_asesor FROM empresas_info_s4_6 LEFT JOIN empresas ON empresas_info_s4_6.Empresa_ID = empresas.Empresa_ID WHERE Escuela_ID=? AND empresas.Empresa_estatus='Activa' AND (empresas_info_s4_6.act_alumno=1 OR empresas_info_s4_6.act_asesor=1)";
			break;
		case "100_1": //CANVAS
			$query = "SELECT DISTINCT empresas_info_s100_1.Empresa_ID, empresas.Empresa_nombre, empresas_info_s100_1.act_alumno, empresas_info_s100_1.act_asesor, empresas_info_s100_1.act_coord, empresas_info_s100_1.act_ja FROM empresas_info_s100_1 LEFT JOIN empresas ON empresas_info_s100_1.Empresa_ID = empresas.Empresa_ID WHERE Escuela_ID=? AND empresas.Empresa_estatus='Activa' AND (empresas_info_s100_1.act_alumno=1 OR empresas_info_s100_1.act_asesor=1 OR empresas_info_s100_1.act_coord=1 OR empresas_info_s100_1.act_ja=1)";
			$solo_asesor = 0;
			break;
		case "100_2": //CANVAS - Validación
			$query = "SELECT DISTINCT empresas_info_s100_2.Empresa_ID, empresas.Empresa_nombre, empresas_info_s100_2.act_alumno, empresas_info_s100_2.act_asesor, empresas_info_s100_2.act_coord, empresas_info_s100_2.act_ja FROM empresas_info_s100_2 LEFT JOIN empresas ON empresas_info_s100_2.Empresa_ID = empresas.Empresa_ID WHERE Escuela_ID=? AND empresas.Empresa_estatus='Activa' AND (empresas_info_s100_2.act_alumno=1 OR empresas_info_s100_2.act_asesor=1 OR empresas_info_s100_2.act_coord=1 OR empresas_info_s100_2.act_ja=1)";
			$solo_asesor = 0;
			break;
		case "101_2": //CANVAS - Video y Reporte
			$query = "SELECT DISTINCT empresas_info_s101_2.Empresa_ID, empresas.Empresa_nombre, empresas_info_s101_2.act_alumno, empresas_info_s101_2.act_asesor, empresas_info_s101_2.act_coord, empresas_info_s101_2.act_ja FROM empresas_info_s101_2 LEFT JOIN empresas ON empresas_info_s101_2.Empresa_ID = empresas.Empresa_ID WHERE Escuela_ID=? AND empresas.Empresa_estatus='Activa' AND (empresas_info_s101_2.act_alumno=1 OR empresas_info_s101_2.act_asesor=1 OR empresas_info_s101_2.act_coord=1 OR empresas_info_s101_2.act_ja=1)";
			$solo_asesor = 0;
			break;
	}
	if ($solo_asesor == 1) {
		if ($stmt = $con->prepare($query)) {
			$stmt->bind_param("i", $Escuela_ID);
			$stmt->execute();
			$stmt->bind_result($Empresa_ID, $Empresa_nombre, $act_alumno, $act_asesor);
			$result_alumno = "";
			$result_asesor = "";
			while ($stmt->fetch()) {
				if ($act_alumno==1) {
					$result_alumno.=$Empresa_nombre . ", ";
				}
				if ($act_asesor==1) {
					$result_asesor.=$Empresa_nombre . ", ";
				}
			}
			if ($result_alumno != "") {
				$result_alumno.= " han actualizado su información.<br>";
			}
			if ($result_asesor != "") {
				$result_asesor.= " han sido comentados por sus asesores.<br>";
			}
			if (($result_alumno . $result_asesor) != "") {
				echo $alerta . "   " . $result_alumno . $result_asesor;
			} else {
				echo "";
			}
			$stmt->close();
		} else { echo ""; }
	} else if ($solo_asesor == 0) {
		if ($stmt = $con->prepare($query)) {
			$stmt->bind_param("i", $Escuela_ID);
			$stmt->execute();
			$stmt->bind_result($Empresa_ID, $Empresa_nombre, $act_alumno, $act_asesor, $act_coord, $act_ja);
			$result_alumno = "";
			$result_asesor = "";
			$result_coord = "";
			$result_ja = "";
			while ($stmt->fetch()) {
				if ($act_alumno==1) {
					$result_alumno.=$Empresa_nombre . ", ";
				}
				if ($act_asesor==1) {
					$result_asesor.=$Empresa_nombre . ", ";
				}
				if ($act_coord==1) {
					$result_coord.=$Empresa_nombre . ", ";
				}
				if ($act_ja==1) {
					$result_ja.=$Empresa_nombre . ", ";
				}
			}
			if ($result_alumno != "") {
				$result_alumno.= " han actualizado su información.<br><br>";
			}
			if ($result_asesor != "") {
				$result_asesor.= " han sido comentados por sus asesores.<br><br>";
			}
			if ($result_coord != "") {
				$result_coord.= " han sido comentados por su coordinador.<br><br>";
			}
			if ($result_ja != "") {
				$result_ja.= " han sido comentados por JA.<br>";
			}
			if (($result_alumno . $result_asesor . $result_coord . $result_ja) != "") {
				echo $alerta . "   " . $result_alumno . $result_asesor . $result_coord . $result_ja;
			} else {
				echo "";
			}
			$stmt->close();
		} else { echo ""; }		}

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