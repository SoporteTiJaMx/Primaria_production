<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../conexion.php');
	include_once('../conexion2.php');
	if ($_SESSION['tipo'] == "Alumn") {
		$Empresa_ID = $_SESSION["Empresa_ID"];
	} else {
		$Empresa_ID = $_POST["Empresa_ID"];
	}
	$area_emp = $_POST["Area_empresa"];
	if ($_SESSION["tipo"]=="Volun") {
		$disabled="";
	} else {
		$disabled="disabled";
	}

	$arr = array('tabla' => '', 'coment' => '');
	if ($area_emp!='0') {
		$datos = mysqli_fetch_array(mysqli_query($con2, "SELECT coments_asesor FROM empresas_info_s5_5_coments WHERE Empresa_ID = ".$Empresa_ID." AND area_emp = '".$area_emp."' LIMIT 1"));
		$coments_asesor = $datos[0];
		$query = "SELECT * FROM empresas_info_s5_5 WHERE Empresa_ID=? AND area_emp=?";
		if ($stmt = $con->prepare($query)) {
			$stmt->bind_param("is", $Empresa_ID, $area_emp);
			$stmt->execute();
			$stmt->bind_result($empresas_info_s5_5_ID, $Empresa_ID, $area_emp, $num_objetivo, $objetivo);
			$tabla="<table class='table table-striped table-hover' id='s_5_6_table' style='width:100%'>";
			$tabla.="
				<thead>
					<tr>
						<th>No. Objetivo</th>
						<th>Objetivo</th>
						<th>Metas y Planes de Acción</th>
					</tr>
				</thead>
				<tbody>";
			while ($result=$stmt->fetch()) {
				$query2 = "SELECT num_meta, meta, plan_accion FROM empresas_info_s5_5_metas WHERE empresas_info_s5_5_ID=?";
				if ($stmt2 = $con2->prepare($query2)) {
					$stmt2->bind_param("i", $empresas_info_s5_5_ID);
					$stmt2->execute();
					$stmt2->bind_result($num_meta, $meta, $plan_accion);
					$tabla_metas="<table class='table table-striped table-hover'style='width:100%'>";
					$tabla_metas.="
						<thead>
							<tr>
								<th>No. Meta</th>
								<th>Meta</th>
								<th>Plan de Acción</th>
							</tr>
						</thead>
						<tbody>";
					while ($stmt2->fetch()) {
						if ($meta!="") {
							$tabla_metas.="
								<tr>
									<td>".$num_meta."</td>
									<td>".$meta."</td>
									<td>".$plan_accion."</td>
								</tr>
							";
						} else {
							$tabla_metas.="
								<tr>
									<td>".$num_meta."</td>
									<td colspan='2'>Aún no se ingresan Metas</td>
								</tr>
							";
						}
					}
					$tabla_metas.="</tbody>
						</table>";
					$stmt2->close();
				}
				$tabla.="
					<tr>
						<td>".$num_objetivo."</td>
						<td>".$objetivo."</td>
						<td>".$tabla_metas."</td>
					</tr>
				";
			}
		}
		$stmt->close();
		$tabla.="</tbody>
			</table>";
		$arr = array('tabla' => $tabla, 'coment' => $coments_asesor);
	} else {
		$arr = array('tabla' => '', 'coment' => '');
	}
	echo json_encode($arr);
} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../sesiones/5.php?id=5'>";
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