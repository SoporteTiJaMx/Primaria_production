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
		$Proyecto_ID = $_POST["select_proyectos"];
		$Grupo_nombre = (isset($_POST["name"])) ? sanitizar($_POST["name"]) : null;

		$stmt3 = $con->prepare("SELECT * FROM grupos WHERE Grupo_nombre = :Grupo_nombre");
		$stmt3->execute(array(':Grupo_nombre'=>$Grupo_nombre));
		$res = $stmt3->fetch();
		if($res == false){ //no existe grupo
			$stmt=$con->prepare("INSERT INTO grupos (Admin_ID, Proyecto_ID, Grupo_nombre, Grupo_estatus) VALUES (:Admin_ID, :Proyecto_ID, :Grupo_nombre, :Grupo_estatus)");
			$accion = $stmt->execute(array(':Admin_ID'=>$Admin_ID, ':Proyecto_ID'=>$Proyecto_ID, ':Grupo_nombre'=>$Grupo_nombre, ':Grupo_estatus'=>'activo'));
			$Grupo_ID = $con->lastInsertId();
			$stmt2=$con->prepare("INSERT INTO grupos_control (Grupo_ID) VALUES (:Grupo_ID)");
			$accion2 = $stmt2->execute(array(':Grupo_ID'=>$Grupo_ID));

			if ($accion == 2) {
				echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/grupos.php'>";
				include_once('../../includes/header.php');
				?>
				<div class="container h-100">
					<div class="row align-items-center h-100">
						<div class="col-6 mx-auto">
							<div class="card shadow">
								<div class="card-body">
									<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i><?php echo $lang["exito_ttl"]; ?></h5>
									<p class="card-text"><?php echo $lang["exito_txt"]; ?></p>
									<div class="text-right mt-5"><a href="../../admin/grupos.php" class="btn btn-warning"><?php echo $lang["exito_btn"]; ?></a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				include_once('../../includes/footer.php');
			}else{
				echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/grupos.php'>";
				include_once('../../includes/header.php');
				?>
				<div class="container h-100">
					<div class="row align-items-center h-100">
						<div class="col-6 mx-auto">
							<div class="card shadow">
								<div class="card-body">
									<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i><?php echo $lang["error_ttl"]; ?></h5>
									<p class="card-text"><?php echo $lang["error_txt"]; ?></p>
									<div class="text-right mt-5"><a href="../../admin/grupos.php" class="btn btn-warning"><?php echo $lang["error_btn"]; ?></a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				include_once('../../includes/footer.php');
			}
		} else { //grupo existente, riesgo de duplicidad
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='10;URL=../../admin/grupos.php'>";
			include_once('../../includes/header.php');
			?>
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<div class="card shadow">
							<div class="card-body">
								<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i><?php echo $lang["duplicado_ttl"]; ?></h5>
								<p class="card-text"><?php echo $lang["duplicado_txt"]; ?></p>
								<div class="text-right mt-5"><a href="../../admin/grupos.php" class="btn btn-warning"><?php echo $lang["duplicado_btn"]; ?></a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			include_once('../../includes/footer.php');
		}

	} else {
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/grupos.php'>";
		include_once('../../includes/header.php');
		?>
		<div class="container h-100">
			<div class="row align-items-center h-100">
				<div class="col-6 mx-auto">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i><?php echo $lang["error_ttl"]; ?></h5>
							<p class="card-text"><?php echo $lang["error_txt"]; ?></p>
							<div class="text-right mt-5"><a href="../../admin/grupos.php" class="btn btn-warning"><?php echo $lang["error_btn"]; ?></a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		include_once('../../includes/footer.php');
	}
} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/grupos.php'>";
	include_once('../../includes/header.php');
	?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i><?php echo $lang["no_access_ttl"]; ?></h5>
						<p class="card-text"><?php echo $lang["no_access_txt"]; ?></p>
						<div class="text-right mt-5"><a href="../../admin/grupos.php" class="btn btn-warning"><?php echo $lang["no_access_btn"]; ?></a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include_once('../../includes/footer.php');
}
?>