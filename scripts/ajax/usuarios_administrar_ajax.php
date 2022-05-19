<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$tipo = $_POST['tipo'];
	if($tipo == 1){
		$tipo_text = "Sadmin";
	} else if($tipo == 2){
		$tipo_text = "Admin";
	} else if($tipo == 3){
		$tipo_text = "Coord";
	} else if($tipo == 4){
		$tipo_text = "Volun";
	} else if($tipo == 5){
		$tipo_text = "Alumn";
	} else if($tipo == 6){
		$tipo_text = "Vincu";
	}
	if ($tipo == 1) {
		$query = "SELECT usuarios.User_ID, usuarios.Usuario, usuarios.UltimoAcceso, superadmins.Sadmin_ID, superadmins.Sadmin_nombre, superadmins.Sadmin_ap_paterno, superadmins.Sadmin_ap_materno, superadmins.Sadmin_email, superadmins.Sadmin_estatus FROM usuarios INNER JOIN superadmins ON usuarios.User_ID = superadmins.User_ID WHERE usuarios.Tipo=? ORDER BY superadmins.Sadmin_nombre";
		if ($stmt = $con->prepare($query)) {
			$stmt->bind_param("s", $tipo_text);
			$stmt->execute();
			$stmt->bind_result($User_ID, $Usuario, $UltimoAcceso, $Sadmin_ID, $Sadmin_nombre, $Sadmin_ap_paterno, $Sadmin_ap_materno, $Sadmin_email, $Sadmin_estatus);

			$tabla = "
				<table id='usuarios_table' class='table table-hover dt-responsive nowrap' style='width:100%'>
					<thead>
						<tr>
							<th>Acciones</th>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>Email</th>
							<th>Usuario</th>
							<th>Ultimo Acceso</th>
							<th>Estatus</th>
						</tr>
					</thead>
					<tbody>";

			while ($stmt->fetch()) {
				if ($Sadmin_estatus == 0) {
					$Estatus = "Pendiente de perfil";
				} else if ($Sadmin_estatus == 1) {
					$Estatus = "Activo";
				} else if ($Sadmin_estatus == 2) {
					$Estatus = "Suspendido";
				} else if ($Sadmin_estatus == 3) {
					$Estatus = "Cancelado";
				}
				$tabla.="<tr>
				<td class='text-center'>
					<a class='select_nuevo_estatus' data-target='#modalEstatus' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit text-dark-gray' data-toggle='tooltip' data-placement='top' data-estatus=" . $Sadmin_estatus . " data-user_id=" . $User_ID . " data-nombre='" . $Sadmin_nombre . " " . $Sadmin_ap_paterno . "' data-tipo=" . $tipo . " title='Cambiar estatus'></i></a>
					<a class='resetear_datos_acceso' data-target='#modalResetear' data-toggle='modal' style='cursor: pointer'><i class='fas fa-key text-dark-gray' data-toggle='tooltip' data-placement='top' data-user_id=" . $User_ID . " data-nombre='" . $Sadmin_nombre . " " . $Sadmin_ap_paterno . "' data-tipo=" . $tipo . " title='Resetear datos de acceso'></i></a>
					<a class='resetear_mail' data-target='#modalUpdateMail' data-toggle='modal' style='cursor: pointer'><i class='fas fa-envelope text-dark-gray' data-toggle='tooltip' data-placement='top' data-user_id=" . $User_ID . " data-nombre='" . $Sadmin_nombre . " " . $Sadmin_ap_paterno . "' data-mail=" . $Sadmin_email . " data-tipo=" . $tipo . " title='Modificar mail'></i></a>
				</td><td>" . $Sadmin_nombre . "</td><td>" . $Sadmin_ap_paterno . " " . $Sadmin_ap_materno . "</td><td>" . $Sadmin_email . "</td><td>" . $Usuario . "</td><td>" . $UltimoAcceso . "</td><td>" . $Estatus . "</td>
				</tr>";
			}
			$tabla.="</tbody>
				</table>";
			$stmt->close();
		} else {
			$tabla = "No hay datos por mostrar";
		}
		$page = "superadmin";
	} else if ($tipo == 2) {
		$query = "SELECT usuarios.User_ID, usuarios.Usuario, usuarios.UltimoAcceso, administradores.Admin_ID, administradores.Admin_nombre, administradores.Admin_ap_paterno, administradores.Admin_ap_materno, administradores.Admin_email, administradores.Admin_tel, administradores.Admin_cel, administradores.Admin_dir, administradores.Admin_estatus, centros.Centro_nombre FROM usuarios INNER JOIN administradores ON usuarios.User_ID = administradores.User_ID INNER JOIN centros ON administradores.Centro_ID = centros.Centro_ID WHERE usuarios.Tipo=? ORDER BY administradores.Admin_nombre";
		if ($stmt = $con->prepare($query)) {
			$stmt->bind_param("s", $tipo_text);
			$stmt->execute();
			$stmt->bind_result($User_ID, $Usuario, $UltimoAcceso, $Admin_ID, $Admin_nombre, $Admin_ap_paterno, $Admin_ap_materno, $Admin_email, $Admin_tel, $Admin_cel, $Admin_dir, $Admin_estatus, $Centro_nombre);

			$tabla = "
				<table id='usuarios_table' class='table table-hover dt-responsive nowrap' style='width:100%'>
					<thead>
						<tr>
							<th>Acciones</th>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>Centro</th>
							<th>Email</th>
							<th>Usuario</th>
							<th>Ultimo Acceso</th>
							<th>Estatus</th>
						</tr>
					</thead>
					<tbody>";

			while ($stmt->fetch()) {
				if ($Admin_estatus == 0) {
					$Estatus = "Pendiente de perfil";
				} else if ($Admin_estatus == 1) {
					$Estatus = "Activo";
				} else if ($Admin_estatus == 2) {
					$Estatus = "Suspendido";
				} else if ($Admin_estatus == 3) {
					$Estatus = "Cancelado";
				}
				$tabla.="<tr>
				<td class='text-center'>
					<a class='select_nuevo_estatus' data-target='#modalEstatus' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit text-dark-gray' data-toggle='tooltip' data-placement='top' data-estatus=" . $Admin_estatus . " data-user_id=" . $User_ID . " data-nombre='" . $Admin_nombre . " " . $Admin_ap_paterno . "' data-tipo=" . $tipo . " title='Cambiar estatus'></i></a>
					<a class='resetear_datos_acceso' data-target='#modalResetear' data-toggle='modal' style='cursor: pointer'><i class='fas fa-key text-dark-gray' data-toggle='tooltip' data-placement='top' data-user_id=" . $User_ID . " data-nombre='" . $Admin_nombre . " " . $Admin_ap_paterno . "' data-tipo=" . $tipo . " title='Resetear datos de acceso'></i></a>
					<a class='resetear_mail' data-target='#modalUpdateMail' data-toggle='modal' style='cursor: pointer'><i class='fas fa-envelope text-dark-gray' data-toggle='tooltip' data-placement='top' data-user_id=" . $User_ID . " data-nombre='" . $Admin_nombre . " " . $Admin_ap_paterno . "' data-mail=" . $Admin_email . " data-tipo=" . $tipo . " title='Modificar mail'></i></a>
				</td><td>" . $Admin_nombre . "</td><td>" . $Admin_ap_paterno . " " . $Admin_ap_materno . "</td><td>" . $Centro_nombre . "</td><td>" . $Admin_email . "</td><td>" . $Usuario . "</td><td>" . $UltimoAcceso . "</td><td>" . $Estatus . "</td>
				</tr>";
			}
			$tabla.="</tbody>
				</table>";
			$stmt->close();
		} else {
			$tabla = "No hay datos por mostrar";
		}
		$page = "admin";
	} else if ($tipo == 3) {
		if ($_SESSION["tipo"] != "Sadmin") {
			$centro_ID = $_SESSION["centro_ID"];
			$query = "SELECT usuarios.User_ID, usuarios.Usuario, usuarios.UltimoAcceso, coordinadores.Coord_ID, coordinadores.Coord_nombre, coordinadores.Coord_ap_paterno, coordinadores.Coord_ap_materno, coordinadores.Coord_cumple, coordinadores.Coord_email, coordinadores.Coord_tel, coordinadores.Coord_cel, coordinadores.Coord_estatus, escuelas.Escuela_nombre FROM usuarios INNER JOIN coordinadores ON usuarios.User_ID = coordinadores.User_ID INNER JOIN centros ON coordinadores.Centro_ID = centros.Centro_ID INNER JOIN escuelas ON coordinadores.Escuela_ID = escuelas.Escuela_ID WHERE usuarios.Tipo=? AND coordinadores.Centro_ID=? ORDER BY coordinadores.Coord_nombre";
		} else {
			$query = "SELECT usuarios.User_ID, usuarios.Usuario, usuarios.UltimoAcceso, coordinadores.Coord_ID, coordinadores.Coord_nombre, coordinadores.Coord_ap_paterno, coordinadores.Coord_ap_materno, coordinadores.Coord_cumple, coordinadores.Coord_email, coordinadores.Coord_tel, coordinadores.Coord_cel, coordinadores.Coord_estatus, escuelas.Escuela_nombre, centros.Centro_nombre FROM usuarios INNER JOIN coordinadores ON usuarios.User_ID = coordinadores.User_ID INNER JOIN centros ON coordinadores.Centro_ID = centros.Centro_ID INNER JOIN escuelas ON coordinadores.Escuela_ID = escuelas.Escuela_ID WHERE usuarios.Tipo=? ORDER BY coordinadores.Coord_nombre";
		}
		if ($stmt = $con->prepare($query)) {
			if ($_SESSION["tipo"] != "Sadmin") {
				$stmt->bind_param("si", $tipo_text, $centro_ID);
				$stmt->execute();
				$stmt->bind_result($User_ID, $Usuario, $UltimoAcceso, $Coord_ID, $Coord_nombre, $Coord_ap_paterno, $Coord_ap_materno, $Coord_cumple, $Coord_email, $Coord_tel, $Coord_cel, $Coord_estatus, $Escuela_nombre);
			} else {
				$stmt->bind_param("s", $tipo_text);
				$stmt->execute();
				$stmt->bind_result($User_ID, $Usuario, $UltimoAcceso, $Coord_ID, $Coord_nombre, $Coord_ap_paterno, $Coord_ap_materno, $Coord_cumple, $Coord_email, $Coord_tel, $Coord_cel, $Coord_estatus, $Escuela_nombre, $Centro_nombre);
			};

			$tabla = "
				<table id='usuarios_table' class='table table-hover dt-responsive' style='width:100%'>
					<thead>
						<tr>
							<th>Acciones</th>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>Escuela</th>";
			if ($_SESSION["tipo"] == "Sadmin") { $tabla.="<th>Centro</th>";}
			$tabla.=	   "<th>Email</th>
							<th>Usuario</th>
							<th>Ultimo Acceso</th>
							<th>Estatus</th>
						</tr>
					</thead>
					<tbody>";

			while ($stmt->fetch()) {
				if ($Coord_estatus == 0) {
					$Estatus = "Pendiente de perfil";
				} else if ($Coord_estatus == 1) {
					$Estatus = "Activo";
				} else if ($Coord_estatus == 2) {
					$Estatus = "Suspendido";
				} else if ($Coord_estatus == 3) {
					$Estatus = "Cancelado";
				}
				$tabla.="<tr>
				<td class='text-center'>
					<a class='select_nuevo_estatus' data-target='#modalEstatus' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit text-dark-gray' data-toggle='tooltip' data-placement='top' data-estatus=" . $Coord_estatus . " data-user_id=" . $User_ID . " data-nombre='" . $Coord_nombre . " " . $Coord_ap_paterno . "' data-tipo=" . $tipo . " title='Cambiar estatus'></i></a>
					<a class='resetear_datos_acceso' data-target='#modalResetear' data-toggle='modal' style='cursor: pointer'><i class='fas fa-key text-dark-gray' data-toggle='tooltip' data-placement='top' data-user_id=" . $User_ID . " data-nombre='" . $Coord_nombre . " " . $Coord_ap_paterno . "' data-tipo=" . $tipo . " title='Resetear datos de acceso'></i></a>
					<a class='resetear_mail' data-target='#modalUpdateMail' data-toggle='modal' style='cursor: pointer'><i class='fas fa-envelope text-dark-gray' data-toggle='tooltip' data-placement='top' data-user_id=" . $User_ID . " data-nombre='" . $Coord_nombre . " " . $Coord_ap_paterno . "' data-mail=" . $Coord_email . " data-tipo=" . $tipo . " title='Modificar mail'></i></a>
				</td><td>" . $Coord_nombre . "</td><td>" . $Coord_ap_paterno . " " . $Coord_ap_materno . "</td><td>" . $Escuela_nombre . "</td>";
				if ($_SESSION["tipo"] == "Sadmin") { $tabla.="<td>" . $Centro_nombre . "</td>";};
				$tabla.="<td>" . $Coord_email . "</td><td>" . $Usuario . "</td><td>" . $UltimoAcceso . "</td><td>" . $Estatus . "</td>
				</tr>";
			}
			$tabla.="</tbody>
				</table>";
			$stmt->close();
		} else {
			$tabla = "No hay datos por mostrar";
		}
		$page = "coordinador";
	} else if ($tipo == 4) {
		if ($_SESSION["tipo"] != "Sadmin") {
			$centro_ID = $_SESSION["centro_ID"];
			$query = "SELECT usuarios.User_ID, usuarios.Usuario, usuarios.UltimoAcceso, asesores.Asesor_ID, asesores.Asesor_nombre, asesores.Asesor_ap_paterno, asesores.Asesor_ap_materno, asesores.Asesor_cumple, asesores.Asesor_email, asesores.Asesor_tel, asesores.Asesor_cel, asesores.Asesor_trabajo, asesores.Asesor_puesto, asesores.Asesor_estatus FROM usuarios INNER JOIN asesores ON usuarios.User_ID = asesores.User_ID INNER JOIN centros ON asesores.Centro_ID = centros.Centro_ID WHERE usuarios.Tipo=? AND asesores.Centro_ID=? ORDER BY asesores.Asesor_nombre";
		} else {
			$query = "SELECT usuarios.User_ID, usuarios.Usuario, usuarios.UltimoAcceso, asesores.Asesor_ID, asesores.Asesor_nombre, asesores.Asesor_ap_paterno, asesores.Asesor_ap_materno, asesores.Asesor_cumple, asesores.Asesor_email, asesores.Asesor_tel, asesores.Asesor_cel, asesores.Asesor_trabajo, asesores.Asesor_puesto, asesores.Asesor_estatus, centros.Centro_nombre FROM usuarios INNER JOIN asesores ON usuarios.User_ID = asesores.User_ID INNER JOIN centros ON asesores.Centro_ID = centros.Centro_ID WHERE usuarios.Tipo=? ORDER BY asesores.Asesor_nombre";
		}
		if ($stmt = $con->prepare($query)) {
			if ($_SESSION["tipo"] != "Sadmin") {
				$stmt->bind_param("si", $tipo_text, $centro_ID);
				$stmt->execute();
				$stmt->bind_result($User_ID, $Usuario, $UltimoAcceso, $Asesor_ID, $Asesor_nombre, $Asesor_ap_paterno, $Asesor_ap_materno, $Asesor_cumple, $Asesor_email, $Asesor_tel, $Asesor_cel, $Asesor_trabajo, $Asesor_puesto, $Asesor_estatus);
			} else {
				$stmt->bind_param("s", $tipo_text);
				$stmt->execute();
				$stmt->bind_result($User_ID, $Usuario, $UltimoAcceso, $Asesor_ID, $Asesor_nombre, $Asesor_ap_paterno, $Asesor_ap_materno, $Asesor_cumple, $Asesor_email, $Asesor_tel, $Asesor_cel, $Asesor_trabajo, $Asesor_puesto, $Asesor_estatus, $Centro_nombre);
			};

			$tabla = "
				<table id='usuarios_table' class='table table-hover dt-responsive' style='width:100%'>
					<thead>
						<tr>
							<th>Acciones</th>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>Email</th>";
			if ($_SESSION["tipo"] == "Sadmin") { $tabla.="<th>Centro</th>";};
			$tabla .=	   "<th>Usuario</th>
							<th>Ultimo Acceso</th>
							<th>Estatus</th>
							<th>Cumpleaños</th>
							<th>Tel / Cel</th>
							<th>Trabajo / Puesto</th>
						</tr>
					</thead>
					<tbody>";

			while ($stmt->fetch()) {
				if ($Asesor_estatus == 0) {
					$Estatus = "Pendiente de perfil";
				} else if ($Asesor_estatus == 1) {
					$Estatus = "Activo";
				} else if ($Asesor_estatus == 2) {
					$Estatus = "Suspendido";
				} else if ($Asesor_estatus == 3) {
					$Estatus = "Cancelado";
				}
				$tabla.="<tr>
				<td class='text-center'>
					<a class='select_nuevo_estatus' data-target='#modalEstatus' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit text-dark-gray' data-toggle='tooltip' data-placement='top' data-estatus=" . $Asesor_estatus . " data-user_id=" . $User_ID . " data-nombre='" . $Asesor_nombre . " " . $Asesor_ap_paterno . "' data-tipo=" . $tipo . " title='Cambiar estatus'></i></a>
					<a class='resetear_datos_acceso' data-target='#modalResetear' data-toggle='modal' style='cursor: pointer'><i class='fas fa-key text-dark-gray' data-toggle='tooltip' data-placement='top' data-user_id=" . $User_ID . " data-nombre='" . $Asesor_nombre . " " . $Asesor_ap_paterno . "' data-tipo=" . $tipo . " title='Resetear datos de acceso'></i></a>
					<a class='resetear_mail' data-target='#modalUpdateMail' data-toggle='modal' style='cursor: pointer'><i class='fas fa-envelope text-dark-gray' data-toggle='tooltip' data-placement='top' data-user_id=" . $User_ID . " data-nombre='" . $Asesor_nombre . " " . $Asesor_ap_paterno . "' data-mail=" . $Asesor_email . " data-tipo=" . $tipo . " title='Modificar mail'></i></a>
				</td><td>" . $Asesor_nombre . "</td><td>" . $Asesor_ap_paterno . " " . $Asesor_ap_materno . "</td><td>" . $Asesor_email . "</td>";
				if ($_SESSION["tipo"] == "Sadmin") { $tabla.="<td>" . $Centro_nombre . "</td>";};
				$tabla.="<td>" . $Usuario . "</td><td>" . $UltimoAcceso . "</td><td>" . $Estatus . "</td><td>" . $Asesor_cumple . "</td><td>" . $Asesor_tel . " / " . $Asesor_cel . "</td><td>" . $Asesor_trabajo . " / " . $Asesor_puesto . "</td>
				</tr>";
			}
			$tabla.="</tbody>
				</table>";
			$stmt->close();
		} else {
			$tabla = "No hay datos por mostrar";
		}
		$page = "asesor";
	} else if ($tipo == 5) {
		if ($_SESSION["tipo"] != "Sadmin") {
			$centro_ID = $_SESSION["centro_ID"];
			$query = "SELECT usuarios.User_ID, usuarios.Usuario, usuarios.UltimoAcceso, alumnos.Alumno_ID, alumnos.Alumno_nombre, alumnos.Alumno_ap_paterno, alumnos.Alumno_ap_materno, alumnos.Alumno_cumple, alumnos.Alumno_email, alumnos.Alumno_cel, alumnos.Alumno_estatus, empresas.Empresa_nombre, empresas.Empresa_estatus, escuelas.Escuela_nombre FROM usuarios INNER JOIN alumnos ON usuarios.User_ID = alumnos.User_ID INNER JOIN centros ON alumnos.Centro_ID = centros.Centro_ID INNER JOIN empresas ON empresas.Empresa_ID = alumnos.Empresa_ID LEFT JOIN licencia_escuela ON licencia_escuela.Escuela_ID = empresas.Escuela_ID LEFT JOIN escuelas ON licencia_escuela.Escuela_ID = escuelas.Escuela_ID WHERE usuarios.Tipo=? AND alumnos.Centro_ID=? ORDER BY alumnos.Alumno_nombre";
		} else {
			$query = "SELECT usuarios.User_ID, usuarios.Usuario, usuarios.UltimoAcceso, alumnos.Alumno_ID, alumnos.Alumno_nombre, alumnos.Alumno_ap_paterno, alumnos.Alumno_ap_materno, alumnos.Alumno_cumple, alumnos.Alumno_email, alumnos.Alumno_cel, alumnos.Alumno_estatus, empresas.Empresa_nombre, empresas.Empresa_estatus, centros.Centro_nombre, escuelas.Escuela_nombre FROM usuarios INNER JOIN alumnos ON usuarios.User_ID = alumnos.User_ID INNER JOIN centros ON alumnos.Centro_ID = centros.Centro_ID INNER JOIN empresas ON empresas.Empresa_ID = alumnos.Empresa_ID LEFT JOIN licencia_escuela ON licencia_escuela.Escuela_ID = empresas.Escuela_ID LEFT JOIN escuelas ON licencia_escuela.Escuela_ID = escuelas.Escuela_ID WHERE usuarios.Tipo=? ORDER BY alumnos.Alumno_nombre";
		}
		if ($stmt = $con->prepare($query)) {
			if ($_SESSION["tipo"] != "Sadmin") {
				$stmt->bind_param("si", $tipo_text, $centro_ID);
				$stmt->execute();
				$stmt->bind_result($User_ID, $Usuario, $UltimoAcceso, $Alumno_ID, $Alumno_nombre, $Alumno_ap_paterno, $Alumno_ap_materno, $Alumno_cumple, $Alumno_email, $Alumno_cel, $Alumno_estatus, $Empresa, $Empresa_estatus, $Escuela_nombre);
			} else {
				$stmt->bind_param("s", $tipo_text);
				$stmt->execute();
				$stmt->bind_result($User_ID, $Usuario, $UltimoAcceso, $Alumno_ID, $Alumno_nombre, $Alumno_ap_paterno, $Alumno_ap_materno, $Alumno_cumple, $Alumno_email, $Alumno_cel, $Alumno_estatus, $Empresa, $Empresa_estatus, $Centro_nombre, $Escuela_nombre);
			};

			$tabla = "
				<table id='usuarios_table' class='table table-hover dt-responsive' style='width:100%'>
					<thead>
						<tr>
							<th>Acciones</th>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>Escuela / Empresa</th>
							<th>Email</th>";
			if ($_SESSION["tipo"] == "Sadmin") { $tabla.="<th>Centro</th>";};
			$tabla .=	   "<th>Usuario</th>
							<th>Ultimo Acceso</th>
							<th>Estatus</th>
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
				$tabla.="<tr>
				<td class='text-center'>
					<a class='select_nuevo_estatus' data-target='#modalEstatus' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit text-dark-gray' data-toggle='tooltip' data-placement='top' data-estatus=" . $Alumno_estatus . " data-user_id=" . $User_ID . " data-nombre='" . $Alumno_nombre . " " . $Alumno_ap_paterno . "' data-tipo=" . $tipo . " title='Cambiar estatus'></i></a>
					<a class='resetear_datos_acceso' data-target='#modalResetear' data-toggle='modal' style='cursor: pointer'><i class='fas fa-key text-dark-gray' data-toggle='tooltip' data-placement='top' data-user_id=" . $User_ID . " data-nombre='" . $Alumno_nombre . " " . $Alumno_ap_paterno . "' data-tipo=" . $tipo . " title='Resetear datos de acceso'></i></a>
					<a class='resetear_mail' data-target='#modalUpdateMail' data-toggle='modal' style='cursor: pointer'><i class='fas fa-envelope text-dark-gray' data-toggle='tooltip' data-placement='top' data-user_id=" . $User_ID . " data-nombre='" . $Alumno_nombre . " " . $Alumno_ap_paterno . "' data-mail=" . $Alumno_email . " data-tipo=" . $tipo . " title='Modificar correo'></i></a>
				</td><td>" . $Alumno_nombre . "</td><td>" . $Alumno_ap_paterno . " " . $Alumno_ap_materno . "</td><td>" . $Escuela_nombre . " / " . $Empresa . " (" . $Empresa_estatus . ")</td><td>" . $Alumno_email . "</td>";
				if ($_SESSION["tipo"] == "Sadmin") { $tabla.="<td>" . $Centro_nombre . "</td>";};
				$tabla.="<td>" . $Usuario . "</td><td>" . $UltimoAcceso . "</td><td>" . $Estatus . "</td>
				</tr>";
			}
			$tabla.="</tbody>
				</table>";
			$stmt->close();
		} else {
			$tabla = "No hay datos por mostrar";
		}
		$page = "alumno";
	} else if ($tipo == 6) {
		if ($_SESSION["tipo"] != "Sadmin") {
			$centro_ID = $_SESSION["centro_ID"];
			$query = "SELECT usuarios.User_ID, usuarios.Usuario, usuarios.UltimoAcceso, vinculadores.Vincul_ID, vinculadores.Vincul_nombre, vinculadores.Vincul_ap_paterno, vinculadores.Vincul_ap_materno, vinculadores.Vincul_cumple, vinculadores.Vincul_email, vinculadores.Vincul_tel, vinculadores.Vincul_cel, vinculadores.Vincul_estatus, instituciones.Institucion_nombre FROM usuarios INNER JOIN vinculadores ON usuarios.User_ID = vinculadores.User_ID INNER JOIN centros ON vinculadores.Centro_ID = centros.Centro_ID INNER JOIN instituciones ON vinculadores.Institucion_ID = instituciones.Institucion_ID WHERE usuarios.Tipo=? AND vinculadores.Centro_ID=? ORDER BY vinculadores.Vincul_nombre";
		} else {
			$query = "SELECT usuarios.User_ID, usuarios.Usuario, usuarios.UltimoAcceso, vinculadores.Vincul_ID, vinculadores.Vincul_nombre, vinculadores.Vincul_ap_paterno, vinculadores.Vincul_ap_materno, vinculadores.Vincul_cumple, vinculadores.Vincul_email, vinculadores.Vincul_tel, vinculadores.Vincul_cel, vinculadores.Vincul_estatus, instituciones.Institucion_nombre, centros.Centro_nombre FROM usuarios INNER JOIN vinculadores ON usuarios.User_ID = vinculadores.User_ID INNER JOIN centros ON vinculadores.Centro_ID = centros.Centro_ID INNER JOIN instituciones ON vinculadores.Institucion_ID = instituciones.Institucion_ID WHERE usuarios.Tipo=? ORDER BY vinculadores.Vincul_nombre";
		}
		if ($stmt = $con->prepare($query)) {
			if ($_SESSION["tipo"] != "Sadmin") {
				$stmt->bind_param("si", $tipo_text, $centro_ID);
				$stmt->execute();
				$stmt->bind_result($User_ID, $Usuario, $UltimoAcceso, $Vincul_ID, $Vincul_nombre, $Vincul_ap_paterno, $Vincul_ap_materno, $Vincul_cumple, $Vincul_email, $Vincul_tel, $Vincul_cel, $Vincul_estatus, $Institucion_nombre);
			} else {
				$stmt->bind_param("s", $tipo_text);
				$stmt->execute();
				$stmt->bind_result($User_ID, $Usuario, $UltimoAcceso, $Vincul_ID, $Vincul_nombre, $Vincul_ap_paterno, $Vincul_ap_materno, $Vincul_cumple, $Vincul_email, $Vincul_tel, $Vincul_cel, $Vincul_estatus, $Institucion_nombre, $Centro_nombre);
			};

			$tabla = "
				<table id='usuarios_table' class='table table-hover dt-responsive' style='width:100%'>
					<thead>
						<tr>
							<th>Acciones</th>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>Institucion</th>";
			if ($_SESSION["tipo"] == "Sadmin") { $tabla.="<th>Centro</th>";}
			$tabla.=	   "<th>Email</th>
							<th>Usuario</th>
							<th>Ultimo Acceso</th>
							<th>Estatus</th>
						</tr>
					</thead>
					<tbody>";

			while ($stmt->fetch()) {
				if ($Vincul_estatus == 0) {
					$Estatus = "Pendiente de perfil";
				} else if ($Vincul_estatus == 1) {
					$Estatus = "Activo";
				} else if ($Vincul_estatus == 2) {
					$Estatus = "Suspendido";
				} else if ($Vincul_estatus == 3) {
					$Estatus = "Cancelado";
				}
				$tabla.="<tr>
				<td class='text-center'>
					<a class='select_nuevo_estatus' data-target='#modalEstatus' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit text-dark-gray' data-toggle='tooltip' data-placement='top' data-estatus=" . $Vincul_estatus . " data-user_id=" . $User_ID . " data-nombre='" . $Vincul_nombre . " " . $Vincul_ap_paterno . "' data-tipo=" . $tipo . " title='Cambiar estatus'></i></a>
					<a class='resetear_datos_acceso' data-target='#modalResetear' data-toggle='modal' style='cursor: pointer'><i class='fas fa-key text-dark-gray' data-toggle='tooltip' data-placement='top' data-user_id=" . $User_ID . " data-nombre='" . $Vincul_nombre . " " . $Vincul_ap_paterno . "' data-tipo=" . $tipo . " title='Resetear datos de acceso'></i></a>
					<a class='resetear_mail' data-target='#modalUpdateMail' data-toggle='modal' style='cursor: pointer'><i class='fas fa-envelope text-dark-gray' data-toggle='tooltip' data-placement='top' data-user_id=" . $User_ID . " data-nombre='" . $Vincul_nombre . " " . $Vincul_ap_paterno . "' data-mail=" . $Vincul_email . " data-tipo=" . $tipo . " title='Modificar mail'></i></a>
				</td><td>" . $Vincul_nombre . "</td><td>" . $Vincul_ap_paterno . " " . $Vincul_ap_materno . "</td><td>" . $Institucion_nombre . "</td>";
				if ($_SESSION["tipo"] == "Sadmin") { $tabla.="<td>" . $Centro_nombre . "</td>";};
				$tabla.="<td>" . $Vincul_email . "</td><td>" . $Usuario . "</td><td>" . $UltimoAcceso . "</td><td>" . $Estatus . "</td>
				</tr>";
			}
			$tabla.="</tbody>
				</table>";
			$stmt->close();
		} else {
			$tabla = "No hay datos por mostrar";
		}
		$page = "coordinador";
	} else {
		$tabla = "No hay datos por mostrar";
	}

	echo $tabla;
} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../" . $page . ".php'>";
	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../$page.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once('../../includes/footer.php');
}

?>