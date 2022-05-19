<?php
include_once('../conexion.php');
include_once('../funciones.php');
if(isset($_SESSION['lang'])){
	require "../../lang/".$_SESSION["lang"].".php";
}else{
	require "../../lang/ES-MX.php";
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST["csrf"]) && $_POST["csrf"] == $_SESSION["token"]) {
		$Admin_ID = $_SESSION["Admin_ID"];
		$Patroc_nombre = (isset($_POST["nombre"])) ? sanitizar($_POST["nombre"]) : null;

		$stmt3 = $con->prepare("SELECT * FROM patrocinadores WHERE Patroc_nombre = :Patroc_nombre AND Admin_ID = :Admin_ID");
		$stmt3->execute(array(':Patroc_nombre'=>$Patroc_nombre, ':Admin_ID'=>$Admin_ID));
		$res = $stmt3->fetch();
		if($res == false){ //no existe patrocinador
			$stmt=$con->prepare("INSERT INTO patrocinadores (Admin_ID, Patroc_nombre, Patroc_estatus) VALUES (:Admin_ID, :Patroc_nombre, :Patroc_estatus)");
			$stmt->execute(array(':Admin_ID'=>$Admin_ID, ':Patroc_nombre'=>$Patroc_nombre, ':Patroc_estatus'=>'activo'));
			$Patroc_ID = $con->lastInsertId();

			$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/patrocinadores/";
			$image_name = $Patroc_ID . ".png";
			$file_tmp = $_FILES['upload']['tmp_name'];
			$file_real = $target_dir . $image_name;
			move_uploaded_file($file_tmp, $file_real);

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
		} else { //patrocinador existente, riesgo de duplicidad
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='10;URL=../../admin/patrocinadores.php'>";
			include_once('../../includes/header.php');
			?>
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<div class="card shadow">
							<div class="card-body">
								<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Nombre de patrocinador duplicado</h5>
								<p class="card-text">Este nombre de patrocinador ya se encuentra registrado en el portal. Favor de modificarlo para su registro.</p>
								<div class="text-right mt-5"><a href="../../admin/patrocinadores.php" class="btn btn-warning"><?php echo $lang["duplicado_btn"]; ?></a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			include_once('../../includes/footer.php');
		}
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