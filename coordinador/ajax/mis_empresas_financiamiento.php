<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	if (isset($_SESSION['Escuela_ID'])) {
		$query_acciones = "SELECT empresas.Empresa_ID, empresas.Empresa_nombre, empresas.Empresa_estatus, escuelas.Escuela_nombre FROM empresas LEFT JOIN escuelas ON escuelas.Escuela_ID = empresas.Escuela_ID LEFT JOIN licencia_empresa ON licencia_empresa.Empresa_ID = empresas.Empresa_ID WHERE licencia_empresa.Empresa_ID IN (SELECT Empresa_ID FROM licencia_empresa WHERE Escuela_ID = ?) AND empresas.Empresa_estatus='Activa' AND empresas.Empresa_ID IN (SELECT Empresa_ID FROM empresas_info_s3_7 WHERE financiamiento = 1) order by empresas.Empresa_nombre";
		$query_crowd = "SELECT empresas.Empresa_ID, empresas.Empresa_nombre, empresas.Empresa_estatus, escuelas.Escuela_nombre FROM empresas LEFT JOIN escuelas ON escuelas.Escuela_ID = empresas.Escuela_ID LEFT JOIN licencia_empresa ON licencia_empresa.Empresa_ID = empresas.Empresa_ID WHERE licencia_empresa.Empresa_ID IN (SELECT Empresa_ID FROM licencia_empresa WHERE Escuela_ID = ?) AND empresas.Empresa_estatus='Activa' AND empresas.Empresa_ID IN (SELECT Empresa_ID FROM empresas_info_s3_7 WHERE financiamiento = 2) order by empresas.Empresa_nombre";
		if ($stmt = $con->prepare($query_acciones)) {
			$stmt->bind_param("i", $_SESSION['Escuela_ID']);
			$stmt->execute();
			$stmt->bind_result($Empresa_ID, $Empresa_nombre, $Empresa_estatus, $Escuela_nombre);

			$select_empresa_acciones = "<option value='0'>Selecciona empresa</option>";
			while ($stmt->fetch()) {
				$select_empresa_acciones.="<option value=" . $Empresa_ID . ">" . $Empresa_nombre . " de " . $Escuela_nombre .  "</option>";
			}
			$stmt->close();
		}
		if ($stmt = $con->prepare($query_crowd)) {
			$stmt->bind_param("i", $_SESSION['Escuela_ID']);
			$stmt->execute();
			$stmt->bind_result($Empresa_ID, $Empresa_nombre, $Empresa_estatus, $Escuela_nombre);

			$select_empresa_crowdfunding = "<option value='0'>Selecciona empresa</option>";
			while ($stmt->fetch()) {
				$select_empresa_crowdfunding.="<option value=" . $Empresa_ID . ">" . $Empresa_nombre . " de " . $Escuela_nombre .  "</option>";
			}
			$stmt->close();
		}
	} else {
		$select_empresa_acciones = "<option value='0'>No tienes Empresas Juveniles en este ciclo del programa</option>";
		$select_empresa_crowdfunding = "<option value='0'>No tienes Empresas Juveniles en este ciclo del programa</option>";
	}
	$arr = array($select_empresa_acciones, $select_empresa_crowdfunding);
	echo json_encode($arr);
} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../coordinador.php'>";
	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../coordinador.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once('../../includes/footer.php');
}

?>