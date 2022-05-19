<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../../scripts/conexion.php');
	include_once('../../scripts/conexion2.php');
	include_once('../../scripts/funciones.php');
	//session_start();

	$Empresa_ID=$_POST['Empresa_ID'];
	$Sesion_ID=$_POST['Sesion_ID'];
	$Escuela_ID=$_SESSION['Escuela_ID'];
	$Licencia_activa = $_SESSION['Licencia_ID'];
	if ($Empresa_ID > 0) {
		$query = "SELECT alumnos.Alumno_subseccion, alumnos.Alumno_nombre, alumnos.Alumno_ap_paterno, alumnos.Alumno_ap_materno, alumnos.Alumno_estatus, alumnos.Alumno_ID, alumnos.Carrera_ID, alumnos.Alumno_turno, alumnos.Alumno_cumple, alumnos.Alumno_email, alumnos.Alumno_tel, alumnos.Alumno_cel, alumnos.Alumno_estatus, puestos.Puesto_nombre, usuarios.Num_accesos, usuarios.UltimoAcceso FROM alumnos INNER JOIN usuarios ON alumnos.User_ID=usuarios.User_ID INNER JOIN puestos ON alumnos.Puesto_ID=puestos.Puesto_ID WHERE Empresa_ID =? ORDER BY alumnos.Puesto_ID";
	} else if ($Empresa_ID < 0) {
		$query = "SELECT empresas.Empresa_ID, empresas.Empresa_nombre, empresas.Empresa_producto, empresas.Empresa_estatus, asesores.Asesor_nombre, asesores.Asesor_ap_paterno FROM empresas LEFT JOIN escuelas ON escuelas.Escuela_ID = empresas.Escuela_ID LEFT JOIN asesores ON asesores.Asesor_ID = empresas.Asesor_ID WHERE empresas.Empresa_ID IN (SELECT Empresa_ID FROM licencia_empresa WHERE Escuela_ID=?) order by empresas.Empresa_nombre";
	} else {
		$query = "";
	}
	if($stmt = $con->prepare($query)){
		if ($Empresa_ID > 0) {
			$stmt->bind_param("i", $Empresa_ID);
			$stmt->execute();
			$stmt->bind_result($Alumno_subseccion, $Alumno_nombre, $Alumno_ap_paterno, $Alumno_ap_materno, $Alumno_estatus, $Alumno_ID, $Carrera_ID, $Alumno_turno, $Alumno_cumple, $Alumno_email, $Alumno_tel, $Alumno_cel, $Alumno_estatus, $Puesto_nombre, $Num_accesos, $UltimoAcceso);
			$tabla = "
				<table id='Datos-filtrados' class='table table-hover' style='width:100%'>
					<thead>
						<tr>
							<th class='align-middle'>Alumno</th>
							<th class='align-middle'>Puesto</th>
							<th class='align-middle'>Sesión</th>";
				if ($Sesion_ID == 0) {
					$tabla.= "	<th class='align-middle'>Carrera</th>
							<th class='align-middle'>Turno</th>
							<th class='align-middle'>Cumpleaños</th>
							<th class='align-middle'>Email</th>
							<th class='align-middle'>Teléfono</th>
							<th class='align-middle'>Celular</th>
							<th class='align-middle'>Accesos al portal</th>
							<th class='align-middle'>Último acceso al portal</th>
							<th class='align-middle'>Estatus</th>";
				} else if ($Sesion_ID == 1) {
					$tabla.= "	<th class='align-middle'>Subsección</th>
							<th class='align-middle'>Carta Compromiso</th>";
				} else if ($Sesion_ID == 2) {
					$tabla.= "	<th class='align-middle'>Subsección</th>
							<th class='align-middle'>Problemas a resolver</th>";
				} else if ($Sesion_ID == 3) {
					$tabla.= "	<th class='align-middle'>Subsección</th>";
				} else if ($Sesion_ID == 4) {
					$tabla.= "	<th class='align-middle'>Subsección</th>";
				} else if ($Sesion_ID == 5) {
					$tabla.= "	<th class='align-middle'>Subsección</th>
							<th class='align-middle'>Test de Perfil</th>
							<th class='align-middle'>CV</th>";
				}
				$tabla.= "</tr>
					</thead>
				<tbody>";
				while ($stmt->fetch()) {
					$Alumno_Sesion="No ha iniciado";
					$Seccion1 = "No ha iniciado";
					$Seccion2 = "No ha iniciado";
					$Seccion3 = "No ha iniciado";
					$Seccion4 = "No ha iniciado";
					$Seccion5 = "No ha iniciado";
					if($Alumno_subseccion==0){
					} else if($Alumno_subseccion<10){
						$Alumno_Sesion=0;
						if ($Alumno_subseccion==1) {
							$Seccion1 = "0.1 Bienvenida y Registro";
						}
					} else if($Alumno_subseccion<20){
						$Alumno_Sesion=1;
						if ($Alumno_subseccion==11) {
							$Seccion2 = "1.1 ¿Qué es Emprender?";
						} else if ($Alumno_subseccion==12) {
							$Seccion2 = "1.2 Tipos de Empresas";
						} else if ($Alumno_subseccion==13) {
							$Seccion2 = "1.3 Modelo Canvas";
						} else if ($Alumno_subseccion==14) {
							$Seccion2 = "1.4 Actividades";
						}
						$Seccion1 = "Sesión Concluida";
					} else if($Alumno_subseccion<30){
						$Alumno_Sesion=2;
						if ($Alumno_subseccion==21) {
							$Seccion3 = "2.1 Design Thinking";
						} else if ($Alumno_subseccion==22) {
							$Seccion3 = "2.2 Mapa de Empatía";
						} else if ($Alumno_subseccion==23) {
							$Seccion3 = "2.3 Mapa de trayectoria";
						} else if ($Alumno_subseccion==24) {
							$Seccion3 = "2.4 Ideación";
						} else if ($Alumno_subseccion==25) {
							$Seccion3 = "2.5 Actividades";
						}
						$Seccion1 = "Sesión 1 Concluida";
						$Seccion2 = "Sesión 2 Concluida";
					} else if($Alumno_subseccion<40){
						$Alumno_Sesion=3;
						if ($Alumno_subseccion==31) {
							$Seccion4 = "3.1 Prototipado";
						} else if ($Alumno_subseccion==32) {
							$Seccion4 = "3.2 Validación";
						} else if ($Alumno_subseccion==33) {
							$Seccion4 = "3.3 Actividades";
						}
						$Seccion1 = "Sesión Concluida";
						$Seccion2 = "Sesión 1 Concluida";
						$Seccion3 = "Sesión 2 Concluida";
					} else if($Alumno_subseccion<50){
						$Alumno_Sesion=4;
						if ($Alumno_subseccion==41) {
							$Seccion5 = "4.1 Áreas de una Empresa";
						} else if ($Alumno_subseccion==42) {
							$Seccion5 = "4.2 Detección de Habilidades";
						} else if ($Alumno_subseccion==43) {
							$Seccion5 = "4.3 Procesos de Selección";
						} else if ($Alumno_subseccion==44) {
							$Seccion5 = "4.4 Diseño Organizacional";
						} else if ($Alumno_subseccion==45) {
							$Seccion5 = "4.5 Actividades";
						}
						$Seccion1 = "Sesión Concluida";
						$Seccion2 = "Sesión 1 Concluida";
						$Seccion3 = "Sesión 2 Concluida";
						$Seccion4 = "Sesión 3 Concluida";
					/*} else if($Alumno_subseccion<60){
						$Alumno_Sesion=5;
						$Seccion1 = "Sesión Concluida";
						$Seccion2 = "Sesión Concluida";
						$Seccion3 = "Sesión Concluida";
						$Seccion4 = "Sesión Concluida";
						$Seccion5 = "Sesión Concluida";
					*/} else {
						$Alumno_Sesion="Urgente Revisar";
					}
					if($Alumno_turno==0){
						$Turno="N/D";
					} else if($Alumno_turno==1){
						$Turno="Matutino";
					} else if($Alumno_turno==2){
						$Turno="Vespertino";
					} else if($Alumno_turno==3){
						$Turno="Mixto";
					} else if($Alumno_turno==4){
						$Turno="No aplica";
					}
					$row = mysqli_fetch_row(mysqli_query($con2, "SELECT Carrera_nombre FROM carreras WHERE Carrera_ID=".$Carrera_ID));
					if ($row[0]>0) {
						$Carrera = $row[0];
					} else {
						$Carrera = "N/D";
					}
					if ($Alumno_cumple == "0000-00-00") {
						$Alumno_cumple = "N/D";
					}
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
						<td class='align-middle " . $bckgrnd_color . "'>" . $Puesto_nombre ."</td>
						<td class='align-middle text-center " . $bckgrnd_color . "'>" . $Alumno_Sesion ."</td>";
					if ($Sesion_ID == 0) {
						$tabla.= "	<td class='align-middle " . $bckgrnd_color . "'>" . $Carrera ."</td>
							<td class='align-middle " . $bckgrnd_color . "'>" . $Turno ."</td>
							<td class='align-middle " . $bckgrnd_color . "'>" . $Alumno_cumple ."</td>
							<td class='align-middle " . $bckgrnd_color . "'>" . $Alumno_email ."</td>
							<td class='align-middle " . $bckgrnd_color . "'>" . $Alumno_tel ."</td>
							<td class='align-middle " . $bckgrnd_color . "'>" . $Alumno_cel ."</td>
							<td class='align-middle text-center " . $bckgrnd_color . "'>" . $Num_accesos ."</td>
							<td class='align-middle text-nowrap " . $bckgrnd_color . "'>" . $UltimoAcceso ."</td>
							<td class='align-middle " . $bckgrnd_color . "'>" . $Estatus ."</td>";
					} else if ($Sesion_ID == 1) {
						$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/carta_compromiso/";
						if (is_file($target_dir . $Alumno_ID . '.jpg')) {
							$href = "href='../images/carta_compromiso/".$Alumno_ID.".jpg' download";
							$carta = "Si";
						} else {
							$href = "";
							$carta = "No";
						}
						$tabla.= "	<td class='align-middle " . $bckgrnd_color . "'>" . $Seccion1 . "</td>
							<td class='align-middle text-center " . $bckgrnd_color . "'><a " . $href . ">". $carta ."</a></td>";
					} else if ($Sesion_ID == 2) {
						$row2 = mysqli_fetch_row(mysqli_query($con2, "SELECT Alumno_ID FROM empresas_info_s1 WHERE Alumno_ID=".$Alumno_ID));
						$tarea_hecha = $row2[0];
						if ($tarea_hecha>0) {
							$problemas = "Realizado";
						} else {
							$problemas = "No realizado";
						}

						$tabla.= "	<td class='align-middle " . $bckgrnd_color . "'>" . $Seccion2 . "</td>";
						$tabla.= "	<td class='align-middle " . $bckgrnd_color . "'>" . $problemas . "</td>";
					} else if ($Sesion_ID == 3) {
						$tabla.= "	<td class='align-middle " . $bckgrnd_color . "'>" . $Seccion3 . "</td>";
					} else if ($Sesion_ID == 4) {
						$tabla.= "	<td class='align-middle " . $bckgrnd_color . "'>" . $Seccion4 . "</td>";
					} else if ($Sesion_ID == 5) {
						$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/cvs/";
						if (is_file($target_dir . "CV_" . $Alumno_ID . "_" . $Alumno_nombre . ".pdf")) {
							$href_cv = "href='../images/cvs/CV_" . $Alumno_ID . "_" . $Alumno_nombre . ".pdf' download";
							$cv = "Si";
						} else {
							$href_cv = "";
							$cv = "No";
						}
						$row11 = mysqli_fetch_row(mysqli_query($con2, "SELECT cadena FROM empresas_info_s4_3 WHERE Alumno_ID=".$Alumno_ID));
						if ($row11[0]!="") { $test = "Ingresado"; } else { $test = "Pendiente"; }
						$tabla.= "	<td class='align-middle " . $bckgrnd_color . "'>" . $Seccion5 . "</td>
								<td class='align-middle " . $bckgrnd_color . "'>" . $test . "</td>
								<td class='align-middle text-center " . $bckgrnd_color . "'><a " . $href_cv . ">". $cv ."</a></td>";
					/*} else if ($Sesion_ID == 5) {
						$row13 = mysqli_fetch_row(mysqli_query($con2, "SELECT financiamiento FROM empresas_info_s3_7 WHERE Empresa_ID =".$Empresa_ID));
						if ($row13[0]==1) {//Acciones
							$row14 = mysqli_query($con2, "SELECT Accion_estatus FROM accionistas WHERE Alumno_ID=".$Alumno_ID);
							$en_proceso = 0;
							$vendida_nopag = 0;
							$vendida_pag = 0;
							$extraviada = 0;
							$cancelada = 0;
							while ($row = mysqli_fetch_row($row14)) {
								if ($row[0] == 0) {
									$en_proceso++;
								} else if ($row[0] == 1) {
									$vendida_nopag++;
								} else if ($row[0] == 2) {
									$vendida_pag++;
								} else if ($row[0] == 3) {
									$extraviada++;
								} else if ($row[0] == 4) {
									$cancelada++;
								}
							}
							$resumen = "Hay " . $en_proceso . " Acciones en <strong>Proceso de venta</strong><br>
										Hay " . $vendida_nopag . " Acciones <strong>Vendidas no pagadas</strong><br>
										Hay " . $vendida_pag . " Acciones <strong>Vendidas pagadas</strong><br>
										Hay " . $extraviada . " Acciones <strong>Extraviadas / perdidas</strong><br>
										Hay " . $cancelada . " Acciones <strong>Canceladas</strong><br>";
						} else if ($row13[0]==2) {//Crowdfunding
							$row15 = mysqli_query($con2, "SELECT Donantes_donacion_inic, Donantes_estatus, Donantes_donacion_fin FROM donantes WHERE Alumno_ID=".$Alumno_ID);
							$donantes = 0;
							$donaciones_registradas = 0;
							$donaciones_recaudadas = 0;
							$canceladas = 0;
							while ($row = mysqli_fetch_row($row15)) {
								if ($row[1] == 1) {
									$donantes++;
									$donaciones_registradas+=$row[0];
									if ($row[2]>0) {
										$donaciones_recaudadas+=$row[2];
									}
								} else if ($row[1] == 2) {
									$canceladas++;
								} else if ($row[1] == 3) {
									$canceladas++;
								}
							}
							$resumen = "Hay <strong>" . $donantes . " Donantes</strong> asignados para seguimiento<br>
										Hay <strong>$ " . $donaciones_registradas . ".00 posibles por recaudar</strong> (registrados por donantes)<br>
										Hay <strong>$ " . $donaciones_recaudadas . ".00 ya recaudados</strong> (registrados por los colaboradores)<br>
										Hay <strong>" . $canceladas . " Donaciones canceladas</strong> o cuyos donantes están ilocalizables<br>";
						} else { $resumen = "N/D"; }
						$tabla.= "	<td class='align-middle " . $bckgrnd_color . "'>" . $Seccion5 . "</td>
								<td class='align-middle " . $bckgrnd_color . "'>" . $resumen . "</td>";
					*/}
					$tabla.= "</tr>";
				}

				$tabla.="</tbody>
					</table>";
				$stmt->close();

		} else if ($Empresa_ID < 0) {
			$stmt->bind_param("i", $Escuela_ID);
			$stmt->execute();
			$stmt->bind_result($Empresa_ID, $Empresa_nombre, $Empresa_producto, $Empresa_estatus, $Asesor_nombre, $Asesor_ap_paterno);
			$tabla = "
				<table id='Datos-filtrados' class='table table-hover nowrap' style='width:100%'>
					<thead>
						<tr>
							<th class='align-middle'>Empresa</th>
							<th class='align-middle'>Escuela</th>";
				if ($Sesion_ID == 0) {
					$tabla.= "	<th class='align-middle'>Integrantes activos</th>;
							<th class='align-middle'>Producto</th>
							<th class='align-middle'>Asesor</th>";
				} else if ($Sesion_ID == 1) {
					$tabla.= "	<th class='align-middle'>Integrantes activos</th>;
							<th class='align-middle'>Integrantes cancelados / suspendidos</th>";
				} else if ($Sesion_ID == 2) {
					$tabla.= "	<th class='align-middle'>Problemas a resolver</th>";
				} else if ($Sesion_ID == 3) {
					$tabla.= "	<th class='align-middle'>Mapa de Empatía</th>
							<th class='align-middle'>Definición</th>
							<th class='align-middle'>Ideación</th>
							<th class='align-middle'>Canvas. Bloque / Elementos</th>";
				} else if ($Sesion_ID == 4) {
					$tabla.= "	<th class='align-middle'>Prototipado</th>
							<th class='align-middle'>Validación</th>
							<th class='align-middle'>Canvas. Bloque / Elementos</th>";
				/*} else if ($Sesion_ID == 5) {
					$tabla.= "	<th class='align-middle'>Medio de Financiamiento</th>
							<th class='align-middle'>Accionistas / Donantes</th>
							<th class='align-middle'>Materias primas / Insumos</th>
							<th class='align-middle'>Procesos de Producción</th>
							<th class='align-middle'>Canales de Distribución</th>";
				*/}
				$tabla.= "</tr>
					</thead>
				 <tbody>";
				 while ($stmt->fetch()) {
					$row = mysqli_fetch_row(mysqli_query($con2, "SELECT COUNT(*) FROM alumnos WHERE Empresa_ID=".$Empresa_ID." AND Alumno_estatus<2"));
					$integrantes = $row[0];
					$row = mysqli_fetch_row(mysqli_query($con2, "SELECT COUNT(*) FROM alumnos WHERE Empresa_ID=".$Empresa_ID." AND Alumno_estatus>1"));
					$integrantes_cancelados = $row[0];

					$tabla.="<tr>
						<td class='align-middle'>" . $Empresa_nombre . "</td>
						<td class='align-middle'>" . $_SESSION["Escuela_nombre"] ."</td>";
					if ($Sesion_ID == 0) {
						$tabla.= "	<td class='text-center'>" . $integrantes ."</td>
							<td class='align-middle'>" . $Empresa_producto ."</td>
							<td class='align-middle'>" . $Asesor_nombre . " " . $Asesor_ap_paterno . "</td>";
					} else if ($Sesion_ID == 1) {
						$tabla.= "	<td class='text-center'>" . $integrantes ."</td>
							<td class='text-center'>" . $integrantes_cancelados . "</td>";
					} else if ($Sesion_ID == 2) {
						$row2 = mysqli_fetch_row(mysqli_query($con2, "SELECT COUNT(*) FROM empresas_info_s1 WHERE Empresa_ID=".$Empresa_ID));
						$tarea_hecha = $row2[0];
						$problemas = $tarea_hecha . " / " . $integrantes;
						$tabla.= "	<td class='align-middle'>" . $problemas . "</td>";
					} else if ($Sesion_ID == 3) {
						$row2 = mysqli_fetch_row(mysqli_query($con2, "SELECT segmentacion FROM empresas_info_s2_2 WHERE Empresa_ID=".$Empresa_ID));
						if ($row2[0]!="") { $mapa = "Ingresado"; } else { $mapa = "Pendiente"; }
						$row3 = mysqli_fetch_row(mysqli_query($con2, "SELECT usuario FROM empresas_info_s2_3 WHERE Empresa_ID=".$Empresa_ID));
						if ($row3[0]!="") { $definicion = "Ingresado"; } else { $definicion = "Pendiente"; }
						$row4 = mysqli_fetch_row(mysqli_query($con2, "SELECT idea1 FROM empresas_info_s2_4 WHERE Empresa_ID=".$Empresa_ID));
						if ($row4[0]!="") { $ideacion = "Ingresado"; } else { $ideacion = "Pendiente"; }
						$row5 = mysqli_query($con2, "SELECT bloque, COUNT(*) as postits FROM canvas WHERE Empresa_ID=".$Empresa_ID ." GROUP BY bloque");
						$canvas_2_5="";
						$bloque_3_num = 0;
						$bloque_5_num = 0;
						$bloque_10_num = 0;
						while ($fila = mysqli_fetch_array($row5, MYSQLI_ASSOC)){
							if ($fila["bloque"]==3) {
								$bloque_3_num = $fila["postits"];
							} else if ($fila["bloque"]==5) {
								$bloque_5_num = $fila["postits"];
							} else if ($fila["bloque"]==10) {
								$bloque_10_num = $fila["postits"];
							}
						}
						$canvas_2_5 .= "Problemas" ." / " . $bloque_3_num . "<br>";
						$canvas_2_5 .= "Propósitos" ." / " . $bloque_10_num . "<br>";
						$canvas_2_5 .= "Segmentos" ." / " . $bloque_5_num . "<br>";
						$tabla.= "	<td class='align-middle'>" . $mapa . "</td>
							<td class='align-middle'>" . $definicion . "</td>
							<td class='align-middle'>" . $ideacion . "</td>
							<td class='align-middle'>" . $canvas_2_5 . "</td>";
					} else if ($Sesion_ID == 4) {
						$row6 = mysqli_fetch_row(mysqli_query($con2, "SELECT ind_datos FROM empresas_info_s3_2 WHERE Empresa_ID=".$Empresa_ID));
						if ($row6[0]!="") { $prototipo = "Ingresado"; } else { $prototipo = "Pendiente"; }
						$row7 = mysqli_fetch_row(mysqli_query($con2, "SELECT COUNT(*) FROM empresas_info_s3_3 WHERE Empresa_ID=".$Empresa_ID));
						if ($row7[0]>0) { $validacion = "Ingresado"; } else { $validacion = "Pendiente"; }
						$row8 = mysqli_query($con2, "SELECT bloque, COUNT(*) as postits FROM canvas WHERE Empresa_ID=".$Empresa_ID ." GROUP BY bloque");
						$canvas_3_3="";
						$bloque_3_num = 0;
						$bloque_5_num = 0;
						$bloque_10_num = 0;
						$bloque_11_num = 0;
						while ($fila = mysqli_fetch_array($row8, MYSQLI_ASSOC)){
							if ($fila["bloque"]==3) {
								$bloque_3_num = $fila["postits"];
							} else if ($fila["bloque"]==5) {
								$bloque_5_num = $fila["postits"];
							} else if ($fila["bloque"]==10) {
								$bloque_10_num = $fila["postits"];
							} else if ($fila["bloque"]==11) {
								$bloque_11_num = $fila["postits"];
							}
						}
						$canvas_3_3 .= "Problemas" ." / " . $bloque_3_num . "<br>";
						$canvas_3_3 .= "Propósitos" ." / " . $bloque_10_num . "<br>";
						$canvas_3_3 .= "Segmentos" ." / " . $bloque_5_num . "<br>";
						$canvas_3_3 .= "Prop. Valor" ." / " . $bloque_11_num . "<br>";
						$tabla.= "	<td class='align-middle'>" . $prototipo . "</td>
							<td class='align-middle'>" . $validacion . "</td>
							<td class='align-middle'>" . $canvas_3_3 . "</td>";
						/*$row13 = mysqli_fetch_row(mysqli_query($con2, "SELECT financiamiento, micrositio FROM empresas_info_s3_7 WHERE Empresa_ID=".$Empresa_ID));
						if ($row13[0]==1) {
							$financiamiento = "Acciones";
							$row14 = mysqli_query($con2, "SELECT Accion_estatus FROM accionistas WHERE Empresa_ID=".$Empresa_ID);
							$en_proceso = 0;
							$vendida_nopag = 0;
							$vendida_pag = 0;
							$extraviada = 0;
							$cancelada = 0;
							while ($row = mysqli_fetch_row($row14)) {
								if ($row[0] == 0) {
									$en_proceso++;
								} else if ($row[0] == 1) {
									$vendida_nopag++;
								} else if ($row[0] == 2) {
									$vendida_pag++;
								} else if ($row[0] == 3) {
									$extraviada++;
								} else if ($row[0] == 4) {
									$cancelada++;
								}
							}
							$resumen = "Hay " . $en_proceso . " Acciones en <strong>Proceso de venta</strong><br>
										Hay " . $vendida_nopag . " Acciones <strong>Vendidas no pagadas</strong><br>
										Hay " . $vendida_pag . " Acciones <strong>Vendidas pagadas</strong><br>
										Hay " . $extraviada . " Acciones <strong>Extraviadas / perdidas</strong><br>
										Hay " . $cancelada . " Acciones <strong>Canceladas</strong><br>";
						} else if ($row13[0]==2) {
							$financiamiento = "Crowdfunding";
							$row15 = mysqli_query($con2, "SELECT Donantes_donacion_inic, Donantes_estatus, Donantes_donacion_fin FROM donantes WHERE Empresa_ID=".$Empresa_ID);
							$donantes = 0;
							$donaciones_registradas = 0;
							$donaciones_recaudadas = 0;
							$canceladas = 0;
							while ($row = mysqli_fetch_row($row15)) {
								if ($row[1] == 1) {
									$donantes++;
									$donaciones_registradas+=$row[0];
									if ($row[2]>0) {
										$donaciones_recaudadas+=$row[2];
									}
								} else if ($row[1] == 2) {
									$canceladas++;
								} else if ($row[1] == 3) {
									$canceladas++;
								}
							}
							$resumen = "Hay <strong>" . $donantes . " Donantes</strong> potenciales registrados o en proceso<br>
										Hay <strong>$ " . $donaciones_registradas . ".00 posibles por recaudar</strong> (registrados por donantes)<br>
										Hay <strong>$ " . $donaciones_recaudadas . ".00 ya recaudados</strong> (registrados por los colaboradores)<br>
										Hay <strong>" . $canceladas . " Donaciones canceladas</strong> o cuyos donantes están ilocalizables<br>";
						} else {  $financiamiento = "N/D"; $resumen = "N/D"; }
						$row16 = mysqli_fetch_row(mysqli_query($con2, "SELECT COUNT(*) FROM empresas_info_s4_4 WHERE Empresa_ID=".$Empresa_ID));
						if ($row16[0]>0) { $insumos = "Ingresado"; } else { $insumos = "Pendiente"; }
						$row17 = mysqli_fetch_row(mysqli_query($con2, "SELECT COUNT(*) FROM empresas_info_s4_5 WHERE Empresa_ID=".$Empresa_ID));
						if ($row17[0]>0) { $procesos = "Ingresado"; } else { $procesos = "Pendiente"; }
						$row18 = mysqli_fetch_row(mysqli_query($con2, "SELECT COUNT(*) FROM empresas_info_s4_6 WHERE Empresa_ID=".$Empresa_ID));
						if ($row18[0]>0) { $canales = "Ingresado"; } else { $canales = "Pendiente"; }
						$tabla.= "	<td class='align-middle'>" . $financiamiento . "</td>
								<td class='align-middle'>" . $resumen . "</td>
								<td class='align-middle'>" . $insumos . "</td>
								<td class='align-middle'>" . $procesos . "</td>
								<td class='align-middle'>" . $canales . "</td>";
					*/}
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