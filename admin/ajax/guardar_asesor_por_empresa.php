<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');
	include_once('../../scripts/conexion2.php');

	$Licencia_ID = $_POST['Licencia_ID'];
	$Array_asesor_por_empresa = $_POST['Array_asesor_por_empresa'];
	$No_IDs = sizeof($Array_asesor_por_empresa);
	$Array_asesor_por_empresa[0][0];
	$query = "UPDATE empresas SET Asesor_ID=? WHERE Empresa_ID=?";
	if ($stmt = $con->prepare($query)) {
		for ($i=0; $i < $No_IDs; $i++) {
			$Asesor_ID = $Array_asesor_por_empresa[$i][1];
			$Empresa_ID = substr($Array_asesor_por_empresa[$i][0], 7);
			$stmt->bind_param("ii", $Asesor_ID, $Empresa_ID);
			$r = mysqli_fetch_array(mysqli_query($con2, "SELECT Asesor_ID FROM empresas WHERE Empresa_ID=$Empresa_ID"));
			//$r[0]; //Asesor actual de la Empresa_ID
			if ($r[0]!=$Asesor_ID AND $Asesor_ID>0) {
				$resultado = mysqli_query($con2, "SELECT Asesor_ID, Asesor_nombre, Asesor_ap_paterno, Asesor_email FROM asesores WHERE Asesor_ID=$Asesor_ID");
				$fila = mysqli_fetch_array($resultado);
				$resultado2 = mysqli_query($con2, "SELECT empresas.Empresa_ID, empresas.Escuela_ID, empresas.Empresa_nombre, escuelas.Escuela_nombre FROM empresas LEFT JOIN escuelas ON escuelas.Escuela_ID = empresas.Escuela_ID WHERE Empresa_ID=$Empresa_ID");
				$fila2 = mysqli_fetch_array($resultado2);
				$stmt->execute(); // Para localhost

				$_SESSION["to_mail"] = $fila[3];
				$_SESSION["nombre_mail"] = $fila[1] . " " . $fila[2];
				$_SESSION["subject"] = "JA México - Nueva empresa juvenil asignada";
				$_SESSION["html_title"] = "JA México te ha asignado una Empresa Juvenil para tu asesoría.";
				$_SESSION["html_parr1"] = "Este Empresa Juvenil es " . $fila2[2] . " de la Escuela " . $fila2[3] . ".";
				$_SESSION["html_parr2"] = "Ingresa al portal de Emprendedores y Empresarios para comenzar a interactuar con estos jóvenes emprendedores. Puedes acceder desde esta <a href='http://emprendedoresyempresarios.org.mx/' target='_blank'>liga</a>.";
				$_SESSION["html_parr3"] = "JA México te agradece tu disposición y experiencia para estas importantes asesorías, formando a los emprendedores de nuesro país.";
				include_once('../../scripts/mailer_pre.php');
				include('../../scripts/mailer_post.php');
				//$stmt->execute(); //Para web
			} else if ($Asesor_ID==0) {
				$stmt->execute();
			}
		}
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