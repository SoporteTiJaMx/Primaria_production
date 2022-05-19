<?php
	include_once('../includes/admin_header.php');
	include_once('../scripts/funciones.php');
	include_once('../admin/side_navbar.php');

	if ($_SESSION["tipo"] != "Admin") {
		header('Location: ../error.php');
	} else {

	$_SESSION["token"] = md5(uniqid(mt_rand(), true));
?>

<link rel="stylesheet" href="../css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="../css/responsive.bootstrap4.css">
<script src="../js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.responsive.min.js" crossorigin="anonymous"></script>
<script src="../js/responsive.bootstrap4.min.js" crossorigin="anonymous"></script>


<nav class="mx-5 my-3">
	<div class="nav nav-tabs" id="nav-tab" role="tablist">
		<a class="nav-item nav-link active" id="nav-crear-tab" data-toggle="tab" href="#nav-crear" role="tab" aria-controls="nav-crear" aria-selected="true">Ingresar nueva escuela</a>
		<a class="nav-item nav-link" id="nav-gestion-tab" data-toggle="tab" href="#nav-gestion" role="tab" aria-controls="nav-gestion" aria-selected="false">Administrar escuelas</a>
	</div>
</nav>
<div class="tab-content mx-5 px-3 mb-5" id="nav-tabContent" >
	<!-- Tab para crear una nueva escuela -->
	<div class="tab-pane fade show active" id="nav-crear" role="tabpanel" aria-labelledby="nav-crear-tab">
		<div class="card shadow">
			<div class="card-header text-center text-dark-gray text-spaced-3">INGRESAR NUEVA ESCUELA PARA <?php echo mb_strtoupper($_SESSION['centro'],'utf-8'); ?></div>
			<div class="card-body">

				<form action="<?php echo $RAIZ_SITIO; ?>scripts/admin/nueva_escuela.php" method="post" class="mt-1" enctype="multipart/form-data">
					<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">

					<div class="col-12 text-center">
						<img src="<?php echo $RAIZ_SITIO . 'images/perfiles/perfil.png'; ?>" width="130" class="rounded mx-auto d-blocks img-thumbnail" id="image_profile">
					</div>
					<div class="col-12 text-center">
						<div class="col-3"></div>
						<div class="custom-file mb-3 mt-1 col-6">
							<input id="upload" name="upload" type="file" class="custom-file-input" onchange="readUpload(this);">
							<label for="upload" class="custom-file-label">Logotipo de la escuela</label>
						</div>
						<div class="col-3"></div>
					</div>

					<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto"></div></div>

					<div class="form-row pb-1 pt-2">
						<div class="col-3"></div>
						<div class="form-group col-6">
							<label for="institucion" class="control-label text-dark-gray">Institución: **</label>
							<select name="institucion" type="text" id="institucion" class="form-control rounded" aria-describedby="institucion_help" onchange="validar()" required>
							</select>
							<small id="institucion_help" class="form-text text-dark-gray w200">Institución a la que pertenece</small>
						</div>
						<div class="col-3"></div>
					</div>
					<?php $validaciones[] = array('institucion', 'institucion_input', "'Error en Institución. Favor de corregir.'"); ?>

					<div class="form-row pb-1">
						<div class="form-group col-6">
							<label for="nombre" class="control-label text-dark-gray">Nombre: **</label>
							<input type="text" class="form-control rounded text-center" name="nombre" id="nombre" aria-describedby="nombre_help" required disabled>
							<small id="nombre_help" class="form-text text-dark-gray w200">Nombre de la escuela</small>
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
							<label for="web" class="control-label text-dark-gray">Sitio web:</label>
							<input type="text" class="form-control rounded text-center" name="web" id="web" aria-describedby="web_help" disabled>
							<small id="web_help" class="form-text text-dark-gray w200">Página en internet de la escuela</small>
						</div>

						<div class="form-group col-6">
							<label for="estatus" class="control-label text-dark-gray">Estatus: **</label>
							<select name="estatus" type="text" id="estatus" class="form-control rounded" aria-describedby="estatus_help" required disabled>
								<option value="">Selecciona estatus de la escuela</option>
								<option value="1">Activa</option>
								<option value="2">Inactiva</option>
							</select>
							<small id="estatus_help" class="form-text text-dark-gray w200">Estatus de la escuela</small>
						</div>
						<?php $validaciones[] = array('estatus', 'estatus_input', "'Error en Estatus. Debes seleccionar el estatus de la Institución.'"); ?>
					</div>

					<div class="form-row pb-1">
						<div class="form-group col-6">
							<label for="maps" class="control-label text-dark-gray">Google Maps:</label>
							<textarea type="text" class="form-control rounded" name="maps" id="maps" aria-describedby="maps_help" rows="2" disabled></textarea>
							<small id="maps_help" class="form-text text-dark-gray w200">Georreferenciación en Google Maps o similar</small>
						</div>
					</div>

					<div class="row pb-1">
						<div class="col text-center">
							<button type="submit" class="btn btn-warning text-center px-5 my-2" name="guardar" id="guardar">Registrar escuela</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
	<!-- Tab para administración de escuelas -->
	<div class="tab-pane fade mb-5" id="nav-gestion" role="tabpanel" aria-labelledby="nav-gestion-tab">
		<div class="card shadow mb-5 pb-5 min-width:300px">
			<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">ADMINISTRAR ESCUELAS DE <?php echo mb_strtoupper($_SESSION['centro'],'utf-8'); ?></div>
			<div class="card-body">

			<div id="result"></div>
			</div>
		</div>
	</div>
</div>

<!-- Modal y Toast de Nuevo Estatus -->
<div class="modal fade" tabindex="-1" id="modalModificar" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Modificar datos </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="form-row pb-1">
						<div class="form-group col-2"></div>
						<div class="form-group col-8">
							<input name="Escuela_ID_nuevo_estatus" type="hidden" id="Escuela_ID_nuevo_estatus" value="">
							<div class="form-group">
								<label for="nombre_nuevo" class="control-label text-dark-gray">Nombre:</label>
								<input type="text" class="form-control rounded text-center" name="nombre_nuevo" id="nombre_nuevo" aria-describedby="nombre_nuevo_help">
								<small id="nombre_nuevo_help" class="form-text text-dark-gray w200">Nombre de la Escuela</small>
							</div>
							<div class="form-group">
								<label for="web_nuevo" class="control-label text-dark-gray">Sitio web:</label>
								<input type="text" class="form-control rounded text-center" name="web_nuevo" id="web_nuevo" aria-describedby="web_nuevo_help">
								<small id="web_nuevo_help" class="form-text text-dark-gray w200">Sitio web de la Escuela</small>
							</div>
							<div class="form-group">
								<label for="maps_nuevo" class="control-label text-dark-gray">Mapa:</label>
								<input type="text" class="form-control rounded text-center" name="maps_nuevo" id="maps_nuevo" aria-describedby="maps_nuevo_help">
								<small id="maps_nuevo_help" class="form-text text-dark-gray w200">Mapa de localización de la Escuela</small>
							</div>
							<div class="form-group">
								<label for="nuevo_estatus" class="control-label text-dark-gray">Estatus:</label>
								<select name="nuevo_estatus" type="text" id="nuevo_estatus" class="form-control rounded" aria-describedby="nuevo_estatus_help">
									<option value="1">Activa</option>
									<option value="2">Inactiva</option>
								</select>
								<small id="nuevo_estatus_help" class="form-text text-dark-gray w200">Estatus de la Escuela</small>
							</div>
						</div>
						<div class="form-group col-2"></div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-warning submitBtn" onclick="modificar_datos()">Modificar datos</button>
			</div>
		</div>
	</div>
</div>
<div class="toast estatus" data-delay="5000" style="position: fixed; top: 10%; right: 2%; z-index: 2000;">
	<div class="toast-header">
		<strong class="mr-auto text-primary">Datos modificados con éxito</strong>
		<small class="text-muted"></small>
		<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
	</div>
	<div class="toast-body">
		Actualiza la página para ver los cambios.
	</div>
</div>



<script type="text/javascript">
	// toggle button institucion seleccionada
	function validar(){
		var indice = document.getElementById("institucion").value;
		if( indice != '') {
			$('#nombre').prop('disabled', false);
			$('#estado').prop('disabled', false);
			$('#web').prop('disabled', false);
			$('#estatus').prop('disabled', false);
			$('#maps').prop('disabled', false);
		} else {
			$('#nombre').prop('disabled', true);
			$('#estado').prop('disabled', true);
			$('#web').prop('disabled', true);
			$('#estatus').prop('disabled', true);
			$('#maps').prop('disabled', true);
		}
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

	$(".custom-file-input").on("change", function() {
	  var fileName = $(this).val().split("\\").pop();
	  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});

	// Funciones de validación al crear nuevo patrocinador
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
			" . $validaciones[$i][1] . ".classList.remove('input_error');
			}
		});
		";
	}
