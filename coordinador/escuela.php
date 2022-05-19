<?php
	include_once('../includes/coordinador_header.php');
	include_once('../scripts/funciones.php');
	include_once('../coordinador/side_navbar.php');

  if ($_SESSION["tipo"] != 'Coord') {
    header('Location: ../error.php');
  } else {

	$_SESSION["token"] = md5(uniqid(mt_rand(), true));

	$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/escuelas/";
	if (is_file($target_dir . $_SESSION["Escuela_ID"] . '.jpg')) {
		$avatar = $RAIZ_SITIO . "images/escuelas/" . $_SESSION["Escuela_ID"] . '.jpg';
	} else {
		$avatar = $RAIZ_SITIO . "images/escuelas/" . 'perfil.png';
	}
?>

<div class="toast" data-delay="5000" style="position: fixed; top: 10%; right: 2%; z-index: 2000;">
	<div class="toast-header">
		<strong class="mr-auto text-primary">¡Actualiza los datos de tu Escuela!</strong>
		<small class="text-muted"></small>
		<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
	</div>
	<div class="toast-body">
		<p>Da click en el botón <span class="badge badge-warning text-center px-3 py-2">Modificar datos</span> de abajo.</p>
		<p>Los campos marcados con ** son obligatorios.</p>
	</div>
</div>

<div class="mx-5 px-5 mt-3 mb-5 pb-5">

	<div class="card shadow">
		<div class="card-header text-center text-dark-gray text-spaced-3">DATOS DE LA ESCUELA</div>
		<div class="card-body">

			<form action="<?php echo $RAIZ_SITIO; ?>scripts/coordinador/modificar_escuela.php" method="post" class="mt-1" enctype="multipart/form-data">
				<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">

				<div class="col-12 text-center">
					<img src="<?php echo $avatar . "?x=" . md5(time()); ?>" width="130" class="rounded mx-auto d-blocks img-thumbnail" id="image_profile">
				</div>
				<div class="col-12 text-center">
					<div class="col-3"></div>
					<div class="custom-file mb-3 mt-1 col-6">
						<input id="upload" name="upload" type="file" class="custom-file-input" onchange="readUpload(this);" disabled>
						<label for="upload" class="custom-file-label">Logotipo de la Escuela</label>
					</div>
					<div class="col-3"></div>
				</div>

				<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto"></div></div>

				<div class="form-row pb-1">
					<div class="form-group col-6">
						<label for="nombre" class="control-label text-dark-gray">Nombre: **</label>
						<input type="text" class="form-control rounded text-center" name="nombre" id="nombre" aria-describedby="nombre_help" value="<?php echo $_SESSION['Escuela_nombre']; ?>" disabled required>
						<small id="nombre_help" class="form-text text-dark-gray w200">Nombre de la Escuela</small>
					</div>
					<?php $validaciones[] = array('nombre', 'nombre_input', "'Error en Nombre. Favor de corregir.'"); ?>

					<div class="form-group col-6">
						<label for="estado" class="control-label text-dark-gray">Estado: **</label>
						<select name="estado" type="text" id="estado" class="form-control rounded" aria-describedby="estado_help" required disabled>
						</select>
						<small id="estado_help" class="form-text text-dark-gray w200">Estado donde se sitúa la escuela</small>
					</div>
					<?php $validaciones[] = array('estado', 'estado_input', "'Error en Estado. Favor de corregir.'"); ?>
				</div>


        		<div class="form-row pb-1">
					<div class="form-group col-6">
						<label for="web" class="control-label text-dark-gray">Sitio web: **</label>
						<input type="text" class="form-control rounded text-center" name="web" id="web" aria-describedby="web_help" value="<?php echo $_SESSION['Escuela_web']; ?>" disabled required>
						<small id="web_help" class="form-text text-dark-gray w200">Página en internet de la Escuela</small>
					</div>
                    <?php $validaciones[] = array('web', 'web_input', "'Error en sitio web. Favor de corregir.'"); ?>

					<div class="form-group col-6">
						<label for="maps" class="control-label text-dark-gray">Google Maps:</label>
						<textarea type="text" class="form-control rounded" name="maps" id="maps" aria-describedby="maps_help" rows="4" disabled><?php echo $_SESSION['Escuela_maps']; ?></textarea>
						<small id="maps_help" class="form-text text-dark-gray w200">Georreferenciación en Google Maps o similar</small>
					</div>

        		</div>

				<div class="row pb-1">
					<div class="col text-center">
						<button type="button" class="btn btn-warning text-center px-5 my-2" name="modificar" id="modificar" onclick="modificar_datos()">Modificar datos</button>
						<button type="submit" class="btn btn-warning text-center px-5 my-2" name="guardar" id="guardar" disabled>Guardar cambios</button>
						<button type="button" class="btn btn-warning text-center px-5 my-2" name="cancelar" id="cancelar" onclick="location.reload()" disabled>Cancelar</button>
					</div>
				</div>

			</form>
		</div>
	</div>

</div>

<script type="text/javascript">
	function modificar_datos() {
		$("#upload").removeAttr('disabled');
		$("#nombre").removeAttr('disabled');
		$("#estado").removeAttr('disabled');
		$("#web").removeAttr('disabled');
		$("#maps").removeAttr('disabled');
		$('#modificar').prop('disabled', true);
		$("#guardar").removeAttr('disabled');
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

	    var parametros = {
			"Estado_ID" : <?php echo $_SESSION['Escuela_estado']; ?>
	    };
	    $.ajax({
	      data:  parametros,
	      url: '../includes/estados_todos_preselect.php',
	      type: 'post',
	      success: function(data)
	      {
	      	$('#estado').html("<option value=''>Selecciona estado de la escuela</option>" + data);
	      }
	    });
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
				error.textContent   = " . $validaciones[$i][2] . ";
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
	include_once('../includes/coordinador_footer.php');
?>

