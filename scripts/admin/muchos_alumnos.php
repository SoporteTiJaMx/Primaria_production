<?php
include_once('../funciones.php');
include_once('../conexion.php');
include_once('../conexion2.php');

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
		$id_oficina_ja = $_SESSION["centro_ID"];
		$Grupo_ID = $_POST["select_grupos"];
		//$Lenguaje = $_SESSION["oficina_ja_lang"];
		$plantilla_correcta = 0;
		$i=0;
		$j=0;
		while(($emp_record = fgetcsv($csv_file)) !== FALSE){
			if ($emp_record[0]=="Usuario" AND utf8_encode($emp_record[1])=="Contrasena" AND utf8_encode($emp_record[2])=="Correo" AND $emp_record[3]=="Nombre") {
				$plantilla_correcta = 1;
			}
			if ($emp_record[0]!="Usuario" AND $plantilla_correcta==1) {
				$user = (isset($emp_record[0])) ? sanitizar($emp_record[0]) : null;
				$pass = (isset($emp_record[1])) ? sanitizar($emp_record[1]) : null;
				$pass=password_hash($pass, PASSWORD_DEFAULT);
				$correo = (isset($emp_record[2])) ? sanitizar($emp_record[2]) : null;
				$nombre = (isset($emp_record[3])) ? utf8_encode(sanear_string($emp_record[3])) : null;
				$date_creacion = date("Y-m-d h:i:s");
				$langu = "ES-MX";
				$alumno_subs=0;
				$alumno_estatus=0;
				$accesos=0;
				$tipo="Alumn";
				if ((isset($user) AND $user!="") AND (isset($emp_record[1]) AND $emp_record[1]!="") AND (isset($correo) AND $correo!="")) {

					$stmt3 = $con->prepare("SELECT * FROM usuarios WHERE Usuario = ?");
					$stmt3 -> bind_param("s", $user);
					$stmt3 -> execute();
					$res = $stmt3->fetch();
					if($res == false){ //no existe usuario
						$stmt=$con2->prepare("INSERT INTO usuarios (Usuario, Contrasena, Tipo, Creado, Num_accesos, lang) VALUES (?, ?, ?, ?, ?, ?)");
						$stmt->bind_param("ssssis", $user, $pass, $tipo, $date_creacion, $accesos, $langu);
						$stmt->execute();
						$stmt->close();
						$stmt = $con2->prepare("SELECT User_ID FROM usuarios WHERE Usuario = ".$user."");
						//$id_user = $con2->lastInsertId();;
						$stmt->execute();
						$stmt->bind_result($id_user);
						$stmt->close();

						/* $stmt=$con2->prepare("INSERT INTO alumnos (User_ID, Centro_ID, Grupo_ID, Alumno_nombre, Alumno_email, Alumno_subseccion, Alumno_estatus) VALUES (?, ?, ?, ?, ?, ?, ?)");
						$stmt->bind_param("iiissii", $id_user, $id_oficina_ja, $Grupo_ID, $nombre, $correo, $alumno_subs, $alumno_estatus);
						$stmt->execute();
						$stmt->close(); */
						$i++;
					} else { // existe usuario
						$j++;
					}
				}
			}
		}
		fclose($csv_file);
		if ($i>0) {
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='10;URL=../../admin/alumnos.php'>";
			include_once('../../includes/header.php');
			?>
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<div class="card shadow">
							<div class="card-body">
								<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Todo salió bien</h5>
								<p class="card-text">Se cargó el archivo con éxtio</p>
								<p class="card-text">Alumnos registrados con éxito:<?php echo " " . $i; ?></p>
								<p class="card-text">Hubo error en:<?php echo " " . $j; ?></p>
								echo "Hola homs". $csv_file . "_" . $Grupo_ID . "_" . $id_oficina_ja . "_" . $langu . "_" . $pass . "_" . $nombre . "_" . $correo . "_" . $alumno_estatus . " _ " . $user . "  " . "_-_-_ ". $i. "_-_-_ ". $id_user;
								<div class="text-right mt-5"><a href="../../admin/alumnos.php" class="btn btn-warning">Regresar</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			include_once('../../includes/footer.php');
		} else {
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='10;URL=../../admin/alumnos.php'>";
			include_once('../../includes/header.php');
			?>
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<div class="card shadow">
							<div class="card-body">
								<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ocurrió un error</h5>
								<p class="card-text">Error al cargar el archivo</p>
								<?php 
								echo "Hola homs". $csv_file . "_" . $Grupo_ID . "_" . $id_oficina_ja . "_" . $langu . "_" . $pass . "_" . $nombre . "_" . $correo . "_" . $alumno_estatus . " _ " . $user . "  " . "_-_-_ ". $i. "_-_-_ ". $id_user;
								?>
								<?php if ($j>0) { ?>
									<p class="card-text">Hubo error en:<?php echo " " . $j. " "; ?> casos</p>
								<?php } ?>
								<div class="text-right mt-5"><a href="../../admin/alumnos.php" class="btn btn-warning">Regresar</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			include_once('../../includes/footer.php');
		}
	} else {
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/alumnos.php'>";
		include_once('../../includes/header.php');
		?>
		<div class="container h-100">
			<div class="row align-items-center h-100">
				<div class="col-6 mx-auto">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ocurrió un error</h5>
							<p class="card-text">Hubo un error, por favor comunícate con un administrador de JA</p>
							<div class="text-right mt-5"><a href="../../admin/alumnos.php" class="btn btn-warning">Regresar</a></div>
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