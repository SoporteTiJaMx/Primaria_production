<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>JA Primaria</title>
	<link rel="icon" type="image/ico" href="images/favicon.ico">
	<link rel="stylesheet" href="css/fontawesome.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/estilos.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400" rel="stylesheet">
	<script src="js/popper.min.js" crossorigin="anonymous"></script>
	<script src="js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
	<script src="js/bootstrap.bundle.js" crossorigin="anonymous"></script>
	<script src="js/bootstrap.js" crossorigin="anonymous"></script>
</head>

<body class="background_gradient_new pt-5">
<?php
	session_start();
	$_SESSION["token"] = md5(uniqid(mt_rand(), true));
?>

	<div class="container-fluid">
		<div>
			<form action="scripts/acceso.php" method="post">
				<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">

				<div class="row pb-5">
					<div class="col-12 offset-lg-4 col-lg-4 text-center">
						<img src="images/logo_ja_blanco.png" alt="Logo JA México">
					</div>
				</div>
				<div class="row mx-3">
					<div class="col-12">
						<h4 class="text-center text-white text-spaced-3 pb-2">PROGRAMAS IMPULSA</h4>
						<h1 class="text-center text-white text-spaced-1 font-weight-bolder pb-4">JUNIOR ACHIEVEMENT PRIMARIA</h1>
						<h5 class="text-center text-white pb-2">Introduce tus datos de acceso para ingresar a la plataforma.</h5>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-12 offset-lg-3 col-lg-6">
						<div class="form-group">
							<label for="user" class="control-label text-white">USUARIO:</label>
							<div class="input-group">
								<input type="text" class="form-control rounded text-center" name="user" id="user" aria-describedby="user_help" required>
								<div class="input-group-append">
    								<div class="btn input-group-text bg-white">
      									<i class="fas fa-user-edit fa-lg fa-fw text-orange"></i>
									</div>
  								</div>
							</div>
							<small id="user_help" class="form-text text-white w200 text-center">Introduce tu usuario registrado</small>
						</div>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-12 offset-lg-3 col-lg-6">
						<div class="form-group">
							<label for="pass" class="control-label text-white">CONTRASEÑA:</label>
							<div class="input-group">
								<input type="password" class="form-control rounded text-center" name="pass" id="pass" aria-describedby="pass_help" required>
  								<div class="input-group-append" data-toggle="tooltip" data-placement="bottom" title="Mostrar/Ocultar Contraseña">
    								<a class="btn input-group-text bg-light" onclick="showpass()">
      									<i class="fas fa-eye-slash fa-lg fa-fw text-orange" id="show-pass"></i>
									</a>
  								</div>
							</div>
							<small id="pass_help" class="form-text text-white w200 text-center">Introduce tu contraseña</small>
						</div>
					</div>
				</div>

				<div class="row mb-2">
					<div class="offset-3 col-6 offset-lg-4 col-lg-4">
						<input type="submit" class="btn btn-warning btn-block" name="submit" id="submit" formaction="scripts/acceso.php" value="Ingresar al portal" style="text-align: center;">
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-6 offset-lg-3 col-lg-3">
						<input type="button" class="btn btn-link btn-block btn-sm text-white" data-toggle="modal" data-target='#emailsend' name="usr_pss" id="usr_pss" value="Recupera tu usuario y contraseña" style="text-align: center;">
					</div>
					<div class="col-6 col-lg-3">
						<input type="button" class="btn btn-link btn-block btn-sm text-white" data-toggle="modal" data-target='#emailsend' name="pss" id="pss" value="Recupera tu contraseña" style="text-align: center;">
					</div>
				</div>

		 </form>
		<!-- Modal recuperar contraseña-->
		<div class="modal fade" tabindex="-1" id="emailsend" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form role="form" action="cambiar_usr_pss.php" method="post">
						<div class="modal-body">
							<div class="text-center mb-3"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto"></div></div>
							<div class="form-row pb-1">
								<div class="form-group col-2"></div>
								<div class="form-group col-8">
									<input name="tipo_cambio" type="hidden" id="tipo_cambio" value="">
										<div>
											<label for="inputEmail" class="control-label text-dark-gray">Correo:</label>
											<input type="text" class="form-control rounded text-center" name="inputEmail" id="inputEmail" aria-describedby="inputEmail_help" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
											<small id="inputEmail_help" class="form-text text-dark-gray w200">Ingresa tu correo electrónico</small>
										</div>
									</div>
									<?php $validaciones[] = array('inputEmail', 'Email_input', "'Ingresar un correo electrónico válido.'"); ?>
									<div class="form-group col-2"></div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<input type="submit" class="btn btn-warning" formaction="cambiar_usr_pss.php" value="Enviar" style="text-align: center;">
								</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#usr_pss').click(function(){
			$('#emailsend .modal-title').text('Recupera tu usuario y tu contraseña');
			$('#tipo_cambio').val('usr_pss');
			$('#error').removeClass('animated');
			$('#error').removeClass('shake');
			$('#error').hide();
			$('#inputEmail').removeClass('input_error');
			$('#inputEmail').val('');
		})

		$('#pss').click(function(){
			$('#emailsend .modal-title').text('Recupera tu contraseña');
			$('#tipo_cambio').val('pss');
			$('#error').removeClass('animated');
			$('#error').removeClass('shake');
			$('#error').hide();
			$('#inputEmail').removeClass('input_error');
			$('#inputEmail').val('');
		})
	});


	// Funciones de validación
		var error = document.getElementById('error');
<?php
		for ($i = 0; $i <= sizeof($validaciones) - 1; $i++) {
				echo "var " . $validaciones[$i][1] . " = document.getElementById('" . $validaciones[$i][0] . "');";
				echo $validaciones[$i][1] . ".addEventListener('invalid', function(event){
						event.preventDefault();
						if (! event.target.validity.valid) {
								error.textContent	 = " . $validaciones[$i][2] . ";
								error.style.display = 'block';
								error.classList.add('animated');
								error.classList.add('shake');
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
?>
function showpass(){
	var estado = document.getElementById("pass").type;
	if (estado=="text") {
		$("#pass").attr("type", "password");
		$("#show-pass").attr("class", "fas fa-eye-slash fa-lg fa-fw text-orange");
	}else{
		$("#pass").attr("type", "text");
		$("#show-pass").attr("class", "fas fa-eye fa-lg fa-fw text-orange");
	}
}
</script>

</body>
</html>