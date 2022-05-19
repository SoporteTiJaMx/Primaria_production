<?php
//session_id ("vidasegura");
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../conexion.php');
	$stmt=$con->prepare("SELECT Patroc_ID, Patroc_nombre, Patroc_estatus FROM patrocinadores WHERE Patroc_estatus = 'Activo' ORDER BY Patroc_nombre");
	$stmt->execute();
	$stmt->bind_result($Patroc_ID, $Patroc_nombre, $Patroc_estatus);

	$tabla="<table class='table table-hover' id='patrocinadores_table' style='width:100%'>";
	$tabla.="
		<thead>
			<tr>
				<th>Acciones</th>
				<th>Patrocinador</th>
				<th>Logotipo</th>
				<th>Estatus</th>
			</tr>
		</thead>
		<tbody>";
		while ($result=$stmt->fetch()) {
			if ($Patroc_estatus == "Activo") {
				$bckgrnd_color = "";
				$text_i = "text-dark-gray";
			} else {
				$bckgrnd_color = "bg-danger text-white";
				$text_i = "text-white";
			}
			$acciones = "<td class='align-middle text-center " . $bckgrnd_color . "'>
				<a class='select_nuevo_estatus2' data-target='#modalModificar2' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit " . $text_i . "' data-toggle='tooltip' data-placement='top' data-patrocinador='" . $Patroc_ID . "' data-nombre='" . $Patroc_nombre . "' data-estatus='" . $Patroc_estatus . "' title='Modificar estatus'></i></a>
				</td>";

			$tabla.="
				<tr>
					".$acciones."
					<td class= 'align-middle " . $bckgrnd_color . "'>".nl2br(htmlentities($Patroc_nombre))."</td>
					<td class='d-flex justify-content-center " . $bckgrnd_color . "'><img src='../images/patrocinadores/" . $Patroc_ID . ".png' alt='Logo de " . $Patroc_nombre . "'  height='30'></td>
					<td class= 'align-middle " . $bckgrnd_color . "'>".ucwords($Patroc_estatus)."</td>
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
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Error</h5>
						<p class="card-text">Error en la solicitud</p>
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