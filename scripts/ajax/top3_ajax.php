
<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../conexion.php');
	include_once('../conexion2.php');

	if ($_SESSION["tipo"] == "Admin") {
		$Licencia_ID = $_SESSION['licencia_activa'];
	} else {
		$Licencia_ID = $_SESSION['Licencia_ID'];
	}

	$query = "SELECT DISTINCT puntos FROM empresas_puntos WHERE Empresa_ID IN (SELECT Empresa_ID FROM licencia_empresa WHERE Licencia_ID=?) ORDER BY puntos DESC LIMIT 3";
	$arr = array('top1' => '', 'puntos_top1' => '', 'i_top1' => 0, 'top2' => '', 'puntos_top2' => '', 'i_top2' => 0, 'top3' => '', 'puntos_top3' => '', 'i_top3' => 0);
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("i", $Licencia_ID);
		$stmt->execute();
		$stmt->bind_result($puntos);
		$top1 = "";
		$top2 = "";
		$top3 = "";
		$i_top1 = 0;
		$i_top2 = 0;
		$i_top3 = 0;
		$top = 1;
		while ($stmt->fetch()) {
			$query2 = "SELECT empresas_puntos.Empresa_ID, empresas.Empresa_nombre, escuelas.Escuela_nombre, AVG(Alumno_score) AS promedio FROM empresas_puntos INNER JOIN empresas ON empresas_puntos.Empresa_ID=empresas.Empresa_ID INNER JOIN escuelas ON empresas.Escuela_ID=escuelas.Escuela_ID INNER JOIN alumnos ON empresas_puntos.Empresa_ID=alumnos.Empresa_ID WHERE empresas_puntos.puntos=? GROUP BY alumnos.Empresa_ID ORDER BY promedio DESC";
			if ($stmt2 = $con2->prepare($query2)) {
				$stmt2->bind_param("i", $puntos);
				$stmt2->execute();
				$stmt2->bind_result($Empresa_ID, $Empresa_nombre, $Escuela_nombre, $Promedio_alumnos);
				while ($stmt2->fetch()) {
					if ($top == 1) {
						$top1 .= $Empresa_nombre . " de " . $Escuela_nombre . " (<strong>" . round($Promedio_alumnos, 2) . "</strong>)<br>";
						$puntos_top1 = '<i class="far fa-star fa-lg fa-fw faa-tada faa-fast animated"></i>'. $puntos;
						$i_top1++;
					} else if ($top == 2) {
						$top2 .= $Empresa_nombre . " de " . $Escuela_nombre . " (<strong>" . round($Promedio_alumnos, 2) . "</strong>)<br>";
						//$puntos_top2 = $puntos;
						$puntos_top2 = '<i class="far fa-star fa-lg fa-fw faa-tada faa-fast animated"></i>' . $puntos;
						$i_top2++;
					} else if ($top == 3) {
						$top3 .= $Empresa_nombre . " de " . $Escuela_nombre . " (<strong>" . round($Promedio_alumnos, 2) . "</strong>)<br>";
						$puntos_top3 = '<i class="far fa-star fa-lg fa-fw faa-tada faa-fast animated"></i>'. $puntos;
						$i_top3++;
					}
				}
			$top++;
			}
		}
		$arr = array('top1' => $top1, 'puntos_top1' => $puntos_top1, 'i_top1' => $i_top1, 'top2' => $top2, 'puntos_top2' => $puntos_top2, 'i_top2' => $i_top2, 'top3' => $top3, 'puntos_top3' => $puntos_top3, 'i_top3' => $i_top3);

		$stmt->close();
	} else {
		$arr = array('top1' => '', 'puntos_top1' => '', 'i_top1' => 0, 'top2' => '', 'puntos_top2' => '', 'i_top2' => 0, 'top3' => '', 'puntos_top3' => '', 'i_top3' => 0);
	}
	echo json_encode($arr);

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