<?php
include_once('../conexion.php');
include_once('../funciones.php');
if(isset($_SESSION['lang'])){
	require "../../lang/".$_SESSION["lang"].".php";
}else{
	require "../../lang/ES-MX.php";
}

function sanear_string($string){
	$string = trim($string);
	$string = str_replace(
		array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
		array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
		$string
	);
	$string = str_replace(
		array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
		array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
		$string
	);
	$string = str_replace(
		array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
		array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
		$string
	);
	$string = str_replace(
		array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
		array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
		$string
	);
	$string = str_replace(
		array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
		array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
		$string
	);
	$string = str_replace(
		array('ñ', 'Ñ', 'ç', 'Ç'),
		array('n', 'N', 'c', 'C',),
		$string
	);
	return $string;
}

if(isset($_POST['btn_subir_csv'])){
	if(is_uploaded_file($_FILES['upload']['tmp_name'])){
		$csv_file = fopen($_FILES['upload']['tmp_name'], 'r');
		$Admin_ID = $_SESSION["Admin_ID"];
		$Proyecto_ID = $_POST["select_proyectos2"];
		$plantilla_correcta = 0;
		$i=0;
		$j=0;
		while(($emp_record = fgetcsv($csv_file)) !== FALSE){
			if ($emp_record[0]=="Nombre") {
				$plantilla_correcta = 1;
			}
			if ($emp_record[0]!="Nombre" AND $plantilla_correcta==1) {
				$Grupo_nombre = (isset($emp_record[0])) ? utf8_encode(sanear_string($emp_record[0])) : null;
				if (isset($Grupo_nombre) AND $Grupo_nombre!="") {
					$stmt3 = $con->prepare("SELECT * FROM grupos WHERE Grupo_nombre = :Grupo_nombre");
					$stmt3->execute(array(':Grupo_nombre'=>$Grupo_nombre));
					$res = $stmt3->fetch();
					if($res == false){ //no existe grupo
						$stmt=$con->prepare("INSERT INTO grupos (Admin_ID, Proyecto_ID, Grupo_nombre, Grupo_estatus) VALUES (:Admin_ID, :Proyecto_ID, :Grupo_nombre, :Grupo_estatus)");
						$stmt->execute(array(':Admin_ID'=>$Admin_ID, ':Proyecto_ID'=>$Proyecto_ID, ':Grupo_nombre'=>$Grupo_nombre, ':Grupo_estatus'=>'activo'));
						$Grupo_ID = $con->lastInsertId();
						$stmt2=$con->prepare("INSERT INTO grupos_control (Grupo_ID) VALUES (:Grupo_ID)");
						$stmt2->execute(array(':Grupo_ID'=>$Grupo_ID));
						$i++;
					} else { // existe grupo
						$j++;
					}
				}
			}
		}
		fclose($csv_file);
		if ($i>0) {
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
								<p class="card-text"><?php echo $lang["registro_ok"] . " " . $i; ?></p>
								<p class="card-text"><?php echo $lang["registro_no_ok"] . " " . $j; ?></p>
								<div class="text-right mt-5"><a href="../../admin/grupos.php" class="btn btn-warning"><?php echo $lang["exito_btn"]; ?></a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			include_once('../../includes/footer.php');
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
								<?php if ($j>0) { ?>
									<p class="card-text"><?php echo $lang["registro_no_ok"] . " " . $j; ?></p>
								<?php } ?>
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
}
?>