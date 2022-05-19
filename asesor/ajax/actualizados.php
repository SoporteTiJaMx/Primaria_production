<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$Asesor_ID = $_SESSION['Asesor_ID'];
	$seccion = $_POST["seccion"];
	$alerta = '<i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i>';
	$solo_asesor = 1;
	switch ($seccion) {
		case "1_5": //problemas
			$query = "SELECT DISTINCT empresas_info_s1.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s1 LEFT JOIN empresas ON empresas_info_s1.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s1.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s1.act_alumno=1";
			break;
		case "2_2": //Mapa de empatía
			$query = "SELECT DISTINCT empresas_info_s2_2.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s2_2 LEFT JOIN empresas ON empresas_info_s2_2.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s2_2.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s2_2.act_alumno=1";
			break;
		case "2_3": //Mapa de trayectoria
			$query = "SELECT DISTINCT empresas_info_s2_3.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s2_3 LEFT JOIN empresas ON empresas_info_s2_3.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s2_3.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s2_3.act_alumno=1";
			break;
		case "2_4": //Storyboards
			$query = "SELECT DISTINCT empresas_info_s2_4.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s2_4 LEFT JOIN empresas ON empresas_info_s2_4.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s2_4.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s2_4.act_alumno=1";
			break;
		case "2_5": //Canvas 3 primeros bloques
			$query = "SELECT DISTINCT canvas_coments.Empresa_ID, empresas.Empresa_nombre FROM canvas_coments LEFT JOIN empresas ON canvas_coments.Empresa_ID = empresas.Empresa_ID WHERE canvas_coments.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND canvas_coments.act_alumno=1";
			break;
		case "3_2": //Prototipos
			$query = "SELECT DISTINCT empresas_info_s3_2.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s3_2 LEFT JOIN empresas ON empresas_info_s3_2.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s3_2.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s3_2.act_alumno=1";
			break;
		case "3_3": //Encuesta de Mercado
			$query = "SELECT DISTINCT empresas_info_s3_3.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s3_3 LEFT JOIN empresas ON empresas_info_s3_3.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s3_3.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s3_3.act_alumno=1";
			break;
		case "3_4": //Canvas 1 bloque más, propuesta de valor
			$query = "SELECT DISTINCT canvas_coments.Empresa_ID, empresas.Empresa_nombre FROM canvas_coments LEFT JOIN empresas ON canvas_coments.Empresa_ID = empresas.Empresa_ID WHERE canvas_coments.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND canvas_coments.act_alumno=1";
			break;
		case "5_1": //Definición del producto
			$query = "SELECT DISTINCT empresas_info_s5_1.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s5_1 LEFT JOIN empresas ON empresas_info_s5_1.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s5_1.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s5_1.act_alumno=1";
			break;
		case "5_4": //Identidad institucional
			$query = "SELECT DISTINCT empresas_info_s5_3.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s5_3 LEFT JOIN empresas ON empresas_info_s5_3.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s5_3.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s5_3.act_alumno=1";
			break;
		case "5_6": //Objetivos de la Empresa
			$query = "SELECT DISTINCT empresas_info_s5_5_coments.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s5_5_coments LEFT JOIN empresas ON empresas_info_s5_5_coments.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s5_5_coments.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s5_5_coments.act_alumno=1";
			break;
		case "6_3": //Materias primas
			$query = "SELECT DISTINCT empresas_info_s6_3_coments.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s6_3_coments LEFT JOIN empresas ON empresas_info_s6_3_coments.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s6_3_coments.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s6_3_coments.act_alumno=1 AND empresas_info_s6_3_coments.tipo=1";
			break;
		case "6_4": //Maquinaria y Equipo
			$query = "SELECT DISTINCT empresas_info_s6_3_coments.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s6_3_coments LEFT JOIN empresas ON empresas_info_s6_3_coments.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s6_3_coments.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s6_3_coments.act_alumno=1 AND empresas_info_s6_3_coments.tipo=2";
			break;
		case "6_5": //Objetivos de la Empresa
			$query = "SELECT DISTINCT empresas_info_s6_5.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s6_5 LEFT JOIN empresas ON empresas_info_s6_5.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s6_5.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s6_5.act_alumno=1";
			break;
		case "6_6": //Canales
			$query = "SELECT DISTINCT empresas_info_s6_6_coments.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s6_6_coments LEFT JOIN empresas ON empresas_info_s6_6_coments.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s6_6_coments.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s6_6_coments.act_alumno=1";
			break;
		case "6_7": //Canvas 3 bloques más, Recursos Clave, Socios Clave (proveedores), y Canales de Distribución
			$query = "SELECT DISTINCT canvas_coments.Empresa_ID, empresas.Empresa_nombre FROM canvas_coments LEFT JOIN empresas ON canvas_coments.Empresa_ID = empresas.Empresa_ID WHERE canvas_coments.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND canvas_coments.act_alumno=1";
			break;
		case "7_3": //Sueldos y Salarios
			$query = "SELECT DISTINCT empresas_info_s7_3_coments.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s7_3_coments LEFT JOIN empresas ON empresas_info_s7_3_coments.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s7_3_coments.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s7_3_coments.act_alumno=1";
			break;
		case "7_4": //Costos
			$query = "SELECT DISTINCT empresas_info_s7_4_coments.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s7_4_coments LEFT JOIN empresas ON empresas_info_s7_4_coments.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s7_4_coments.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s7_4_coments.act_alumno=1";
			break;
		case "7_6": //Inversión inicial
			$query = "SELECT DISTINCT empresas_info_s7_6_coments.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s7_6_coments LEFT JOIN empresas ON empresas_info_s7_6_coments.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s7_6_coments.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s7_6_coments.act_alumno=1";
			break;
		case "7_7": //Financiamiento
			$query = "SELECT DISTINCT empresas_info_s7_7.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s7_7 LEFT JOIN empresas ON empresas_info_s7_7.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s7_7.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s7_7.act_alumno=1";
			break;
		case "8_2": //Inversión inicial
			$query = "SELECT DISTINCT empresas_info_s8_2_coments.Empresa_ID, empresas.Empresa_nombre FROM empresas_info_s8_2_coments LEFT JOIN empresas ON empresas_info_s8_2_coments.Empresa_ID = empresas.Empresa_ID WHERE empresas_info_s8_2_coments.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE Asesor_ID=? AND empresas.Empresa_estatus='Activa') AND empresas_info_s8_2_coments.act_alumno=1";
			break;
	}
	if ($solo_asesor == 1) {
		if ($stmt = $con->prepare($query)) {
			$stmt->bind_param("i", $Asesor_ID);
			$stmt->execute();
			$stmt->bind_result($Empresa_ID, $Empresa_nombre);
			$result = "";
			while ($stmt->fetch()) {
				$result.=$alerta . "   " . $Empresa_nombre . " ha actualizado su información.<br>";
			}
			echo $result;
			$stmt->close();
		} else { echo ""; }
	} else if ($solo_asesor == 0) {
		if ($stmt = $con->prepare($query)) {
			$stmt->bind_param("i", $Asesor_ID);
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