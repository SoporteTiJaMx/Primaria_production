<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../conexion.php');
	$Empresa_ID = $_POST["Empresa_ID"];
	if ($_SESSION["tipo"]=="Volun") {
		$disabled="";
	} else {
		$disabled="disabled";
	}

	if ($Empresa_ID!=0) {
		$query = "SELECT alumnos.Alumno_ID, alumnos.Alumno_nombre, empresas_info_s1.problema1, empresas_info_s1.problema2, empresas_info_s1.conclusion, empresas_info_s1.coments_asesor FROM alumnos LEFT JOIN empresas_info_s1 ON alumnos.Alumno_ID=empresas_info_s1.Alumno_ID WHERE alumnos.Alumno_estatus<2 AND alumnos.Empresa_ID=?";
		$stmt = $con->prepare($query);
		$stmt->bind_param("i", $Empresa_ID);
		$stmt->execute();
		$stmt->bind_result($Alumno_ID, $Alumno_nombre, $problema1, $problema2, $conclusion, $coments_asesor);

		$tabla="<table class='table table-striped table-hover' id='s_1_5_table' style='width:100%'>";
		$tabla.="
			<thead>
				<tr>
					<th>Alumno</th>
					<th>Problemática 1</th>
					<th>Problemática 2</th>
					<th>Escribe aquí tu conclusión</th>
					<th>Comentario del Asesor</th>
				</tr>
			</thead>
			<tbody>";
			while ($result=$stmt->fetch()) {
				$input_coments = "<textarea class='form-control rounded input_coments' name='alumno_" . $Alumno_ID . "' id='alumno_" . $Alumno_ID . "' rows='2' " . $disabled . " >" . $coments_asesor . "</textarea>";

				$tabla.="
					<tr>
						<td>".$Alumno_nombre."</td>
						<td>".$problema1."</td>
						<td>".$problema2."</td>
						<td>".$conclusion."</td>
						<td>".$input_coments."</td>
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
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../sesiones/1.php?id=5'>";
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