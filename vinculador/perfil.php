<?php
	include_once('../includes/vinculador_header.php');
	include_once('../scripts/funciones.php');
	include_once('../vinculador/side_navbar.php');

	if ($_SESSION["tipo"] != 'Vincu') {
		header('Location: ../error.php');
	} else {

	$_SESSION["token"] = md5(uniqid(mt_rand(), true));

	$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/perfiles/";
	if (is_file($target_dir . $_SESSION["User_ID"] . '.jpg')) {
		$avatar = $RAIZ_SITIO . "images/perfiles/" . $_SESSION["User_ID"] . '.jpg';
	} else {
		$avatar = $RAIZ_SITIO . "images/perfiles/" . 'perfil.png';
	}

	$cumple = $_SESSION['cumple'];
	if ($_SESSION['cumple'] == "0000-00-00") {
		$hoy = date('Y-m-d');
		$nuevafecha = strtotime ('-18 year' , strtotime($hoy));
		$nuevafecha = date ('Y-m-d',$nuevafecha);
		$cumple = $nuevafecha;
	}
?>

<div class="toast" data-delay="5000" style="position: fixed; top: 10%; right: 2%; z-index: 2000;">
	<div class="toast-header">
		<strong class="mr-auto text-primary">¡Actualiza tu perfil!</strong>
		<small class="text-muted"></small>
		<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
	</div>
	<div class="toast-body">
		<p>Da click en el botón <span class="badge badge-warning text-center px-3 py-2">Modificar perfil</span> de abajo.</p>
		<p>Los campos marcados con ** son obligatorios.</p>
	</div>
</div>

<div class="mx-5 px-5 mt-3 mb-5 pb-5">

	<div class="card shadow">
		<div class="card-header text-center text-dark-gray text-spaced-3">PERFIL DE COORDINADOR</div>
		<div class="card-body">

			<form action="<?php echo $RAIZ_SITIO; ?>scripts/vinculador/modificar_perfil.php" method="post" class="mt-1" enctype="multipart/form-data">
				<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">

				<div class="col-12 text-center">
					<img src="<?php echo $avatar . "?x=" . md5(time()); ?>" width="130" class="rounded mx-auto d-blocks img-thumbnail" id="image_profile">
				</div>
				<div class="col-12 text-center">
					<div class="col-3"></div>
					<div class="custom-file mb-3 mt-1 col-6">
						<input id="upload" name="upload" type="file" class="custom-file-input" onchange="readUpload(this);" disabled>
						<label for="upload" class="custom-file-label">Cambiar imagen</label>
					</div>
					<div class="col-3"></div>
				</div>

				<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto"></div></div>

				<div class="form-row pb-1">
					<div class="form-group col-4">
						<label for="nombre" class="control-label text-dark-gray">Nombre: **</label>
						<input type="text" class="form-control rounded text-center" name="nombre" id="nombre" aria-describedby="user_help" value="<?php echo $_SESSION['nombre']; ?>" disabled pattern="(^[A-ZÁÉÍÓÚÑ]{1}([a-zñáéíóúü]+){1,})(\s[A-ZÁÉÍÓÚÑ]{1}([a-zñáéíóúü]+){1,})?(\s[A-ZÁÉÍÓÚÑ]{1}([a-zñáéíóúü]+){1,})?$" required>
						<small id="user_help" class="form-text text-dark-gray w200">Nombre(s)</small>
					</div>
					<?php $validaciones[] = array('nombre', 'nombre_input', "'Error en Nombre. Favor de corregir.'"); ?>

					<div class="form-group col-4">
						<label for="ap_paterno" class="control-label text-pale-gray">.</label>
						<input type="text" class="form-control rounded text-center" name="ap_paterno" id="ap_paterno" aria-describedby="ap_paterno_help" value="<?php echo $_SESSION['ap_paterno']; ?>" disabled pattern="(^[A-ZÁÉÍÓÚÑ]{1}([a-zñáéíóúü]+){1,})(\s[A-ZÁÉÍÓÚÑ]{1}([a-zñáéíóúü]+){1,})?(\s[A-ZÁÉÍÓÚÑ]{1}([a-zñáéíóúü]+){1,})?$" required>
						<small id="ap_paterno_help" class="form-text text-dark-gray w200">Apellido paterno</small>
					</div>
					<?php $validaciones[] = array('ap_paterno', 'ap_paterno_input', "'Error en Apellido Paterno. Favor de corregir.'"); ?>

					<div class="form-group col-4">
						<label for="ap_materno" class="control-label text-pale-gray">.</label>
						<input type="text" class="form-control rounded text-center" name="ap_materno" id="ap_materno" aria-describedby="ap_materno_help" value="<?php echo $_SESSION['ap_materno']; ?>" disabled pattern="(^[A-ZÁÉÍÓÚÑ]{1}([a-zñáéíóúü]+){1,})(\s[A-ZÁÉÍÓÚÑ]{1}([a-zñáéíóúü]+){1,})?(\s[A-ZÁÉÍÓÚÑ]{1}([a-zñáéíóúü]+){1,})?$" required>
						<small id="ap_materno_help" class="form-text text-dark-gray w200">Apellido materno</small>
					</div>
					<?php $validaciones[] = array('ap_materno', 'ap_materno_input', "'Error en Apellido Materno. Favor de corregir.'"); ?>
				</div>

				<div class="form-row pb-1">
					<div class="form-group col-4">
						<label for="puesto" class="control-label text-dark-gray">Puesto: **</label>
						<input type="text" class="form-control rounded text-center" name="puesto" id="puesto" aria-describedby="puesto_help" value="<?php echo $_SESSION['puesto']; ?>" disabled required>
						<small id="puesto_help" class="form-text text-dark-gray w200">Puesto o cargo en la escuela</small>
					</div>
					<?php $validaciones[] = array('puesto', 'puesto_input', "'Error en Puesto. Favor de corregir.'"); ?>
					<div class="form-group col-4">
						<label for="correo" class="control-label text-dark-gray">E-mail: **</label>
						<input type="text" class="form-control rounded text-center" name="correo" id="correo" aria-describedby="correo_help" value="<?php echo $_SESSION['email']; ?>" disabled pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
						<small id="correo_help" class="form-text text-dark-gray w200">Correo electrónico</small>
					</div>
					<?php $validaciones[] = array('correo', 'correo_input', "'Error en E-mail. Favor de corregir.'"); ?>
					<div class="form-group col-4">
						<label for="tel" class="control-label text-dark-gray">Teléfono: **</label>
						<input type="text" class="form-control rounded text-center" name="tel" id="tel" aria-describedby="tel_help" value="<?php echo $_SESSION['tel']; ?>" disabled required>
						<small id="tel_help" class="form-text text-dark-gray w200">Teléfono de contacto</small>
					</div>
					<?php $validaciones[] = array('tel', 'tel_input', "'Error en Teléfono. Favor de corregir.'"); ?>
				</div>

				<div class="form-row pb-1">
					<div class="form-group col-4">
						<label for="cel" class="control-label text-dark-gray">Celular:</label>
						<input type="text" class="form-control rounded text-center" name="cel" id="cel" aria-describedby="cel_help" value="<?php echo $_SESSION['cel']; ?>" disabled>
						<small id="correo_help" class="form-text text-dark-gray w200">Teléfono móvil de contacto</small>
					</div>
					<div class="form-group col-4">
						<label for="cumple" class="control-label text-dark-gray">Cumpleaños:</label>
						<input type="date" class="form-control rounded text-center" name="cumple" id="cumple" aria-describedby="cumple_help" value="<?php echo $cumple; ?>" disabled>
						<small id="cumple_help" class="form-text text-dark-gray w200">Fecha de cumpleaños</small>
					</div>
				</div>

				<div class="row pb-1">
					<div class="col text-center">
						<button type="button" class="btn btn-warning text-center px-5 my-2" name="modificar" id="modificar" onclick="modificar_perfil()">Modificar perfil</button>
						<button type="submit" class="btn btn-warning text-center px-5 my-2" name="guardar" id="guardar" disabled>Guardar cambios</button>
						<button type="button" class="btn btn-warning text-center px-5 my-2" name="cancelar" id="cancelar" onclick="location.reload()" disabled>Cancelar</button>
					</div>
				</div>

			</form>
		</div>
	</div>

</div>

<script type="text/javascript">
	function modificar_perfil() {
		$("#upload").removeAttr('disabled');
		$("#nombre").removeAttr('disabled');
		$("#ap_paterno").removeAttr('disabled');
		$("#ap_materno").removeAttr('disabled');
		$("#puesto").removeAttr('disabled');
		$("#correo").removeAttr('disabled');
		$("#tel").removeAttr('disabled');
		$("#cel").removeAttr('disabled');
		$("#cumple").removeAttr('disabled');
		$("#guardar").removeAttr('disabled');
		$('#modificar').prop('disabled', true);
		$("#cancelar").removeAttr('disabled');
	}

	function readUpload(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#image_profile')
					.attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(document).ready(function(){
		$('.toast').toast('show');
	});

	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});

	var error = document.getElementById('error');
<?php
	for ($i = 0; $i <= sizeof($validaciones) - 1; $i++) {
		echo "var " . $validaciones[$i][1] . " = document.getElementById('" . $validaciones[$i][0] . "');";
		echo $validaciones[$i][1] . ".addEventListener('invalid', function(event){
			event.preventDefault();
			if (! event.target.validity.valid) {
				error.textContent = " . $validaciones[$i][2] . ";
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
</script>

<?php
	}
	include_once('../includes/vinculador_footer.php');
?>

