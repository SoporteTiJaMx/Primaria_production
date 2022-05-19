<?php
date_default_timezone_set("America/Mexico_City");
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
include_once('conexion.php');
include_once('conexion2.php');
$hoy = date("Y-m-d H:i:s");
//$hoy = date("2021-03-21 07:59:59");
//$Licencia_ID = $_SESSION["Licencia_ID"];
$Licencia_ID = 1;
/*https://emprendedoresyempresarios.org.mx/scripts/actualizar_puntajes.php

Perfil + Carta compromiso
	Máximo por alumno: 20 estrellas
Sesión 1 - Conviértete en emprendedor
	Máximo por alumno: 55 estrellas
Sesión 2 - El arte de crear I
	Máximo por alumno: 25 estrellas
Sesión 3 - El arte de crear II
	Máximo por alumno: 15 estrellas
Sesión 4 - Selección de Roles
	Máximo por alumno: 60 estrellas - 175 estrellas en total

*/
$arr_sesiones = array();
$datos_sesiones = mysqli_query($con, "SELECT * FROM eventos WHERE Licencia_ID=" . $Licencia_ID . " ORDER BY Eventos_fin ASC");
while ($row_sesiones = mysqli_fetch_array($datos_sesiones, MYSQLI_ASSOC)) {
	if ($row_sesiones["Sesiones_ID"] > 0) {
		array_push($arr_sesiones, array('no_sesion' => $row_sesiones["Sesiones_ID"], 'fin_sesion' => $row_sesiones["Eventos_fin"]));
	}
}

