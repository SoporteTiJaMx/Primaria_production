<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$Centro_ID = $_POST['Centro_ID'];
	$Licencia_ID = $_POST['Licencia_ID'];

	$query = "SELECT * FROM patrocinadores LEFT JOIN centros ON patrocinadores.Centro_ID = centros.Centro_ID WHERE patrocinadores.Centro_ID=? and Patroc_estatus='Activo' and patrocinadores.Patroc_ID NOT IN (SELECT Patroc_ID FROM licencia_patrocinador WHERE Licencia_ID=?) order by Patroc_nombre";
	if ($stmt = $con->prepare($query)) {
		if ($Centro_ID != 0) {
			$stmt->bind_param("ii", $Centro_ID, $Licencia_ID);
		}
		$stmt->execute();
		$stmt->bind_result($Patroc_ID, $Centro_ID, $Patroc_nombre, $Patroc_tipo, $Patroc_estatus, $Centro_ID2, $Centro_nombre);

		$tabla = "
			<table id='patrocinadores_disp_table' class='table table-hover dt-responsive nowrap' style='width:100%'>
		        <thead>
		            <tr>
		                <th>Patrocinador</th>
		                <th>Logo</th>
		                <th>Asociar</th>
		            </tr>
		        </thead>
		        <tbody>";

		while ($stmt->fetch()) {
			if(is_file('../../images/patrocinadores/'. $Patroc_ID .'.jpg')){
				$imagen = '../images/patrocinadores/'. $Patroc_ID .'.jpg';
			} else {
				$imagen = '../images/patrocinadores/perfil.png';
			}
			$tabla.="<tr>
				<td class='align-middle'>" . $Patroc_nombre . "</td>
				<td class='d-flex justify-content-center'><img src='" . $imagen . "' alt='Logo de " . $Patroc_nombre . "'  height='30'></td>
				<td class='align-middle text-center'>
					<div class='checkbox checkbox-green' style='cursor:pointer'>
						<input type='checkbox' class='custom-control-input select_asociar_patroc' id=" . $Patroc_ID . " style='cursor:pointer'>
						<label class='custom-control-label pt-1' for=" . $Patroc_ID . " style='cursor:pointer'>Seleccionar</label>
					</div>
				</td>
			</tr>";
		}
	    $tabla.="</tbody>
	        </table>";
		$stmt->close();
	} else {
		$tabla = "No hay datos por mostrar";
	}

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