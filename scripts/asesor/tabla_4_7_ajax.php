<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../conexion.php');
	include_once('../conexion2.php');
	include_once('../funciones.php');
	$Empresa_ID = $_POST["Empresa_ID"];

	if ($Empresa_ID!=0) {
		$query = "SELECT Alumno_ID, Alumno_nombre, puestos.Puesto_nombre FROM alumnos INNER JOIN puestos ON puestos.Puesto_ID=alumnos.Puesto_ID WHERE alumnos.Alumno_estatus<2 AND alumnos.Empresa_ID=?";
		$stmt = $con->prepare($query);
		$stmt->bind_param("i", $Empresa_ID);
		$stmt->execute();
		$stmt->bind_result($Alumno_ID, $Alumno_nombre, $Puesto_nombre);

		$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/cvs/";

		$tabla="<table class='table table-striped table-hover' id='s_4_7_table' style='width:100%'>";
		$tabla.="
			<thead>
				<tr>
					<th>Alumno</th>
					<th>Test de Perfil <br>(resultados en 'Detección de Habilidades')</th>
					<th>Curriculum Vitae</th>
					<th>Puesto asignado</th>
				</tr>
			</thead>
			<tbody>";
			while ($result=$stmt->fetch()) {
				$test = mysqli_fetch_array(mysqli_query($con2, "SELECT COUNT(Alumno_ID) FROM empresas_info_s4_3 WHERE Alumno_ID=" . $Alumno_ID));
				if ($test[0] == 0) {
					$test_de_perfil = "No realizado aún";
				} else {
					$test_de_perfil = "Ya realizado";
				}

				if (is_file($target_dir . "CV_" . $Alumno_ID . "_" . $Alumno_nombre . ".pdf")) {
					$nombre_cv = "CV_" . $Alumno_ID . "_" . $Alumno_nombre . ".pdf";
				} else {
					$nombre_cv = "";
				}

				if ($nombre_cv!="") {
					$CV = " CV subido. Puedes descargarlo <a href='../images/cvs/" . $nombre_cv . "' download>Aquí</a>";
				} else if ($nombre_cv=="") {
					$CV = "Aún no sube CV";
				}

				$tabla.="
					<tr>
						<td>".$Alumno_nombre."</td>
						<td>".$test_de_perfil."</td>
						<td>".$CV."</td>
						<td>".$Puesto_nombre."</td>
					</tr>
				";
			}
		$tabla.="</tbody>
			</table>";
		echo $tabla;
	} else {
		echo "";
	}
} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../sesiones/4.php?id=6'>";
	include_once('../../includes/header.php');
	?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i><?php echo $lang["no_access_ttl"]; ?></h5>
						<p class="card-text"><?php echo $lang["no_access_txt"]; ?></p>
						<div class="text-right mt-5"><a href="../../<?php echo $link; ?>.php" class="btn btn-warning"><?php echo $lang["no_access_btn"]; ?></a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include_once('../../includes/footer.php');
}
?>