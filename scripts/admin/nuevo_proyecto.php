<?php
include_once('../funciones.php');
include_once('../conexion.php');
/* if(isset($_SESSION['lang'])){
	require "../../lang/".$_SESSION["lang"].".php";
}else{
	require "../../lang/ES-MX.php";
} */

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if ((isset($_POST["csrf"]) && $_POST["csrf"] == $_SESSION["token"]) AND isset($_POST["name"])) {
		//$Admin_ID = $_SESSION["Admin_ID"];
		$Escuela_ID = (isset($_POST["select_escuela_1"])) ? sanitizar($_POST["select_escuela_1"]) : null;
		$centro_ID = (isset($_POST["centro_ID"])) ? sanitizar($_POST["centro_ID"]) : null;
		$Proyecto_nombre = (isset($_POST["name"])) ? sanitizar($_POST["name"]) : null;

		$stmt3 = $con->prepare("SELECT * FROM proyectos WHERE Proyecto_nombre = ? AND Escuela_ID = ?");
		$stmt3 ->bind_param("si", $Proyecto_nombre, $Escuela_ID);
		$stmt3->execute();
		$res = $stmt3->fetch();
		$estatus = "Activo";
		if($res == false){ //no existe proyecto
			$stmt=$con->prepare("INSERT INTO proyectos (Proyecto_nombre, Proyecto_estatus, Escuela_ID) VALUES (?, ?, ?)");
			$stmt->bind_param("ssi", $Proyecto_nombre, $estatus, $Escuela_ID);
			$stmt->execute();
			$stmt->close();
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/patrocinadores.php'>";
			include_once('../../includes/header.php');
			?>
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<div class="card shadow">
							<div class="card-body">
								<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Datos guardados exitosamente.</h5>
								<p class="card-text">El proyecto se registró exitosamente. En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
								<div class="text-right mt-5"><a href="../../admin/patrocinadores.php" class="btn btn-warning">Ir</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			include_once('../../includes/footer.php');
		} else { //proyecto existente, riesgo de duplicidad
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='10;URL=../../admin/patrocinadores.php'>";
			include_once('../../includes/header.php');
			?>
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<div class="card shadow">
							<div class="card-body">
								<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Nombre de proyecto duplicado</h5>
								<p class="card-text">Este nombre de proyecto ya se encuentra asociado a esa escuela en el portal. Favor de modificarlo para su registro.</p>
								<div class="text-right mt-5"><a href="../../admin/patrocinadores.php" class="btn btn-warning">Regresar</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			include_once('../../includes/footer.php');
		}

	} else {
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/patrocinadores.php'>";
		include_once('../../includes/header.php');
		?>
		<div class="container h-100">
			<div class="row align-items-center h-100">
				<div class="col-6 mx-auto">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ha ocurrido un error.</h5>
							<p class="card-text">No se han podido almacenar los datos en la plataforma. Si el error persiste por favor avisa al administrador de JA México.</p>
							<div class="text-right mt-5"><a href="../../admin/patrocinadores.php" class="btn btn-warning">Regresar</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		include_once('../../includes/footer.php');
	}
} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/patrocinadores.php'>";
	include_once('../../includes/header.php');
	?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../admin/patrocinadores.php" class="btn btn-warning">Regresar a sección previa</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include_once('../../includes/footer.php');
}
?>