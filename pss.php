<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Emprendedores y Empresarios</title>
	<link rel="icon" type="image/ico" href="images/favicon.ico">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="css/animate.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400" rel="stylesheet">
	<script src="js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
	<script src="js/bootstrap.bundle.js" crossorigin="anonymous"></script>
	<script src="js/bootstrap.js" crossorigin="anonymous"></script>
</head>

<body class="background_gradient pt-5">
<?php
	include_once('scripts/conexion.php');
	session_start();
	$_SESSION["token"] = md5(uniqid(mt_rand(), true));
	if (isset($_GET["ID"]) and $_GET["ID"] != "") {
		$ID_nuevo_usuario = $_GET["ID"];
		$result = mysqli_query($con, "SELECT * FROM usuarios WHERE Temp_pss='".mysqli_real_escape_string($con, $ID_nuevo_usuario)."'");
		if (mysqli_num_rows($result) != 0) {
			$row = mysqli_fetch_array($result);
			$User_ID = $row['User_ID'];
			$tipo = $row['Tipo'];
			if($tipo == "Sadmin"){ //Superadministrador
				$BD = "superadmins";
				$prefix = "Sadmin_";
			} else if($tipo == "Admin"){ //Administrador
				$BD = "administradores";
				$prefix = "Admin_";
			} else if($tipo == "Vincu"){ //Vinculador escolar
				$BD = "vinculadores";
				$prefix = "Vincul_";
			} else if($tipo == "Coord"){ //Coordinador
				$BD = "coordinadores";
				$prefix = "Coord_";
			} else if($tipo == "Volun"){ //Asesores
				$BD = "asesores";
				$prefix = "Asesor_";
			} else if($tipo == "Alumn"){ //Alumnos
				$BD = "alumnos";
				$prefix = "Alumno_";
			}
			$result = mysqli_query($con, "SELECT * FROM " . $BD . " WHERE User_ID=" . $User_ID);
			$row = mysqli_fetch_array($result);
			$nombre = $row[$prefix . 'nombre'];
			$ap_paterno = $row[$prefix . 'ap_paterno'];
			$email = $row[$prefix . 'email'];
			?>

				<div class="container-fluid">
					<div>
						<?php /*<form action="https://emprendedoresyempresarios.org.mx/scripts/pss.php" method="post" id="form_pss">*/ ?>
						<form action="http://localhost/eye/scripts/pss.php" method="post" id="form_pss">
							<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
								<input name="User_ID" type="hidden" id="User_ID" value="<?php echo $User_ID; ?>">
							<div class="row pb-5">
								<div class="col"></div>
								<div class="col">
									<img class="img-fluid" src="images/logo_ja_blanco.png" alt="Logo JA M??xico">
								</div>
								<div class="col"></div>
							</div>
							<h4 class="text-center text-white text-spaced-3 pb-2">PROGRAMAS IMPULSA</h4>
							<h1 class="text-center text-white text-spaced-1 font-weight-bolder pb-4">EMPRENDEDORES Y EMPRESARIOS</h1>
							<h5 class="text-center text-white pb-2">Bienvenido(a) <?php echo $nombre . " " . $ap_paterno?>. Personaliza tu contrase??a para ingresar a la plataforma.</h5>
							<div class="row">
								<div class="col-3"></div>
								<div id="error" display="none" class="col-6 d-flex justify-content-center bg-warning text-white text-center"></div>
								<div class="col-3"></div>
							</div>

							<div class="row mb-2 mt-3">
								<div class="col-3"></div>
								<div class="col-6">
									<div class="form-group">
										<label for="pass" class="control-label text-white">CONTRASE??A:</label>
										<input type="password" name="pass" id="pass" placeholder="Personaliza tu contrase??a de acceso" class="form-control rounded text-center" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{7,}$" aria-describedby="user_help" required>
										<small id="user_help" class="form-text text-white w300 text-center">Debe tener al menos 8 caracteres, letras o n??meros, iniciando con letra. No caracteres especiales</small>
									</div>
										<?php $validaciones[] = array('pass', 'pass_input', "'Error en Contrase??a. Debe tener al menos 8 caracteres, letras o n??meros, iniciando con letra.'"); ?>
								</div>
								<div class="col-3"></div>
							</div>
							<div class="row mb-2">
								<div class="col-3"></div>
								<div class="col-6">
									<div class="form-group">
										<label for="pass2" class="control-label text-white">CONTRASE??A:</label>
										<input type="password" name="pass2" id="pass2" placeholder="Reescribe tu contrase??a" class="form-control rounded text-center" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{7,}$" aria-describedby="user_help" required>
										<small id="user_help" class="form-text text-white w300 text-center">Debe coincidir con la contrase??a anterior.</small>
									</div>
									<?php $validaciones[] = array('pass2', 'pass2_input', "'Error en Contrase??a 2. Debe tener al menos 8 caracteres, letras o n??meros, iniciando con letra y coincidir con la contrase??a anterior.'"); ?>
								</div>
								<div class="col-3"></div>
							</div>

							<div class="row mb-2">
								<div class="col"></div>
								<div class="col text-center">
									<button type="submit" class="btn btn-warning text-center px-5 my-2" onclick="validar_pass()" name="personalizar" id="personalizar">Personaliza tu contrase??a</button>
								</div>
								<div class="col"></div>
							</div>
					 </form>
					</div>
				</div>

			<?php
		} else {
			include_once('includes/header.php');
			?>

			<div class='container h-100'>
				<div class='row align-items-center h-100'>
					<div class='col-6 mx-auto'>
						<div class='card shadow'>
						<div class='card-body'>
						<h5 class='card-title mb-5 align-middle'><i class='fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green'></i>Datos err??neos.</h5>
						<p class='card-text'>Los datos con los que intentas resetear tu acceso han caducado. Es posible que hayas recibido un correo posterior o que ya hayas establecido tus datos de acceso.</p>
						<p class='card-text'>Accede al portal <a href="index.php">aqu??</a> o ponte en contacto con el administrador del programa.</p>
						<p class='card-text'>Da click en el bot??n para dirigirte al acceso.</p>
						<div class='text-right mt-5'><a href='index.php' class='btn btn-warning'>Ir</a></div>
						</div>
						</div>
					</div>
				</div>
			</div>

			<?php
			include_once('includes/footer.php');
		}
	} else {
		include_once('includes/header.php');
		?>

		<div class='container h-100'>
			<div class='row align-items-center h-100'>
				<div class='col-6 mx-auto'>
				<div class='card shadow'>
				<div class='card-body'>
				<h5 class='card-title mb-5 align-middle'><i class='fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green'></i>Datos err??neos.</h5>
				<p class='card-text'>Los datos con los que intentas resetear tu acceso han caducado. Es posible que hayas recibido un correo posterior o que ya hayas establecido tus datos de acceso.</p>
				<p class='card-text'>Accede al portal <a href="index.php">aqu??</a> o ponte en contacto con el administrador del programa.</p>
				<p class='card-text'>Da click en el bot??n para dirigirte al acceso.</p>
				<div class='text-right mt-5'><a href='index.php' class='btn btn-warning'>Ir</a></div>
				</div>
				</div>
				</div>
			</div>
		</div>

		<?php
		include_once('includes/footer.php');
	}

