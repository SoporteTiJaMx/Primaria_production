<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../../scripts/funciones.php');
	include_once('../../scripts/conexion.php');
	$query = "SELECT Patroc_ID, Patroc_tipo, Patroc_nombre FROM patrocinadores WHERE Patroc_estatus='Activo' AND Patroc_tipo='Nacional' ORDER BY Patroc_nombre";
	if ($stmt = $con->prepare($query)) {
		$stmt->execute();
		$stmt->bind_result($Patroc_ID, $Patroc_tipo, $Patroc_nombre);
		$resultadonal = '<div class="carousel-inner">';
		$i=0;
		while ($stmt->fetch()) {
            //list($ancho, $alto, $tipo, $atributos) = getimagesize($RAIZ_SITIO.'images/patrocinadores/'.$Patroc_ID.'.jpg');
            //1rem=13 px, 20rem=260px
			$azar = rand();
            /* $ratio = ($ancho/$alto)*40;
            if ($ratio<200) {
                $size = "height='40px'";
            } else {
                $size = "width='180px'";
            }*/
			$size = "height='38px'";
			if ($i==0) {
				$resultadonal .= "<div class='active carousel-item align-middle' style='height: 40px'><img src='".$RAIZ_SITIO."images/patrocinadores/".$Patroc_ID.".jpg?nocache=".$azar."' ".$size." alt='patroc".$Patroc_ID."' /></div>";
			} else {
				$resultadonal .= "<div class='carousel-item align-middle' style='height: 40px'><img src='".$RAIZ_SITIO."images/patrocinadores/".$Patroc_ID.".jpg?nocache=".$azar."' ".$size." alt='patroc".$Patroc_ID."' /></div>";
			}
			$i++;
		}
		$resultadonal .= '</div>';
		echo $resultadonal;
		$stmt->close();
	}

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
