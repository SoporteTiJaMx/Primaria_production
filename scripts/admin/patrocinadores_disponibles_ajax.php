<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../conexion.php');

	$Proyecto_ID = $_POST['Proyecto_ID'];

	$stmt=$con->prepare("SELECT patrocinadores.Patroc_nombre, patrocinadores.Patroc_estatus, patrocinadores.Patroc_ID FROM patrocinadores WHERE patrocinadores.Patroc_ID NOT IN (SELECT proyecto_patrocinador.Patroc_ID FROM proyecto_patrocinador WHERE proyecto_patrocinador.Proyecto_ID=?)");
	$stmt->bind_param('i', $Proyecto_ID);
	$stmt->execute();
	$stmt->bind_result($Patroc_nombre, $Patroc_estatus, $Patroc_ID);

	$tabla = "
		<table id='patrocinadores_disp_table' class='table table-hover dt-responsive' style='width:100%'>
	        <thead>
	            <tr>
	                <th>Patrocinador</th>
	                <th>Logo</th>
	                <th>Asociar</th>
	            </tr>
	        </thead>
	        <tbody>";

	while ($result=$stmt->fetch()) {
		if(is_file('../../images/patrocinadores/'. $Patroc_ID .'.png')){
			$imagen = '../images/patrocinadores/'. $Patroc_ID .'.png';
		} else {
			$imagen = '../images/patrocinadores/perfil.png';
		}
		$tabla.="<tr>
			<td class='align-middle'>" . $Patroc_nombre . "</td>
			<td class='d-flex justify-content-center'><img src='" . $imagen . "' alt='Logo de " . $Patroc_nombre . "'  height='25'></td>
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