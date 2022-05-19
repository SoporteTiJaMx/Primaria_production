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

?>

<div class="mx-5 px-5 mt-3 mb-5 pb-5">
	<div class="text-center" id="info"></div><br>
	<div class="card shadow">
		<div class="card-header text-center text-dark-gray text-spaced-3">TU ASESOR EMPRESARIAL</div>
		<div class="card-body">

			<form class="mt-1">
				<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">

				<div class="col-12 text-center">
					<img src="<?php echo $avatar . "?x=" . md5(time()); ?>" width="130" class="rounded mx-auto d-blocks img-thumbnail" id="image_profile">
				</div>

				<div class="form-row pb-1">
					<div class="form-group col-4">
						<label for="nombre" class="control-label text-dark-gray">Nombre:</label>
						<input type="text" class="form-control rounded text-center" name="nombre" id="nombre" disabled>
						<small id="user_help" class="form-text text-dark-gray w200">Nombre(s)</small>
					</div>

					<div class="form-group col-4">
						<label for="ap_paterno" class="control-label text-pale-gray">.</label>
						<input type="text" class="form-control rounded text-center" name="ap_paterno" id="ap_paterno" disabled>
						<small id="ap_paterno_help" class="form-text text-dark-gray w200">Apellido paterno</small>
					</div>

					<div class="form-group col-4">
						<label for="ap_materno" class="control-label text-pale-gray">.</label>
						<input type="text" class="form-control rounded text-center" name="ap_materno" id="ap_materno" disabled>
						<small id="ap_materno_help" class="form-text text-dark-gray w200">Apellido materno</small>
					</div>
				</div>

				<div class="form-row pb-1">
					<div class="form-group col-4">
						<label for="carrera" class="control-label text-dark-gray">Carrera / Profesión:</label>
						<input type="text" class="form-control rounded text-center" name="carrera" id="carrera" disabled>
						<small id="carrera_help" class="form-text text-dark-gray w200">Profesión de tu asesor</small>
					</div>

					<div class="form-group col-4">
						<label for="trabajo" class="control-label text-dark-gray">Lugar de trabajo:</label>
						<input type="text" class="form-control rounded text-center" name="trabajo" id="trabajo" disabled>
						<small id="trabajo_help" class="form-text text-dark-gray w200">Lugar donde labora tu asesor</small>
					</div>

					<div class="form-group col-4">
						<label for="puesto" class="control-label text-dark-gray">Puesto:</label>
						<input type="text" class="form-control rounded text-center" name="puesto" id="puesto" disabled>
						<small id="puesto_help" class="form-text text-dark-gray w200">Puesto laboral</small>
					</div>
				</div>

				<div class="form-row pb-1">
					<div class="form-group col-4">
						<label for="correo" class="control-label text-dark-gray">E-mail:</label>
						<input type="text" class="form-control rounded text-center" name="correo" id="correo" disabled>
						<small id="correo_help" class="form-text text-dark-gray w200">Correo electrónico</small>
					</div>
					<div class="form-group col-4">
						<label for="tel" class="control-label text-dark-gray">Teléfono:</label>
						<input type="text" class="form-control rounded text-center" name="tel" id="tel" disabled>
						<small id="tel_help" class="form-text text-dark-gray w200">Teléfono de contacto</small>
					</div>
					<div class="form-group col-4">
						<label for="cel" class="control-label text-dark-gray">Celular:</label>
						<input type="text" class="form-control rounded text-center" name="cel" id="cel" disabled>
						<small id="correo_help" class="form-text text-dark-gray w200">Teléfono móvil de contacto</small>
					</div>
				</div>

				<div class="form-row pb-1">
					<div class="form-group col-4">
						<label for="cumple" class="control-label text-dark-gray">Cumpleaños:</label>
						<input type="date" class="form-control rounded text-center" name="cumple" id="cumple" disabled>
						<small id="cumple_help" class="form-text text-dark-gray w200">Fecha de cumpleaños</small>
					</div>
				</div>
			</form>
		</div>
	</div>

</div>

<script type="text/javascript">
	$(document).ready(function(){
			$.ajax({
			url: 'ajax/mi_asesor.php',
			type: 'post',
			success: function(data)
			{
				var array = JSON.parse(data);
				console.log(array);
				$("#nombre").val(array.nombre);
				$("#ap_paterno").val(array.ap_paterno);
				$("#ap_materno").val(array.ap_materno);
				$("#carrera").val(array.carrera);
				$("#trabajo").val(array.trabajo);
				$("#puesto").val(array.puesto);
				$("#correo").val(array.correo);
				$("#tel").val(array.tel);
				$("#cel").val(array.cel);
				$("#cumple").val(array.cumple);
				if (array.nombre != null) {
					$("#info").html("");
				} else {
					$("#info").html("Aún no tienes asesor asignado. En breve el equipo de JA México te lo asignará, de lo contrario solicita a tu Coordinador escolar que lo comente.");
				}
			}
			});
	});

</script>

<?php
	}
	include_once('../includes/alumno_footer.php');
?>

