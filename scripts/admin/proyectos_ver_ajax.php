<?php
//session_id ("vidasegura");
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../conexion.php');
	$stmt=$con->prepare("SELECT Proyecto_ID, Proyecto_nombre, Proyecto_estatus FROM proyectos WHERE Proyecto_estatus = 'activo' ORDER BY Proyecto_nombre");
	$stmt->execute();
	$stmt->bind_result($Proyecto_ID, $Proyecto_nombre, $Proyecto_estatus);

	$tabla="<table class='table table-striped table-hover' id='proyectos_table' style='width:100%'>";
	$tabla.="
		<thead>
			<tr>
				<th>Acciones</th>
				<th>Proyectos</th>
				<th>Estatus</th>
			</tr>
		</thead>
		<tbody>";
		while ($result=$stmt->fetch()) {
			if ($Proyecto_estatus == "activo") {
				$bckgrnd_color = "";
				$text_i = "text-dark-gray";
			} else {
				$bckgrnd_color = "bg-danger text-white";
				$text_i = "text-white";
			}
			$acciones = "<td class='align-middle text-center " . $bckgrnd_color . "'>
				<a class='select_nuevo_estatus' data-target='#modalModificar' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit " . $text_i . "' data-toggle='tooltip' data-placement='top' data-proyecto='" . $Proyecto_ID . "' data-nombre='" . $result['Proyecto_nombre'] . "' data-estatus='" . $Proyecto_nombre . "' title='Modificar estatus'></i></a>
			</td>";

			$tabla.="
				<tr>
					".$acciones."
					<td class= 'align-middle " . $bckgrnd_color . "'>".$Proyecto_nombre."</td>
					<td class= 'align-middle " . $bckgrnd_color . "'>".ucwords($Proyecto_estatus)."</td>
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
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Error en la carga</h5>
						<p class="card-text">Hubo un error, comunícate con el superadmin</p>
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