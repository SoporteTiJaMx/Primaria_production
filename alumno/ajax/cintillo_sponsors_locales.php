<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../../scripts/funciones.php');
	include_once('../../scripts/conexion.php');
	$Centro_ID = $_SESSION['Centro_ID'];
	$query = "SELECT Patroc_ID, Patroc_tipo, Patroc_nombre FROM patrocinadores WHERE Patroc_estatus='Activo' AND Patroc_tipo='Local' AND Centro_ID=" . $Centro_ID . " ORDER BY Patroc_nombre";
	if ($stmt = $con->prepare($query)) {
		$stmt->execute();
		$stmt->bind_result($Patroc_ID, $Patroc_tipo, $Patroc_nombre);
		$resultadoloc = '<div class="carousel-inner">';
		$i=0;
		while ($stmt->fetch()) {
			if ($i==0) {
				$resultadoloc .= "<div class='active carousel-item'><img  src='".$RAIZ_SITIO_nohttp."images/patrocinadores/".$Patroc_ID.".jpg' height='30px' alt='patroc".$Patroc_ID."' /></div>";
			} else {
				$resultadoloc .= "<div class='carousel-item'><img  src='".$RAIZ_SITIO_nohttp."images/patrocinadores/".$Patroc_ID.".jpg' height='30px' alt='patroc".$Patroc_ID."' /></div>";
			}
			$i++;
		}
		$resultadoloc .= '</div>';
		echo $resultadoloc;
		$stmt->close();
	}

} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../asesor.php'>";
	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../asesor.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once('../../includes/footer.php');
}

?>