$sesiones = count($arr_sesiones);
for ($i = 0; $i < $sesiones; $i++) {
	$no_sesion = $arr_sesiones[$i]['no_sesion'];
	$fin_sesion = $arr_sesiones[$i]['fin_sesion'];
	if (strtotime($hoy) - strtotime($fin_sesion) > 0) {
		$dia_previo = date("Y-m-d", strtotime('-24 hour', strtotime($hoy)));
		if (strtotime($dia_previo) - strtotime($fin_sesion) < 0) {
			$sesion_terminada = $no_sesion;
		} else {
			$sesion_terminada = "";
		}
		$puntos_empresas = mysqli_query($con, "SELECT licencia_empresa.Empresa_ID, empresas.Empresa_nombre, licencia_empresa.Escuela_ID, escuelas.Escuela_nombre, empresas.Empresa_producto, empresas.Empresa_score FROM licencia_empresa INNER JOIN empresas ON licencia_empresa.Empresa_ID=empresas.Empresa_ID INNER JOIN escuelas ON escuelas.Escuela_ID=licencia_empresa.Escuela_ID WHERE Licencia_ID=" . $Licencia_ID);
		while ($row_empresas = mysqli_fetch_array($puntos_empresas, MYSQLI_ASSOC)) {
			$Empresa_ID = $row_empresas["Empresa_ID"];
			//$Empresa_score = $row_empresas["Empresa_score"];
			$row = mysqli_fetch_row(mysqli_query($con2, "SELECT COUNT(*) FROM alumnos WHERE Empresa_ID=".$Empresa_ID." AND Alumno_estatus<2"));
			$integrantes_empresa = $row[0];
			$existe = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM empresas_puntos WHERE Empresa_ID=".$Empresa_ID), MYSQLI_ASSOC);
			$sesionN = "Sesion" . $no_sesion;
			if ($no_sesion == 2) { //Conviértete en emprendedor
				$puntos_maximos_empresa = 50;
				$puntos_sesion_2 = 0;
				if ($existe) {
					$puntos_en_bd = $existe[$sesionN];
				} else {
					mysqli_query($con, "INSERT INTO empresas_puntos (Empresa_ID) VALUES (".$Empresa_ID.")");
					$puntos_en_bd = 0;
				}
				$row2 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(Empresa_ID), Act_1_4 FROM empresas_puntos_avances_sesiones WHERE Empresa_ID=".$Empresa_ID));
				if ($row2[0] == 0) {
					mysqli_query($con, "INSERT INTO empresas_puntos_avances_sesiones (Empresa_ID) VALUES (".$Empresa_ID.")");
					$tareas_realizadas_en_bd = 0;
				} else {
					$tareas_realizadas_en_bd = $row2[1];
				}
				$row3 = mysqli_fetch_row(mysqli_query($con2, "SELECT COUNT(*) FROM empresas_info_s1 WHERE Empresa_ID=".$Empresa_ID . " AND problema1!=''"));
				$tareas_realizadas_alumnos = $row3[0];
				$diferencia_tareas = $tareas_realizadas_alumnos - $tareas_realizadas_en_bd;
				if ($diferencia_tareas >0 AND $sesion_terminada == 2) {
					$puntos_sesion_2 = $tareas_realizadas_alumnos * $puntos_maximos_empresa / $integrantes_empresa;
				} else if ($diferencia_tareas >0) {
					$puntos_posibles = ($puntos_maximos_empresa - $puntos_en_bd)/2;
					if ($integrantes_empresa - $tareas_realizadas_en_bd > 0) {
						$puntos_sesion_2 = $puntos_en_bd + $diferencia_tareas / ($integrantes_empresa - $tareas_realizadas_en_bd) * $puntos_posibles;
					} else {
						$puntos_sesion_2 = $puntos_en_bd + $puntos_posibles;
					}
				}
				mysqli_query($con, "UPDATE empresas_puntos_avances_sesiones SET Act_1_4 =".$tareas_realizadas_alumnos." WHERE Empresa_ID= ".$Empresa_ID);
				if (isset($puntos_sesion_2) AND $puntos_sesion_2 >$puntos_en_bd) {
					mysqli_query($con, "UPDATE empresas_puntos SET ".$sesionN."=".$puntos_sesion_2." WHERE Empresa_ID= ".$Empresa_ID);
				}
			} else if ($no_sesion == 3) { //El arte de crear I
				$puntos_maximos_empresa = 50;
				$puntos_sesion_3 = 0;
				$puntos_en_bd = $existe[$sesionN];
				$row_i = mysqli_fetch_array(mysqli_query($con, "SELECT Act_2_2, Act_2_3, Act_2_4, Act_2_5 FROM empresas_puntos_avances_sesiones WHERE Empresa_ID=".$Empresa_ID));
				$tareas_realizadas_en_bd = $row_i[0]+$row_i[1]+$row_i[2]+$row_i[3];

				$row2 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s2_2 WHERE Empresa_ID=".$Empresa_ID . " AND (segmentacion!='' OR humanizacion!='')"));
				$etapa_2_2 = 0;
				if ($row2[0] > 0) {
					$etapa_2_2 = 1;
				}
				$row3 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s2_3 WHERE Empresa_ID=".$Empresa_ID . " AND (usuario!='' OR necesidad!='')"));
				$etapa_2_3 = 0;
				if ($row3[0] > 0) {
					$etapa_2_3 = 1;
				}
				$row4 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s2_4 WHERE Empresa_ID=".$Empresa_ID . " AND (idea1!='' OR descripcion1!='')"));
				$etapa_2_4 = 0;
				if ($row4[0] > 0) {
					$etapa_2_4 = 1;
				}
				$row5 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM canvas WHERE Empresa_ID=".$Empresa_ID . " AND (bloque=3 OR bloque=5 OR bloque=10)"));
				$etapa_2_5 = 0;
				if ($row5[0] > 0) {
					$etapa_2_5 = 1;
				}

				$tareas_realizadas_alumnos = $etapa_2_2+$etapa_2_3+$etapa_2_4+$etapa_2_5;
				$diferencia_tareas = $tareas_realizadas_alumnos - $tareas_realizadas_en_bd;
				if ($diferencia_tareas >0 AND $sesion_terminada == 3) {
					$puntos_sesion_3 = ($etapa_2_2+$etapa_2_3+$etapa_2_4+$etapa_2_5) * $puntos_maximos_empresa / 4;
				} else if ($diferencia_tareas >0) {
					$puntos_posibles = ($puntos_maximos_empresa - $puntos_en_bd)/2;
					if (4 - $tareas_realizadas_en_bd > 0) {
						$puntos_sesion_3 = $puntos_en_bd + $diferencia_tareas / (4 - $tareas_realizadas_en_bd) * $puntos_posibles;
					} else {
						$puntos_sesion_3 = $puntos_en_bd + $puntos_posibles;
					}
				}

				if (isset($puntos_sesion_3) AND $puntos_sesion_3 >$puntos_en_bd) {
					mysqli_query($con, "UPDATE empresas_puntos_avances_sesiones SET Act_2_2 = $etapa_2_2 WHERE Empresa_ID= ".$Empresa_ID);
					mysqli_query($con, "UPDATE empresas_puntos_avances_sesiones SET Act_2_3 = $etapa_2_3 WHERE Empresa_ID= ".$Empresa_ID);
					mysqli_query($con, "UPDATE empresas_puntos_avances_sesiones SET Act_2_4 = $etapa_2_4 WHERE Empresa_ID= ".$Empresa_ID);
					mysqli_query($con, "UPDATE empresas_puntos_avances_sesiones SET Act_2_5 = $etapa_2_5 WHERE Empresa_ID= ".$Empresa_ID);
					mysqli_query($con, "UPDATE empresas_puntos SET ".$sesionN."=".$puntos_sesion_3." WHERE Empresa_ID= ".$Empresa_ID);
				}
			} else if ($no_sesion == 4) { //El arte de crear II
				$puntos_maximos_empresa = 50;
				$puntos_sesion_4 = 0;
				$puntos_en_bd = $existe[$sesionN];
				$row_i = mysqli_fetch_array(mysqli_query($con, "SELECT Act_3_2, Act_3_3, Act_3_4 FROM empresas_puntos_avances_sesiones WHERE Empresa_ID=".$Empresa_ID));
				$tareas_realizadas_en_bd = $row_i[0]+$row_i[1]+$row_i[2];

				$row6 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s3_2 WHERE Empresa_ID=".$Empresa_ID . " AND ind_datos=1"));
				$etapa_3_2 = 0;
				if ($row6[0] > 0) {
					$etapa_3_2 = 1;
				}
				$row7 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s3_3 WHERE Empresa_ID=".$Empresa_ID));
				$etapa_3_3 = 0;
				if ($row7[0] > 0) {
					$etapa_3_3 = 1;
				}
				$row8 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM canvas WHERE Empresa_ID=".$Empresa_ID . " AND bloque=11"));
				$etapa_3_4 = 0;
				if ($row8[0] > 0) {
					$etapa_3_4 = 1;
				}

				$tareas_realizadas_alumnos = $etapa_3_2+$etapa_3_3+$etapa_3_4;
				$diferencia_tareas = $tareas_realizadas_alumnos - $tareas_realizadas_en_bd;
				if ($diferencia_tareas >0 AND $sesion_terminada == 4) {
					$puntos_sesion_4 = ($etapa_3_2+$etapa_3_3+$etapa_3_4) * $puntos_maximos_empresa / 3;
				} else if ($diferencia_tareas >0) {
					$puntos_posibles = ($puntos_maximos_empresa - $puntos_en_bd)/2;
					if (3 - $tareas_realizadas_en_bd > 0) {
						$puntos_sesion_4 = $puntos_en_bd + $diferencia_tareas / (3 - $tareas_realizadas_en_bd) * $puntos_posibles;
					} else {
						$puntos_sesion_4 = $puntos_en_bd + $puntos_posibles;
					}
				}

				if (isset($puntos_sesion_4) AND $puntos_sesion_4 >$puntos_en_bd) {
					mysqli_query($con, "UPDATE empresas_puntos_avances_sesiones SET Act_3_2 = $etapa_3_2 WHERE Empresa_ID= ".$Empresa_ID);
					mysqli_query($con, "UPDATE empresas_puntos_avances_sesiones SET Act_3_3 = $etapa_3_3 WHERE Empresa_ID= ".$Empresa_ID);
					mysqli_query($con, "UPDATE empresas_puntos_avances_sesiones SET Act_3_4 = $etapa_3_4 WHERE Empresa_ID= ".$Empresa_ID);
					mysqli_query($con, "UPDATE empresas_puntos SET ".$sesionN."=".$puntos_sesion_4." WHERE Empresa_ID= ".$Empresa_ID);
				}
			} else if ($no_sesion == 5) { //Selección de Roles
				$puntos_maximos_empresa = 50;
				$puntos_sesion_5 = 0;
				$puntos_en_bd = $existe[$sesionN];
				$row_i = mysqli_fetch_array(mysqli_query($con, "SELECT Act_4_2, Act_4_3, Act_4_4 FROM empresas_puntos_avances_sesiones WHERE Empresa_ID=".$Empresa_ID));
				$tareas_realizadas_en_bd = $row_i[0]+$row_i[1]+$row_i[2];
				$tests_guardados_en_bd = $row_i[0];
				$cvs_guardados_en_bd = $row_i[1];
				$puestos_guardados_en_bd = $row_i[2];

				$row9 = mysqli_fetch_row(mysqli_query($con2, "SELECT COUNT(*) FROM empresas_info_s4_3 WHERE Empresa_ID=".$Empresa_ID));
				$tests_realizados_alumnos = $row9[0];
				$indice_4_3 = $tests_realizados_alumnos / $integrantes_empresa;
				$indice_4_3 = ($indice_4_3>1) ? 1 : $indice_4_3;

				$row10 = mysqli_query($con2, "SELECT Alumno_ID, Alumno_nombre FROM alumnos WHERE Empresa_ID=".$Empresa_ID);
				$target_dir = "../images/cvs/";
				$cvs_realizados = 0;
				while ($row_alumno = mysqli_fetch_array($row10, MYSQLI_ASSOC)) {
					$Alumno_ID = $row_alumno["Alumno_ID"];
					$Alumno_nombre = $row_alumno["Alumno_nombre"];
					if (is_file($target_dir . "CV_" . $Alumno_ID . "_" . $Alumno_nombre . ".pdf")) {
						$cvs_realizados++;
					}
				}
				$indice_4_4 = $cvs_realizados / $integrantes_empresa;
				$indice_4_4 = ($indice_4_4>1) ? 1 : $indice_4_4;

				$row11 = mysqli_fetch_row(mysqli_query($con2, "SELECT COUNT(*) FROM alumnos WHERE Empresa_ID=".$Empresa_ID." AND Alumno_estatus<2 AND Puesto_ID!=0"));
				$alumnos_con_puesto = $row11[0];
				if ($integrantes_empresa>12 AND $alumnos_con_puesto==12) {
					$indice_4_5 = 1;
				} else {
					$indice_4_5 = $alumnos_con_puesto / $integrantes_empresa;
				}
				$indice_4_5 = ($indice_4_5>1) ? 1 : $indice_4_5;

				if ($sesion_terminada == 5) {
					$puntos_sesion_5 = ($indice_4_3+$indice_4_4+$indice_4_5) * $puntos_maximos_empresa / 3;
				} else {
					$puntos_posibles = ($puntos_maximos_empresa - $puntos_en_bd)/2;
					$diferencia_4_3 = $tests_realizados_alumnos - $tests_guardados_en_bd;
					$puntos_extra_4_3 = 0;
					if ($diferencia_4_3 > 0) {
						$puntos_extra_4_3 = ($puntos_posibles / 3) * ($diferencia_4_3 / $tests_realizados_alumnos);
					}

					$diferencia_4_4 = $cvs_realizados - $cvs_guardados_en_bd;
					$puntos_extra_4_4 = 0;
					if ($diferencia_4_4 > 0) {
						$puntos_extra_4_4 = ($puntos_posibles / 3) * ($diferencia_4_4 / $cvs_realizados);
					}

					$diferencia_4_5 = $alumnos_con_puesto - $puestos_guardados_en_bd;
					$puntos_extra_4_5 = 0;
					if ($diferencia_4_5 > 0) {
						$puntos_extra_4_5 = ($puntos_posibles / 3) * ($diferencia_4_5 / $alumnos_con_puesto);
					}

					$puntos_sesion_5 = $puntos_en_bd + $puntos_extra_4_3 + $puntos_extra_4_4 + $puntos_extra_4_5;
				}

				if (isset($puntos_sesion_5) AND $puntos_sesion_5 >$puntos_en_bd) {
					mysqli_query($con, "UPDATE empresas_puntos_avances_sesiones SET Act_4_2 = $tests_realizados_alumnos WHERE Empresa_ID= ".$Empresa_ID);
					mysqli_query($con, "UPDATE empresas_puntos_avances_sesiones SET Act_4_3 = $cvs_realizados WHERE Empresa_ID= ".$Empresa_ID);
					mysqli_query($con, "UPDATE empresas_puntos_avances_sesiones SET Act_4_4 = $alumnos_con_puesto WHERE Empresa_ID= ".$Empresa_ID);
					mysqli_query($con, "UPDATE empresas_puntos SET ".$sesionN."=".$puntos_sesion_5." WHERE Empresa_ID= ".$Empresa_ID);
				}
			}
		}
		//$i = $sesiones;
	}
}
$datos_puntajes = mysqli_query($con, "SELECT * FROM empresas_puntos");
while ($row = mysqli_fetch_array($datos_puntajes, MYSQLI_ASSOC)) {
	$Empresa_ID = $row["Empresa_ID"];
	$puntos = $row["Sesion1"]+$row["Sesion2"]+$row["Sesion3"]+$row["Sesion4"]+$row["Sesion5"]+$row["Sesion6"]+$row["Sesion7"]+$row["Sesion8"]+$row["Sesion9"]+$row["Sesion10"]+$row["Sesion11"]+$row["Sesion12"]+$row["Sesion13"]+$row["Sesion14"]+$row["Sesion15"];
	mysqli_query($con, "UPDATE empresas_puntos SET Puntos=".$puntos." WHERE Empresa_ID= ".$Empresa_ID);
	mysqli_query($con, "UPDATE empresas SET Empresa_score=".$puntos." WHERE Empresa_ID= ".$Empresa_ID);
}
echo "ok";

/* echo('<pre>');
var_dump($arr_sesiones);
echo('</pre>'); */
?>