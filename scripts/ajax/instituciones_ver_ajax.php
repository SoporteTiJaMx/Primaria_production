<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$Centro_ID = $_POST['Centro_ID'];

	$query = "SELECT * FROM instituciones LEFT JOIN centros ON instituciones.Centro_ID = centros.Centro_ID WHERE instituciones.Centro_ID=? order by Institucion_nombre";
	if ($stmt = $con->prepare($query)) {
		if ($Centro_ID != 0) {
			$stmt->bind_param("i", $Centro_ID);
		}
		$stmt->execute();
		$stmt->bind_result($Institucion_ID, $Centro_ID, $Institucion_nombre, $Institucion_director, $Institucion_web, $Institucion_estatus, $Centro_ID2, $Centro_nombre);

		$tabla = "
			<table id='instituciones_table' class='table table-hover responsive' style='width:100%'>
				<thead>
					<tr>
						<th>Acciones</th>
						<th>Institucion</th>
						<th>Director</th>
						<th>Logo</th>
						<th>Web</th>
						<th>Estatus</th>
					</tr>
				</thead>
				<tbody>";

		while ($stmt->fetch()) {
			if ($Institucion_estatus=="Activa") {
				$estatus = 1;
			} else if ($Institucion_estatus=="Inactiva") {
				$estatus = 2;
			}
			if(is_file('../../images/instituciones/'. $Institucion_ID .'.jpg')){
				$imagen = '../images/instituciones/'. $Institucion_ID .'.jpg';
			} else {
				$imagen = '../images/instituciones/perfil.png';
			}
			if ($Institucion_web != "") {
				$href = $Institucion_web;
				$text_web = "Ver sitio";
			} else {
				$href = "";
				$text_web = "";
			}
			$tabla.="<tr>
				<td class='align-middle text-center'>
					<a class='select_nuevo_estatus' data-target='#modalModificar' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit text-dark-gray' data-toggle='tooltip' data-placement='top' data-institucion=" . $Institucion_ID . " data-nombre='" . $Institucion_nombre . "'' data-director='" . $Institucion_director . "'' data-web='" . $Institucion_web . "'' data-estatus=" . $estatus . " title='Modificar datos'></i></a>
					<a class='select_nuevo_logo' data-target='#modalLogo' data-toggle='modal' style='cursor: pointer'><i class='fas fa-exchange-alt text-dark-gray' data-toggle='tooltip' data-placement='top' data-institucion=" . $Institucion_ID . " title='Cambiar logo'></i></a>
				</td>
				<td class='align-middle'>" . $Institucion_nombre . "</td>
				<td class='align-middle'>" . $Institucion_director . "</td>
				<td class='d-flex justify-content-center'><img src='" . $imagen . "' alt='Logo de " . $Institucion_nombre . "'  height='30'></td>
				<td class='align-middle'><a href=\"http://" . $href . "\" target='_blank'>" . $text_web . "</a></td>
				<td class='align-middle'>" . $Institucion_estatus . "</td>
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