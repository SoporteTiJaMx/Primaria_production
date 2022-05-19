<?php
	include_once('../../scripts/conexion.php');
	include_once('../../scripts/conexion2.php');
	include_once('../../scripts/funciones.php');
	//session_start();

	$Empresa_ID=$_POST['Empresa_ID'];
	$Sesion_ID=$_POST['Sesion_ID'];
	$Escuela_ID=$_SESSION['Escuela_ID'];
	if ($Empresa_ID > 0) {
		$query = "SELECT alumnos.Alumno_subseccion, alumnos.Alumno_nombre, alumnos.Alumno_ap_paterno, alumnos.Alumno_ap_materno, alumnos.Alumno_estatus, alumnos.Alumno_ID, alumnos.Alumno_curp, alumnos.Carrera_ID, alumnos.Alumno_turno, alumnos.Alumno_cumple, alumnos.Alumno_email, alumnos.Alumno_tel, alumnos.Alumno_cel, alumnos.Alumno_estatus, puestos.Puesto_nombre FROM alumnos INNER JOIN puestos ON alumnos.Puesto_ID=puestos.Puesto_ID WHERE Empresa_ID =? ORDER BY alumnos.Puesto_ID";
	} else if ($Empresa_ID < 0) {
		$query = "SELECT empresas.Empresa_ID, empresas.Empresa_nombre, empresas.Empresa_producto, empresas.Empresa_estatus, asesores.Asesor_nombre, asesores.Asesor_ap_paterno FROM empresas LEFT JOIN escuelas ON escuelas.Escuela_ID = empresas.Escuela_ID LEFT JOIN asesores ON asesores.Asesor_ID = empresas.Asesor_ID WHERE empresas.Empresa_ID IN (SELECT Empresa_ID FROM licencia_empresa WHERE Escuela_ID=?) order by empresas.Empresa_nombre";
	}
	if($stmt = $con->prepare($query)){
		if ($Empresa_ID > 0) {
			$stmt->bind_param("i", $Empresa_ID);
			$stmt->execute();
			$stmt->bind_result($Alumno_subseccion, $Alumno_nombre, $Alumno_ap_paterno, $Alumno_ap_materno, $Alumno_estatus, $Alumno_ID, $Alumno_curp, $Carrera_ID, $Alumno_turno, $Alumno_cumple, $Alumno_email, $Alumno_tel, $Alumno_cel, $Alumno_estatus, $Puesto_nombre);
			$tabla = "
				<table id='Datos-filtrados' class='table table-hover nowrap' style='width:100%'>
					<thead>
						<tr>
							<th class='align-middle'>Alumno</th>
							<th class='align-middle'>Puesto</th>
							<th class='align-middle'>Sesión</th>";
				if ($Sesion_ID == 0) {
					$tabla.= "	<th class='align-middle'>CURP</th>
							<th class='align-middle'>Carrera</th>
							<th class='align-middle'>Turno</th>
							<th class='align-middle'>Cumpleaños</th>
							<th class='align-middle'>Email</th>
							<th class='align-middle'>Teléfono</th>
							<th class='align-middle'>Celular</th>
							<th class='align-middle'>Estatus</th>";
				} else if ($Sesion_ID == 1) {
					$tabla.= "	<th class='align-middle'>Subsección</th>
							<th class='align-middle'>Carta Compromiso</th>";
				} else if ($Sesion_ID == 2) {
					$tabla.= "	<th class='align-middle'>Subsección</th>";
				} else if ($Sesion_ID == 3) {
					$tabla.= "	<th class='align-middle'>Subsección</th>";
				} else if ($Sesion_ID == 4) {
					$tabla.= "	<th class='align-middle'>Subsección</th>
							<th class='align-middle'>CV</th>
							<th class='align-middle'>Test de Perfil</th>
							<th class='align-middle'>Medio de Financiamiento</th>";
				} else if ($Sesion_ID == 5) {
					$tabla.= "	<th class='align-middle'>Subsección</th>
							<th class='align-middle'>Accionistas / Donantes</th>";
				}
				$tabla.= "</tr>
					</thead>
				<tbody>";
				while ($stmt->fetch()) {
					if($Alumno_subseccion==0){
						$Alumno_Sesion="No ha iniciado";
						$Seccion1 = "No ha iniciado";
						$Seccion2 = "No ha iniciado";
						$Seccion3 = "No ha iniciado";
						$Seccion4 = "No ha iniciado";
						$Seccion5 = "No ha iniciado";
					} else if($Alumno_subseccion<10){
						$Alumno_Sesion=0;
						if ($Alumno_subseccion==1) {
							$Seccion1 = "0.1 Bienvenida - Integrantes";
						}
					} else if($Alumno_subseccion<20){
						$Alumno_Sesion=1;
						if ($Alumno_subseccion==11) {
							$Seccion2 = "1.1 Presentaciones";
						} else if ($Alumno_subseccion==12) {
							$Seccion2 = "1.2 Tipos de Empresas";
						} else if ($Alumno_subseccion==13) {
							$Seccion2 = "1.3 Capitalización";
						} else if ($Alumno_subseccion==14) {
							$Seccion2 = "1.4 Modelo de Negocios";
						} else if ($Alumno_subseccion==15) {
							$Seccion2 = "1.5 Posibles problemas a resolver";
						}
						$Seccion1 = "Sesión Concluida";
					} else if($Alumno_subseccion<30){
						$Alumno_Sesion=2;
						if ($Alumno_subseccion==21) {
							$Seccion3 = "2.1 Design Thinking";
						} else if ($Alumno_subseccion==22) {
							$Seccion3 = "2.2 Mapa de Empatía";
						} else if ($Alumno_subseccion==23) {
							$Seccion3 = "2.3 Definición";
						} else if ($Alumno_subseccion==24) {
							$Seccion3 = "2.4 Ideación";
						} else if ($Alumno_subseccion==25) {
							$Seccion3 = "2.5 Prototipado";
						} else if ($Alumno_subseccion==26) {
							$Seccion3 = "2.6 Encuesta de Mercado";
						} else if ($Alumno_subseccion==27) {
							$Seccion3 = "2.7 Validación";
						} else if ($Alumno_subseccion==28) {
							$Seccion3 = "2.8 Mi producto";
						}
						$Seccion1 = "Sesión Concluida";
						$Seccion2 = "Sesión Concluida";
					} else if($Alumno_subseccion<40){
						$Alumno_Sesion=3;
						if ($Alumno_subseccion==31) {
							$Seccion4 = "3.1 Perfil de la Empresa";
						} else if ($Alumno_subseccion==32) {
							$Seccion4 = "3.2 Areas de la Empresa";
						} else if ($Alumno_subseccion==33) {
							$Seccion4 = "3.3 Detección de Habilidades";
						} else if ($Alumno_subseccion==34) {
							$Seccion4 = "3.4 Diseño Organizacional";
						} else if ($Alumno_subseccion==35) {
							$Seccion4 = "3.5 Gestión de la Empresa";
						} else if ($Alumno_subseccion==36) {
							$Seccion4 = "3.6 Financiando mi Empresa";
						}
						$Seccion1 = "Sesión Concluida";
						$Seccion2 = "Sesión Concluida";
						$Seccion3 = "Sesión Concluida";
					} else if($Alumno_subseccion<50){
						$Alumno_Sesion=4;
						if ($Alumno_subseccion==41) {
							$Seccion5 = "4.1 Registro de Accionistas / Donantes";
						} else if ($Alumno_subseccion==42) {
							$Seccion5 = "4.2 Factibilidad Técnica";
						} else if ($Alumno_subseccion==43) {
							$Seccion5 = "4.3 Materias primas o Insumos";
						} else if ($Alumno_subseccion==44) {
							$Seccion5 = "4.4 Procesos de Producción";
						} else if ($Alumno_subseccion==45) {
							$Seccion5 = "4.5 Canales de Distribución";
						}
						$Seccion1 = "Sesión Concluida";
						$Seccion2 = "Sesión Concluida";
						$Seccion3 = "Sesión Concluida";
						$Seccion4 = "Sesión Concluida";
					} else if($Alumno_subseccion<60){
						$Alumno_Sesion=5;
						$Seccion1 = "Sesión Concluida";
						$Seccion2 = "Sesión Concluida";
						$Seccion3 = "Sesión Concluida";
						$Seccion4 = "Sesión Concluida";
						$Seccion5 = "Sesión Concluida";
					} else {
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
						<td class='align-middle " . $bckgrnd_color . "'>" . $Alumno_nombre . " " . $Alumno_ap_paterno . " " . $Alumno_ap_materno . "</td>
						<td class='align-middle " . $bckgrnd_color . "'>" . $Puesto_nombre ."</td>
						<td class='align-middle text-center " . $bckgrnd_color . "'>" . $Alumno_Sesion ."</td>";
				if ($Sesion_ID == 0) {
					$tabla.= "	<td class='align-middle " . $bckgrnd_color . "'>" . $Alumno_curp ."</td>
						<td class='align-middle " . $bckgrnd_color . "'>" . $Carrera ."</td>
						<td class='align-middle " . $bckgrnd_color . "'>" . $Turno ."</td>
						<td class='align-middle " . $bckgrnd_color . "'>" . $Alumno_cumple ."</td>
						<td class='align-middle " . $bckgrnd_color . "'>" . $Alumno_email ."</td>
						<td class='align-middle " . $bckgrnd_color . "'>" . $Alumno_tel ."</td>
						<td class='align-middle " . $bckgrnd_color . "'>" . $Alumno_cel ."</td>
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
					$tabla.= "	<td class='align-middle " . $bckgrnd_color . "'>" . $Seccion2 . "</td>";
				} else if ($Sesion_ID == 3) {
					$tabla.= "	<td class='align-middle " . $bckgrnd_color . "'>" . $Seccion3 . "</td>";
				} else if ($Sesion_ID == 4) {
					$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/cvs/";
					if (is_file($target_dir . "CV_" . $Alumno_ID . "_" . $Alumno_nombre . ".pdf")) {
						$href_cv = "href='../images/cvs/CV_" . $Alumno_ID . "_" . $Alumno_nombre . ".pdf' download";
						$cv = "Si";
					} else {
						$href_cv = "";
						$cv = "No";
					}
					$row11 = mysqli_fetch_row(mysqli_query($con2, "SELECT cadena FROM empresas_info_s3_4 WHERE Alumno_ID=".$Alumno_ID));
					if ($row11[0]!="") { $test = "Ingresado"; } else { $test = "Pendiente"; }
					$row13 = mysqli_fetch_row(mysqli_query($con2, "SELECT financiamiento FROM empresas_info_s3_7 WHERE Empresa_ID=".$Empresa_ID));
					if ($row13[0]==1) { $financiamiento = "Acciones"; } else if ($row13[0]==2) { $financiamiento = "Crowdfunding"; } else {  $financiamiento = "N/D"; }
					$tabla.= "	<td class='align-middle " . $bckgrnd_color . "'>" . $Seccion4 . "</td>
							<td class='align-middle text-center " . $bckgrnd_color . "'><a " . $href_cv . ">". $cv ."</a></td>
							<td class='align-middle " . $bckgrnd_color . "'>" . $test . "</td>
							<td class='align-middle " . $bckgrnd_color . "'>" . $financiamiento . "</td>";
				} else if ($Sesion_ID == 5) {
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
				}
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
							<th class='align-middle'>Prototipado</th>
							<th class='align-middle'>Encuesta de Mercado</th>
							<th class='align-middle'>Validación</th>
							<th class='align-middle'>Mi producto</th>";
				} else if ($Sesion_ID == 4) {
					$tabla.= "	<th class='align-middle'>Perfil de Empresa</th>
							<th class='align-middle'>Acta Constitutiva</th>
							<th class='align-middle'>Medio de Financiamiento</th>
							<th class='align-middle'>Micrositio</th>";
				} else if ($Sesion_ID == 5) {
					$tabla.= "	<th class='align-middle'>Medio de Financiamiento</th>
							<th class='align-middle'>Accionistas / Donantes</th>
							<th class='align-middle'>Materias primas / Insumos</th>
							<th class='align-middle'>Procesos de Producción</th>
							<th class='align-middle'>Canales de Distribución</th>";
				}
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
					$row2 = mysqli_fetch_row(mysqli_query($con2, "SELECT problemas FROM empresas_info_s1 WHERE Empresa_ID=".$Empresa_ID));
					if ($row2[0]!="") {
						$problemas = "Ingresado";
					} else {
						$problemas = "Pendiente";
					}
					$tabla.= "	<td class='align-middle'>" . $problemas . "</td>";
				} else if ($Sesion_ID == 3) {
					$row3 = mysqli_fetch_row(mysqli_query($con2, "SELECT segmentacion FROM empresas_info_s2_3 WHERE Empresa_ID=".$Empresa_ID));
					if ($row3[0]!="") { $mapa = "Ingresado"; } else { $mapa = "Pendiente"; }
					$row4 = mysqli_fetch_row(mysqli_query($con2, "SELECT usuario FROM empresas_info_s2_4 WHERE Empresa_ID=".$Empresa_ID));
					if ($row4[0]!="") { $definicion = "Ingresado"; } else { $definicion = "Pendiente"; }
					$row5 = mysqli_fetch_row(mysqli_query($con2, "SELECT idea1 FROM empresas_info_s2_5 WHERE Empresa_ID=".$Empresa_ID));
					if ($row5[0]!="") { $ideacion = "Ingresado"; } else { $ideacion = "Pendiente"; }
					$row6 = mysqli_fetch_row(mysqli_query($con2, "SELECT ind_datos FROM empresas_info_s2_6 WHERE Empresa_ID=".$Empresa_ID));
					if ($row6[0]>0) { $prototipado = "Ingresado"; } else { $prototipado = "Pendiente"; }
					$row7 = mysqli_fetch_row(mysqli_query($con2, "SELECT COUNT(*) FROM empresas_info_s2_7 WHERE Empresa_ID=".$Empresa_ID));
					if ($row7[0]>0) { $encuesta = "Ingresado"; } else { $encuesta = "Pendiente"; }
					$row8 = mysqli_fetch_row(mysqli_query($con2, "SELECT COUNT(*) FROM empresas_info_s2_8 WHERE Empresa_ID=".$Empresa_ID));
					if ($row8[0]>0) { $validacion = "Ingresado"; } else { $validacion = "Pendiente"; }
					$row9 = mysqli_fetch_row(mysqli_query($con2, "SELECT producto FROM empresas_info_s2_9 WHERE Empresa_ID=".$Empresa_ID));
					if ($row9[0]!="") { $producto = "Ingresado"; } else { $producto = "Pendiente"; }
					$tabla.= "	<td class='align-middle'>" . $mapa . "</td>
						<td class='align-middle'>" . $definicion . "</td>
						<td class='align-middle'>" . $ideacion . "</td>
						<td class='align-middle'>" . $prototipado . "</td>
						<td class='align-middle'>" . $encuesta . "</td>
						<td class='align-middle'>" . $validacion . "</td>
						<td class='align-middle'>" . $producto . "</td>";
				} else if ($Sesion_ID == 4) {
					$row10 = mysqli_fetch_row(mysqli_query($con2, "SELECT nombre_empresa FROM empresas_info_s3_2 WHERE Empresa_ID=".$Empresa_ID));
					if ($row10[0]!="") { $perfil = "Ingresado"; } else { $perfil = "Pendiente"; }
					$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/actas/";
					if (is_file($target_dir . "Acta_empresa_" . $Empresa_nombre . ".pdf")) {
						$href_acta = "href='../images/actas/Acta_empresa_" . $Empresa_nombre . ".pdf' download";
						$acta = "Si";
					} else {
						$href_acta = "";
						$acta = "No";
					}
					$row13 = mysqli_fetch_row(mysqli_query($con2, "SELECT financiamiento, micrositio FROM empresas_info_s3_7 WHERE Empresa_ID=".$Empresa_ID));
					if ($row13[0]==1) { $financiamiento = "Acciones"; $micrositio = "N/A"; } else if ($row13[0]==2) { $financiamiento = "Crowdfunding"; $micrositio = "<a href='../web.php?id=" . $row13[1] . "' target='_blank'>https://emprendedoresyempresarios.org.mx/web?id=" . $row13[1] . "</a>"; } else {  $financiamiento = "N/D"; $micrositio = "N/D"; }
					$tabla.= "	<td class='align-middle'>" . $perfil . "</td>
							<td class='align-middle text-center'><a " . $href_acta . ">". $acta ."</a></td>
							<td class='align-middle'>" . $financiamiento . "</td>
							<td class='align-middle'>" . $micrositio . "</td>";
				} else if ($Sesion_ID == 5) {
					$row13 = mysqli_fetch_row(mysqli_query($con2, "SELECT financiamiento, micrositio FROM empresas_info_s3_7 WHERE Empresa_ID=".$Empresa_ID));
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
				}
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
?>