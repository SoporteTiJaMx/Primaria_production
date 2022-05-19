<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	//session_start();
	include_once('../../scripts/funciones.php');
	include_once('../../scripts/conexion.php');

	$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/actas/";
	$Empresa_ID = $_POST["Empresa_ID"];
	$query = "SELECT Empresa_nombre FROM empresas WHERE Empresa_ID=?";
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("i", $Empresa_ID);
		$stmt->execute();
		$stmt->bind_result($Empresa_nombre);
		$stmt->fetch();

		if ($Empresa_ID>0) {
			if (is_file($target_dir . "Acta_empresa_" . $Empresa_nombre . '.pdf')) {
				$nombre_acta = "Acta_empresa_" . $Empresa_nombre . '.pdf';
			} else {
				$nombre_acta = "";
			}
		} else {
			$nombre_acta = "";
		}

		$stmt->close();
	} else {
		$nombre_acta = "";
	}
	if ($Empresa_ID>0 AND $nombre_acta!="") {
		echo "Acta registrada: <a href='../images/actas/" . $nombre_acta . "' download>" . $nombre_acta . "</a>";
	} else if ($Empresa_ID>0 AND $nombre_acta=="") {
		echo "Aun no sube Acta Constitutiva";
	} else {
		echo "";
	}

} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../index.php'>";
	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../index.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once('../../includes/footer.php');
}

?>