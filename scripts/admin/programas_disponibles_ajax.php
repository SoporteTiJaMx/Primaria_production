<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../conexion.php');

	$Proyecto_ID = $_POST['Proyecto_ID'];
	$Centro_ID = $_SESSION['centro_ID'];

	$stmt=$con->prepare("SELECT programas.programa_nombre, programas.programa_ID FROM programas WHERE programas.programa_id NOT IN (SELECT proyecto_programa.programa_id FROM proyecto_programa WHERE proyecto_programa.Proyecto_ID=?)");
	$stmt->bind_param('i', $Proyecto_ID);
	$stmt->execute();
	$stmt->bind_result($programa_nombre, $programa_id);

	$tabla = "
		<table id='proyectos_disp_table' class='table table-hover dt-responsive' style='width:100%'>
	        <thead>
	            <tr>
	                <th>Programa</th>
	                <th>Asociar</th>
	            </tr>
	        </thead>
	        <tbody>";

	while ($result=$stmt->fetch()) {
		$tabla.="<tr>
			<td class='align-middle'>" . $programa_nombre . "</td>
			<td class='align-middle text-center'>
				<div class='checkbox checkbox-green' style='cursor:pointer'>
					<input type='checkbox' class='custom-control-input select_asociar_proyec' id=" . $programa_id . " style='cursor:pointer'>
					<label class='custom-control-label pt-1' for=" . $programa_id . " style='cursor:pointer'>Seleccionar</label>
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