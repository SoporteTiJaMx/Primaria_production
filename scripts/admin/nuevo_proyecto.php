<?php
include_once('../funciones.php');
include_once('../conexion.php');
if(isset($_SESSION['lang'])){
	require "../../lang/".$_SESSION["lang"].".php";
}else{
	require "../../lang/ES-MX.php";
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST["csrf"]) && $_POST["csrf"] == $_SESSION["token"]) {
		$Admin_ID = $_SESSION["Admin_ID"];
		$Proyecto_nombre = (isset($_POST["name"])) ? sanitizar($_POST["name"]) : null;

		$stmt3 = $con->prepare("SELECT * FROM proyectos WHERE Proyecto_nombre = :Proyecto_nombre AND Admin_ID = :Admin_ID");
		$stmt3->execute(array(':Proyecto_nombre'=>$Proyecto_nombre, ':Admin_ID'=>$Admin_ID));
		$res = $stmt3->fetch();
		if($res == false){ //no existe proyecto
			$stmt=$con->prepare("INSERT INTO proyectos (Admin_ID, Proyecto_nombre, Proyecto_estatus) VALUES (:Admin_ID, :Proyecto_nombre, :Proyecto_estatus)");
			$stmt->execute(array(':Admin_ID'=>$Admin_ID, ':Proyecto_nombre'=>$Proyecto_nombre, ':Proyecto_estatus'=>'activo'));

			echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/patrocinadores.php'>";
			include_once('../../includes/header.php');
			?>
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<div class="card shadow">
							<div class="card-body">
								<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i><?php echo $lang["exito_ttl"]; ?></h5>
								<p class="card-text"><?php echo $lang["exito_txt"]; ?></p>
								<div class="text-right mt-5"><a href="../../admin/patrocinadores.php" class="btn btn-warning"><?php echo $lang["exito_btn"]; ?></a></div>
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
								<div class="text-right mt-5"><a href="../../admin/patrocinadores.php" class="btn btn-warning"><?php echo $lang["duplicado_btn"]; ?></a></div>
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
							<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i><?php echo $lang["error_ttl"]; ?></h5>
							<p class="card-text"><?php echo $lang["error_txt"]; ?></p>
							<div class="text-right mt-5"><a href="../../admin/patrocinadores.php" class="btn btn-warning"><?php echo $lang["error_btn"]; ?></a></div>
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
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i><?php echo $lang["no_access_ttl"]; ?></h5>
						<p class="card-text"><?php echo $lang["no_access_txt"]; ?></p>
						<div class="text-right mt-5"><a href="../../admin/patrocinadores.php" class="btn btn-warning"><?php echo $lang["no_access_btn"]; ?></a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include_once('../../includes/footer.php');
}
?>