?>

	$(document).ready(function(){
		$.ajax({
		  url: '../includes/estados_todos.php',
		  success: function(data)
		  {
		  	$('#estado').html("<option value=''>Selecciona estado de la escuela</option>" + data);
		  }
		});
		$.ajax({
		  url: '../includes/instituciones_todos.php',
		  success: function(data)
		  {
		  	$('#institucion').html("<option value=''>Selecciona institución a la que pertenece</option><option value='0'>Sin institución</option>" + data);
		  }
		});

		$.ajax({
		  url: '../scripts/ajax/escuelas_ver_ajax.php',
		  type: 'post',
		  success: function(data)
		  {
		  	$('#result').html(data)
			$('#escuelas_table').DataTable( {
				"pagingType": "simple",
				responsive: {
					details: {
						display: $.fn.dataTable.Responsive.display.childRow,
					}
				},
				"pageLength": 100,
			} );
			$('#escuelas_table_wrapper div.row').addClass('col-sm-12');
			$('.dataTables_length').parent().addClass('d-flex justify-content-start');
			$('.dataTables_filter').parent().addClass('d-flex justify-content-end');
			$('ul.pagination').addClass('pagination-sm');
			$('[data-toggle="tooltip"]').tooltip();

			$('.select_nuevo_estatus i').click(function(){
				$('#modalModificar .modal-title').text('Modificar datos de ' + $(this).data('nombre'));
				$('#Escuela_ID_nuevo_estatus').val($(this).data('escuela'));
				$('#nombre_nuevo').val($(this).data('nombre'));
				$('#web_nuevo').val($(this).data('web'));
				$('#maps_nuevo').val($(this).data('maps'));
				$('#nuevo_estatus').val($(this).data('estatus'));
			})

		  }
		});

	});

	// función para ir a tab en administración de patrocinadores
	function activaTab(tab){
		$('.nav-tabs a[href="#' + tab + '"]').tab('show');
	};

	// función para cambio de estatus de patrocinador
	function modificar_datos(){
		var Escuela_ID_nuevo_estatus = document.getElementById("Escuela_ID_nuevo_estatus").value;
		var nombre_nuevo = document.getElementById("nombre_nuevo").value;
		var web_nuevo = document.getElementById("web_nuevo").value;
		var maps_nuevo = document.getElementById("maps_nuevo").value;
		var nuevo_estatus = document.getElementById("nuevo_estatus").value;
		var parametros = {
			"nuevo_estatus" : nuevo_estatus,
			"Escuela_ID_nuevo_estatus" : Escuela_ID_nuevo_estatus,
			"nombre_nuevo" : nombre_nuevo,
			"web_nuevo" : web_nuevo,
			"maps_nuevo" : maps_nuevo,
		};
		$.ajax({
			data:  parametros,
			url: '../scripts/ajax/escuelas_modificar_datos_ajax.php',
			type: 'post',
			success: function(data)
			{
				$('.toast.estatus').toast('show');
				$('#modalModificar').modal('hide');
				activaTab('nav-gestion');
			}
		});
	}

</script>

<?php
	}
	include_once('../includes/admin_footer.php');
?>
