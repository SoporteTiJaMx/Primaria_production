<?php
include_once('../funciones.php');
include_once('../conexion.php');
/* if(isset($_SESSION['lang'])){
	require "../../lang/".$_SESSION["lang"].".php";
}else{
	require "../../lang/ES-MX.php";
} */

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST["csrf"]) && $_POST["csrf"] == $_SESSION["token"]) {
		//$Admin_ID = $_SESSION["Admin_ID"];
		$Proyecto_nombre = (isset($_POST["name"])) ? sanitizar($_POST["name"]) : null;
		$centro_ID = (isset($_POST["centro_ID"])) ? sanitizar($_POST["centro_ID"]) : null;

		$stmt3 = $con->prepare("SELECT * FROM proyectos WHERE Proyecto_nombre = ?");
		$stmt3 ->bind_param("s", $Proyecto_nombre);
		$stmt3->execute();
		$res = $stmt3->fetch();
		$estatus = "Activo";
		if($res == false){ //no existe proyecto
			$stmt=$con->prepare("INSERT INTO proyectos (Proyecto_nombre, Proyecto_estatus) VALUES (?, ?)");
			$stmt->bind_param("ss", $Proyecto_nombre, $estatus);
			$stmt->execute();
			$stmt->close();
			$stmt_id=$con->prepare("SELECT Proyecto_ID FROM proyectos WHERE Proyecto_nombre = ?");
			$stmt_id -> bind_param("s", $Proyecto_nombre);
			$stmt_id -> execute();
			$stmt_id -> bind_result($id);
			$stmt_id->fetch();
			$stmt_id -> close();
			$stmt_p = $con->prepare("INSERT INTO centro_proyecto (Centro_ID, Proyecto_ID) VALUES (?, ?)");
			$stmt_p -> bind_param("ii", $centro_ID, $id);
			$stmt_p -> execute();
			$stmt_p -> close();
			$stmt_prog = $con->prepare("INSERT INTO proyecto_programa (Proyecto_ID) VALUES (?)");
			$stmt_prog -> bind_param("i", $id);
			$stmt_prog -> execute();
			$stmt_prog -> close();
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
								<p class="card-text">Este nombre de proyecto ya se encuentra registrado en el portal. Favor de modificarlo para su registro.</p>
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