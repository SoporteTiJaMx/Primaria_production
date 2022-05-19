<?php
//session_id ("vidasegura");
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../conexion.php');
    $stmt=$con->prepare("SELECT alumnos.Alumno_ID, alumnos.Alumno_nombre, alumnos.Alumno_ap_paterno, alumnos.Alumno_email, alumnos.Alumno_tel, alumnos.Alumno_estatus, usuarios.User_ID, usuarios.Usuario, usuarios.UltimoAcceso, usuarios.Num_accesos, grupos.Grupo_nombre FROM alumnos LEFT JOIN usuarios ON usuarios.User_ID = alumnos.User_ID LEFT JOIN grupos ON grupos.Grupo_ID = alumnos.Grupo_ID WHERE alumnos.Alumno_estatus<2 AND grupos.Grupo_estatus ='activo'");
	$stmt->execute();
    $stmt->bind_result($Alumno_ID, $Alumno_nombre, $Alumno_ap, $Alumno_email, $Alumno_tel, $Alumno_estatus, $User_ID, $usuario, $ultimo_acceso, $num_accesos, $Grupo_nombre);
	$tabla="<table class='table table-striped table-hover nowrap' id='alumnos_table' style='width:100%'>";
	$tabla.="
		<thead>
			<tr>
				<th>Acciones</th>
				<th>Usuario</th>
				<th>Alumno</th>
				<th>Grupo</th>
				<th>Correo</th>
				<th>Telefono</th>
				<th>Último acceso</th>
				<th>Veces conectado</th>
				<th>Estatus</th>
			</tr>
		</thead>
		<tbody>";
		while ($stmt->fetch()) {
            $alumno = $Alumno_nombre . " " . $Alumno_ap;
            if($Alumno_estatus==0){
                $alumno_estatus="Pendiente de perfil";
            }else if($Alumno_estatus==1){
                $alumno_estatus="Activo";
            }else if($Alumno_estatus>1){
                $alumno_estatus="Cancelado";
            }
			$bckgrnd_color = "";
			if ($Alumno_estatus == "activo") {
				$acciones = "<td class='align-middle text-center " . $bckgrnd_color . "'>
					<a class='select_nuevo_estatus' data-target='#modalModificar' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit text-dark-gray' data-toggle='tooltip' data-placement='top' data-alumno='" . $Alumno_ID . "' data-nombre='" . $usuario . " - " . $Alumno_nombre . "' data-estatus='" . $Alumno_estatus . "' title='Modificar estatus'></i></a>
					<a class='resetear_datos_acceso' data-target='#modalResetear' data-toggle='modal' style='cursor: pointer'><i class='fas fa-key text-dark-gray' data-toggle='tooltip' data-placement='top' data-id_user=" . $User_ID . " data-nombre='" . $usuario . " - " . $Alumno_nombre . "' title='Resetear datos'></i></a>
				</td>";
			} else {
				$bckgrnd_color = "bg-danger text-white";
				$acciones = "<td class='align-middle text-center " . $bckgrnd_color . "'></td>";
			}

			$tabla.="
				<tr>
					".$acciones."
					<td class= '" . $bckgrnd_color . "'>".nl2br(htmlentities($usuario))."</td>
					<td class= '" . $bckgrnd_color . "'>".$alumno."</td>
					<td class= '" . $bckgrnd_color . "'>".nl2br(htmlentities($Grupo_nombre))."</td>
					<td class= '" . $bckgrnd_color . "'>".nl2br(htmlentities($Alumno_email))."</td>
					<td class= '" . $bckgrnd_color . "'>".nl2br(htmlentities($Alumno_tel))."</td>
					<td class= '" . $bckgrnd_color . "'>".$ultimo_acceso."</td>
					<td class='text-center " . $bckgrnd_color . "'>".$num_accesos."</td>
					<td class= '" . $bckgrnd_color . "'>".ucwords($alumno_estatus)."</td>
				</tr>
			";
		}
	$tabla.="</tbody>
		</table>";
	echo $tabla;
} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin.php'>";
	include_once('../../includes/header.php');
	?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ocurrió un error</h5>
						<p class="card-text">En unos segundos, serás redirigido</p>
						<div class="text-right mt-5"><a href="../../admin.php" class="btn btn-warning">Regresar</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include_once('../../includes/footer.php');
}

?>