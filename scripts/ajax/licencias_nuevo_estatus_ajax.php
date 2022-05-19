<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$Licencia_ID_modificada = $_POST['Licencia_ID_modificada'];
	$Licencia_nombre = $_POST['Licencia_nombre'];
	$Licencia_duracion = $_POST['Licencia_duracion'];
	$Licencia_inicio = $_POST['Licencia_inicio'];
	$nuevo_estatus = $_POST['nuevo_estatus'];
	$habilitarLicencia = $_POST['habilitarLicencia'];
	if ($nuevo_estatus == 1) {
		$estatus_text = "Activa";
	} else if ($nuevo_estatus == 2) {
		$estatus_text = "Inactiva";
	}
	if ($estatus_text == "Activa") {
		if ($Licencia_inicio == "0000-00-00") {
			date_default_timezone_set("America/Mexico_City");
			$fecha_inicio = date('Y-m-j');
		} else {
			$fecha_inicio = $Licencia_inicio;
		}
		$fecha_fin = strtotime ('+' . $Licencia_duracion . ' month', strtotime ($fecha_inicio) );
		$fecha_fin = date ( 'Y-m-j' , $fecha_fin );
	} else {
		$fecha_inicio = NULL;
		$fecha_fin = NULL;
	}

	$query = "UPDATE licencias SET Licencia_nombre=?, Licencia_estatus=?, Licencia_inicio=?, Licencia_fin=? WHERE Licencia_ID=?";
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("ssssi", $Licencia_nombre, $estatus_text, $fecha_inicio, $fecha_fin, $Licencia_ID_modificada);
		$stmt->execute();
		$stmt->close();
		if ($habilitarLicencia && $estatus_text == "Activa") {
			$_SESSION["licencia_activa"] = $Licencia_ID_modificada;
			$_SESSION["nombre_licencia"] = $Licencia_nombre;
			$_SESSION["inicio_licencia"] = $fecha_inicio;
			$datosVariables = mysqli_fetch_row(mysqli_query($con, "SELECT valor_accion FROM variables WHERE Licencia_ID=$Licencia_ID_modificada"));
			if ($datosVariables[0]>0) {
				$_SESSION["valor_accion"] = $datosVariables[0];
			} else {
				$_SESSION["valor_accion"] = "";
			}
			$datos_sesiones = mysqli_query($con, "SELECT * FROM eventos WHERE Licencia_ID=" . $Licencia_ID_modificada);
			while ($row_sesiones = mysqli_fetch_array($datos_sesiones, MYSQLI_ASSOC)) {
				if ($row_sesiones["Sesiones_ID"] == 1) {$_SESSION["Sesion_1_inicio"] = $row_sesiones["Eventos_inicio"]; $_SESSION["Sesion_1_fin"] = $row_sesiones["Eventos_fin"]; }
				if ($row_sesiones["Sesiones_ID"] == 2) {$_SESSION["Sesion_2_inicio"] = $row_sesiones["Eventos_inicio"]; $_SESSION["Sesion_2_fin"] = $row_sesiones["Eventos_fin"]; }
				if ($row_sesiones["Sesiones_ID"] == 3) {$_SESSION["Sesion_3_inicio"] = $row_sesiones["Eventos_inicio"]; $_SESSION["Sesion_3_fin"] = $row_sesiones["Eventos_fin"]; }
				if ($row_sesiones["Sesiones_ID"] == 4) {$_SESSION["Sesion_4_inicio"] = $row_sesiones["Eventos_inicio"]; $_SESSION["Sesion_4_fin"] = $row_sesiones["Eventos_fin"]; }
				if ($row_sesiones["Sesiones_ID"] == 5) {$_SESSION["Sesion_5_inicio"] = $row_sesiones["Eventos_inicio"]; $_SESSION["Sesion_5_fin"] = $row_sesiones["Eventos_fin"]; }
				if ($row_sesiones["Sesiones_ID"] == 6) {$_SESSION["Sesion_6_inicio"] = $row_sesiones["Eventos_inicio"]; $_SESSION["Sesion_6_fin"] = $row_sesiones["Eventos_fin"]; }
				if ($row_sesiones["Sesiones_ID"] == 7) {$_SESSION["Sesion_7_inicio"] = $row_sesiones["Eventos_inicio"]; $_SESSION["Sesion_7_fin"] = $row_sesiones["Eventos_fin"]; }
				if ($row_sesiones["Sesiones_ID"] == 8) {$_SESSION["Sesion_8_inicio"] = $row_sesiones["Eventos_inicio"]; $_SESSION["Sesion_8_fin"] = $row_sesiones["Eventos_fin"]; }
				if ($row_sesiones["Sesiones_ID"] == 9) {$_SESSION["Sesion_9_inicio"] = $row_sesiones["Eventos_inicio"]; $_SESSION["Sesion_9_fin"] = $row_sesiones["Eventos_fin"]; }
				if ($row_sesiones["Sesiones_ID"] == 10) {$_SESSION["Sesion_10_inicio"] = $row_sesiones["Eventos_inicio"]; $_SESSION["Sesion_10_fin"] = $row_sesiones["Eventos_fin"]; }
				if ($row_sesiones["Sesiones_ID"] == 11) {$_SESSION["Sesion_11_inicio"] = $row_sesiones["Eventos_inicio"]; $_SESSION["Sesion_11_fin"] = $row_sesiones["Eventos_fin"]; }
				if ($row_sesiones["Sesiones_ID"] == 12) {$_SESSION["Sesion_12_inicio"] = $row_sesiones["Eventos_inicio"]; $_SESSION["Sesion_12_fin"] = $row_sesiones["Eventos_fin"]; }
				if ($row_sesiones["Sesiones_ID"] == 13) {$_SESSION["Sesion_13_inicio"] = $row_sesiones["Eventos_inicio"]; $_SESSION["Sesion_13_fin"] = $row_sesiones["Eventos_fin"]; }
				if ($row_sesiones["Sesiones_ID"] == 14) {$_SESSION["Sesion_14_inicio"] = $row_sesiones["Eventos_inicio"]; $_SESSION["Sesion_14_fin"] = $row_sesiones["Eventos_fin"]; }
				/*
				if ($row_sesiones["Sesiones_ID"] == 5) {$_SESSION["Sesion_5_inicio"] = $row_sesiones["Eventos_inicio"]; $_SESSION["Sesion_5_fin"] = $row_sesiones["Eventos_fin"]; }
				if ($row_sesiones["Sesiones_ID"] == 100) {$_SESSION["Sesion_100_inicio"] = $row_sesiones["Eventos_inicio"]; $_SESSION["Sesion_100_fin"] = $row_sesiones["Eventos_fin"]; }*/
			}

			$datosS1 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s1 LEFT JOIN empresas ON empresas_info_s1.Empresa_ID = empresas.Empresa_ID LEFT JOIN licencia_empresa ON empresas_info_s1.Empresa_ID = licencia_empresa.Empresa_ID WHERE empresas_info_s1.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE licencia_empresa.Licencia_ID=$Licencia_ID_modificada AND empresas.Empresa_estatus='Activa') AND (empresas_info_s1.act_alumno=1 OR empresas_info_s1.act_asesor=1)"));
			if ($datosS1[0]>0) {
				$_SESSION["sesion1"] = 1;
				$_SESSION["sesion1_5"] = 1;
			}
			$datosS2_2 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s2_2 LEFT JOIN empresas ON empresas_info_s2_2.Empresa_ID = empresas.Empresa_ID LEFT JOIN licencia_empresa ON empresas_info_s2_2.Empresa_ID = licencia_empresa.Empresa_ID WHERE empresas_info_s2_2.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE licencia_empresa.Licencia_ID=$Licencia_ID_modificada AND empresas.Empresa_estatus='Activa') AND (empresas_info_s2_2.act_alumno=1 OR empresas_info_s2_2.act_asesor=1)"));
			if ($datosS2_2[0]>0) {
				$_SESSION["sesion2_2"] = 1;
				$_SESSION["sesion2"] = 1;
			}
			$datosS2_3 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s2_3 LEFT JOIN empresas ON empresas_info_s2_3.Empresa_ID = empresas.Empresa_ID LEFT JOIN licencia_empresa ON empresas_info_s2_3.Empresa_ID = licencia_empresa.Empresa_ID WHERE empresas_info_s2_3.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE licencia_empresa.Licencia_ID=$Licencia_ID_modificada AND empresas.Empresa_estatus='Activa') AND (empresas_info_s2_3.act_alumno=1 OR empresas_info_s2_3.act_asesor=1)"));
			if ($datosS2_3[0]>0) {
				$_SESSION["sesion2_3"] = 1;
				$_SESSION["sesion2"] = 1;
			}
			$datosS2_4 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s2_4 LEFT JOIN empresas ON empresas_info_s2_4.Empresa_ID = empresas.Empresa_ID LEFT JOIN licencia_empresa ON empresas_info_s2_4.Empresa_ID = licencia_empresa.Empresa_ID WHERE empresas_info_s2_4.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE licencia_empresa.Licencia_ID=$Licencia_ID_modificada AND empresas.Empresa_estatus='Activa') AND (empresas_info_s2_4.act_alumno=1 OR empresas_info_s2_4.act_asesor=1)"));
			if ($datosS2_4[0]>0) {
				$_SESSION["sesion2_4"] = 1;
				$_SESSION["sesion2"] = 1;
			}
			$datosS3_2 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s3_2 LEFT JOIN empresas ON empresas_info_s3_2.Empresa_ID = empresas.Empresa_ID LEFT JOIN licencia_empresa ON empresas_info_s3_2.Empresa_ID = licencia_empresa.Empresa_ID WHERE empresas_info_s3_2.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE licencia_empresa.Licencia_ID=$Licencia_ID_modificada AND empresas.Empresa_estatus='Activa') AND (empresas_info_s3_2.act_alumno=1 OR empresas_info_s3_2.act_asesor=1)"));
			if ($datosS3_2[0]>0) {
				$_SESSION["sesion3_2"] = 1;
				$_SESSION["sesion3"] = 1;
			}
			$datosS3_3 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s3_3 LEFT JOIN empresas ON empresas_info_s3_3.Empresa_ID = empresas.Empresa_ID LEFT JOIN licencia_empresa ON empresas_info_s3_3.Empresa_ID = licencia_empresa.Empresa_ID WHERE empresas_info_s3_3.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE licencia_empresa.Licencia_ID=$Licencia_ID_modificada AND empresas.Empresa_estatus='Activa') AND (empresas_info_s3_3.act_alumno=1 OR empresas_info_s3_3.act_asesor=1)"));
			if ($datosS3_3[0]>0) {
				$_SESSION["sesion3_3"] = 1;
				$_SESSION["sesion3"] = 1;
			}/*
			$datosS2_8 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s2_8 LEFT JOIN empresas ON empresas_info_s2_8.Empresa_ID = empresas.Empresa_ID LEFT JOIN licencia_empresa ON empresas_info_s2_8.Empresa_ID = licencia_empresa.Empresa_ID WHERE empresas_info_s2_8.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE licencia_empresa.Licencia_ID=$Licencia_ID_modificada AND empresas.Empresa_estatus='Activa') AND (empresas_info_s2_8.act_alumno=1 OR empresas_info_s2_8.act_asesor=1)"));
			if ($datosS2_8[0]>0) {
				$_SESSION["sesion2_8"] = 1;
				$_SESSION["sesion2"] = 1;
			}
			$datosS2_9 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s2_9 LEFT JOIN empresas ON empresas_info_s2_9.Empresa_ID = empresas.Empresa_ID LEFT JOIN licencia_empresa ON empresas_info_s2_9.Empresa_ID = licencia_empresa.Empresa_ID WHERE empresas_info_s2_9.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE licencia_empresa.Licencia_ID=$Licencia_ID_modificada AND empresas.Empresa_estatus='Activa') AND (empresas_info_s2_9.act_alumno=1 OR empresas_info_s2_9.act_asesor=1)"));
			if ($datosS2_9[0]>0) {
				$_SESSION["sesion2_9"] = 1;
				$_SESSION["sesion2"] = 1;
			}
			$datosS3_2 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s3_2 LEFT JOIN empresas ON empresas_info_s3_2.Empresa_ID = empresas.Empresa_ID LEFT JOIN licencia_empresa ON empresas_info_s3_2.Empresa_ID = licencia_empresa.Empresa_ID WHERE empresas_info_s3_2.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE licencia_empresa.Licencia_ID=$Licencia_ID_modificada AND empresas.Empresa_estatus='Activa') AND (empresas_info_s3_2.act_alumno=1 OR empresas_info_s3_2.act_asesor=1)"));
			if ($datosS3_2[0]>0) {
				$_SESSION["sesion3_2"] = 1;
				$_SESSION["sesion3"] = 1;
			}
			$datosS3_6 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s3_6 LEFT JOIN empresas ON empresas_info_s3_6.Empresa_ID = empresas.Empresa_ID LEFT JOIN licencia_empresa ON empresas_info_s3_6.Empresa_ID = licencia_empresa.Empresa_ID WHERE empresas_info_s3_6.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE licencia_empresa.Licencia_ID=$Licencia_ID_modificada AND empresas.Empresa_estatus='Activa') AND (empresas_info_s3_6.act_alumno=1 OR empresas_info_s3_6.act_asesor=1)"));
			if ($datosS3_6[0]>0) {
				$_SESSION["sesion3_6"] = 1;
				$_SESSION["sesion3"] = 1;
			}
			$datosS3_7 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s3_7 LEFT JOIN empresas ON empresas_info_s3_7.Empresa_ID = empresas.Empresa_ID LEFT JOIN licencia_empresa ON empresas_info_s3_7.Empresa_ID = licencia_empresa.Empresa_ID WHERE empresas_info_s3_7.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE licencia_empresa.Licencia_ID=$Licencia_ID_modificada AND empresas.Empresa_estatus='Activa') AND (empresas_info_s3_7.act_alumno=1 OR empresas_info_s3_7.act_asesor=1)"));
			if ($datosS3_7[0]>0) {
				$_SESSION["sesion3_7"] = 1;
				$_SESSION["sesion3"] = 1;
			}
			$datosS4_4 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s4_4 LEFT JOIN empresas ON empresas_info_s4_4.Empresa_ID = empresas.Empresa_ID LEFT JOIN licencia_empresa ON empresas_info_s4_4.Empresa_ID = licencia_empresa.Empresa_ID WHERE empresas_info_s4_4.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE licencia_empresa.Licencia_ID=$Licencia_ID_modificada AND empresas.Empresa_estatus='Activa') AND (empresas_info_s4_4.act_alumno=1 OR empresas_info_s4_4.act_asesor=1)"));
			if ($datosS4_4[0]>0) {
				$_SESSION["sesion4_4"] = 1;
				$_SESSION["sesion4"] = 1;
			}
			$datosS4_5 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s4_5 LEFT JOIN empresas ON empresas_info_s4_5.Empresa_ID = empresas.Empresa_ID LEFT JOIN licencia_empresa ON empresas_info_s4_5.Empresa_ID = licencia_empresa.Empresa_ID WHERE empresas_info_s4_5.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE licencia_empresa.Licencia_ID=$Licencia_ID_modificada AND empresas.Empresa_estatus='Activa') AND (empresas_info_s4_5.act_alumno=1 OR empresas_info_s4_5.act_asesor=1)"));
			if ($datosS4_5[0]>0) {
				$_SESSION["sesion4_5"] = 1;
				$_SESSION["sesion4"] = 1;
			}
			$datosS4_6 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s4_6 LEFT JOIN empresas ON empresas_info_s4_6.Empresa_ID = empresas.Empresa_ID LEFT JOIN licencia_empresa ON empresas_info_s4_6.Empresa_ID = licencia_empresa.Empresa_ID WHERE empresas_info_s4_6.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE licencia_empresa.Licencia_ID=$Licencia_ID_modificada AND empresas.Empresa_estatus='Activa') AND (empresas_info_s4_6.act_alumno=1 OR empresas_info_s4_6.act_asesor=1)"));
			if ($datosS4_6[0]>0) {
				$_SESSION["sesion4_6"] = 1;
				$_SESSION["sesion4"] = 1;
			}
			$datosS100_1 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s100_1 LEFT JOIN empresas ON empresas_info_s100_1.Empresa_ID = empresas.Empresa_ID LEFT JOIN licencia_empresa ON empresas_info_s100_1.Empresa_ID = licencia_empresa.Empresa_ID WHERE empresas_info_s100_1.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE licencia_empresa.Licencia_ID=$Licencia_ID_modificada AND empresas.Empresa_estatus='Activa') AND (empresas_info_s100_1.act_alumno=1 OR empresas_info_s100_1.act_asesor=1 OR empresas_info_s100_1.act_coord=1 OR empresas_info_s100_1.act_ja=1)"));
			if ($datosS100_1[0]>0) {
				$_SESSION["sesion100_1"] = 1;
				$_SESSION["sesion100"] = 1;
			}
			$datosS100_2 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s100_2 LEFT JOIN empresas ON empresas_info_s100_2.Empresa_ID = empresas.Empresa_ID LEFT JOIN licencia_empresa ON empresas_info_s100_2.Empresa_ID = licencia_empresa.Empresa_ID WHERE empresas_info_s100_2.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE licencia_empresa.Licencia_ID=$Licencia_ID_modificada AND empresas.Empresa_estatus='Activa') AND (empresas_info_s100_2.act_alumno=1 OR empresas_info_s100_2.act_asesor=1 OR empresas_info_s100_2.act_coord=1 OR empresas_info_s100_2.act_ja=1)"));
			if ($datosS100_2[0]>0) {
				$_SESSION["sesion100_2"] = 1;
				$_SESSION["sesion100"] = 1;
			}
			$datosS101_2 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM empresas_info_s101_2 LEFT JOIN empresas ON empresas_info_s101_2.Empresa_ID = empresas.Empresa_ID LEFT JOIN licencia_empresa ON empresas_info_s101_2.Empresa_ID = licencia_empresa.Empresa_ID WHERE empresas_info_s101_2.Empresa_ID IN (SELECT Empresa_ID FROM empresas WHERE licencia_empresa.Licencia_ID=$Licencia_ID_modificada AND empresas.Empresa_estatus='Activa') AND (empresas_info_s101_2.act_alumno=1 OR empresas_info_s101_2.act_asesor=1 OR empresas_info_s101_2.act_coord=1 OR empresas_info_s101_2.act_ja=1)"));
			if ($datosS101_2[0]>0) {
				$_SESSION["sesion101_2"] = 1;
				$_SESSION["sesion101"] = 1;
			}*/


		} else if ($estatus_text != "Activa") {
			$_SESSION["licencia_activa"] = 0;
			$_SESSION["nombre_licencia"] = "";
			$_SESSION["inicio_licencia"] = "";
			$_SESSION["sesion1"] = 0;
			$_SESSION["sesion1_5"] = 0;
			$_SESSION["sesion2"] = 0;
			$_SESSION["sesion2_2"] = 0;
			$_SESSION["sesion2_3"] = 0;
			$_SESSION["sesion2_4"] = 0;
			$_SESSION["sesion3_2"] = 0;
			$_SESSION["sesion3_3"] = 0;
			/*$_SESSION["sesion2_8"] = 0;
			$_SESSION["sesion2_9"] = 0;
			$_SESSION["sesion3_2"] = 0;
			$_SESSION["sesion3"] = 0;
			$_SESSION["sesion3_6"] = 0;
			$_SESSION["sesion3_7"] = 0;
			$_SESSION["sesion4"] = 0;
			$_SESSION["sesion4_5"] = 0;
			$_SESSION["sesion4_6"] = 0;
			$_SESSION["sesion100"] = 0;
			$_SESSION["sesion100_1"] = 0;
			$_SESSION["sesion100_2"] = 0;
			$_SESSION["sesion101_2"] = 0;*/
		}
	}
} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin.php'>";
	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../admin.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once('../../includes/footer.php');
}

?>