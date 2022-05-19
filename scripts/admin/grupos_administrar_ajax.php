<?php
//session_id ("vidasegura");
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../conexion.php');
	include_once('../conexion2.php');
	$stmt=$con->prepare("SELECT grupos.Grupo_ID, grupos.Proyecto_ID, grupos.Grupo_nombre, grupos.Grupo_estatus, proyectos.Proyecto_nombre, asesores.Asesor_nombre, asesores.Asesor_ap_paterno, asesores.Asesor_estatus, asesores_x_grupo.Asesor_ID FROM grupos LEFT JOIN proyectos ON proyectos.Proyecto_ID = grupos.Proyecto_ID LEFT JOIN asesores_x_grupo ON asesores_x_grupo.Grupo_ID = grupos.Grupo_ID LEFT JOIN asesores ON asesores.Asesor_ID = asesores_x_grupo.Asesor_ID WHERE Grupo_estatus = 'activo' ORDER BY Grupo_nombre");
	$stmt->execute();
	$stmt->bind_result($Grupo_ID, $Proyecto_ID, $Grupo_nombre, $Grupo_estatus, $Proyecto_nombre, $Asesor_nombre, $Asesor_ap, $Asesor_estatus, $Asesor_ID);

	$tabla="<table class='table table-striped table-hover' id='grupos_table' style='width:100%'>";
	$tabla.="
		<thead>
			<tr>
				<th>Acciones</th>
				<th>Grupo</th>
				<th>Proyecto</th>
				<th>Alumnos registrados</th>
				<th>Voluntarios</th>
				<th>Estatus</th>
			</tr>
		</thead>
		<tbody>";
		while ($stmt->fetch()) {
			
			//$voluntarios_list = "";
			/* $stmt2=$con->prepare("SELECT asesores.Asesor_nombre, usuarios.Usuario, asesores_x_grupo.Asesor_ID, asesores_x_grupo.Grupo_ID FROM asesores left JOIN usuarios ON usuarios.User_ID=asesores.User_ID LEFT JOIN asesores_x_grupo ON asesores_x_grupo.Asesor_ID = asesores.Asesor_ID  WHERE Grupo_ID=? order by Asesor_nombre");
			$stmt2->bind_param('i', $Grupo_ID);
			$stmt2->execute();
			$stmt2->bind_result($Asesor_nombre, $Usuario, $Asesor_ID, $grupo);
			while ($stmt2->fetch()) {
				$voluntarios_list .= $Usuario . " - " . $Asesor_nombre .PHP_EOL;
			} */

			$bckgrnd_color = "";
			if ($Grupo_estatus == "activo") {
				$acciones = "<td class='align-middle text-center " . $bckgrnd_color . "'>
					<a class='select_nuevo_estatus' data-target='#modalModificar' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit text-dark-gray' data-toggle='tooltip' data-placement='top' data-grupo='" . $Grupo_ID . "' data-nombre='" . $Grupo_nombre . "' data-estatus='" . $Grupo_estatus . "' title='Modificar Estatus'></i></a>
				</td>";
				$voluntarios = "<td class='align-middle'>" . $Asesor_nombre . " ". $Asesor_ap ."</td>";
				$alumnos = mysqli_fetch_row(mysqli_query($con2, "SELECT COUNT(*) FROM alumnos WHERE Grupo_ID=" . $Grupo_ID . ""));
				//$alumnos = 0;
				/* $stmt3=$con->prepare("SELECT COUNT(*) AS alumnos FROM alumnos WHERE Grupo_ID=?");
				$stmt3->bind_param('i', $Grupo_ID);
				$stmt3->execute();
				$stmt3->bind_result($alumnos_number);
				$stmt3->fetch();
				$alumnos = $alumnos_number; */
			} else {
				$bckgrnd_color = "bg-danger text-white";
				$acciones = "<td class='align-middle text-center " . $bckgrnd_color . "'></td>";
				$voluntarios = "<td class='align-middle " . $bckgrnd_color . "'>N / A</td>";
				$alumnos = 0;
			}
			/* $stmt4=$con->prepare("SELECT Proyecto_nombre FROM proyectos WHERE Proyecto_ID=?");
			$stmt3->bind_param('i', $Proyecto_ID);
			$stmt4->execute();
			$stmt4->bind_result($Proyecto_nombre);
			$stmt4->fetch();
			$proyecto = $Proyecto_nombre; */

			$tabla.="
				<tr>
					".$acciones."
					<td class= 'align-middle " . $bckgrnd_color . "'>".$Grupo_nombre."</td>
					<td class= 'align-middle text-center " . $bckgrnd_color . "'>".$Proyecto_nombre."</td>
					<td class= 'align-middle text-center " . $bckgrnd_color . "'>".$alumnos[0]."</td>
					".$voluntarios."
					<td class= 'align-middle " . $bckgrnd_color . "'>".ucwords($Grupo_estatus)."</td>
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
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Fallo en la operación</h5>
						<p class="card-text">No se completó la petición <br><br>En unos segundos serás redirigido</p>
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