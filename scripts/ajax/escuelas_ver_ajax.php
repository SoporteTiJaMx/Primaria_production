<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$Centro_ID = $_SESSION['centro_ID'];

	$query = "SELECT escuelas.escuela_ID, escuelas.Escuela_nombre, escuelas.Escuela_estado, escuelas.Escuela_maps, escuelas.Escuela_web, escuelas.Escuela_estatus, instituciones.Institucion_nombre, centros.Centro_nombre, estados.Estado FROM escuelas LEFT JOIN instituciones ON escuelas.Institucion_ID = instituciones.Institucion_ID INNER JOIN centros ON escuelas.Centro_ID = centros.Centro_ID LEFT JOIN estados ON escuelas.Escuela_estado = estados.Estado_ID WHERE escuelas.Centro_ID=?";
	if ($stmt = $con->prepare($query)) {
		if ($Centro_ID != 0) {
			$stmt->bind_param("i", $Centro_ID);
		}
		$stmt->execute();
		$stmt->bind_result($Escuela_ID, $Escuela_nombre, $Escuela_estado, $Escuela_maps, $Escuela_web, $Escuela_estatus, $Institucion_nombre, $Centro_nombre, $Estado);

		$tabla = "
			<table id='escuelas_table' class='table table-hover responsive' style='width:100%'>
				<thead>
					<tr>
						<th>Acciones</th>
						<th>Escuela</th>
						<th>Estado</th>
						<th>Logo</th>
						<th>Institución</th>
						<th>Maps</th>
						<th>Web</th>
						<th>Estatus</th>
					</tr>
				</thead>
				<tbody>";

		while ($stmt->fetch()) {
			if ($Escuela_estatus=="Activa") {
				$estatus = 1;
			} else if ($Escuela_estatus=="Inactiva") {
				$estatus = 2;
			}
			if(is_file('../../images/escuelas/'. $Escuela_ID .'.jpg')){
				$imagen = '../images/escuelas/'. $Escuela_ID .'.jpg';
			} else {
				$imagen = '../images/escuelas/perfil.png';
			}
			if ($Escuela_maps != "") {
				$href_maps = $Escuela_maps;
				$text_mapa = "Ver Mapa";
			} else {
				$href_maps = "";
				$text_mapa = "";
			}
			if ($Escuela_web != "") {
				$href_web = $Escuela_web;
				$text_web = "Ver Web";
			} else {
				$href_web = "";
				$text_web = "";
			}
			$tabla.="<tr>
				<td class='align-middle text-center'>
					<a class='select_nuevo_estatus' data-target='#modalModificar' data-toggle='modal' style='cursor: pointer'><i class='fas fa-edit text-dark-gray' data-toggle='tooltip' data-placement='top' data-escuela=" . $Escuela_ID . " data-nombre='" . $Escuela_nombre . "'' data-web='" . $Escuela_web . "'' data-maps='" . $Escuela_maps . "'' data-estatus=" . $estatus . " title='Modificar datos'></i></a>
					<a class='select_nuevo_logo' data-target='#modalLogo' data-toggle='modal' style='cursor: pointer'><i class='fas fa-exchange-alt text-dark-gray' data-toggle='tooltip' data-placement='top' data-escuela=" . $Escuela_ID . " title='Cambiar logo'></i></a>
				</td>
				<td class='align-middle'>" . $Escuela_nombre . "</td>
				<td class='align-middle'>" . $Estado . "</td>
				<td class='d-flex justify-content-center'><img src='" . $imagen . "' alt='Logo de " . $Escuela_nombre . "'  height='30'></td>
				<td class='align-middle'>" . $Institucion_nombre . "</td>
				<td class='align-middle'><a href=\"http://" . $href_maps . "\" target='_blank'>" . $text_mapa . "</a></td>
				<td class='align-middle'><a href=\"http://" . $href_web . "\" target='_blank'>" . $text_web . "</a></td>
				<td class='align-middle'>" . $Escuela_estatus . "</td>
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