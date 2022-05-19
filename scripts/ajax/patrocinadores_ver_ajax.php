<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$Centro_ID = $_POST['Centro_ID'];
	if ($Centro_ID == 0) {
		$where = "";
	} else {
		$where = " WHERE patrocinadores.Centro_ID=? ";
	}
	$query = "SELECT * FROM patrocinadores LEFT JOIN centros ON patrocinadores.Centro_ID = centros.Centro_ID " . $where . " order by Patroc_nombre";
	if ($stmt = $con->prepare($query)) {
		if ($Centro_ID != 0) {
			$stmt->bind_param("i", $Centro_ID);
		}
		$stmt->execute();
		$stmt->bind_result($Patroc_ID, $Centro_ID, $Patroc_nombre, $Patroc_tipo, $Patroc_estatus, $Centro_ID2, $Centro_nombre);

		$tabla = "
			<table id='patrocinadores_table' class='table table-hover dt-responsive nowrap' style='width:100%'>
		        <thead>
		            <tr>
		                <th>Acciones</th>
		                <th>Patrocinador</th>
		                <th>Logo</th>
		                <th>Tipo</th>
		                <th>Centro</th>
		                <th>Estatus</th>
		            </tr>
		        </thead>
		        <tbody>";

		while ($stmt->fetch()) {
			if ($Centro_ID==0) {
				$Centro_nombre = "-";
			}
			if ($Patroc_estatus=="Activo") {
				$estatus = 1;
			} else if ($Patroc_estatus=="Inactivo") {
				$estatus = 2;
			}
			$tabla.="<tr>
				<td class='align-middle text-center'>
					<a class='select_nuevo_estatus' data-target='#modalEstatus' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit text-dark-gray' data-toggle='tooltip' data-placement='top' data-patrocinador=" . $Patroc_ID . " data-nombre=" . $Patroc_nombre . " data-estatus=" . $estatus . " title='Cambiar estatus'></i></a>
					<a class='select_nuevo_logo' data-target='#modalLogo' data-toggle='modal' style='cursor: pointer'><i class='fas fa-exchange-alt text-dark-gray' data-toggle='tooltip' data-placement='top' data-patrocinador=" . $Patroc_ID . " title='Cambiar logo'></i></a>
				</td>
				<td class='align-middle'>" . $Patroc_nombre . "</td>
				<td class='d-flex justify-content-center'><img src='../images/patrocinadores/" . $Patroc_ID . ".jpg' alt='Logo de " . $Patroc_nombre . "'  height='30'></td>
				<td class='align-middle'>" . $Patroc_tipo . "</td>
				<td class='align-middle'>" . $Centro_nombre . "</td>
				<td class='align-middle'>" . $Patroc_estatus . "</td>
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
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../superadmin.php'>";
	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../superadmin.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once('../../includes/footer.php');
}

?>