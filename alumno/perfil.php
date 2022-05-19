<?php
	include_once('../includes/alumno_header.php');
	include_once('../scripts/funciones.php');
	include_once('../alumno/side_navbar.php');

	if ($_SESSION["tipo"] != "Alumn") {
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

<div class="mx-1 mx-lg-5 px-1 px-lg-5 mt-lg-3 mb-5 pb-5">

	<div class="card shadow">
		<div class="card-header text-center text-dark-gray text-spaced-3">PERFIL DE PARTICIPANTE</div>
		<div class="card-body">

			<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/modificar_perfil.php" method="post" class="mt-1" enctype="multipart/form-data">
				<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">

				<div class="container py-2">
					<div class="row justify-content-md-center">
						<div class="col-md-auto px-5 text-center">
						<?php if ($_SESSION["estatus"]==0) { ?>
							<h5><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><span class="badge badge-success px-3 py-3"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Llena tu perfil y obtén <span class="text-yellow">10 estrellas</span></span></h5>
						<?php } else { ?>
							<h5><span class="badge badge-success px-3 py-3"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp;<span class="text-yellow">10 estrellas</span> obtenidas</span></h5>
						<?php } ?>
						</div>
					</div>
				</div>


				<div class="col-12 text-center">
					<img src="<?php echo $avatar . "?x=" . md5(time()); ?>" width="130" class="rounded mx-auto d-blocks img-thumbnail" id="image_profile">
				</div>
				<div class="col-12 text-center">
					<div class="custom-file mb-3 mt-1 col-lg-6">
						<input id="upload" name="upload" type="file" class="custom-file-input" onchange="readUpload(this);" disabled accept="image/jpeg, image/png, image/gif, image/pjpeg">
						<label for="upload" class="custom-file-label">Cambiar imagen</label>
					</div>
				</div>

				<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto"></div></div>

				<div class="form-row pb-1">
					<div class="form-group col-12 col-lg-4">
						<label for="nombre" class="control-label text-dark-gray">Nombre: **</label>
						<input type="text" class="form-control rounded text-center" name="nombre" id="nombre" aria-describedby="user_help" value="<?php echo $_SESSION['nombre']; ?>" disabled required pattern="^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$">
						<small id="user_help" class="form-text text-dark-gray w200">Nombre(s)</small>
					</div>
					<?php $validaciones[] = array('nombre', 'nombre_input', "'Error en Nombre. Favor de corregir.'"); ?>

					<div class="form-group col-12 col-lg-4">
						<label for="ap_paterno" class="control-label text-pale-gray">.</label>
						<input type="text" class="form-control rounded text-center" name="ap_paterno" id="ap_paterno" aria-describedby="ap_paterno_help" value="<?php echo $_SESSION['ap_paterno']; ?>" disabled required>
						<small id="ap_paterno_help" class="form-text text-dark-gray w200">Apellido paterno</small>
					</div>
					<?php $validaciones[] = array('ap_paterno', 'ap_paterno_input', "'Error en Apellido Paterno. Favor de corregir.'"); ?>

					<div class="form-group col-12 col-lg-4">
						<label for="ap_materno" class="control-label text-pale-gray">.</label>
						<input type="text" class="form-control rounded text-center" name="ap_materno" id="ap_materno" aria-describedby="ap_materno_help" value="<?php echo $_SESSION['ap_materno']; ?>" disabled required>
						<small id="ap_materno_help" class="form-text text-dark-gray w200">Apellido materno</small>
					</div>
					<?php $validaciones[] = array('ap_materno', 'ap_materno_input', "'Error en Apellido Materno. Favor de corregir.'"); ?>
				</div>

				<div class="form-row pb-1">
					<div class="form-group col-12 col-lg-6">
						<label for="cumple" class="control-label text-dark-gray">Cumpleaños:</label>
						<input type="date" class="form-control rounded text-center" name="cumple" id="cumple" aria-describedby="cumple_help" value="<?php echo $cumple; ?>" disabled>
						<small id="cumple_help" class="form-text text-dark-gray w200">Fecha de cumpleaños</small>
					</div>
				</div>

				<div class="form-row pb-1">
					<div class="form-group col-12 col-lg-6">
						<label for="carrera" class="control-label text-dark-gray">Carrera: **</label>
						<select name="carrera" type="text" id="carrera" class="form-control rounded" aria-describedby="carrera_help" required disabled></select>
						<small id="carrera_help" class="form-text text-dark-gray w200">Selecciona la carrera que estudias actualmente</small>
					</div>
					<?php $validaciones[] = array('carrera', 'carrera_input', "'Error en Carrera. Favor de corregir.'"); ?>
					<div class="form-group col-12 col-lg-6">
						<label for="turno" class="control-label text-dark-gray">Turno: **</label>
						<select name="turno" type="text" id="turno" class="form-control rounded" aria-describedby="turno_help" required disabled>
							<option value="0">Selecciona turno</option>
							<option value="1" <?php if ($_SESSION['turno']==1) { echo "selected"; }?>>Matutino</option>
							<option value="2" <?php if ($_SESSION['turno']==2) { echo "selected"; }?>>Vespertino</option>
							<option value="3" <?php if ($_SESSION['turno']==3) { echo "selected"; }?>>Mixto</option>
							<option value="4" <?php if ($_SESSION['turno']==4) { echo "selected"; }?>>No aplica</option>
						</select>
						<small id="turno_help" class="form-text text-dark-gray w200">Turno escolar</small>
					</div>
					<?php $validaciones[] = array('turno', 'turno_input', "'Error en Turno. Favor de corregir.'"); ?>
				</div>

				<div class="form-row pb-1">
					<div class="form-group col-12 col-lg-6">
						<label for="tel" class="control-label text-dark-gray">Teléfono de casa:</label>
						<input type="text" class="form-control rounded text-center" name="tel" id="tel" aria-describedby="tel_help" value="<?php echo $_SESSION['tel']; ?>" disabled>
						<small id="tel_help" class="form-text text-dark-gray w200">Teléfono local o de casa</small>
					</div>
					<div class="form-group col-12 col-lg-6">
						<label for="cel" class="control-label text-dark-gray">Celular:</label>
						<input type="text" class="form-control rounded text-center" name="cel" id="cel" aria-describedby="cel_help" value="<?php echo $_SESSION['cel']; ?>" disabled>
						<small id="correo_help" class="form-text text-dark-gray w200">Teléfono móvil de contacto</small>
					</div>
				</div>

				<div class="form-row pb-1">
					<div class="form-group col-12 col-lg-6">
						<label for="correo" class="control-label text-dark-gray">E-mail: **</label>
						<input type="text" class="form-control rounded text-center" name="correo" id="correo" aria-describedby="correo_help" value="<?php echo $_SESSION['email']; ?>" disabled pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
						<small id="correo_help" class="form-text text-dark-gray w200">Correo electrónico</small>
					</div>
					<?php $validaciones[] = array('correo', 'correo_input', "'Error en E-mail. Favor de corregir.'"); ?>
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
		$("#curp").removeAttr('disabled');
		$("#cumple").removeAttr('disabled');
		$("#turno").removeAttr('disabled');
		$("#carrera").removeAttr('disabled');
		$("#correo").removeAttr('disabled');
		$("#tel").removeAttr('disabled');
		$("#cel").removeAttr('disabled');
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
		var parametros = {
			"Carrera_ID" : <?php echo $_SESSION['carrera_ID']; ?>,
		};
		$.ajax({
			data: parametros,
			url: '../includes/carreras_todas_preselect.php',
			type: 'post',
			success: function(data)
			{
				$('#carrera').html("<option value=''>Selecciona tu carrera</option>" + data);
			}
		});
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
	include_once('../includes/alumno_footer.php');
?>

