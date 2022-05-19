<?php
include_once('../funciones.php');
include_once('../conexion.php');
if(isset($_SESSION['lang'])){
	require "../../lang/".$_SESSION["lang"].".php";
}else{
	require "../../lang/ES-MX.php";
}
if(isset($_POST['btn_subir_csv'])){
	if(is_uploaded_file($_FILES['upload']['tmp_name'])){
		$csv_file = fopen($_FILES['upload']['tmp_name'], 'r');
		$Admin_ID = $_SESSION["Admin_ID"];
		$id_oficina_ja = $_SESSION["id_oficina_ja"];
		$Lenguaje = $_SESSION["oficina_ja_lang"];
		$plantilla_correcta = 0;
		$i=0;
		$j=0;
		while(($emp_record = fgetcsv($csv_file)) !== FALSE){
			if ($emp_record[0]=="Usuario" AND utf8_encode($emp_record[1])=="Contrasena" AND utf8_encode($emp_record[2])=="Correo") {
				$plantilla_correcta = 1;
			}
			if ($emp_record[0]!="Usuario" AND $plantilla_correcta==1) {
				$user = (isset($emp_record[0])) ? sanitizar($emp_record[0]) : null;
				$pass = (isset($emp_record[1])) ? sanitizar($emp_record[1]) : null;
				$pass=hash('sha512', $pass);
				$correo = (isset($emp_record[2])) ? sanitizar($emp_record[2]) : null;
				if ((isset($user) AND $user!="") AND (isset($emp_record[1]) AND $emp_record[1]!="") AND (isset($correo) AND $correo!="" AND filter_var($correo, FILTER_VALIDATE_EMAIL))) {

					$stmt2 = $con->prepare("SELECT * FROM usuarios WHERE user = :user");
					$stmt2->execute(array(':user'=>$user));
					$res = $stmt2->fetch();
					if($res == false){ //no existe usuario

						$stmt=$con->prepare("INSERT INTO usuarios (id_oficina_ja, user, pass, tipo, email, lang, estatus) VALUES (:id_oficina_ja, :user, :pass, :tipo, :email, :lang, :estatus)");
						$stmt->execute(array(':id_oficina_ja'=>$id_oficina_ja, ':user'=>$user, ':pass'=>$pass, ':tipo'=>'volun', ':email'=>$correo, ':lang'=>$Lenguaje, ':estatus'=>'activo'));
						$id_user = $con->lastInsertId();;

						$stmt=$con->prepare("INSERT INTO voluntarios (id_user, Admin_ID, Volunt_email, Volunt_estatus) VALUES (:id_user, :Admin_ID, :Volunt_email, :Volunt_estatus)");
						$stmt->execute(array(':id_user'=>$id_user, ':Admin_ID'=>$Admin_ID, ':Volunt_email'=>$correo, ':Volunt_estatus'=>'activo'));
						$i++;
					} else { // existe usuario
						$j++;
					}
				}
			}
		}
		fclose($csv_file);
		if ($i>0) {
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/voluntarios.php'>";
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
								<div class="text-right mt-5"><a href="../../admin/voluntarios.php" class="btn btn-warning"><?php echo $lang["exito_btn"]; ?></a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			include_once('../../includes/footer.php');
		} else {
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/voluntarios.php'>";
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
								<div class="text-right mt-5"><a href="../../admin/voluntarios.php" class="btn btn-warning"><?php echo $lang["error_btn"]; ?></a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			include_once('../../includes/footer.php');
		}
	} else {
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/voluntarios.php'>";
		include_once('../../includes/header.php');
		?>
		<div class="container h-100">
			<div class="row align-items-center h-100">
				<div class="col-6 mx-auto">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i><?php echo $lang["error_ttl"]; ?></h5>
							<p class="card-text"><?php echo $lang["error_txt"]; ?></p>
							<div class="text-right mt-5"><a href="../../admin/voluntarios.php" class="btn btn-warning"><?php echo $lang["error_btn"]; ?></a></div>
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