?>

</body>

<script language = "javascript" type = "text/javascript">
	var error = document.getElementById('error');
<?php
	if (isset($validaciones)) {
	for ($i = 0; $i <= sizeof($validaciones) - 1; $i++) {
		echo "var " . $validaciones[$i][1] . " = document.getElementById('" . $validaciones[$i][0] . "');";
		echo $validaciones[$i][1] . ".addEventListener('invalid', function(event){
			event.preventDefault();
			if (! event.target.validity.valid) {
				error.textContent	= " . $validaciones[$i][2] . ";
				error.style.display = 'block';
				error.classList.add('animated');
				error.classList.add('shake');
				error.classList.add('py-2');
				" . $validaciones[$i][1] . ".classList.add('input_error');
			}
		});

		" . $validaciones[$i][1] . ".addEventListener('input', function(event){
			if ( 'block' === error.style.display ) {
				error.style.display = 'none';
				error.classList.remove('animated');
				error.classList.remove('shake');
			" . $validaciones[$i][1] . ".classList.remove('input_error');
			}
		});
		";
	}
	}
 ?>

	function validar_pass() {
		var pass = document.getElementById('pass').value;
		var pass2 = document.getElementById('pass2').value;
		if (pass == "") {
			var form = document.getElementById("form_usr_pss");
			form.onsubmit = function(e){
				e.preventDefault();
			}
		} else if (pass != pass2) {
			error.textContent = 'Las contrase??as deben coincidir';
			error.style.display = 'block';
			error.classList.add('invalid');
			error.classList.add('animated');
			error.classList.add('shake');
			error.classList.add('py-2');
			pass_input.classList.add('input_error');
			pass2_input.classList.add('input_error');
			var form = document.getElementById("form_usr_pss");
			form.onsubmit = function(e){
				e.preventDefault();
			}
		} else {
			document.getElementById("form_pss").submit();
		}

	}
</script>

</html>