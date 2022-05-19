<?php
	include_once('../includes/admin_header.php');
	include_once('../scripts/funciones.php');
	include_once('../scripts/conexion.php');
	include_once('../scripts/conexion2.php');
	include_once('../admin/side_navbar.php');

  if ($_SESSION["tipo"] != "Admin") {
    header('Location: ../error.php');
  } else {
	$stmt=$con->prepare("SELECT Proyecto_ID, Proyecto_nombre FROM proyectos WHERE Proyecto_estatus='activo' ORDER BY Proyecto_nombre");
	$stmt->execute();
	$stmt->bind_result($Proyecto_ID, $Proyecto_nombre);
	$select_proyectos = "<select name='select_proyectos' type='text' id='select_proyectos' class='form-control rounded' onchange='validar_proyecto();'>";
	$select_proyectos.= "<option value='0'>Selecciona proyecto</option>";
	while ($result=$stmt->fetch()) {
		$select_proyectos.="<option value='" . $Proyecto_ID . "'>" . $Proyecto_nombre . "</option>";
	}
	$select_proyectos.="</select>";

	$_SESSION["token"] = md5(uniqid(mt_rand(), true));
?>

<link rel="stylesheet" href="../css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="../css/responsive.bootstrap4.css">
<script src="../js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.responsive.min.js" crossorigin="anonymous"></script>
<script src="../js/responsive.bootstrap4.min.js" crossorigin="anonymous"></script>

<nav class="mx-5 pt-2">
	<div class="text-right">Estás logeado como: <strong><?php echo $_SESSION["nombre"];?></strong></div>
	<br>
	<div class="nav nav-pills" id="nav-tab" role="tablist">
		<a class="nav-item nav-link active" id="nav-proyectos-tab" data-toggle="tab" href="#nav-proyectos" role="tab" aria-controls="nav-proyectos" aria-selected="true">Proyectos</a>
		<a class="nav-item nav-link" id="nav-patrocinadores-tab" data-toggle="tab" href="#nav-patrocinadores" role="tab" aria-controls="nav-patrocinadores" aria-selected="false">Patrocinadores</a>
		<a class="nav-item nav-link" id="nav-patrocproy-tab" data-toggle="tab" href="#nav-patrocproy" role="tab" aria-controls="nav-patrocproy" aria-selected="false">Asignar patrocinadores al proyecto</a>
	</div>
</nav>
<div class="tab-content mx-5 pt-2 pb-5" id="nav-tabContent" >
	<!-- Tab para crear un nuevo proyecto -->
	<div class="tab-pane fade show active" id="nav-proyectos" role="tabpanel" aria-labelledby="nav-proyectos-tab">
		<div class="card shadow min-width:300px">
			<div class="card-header text-center bg-dark-blue text-white text-spaced-3">NUEVO PROYECTO</div>
			<div class="card-body">
				<form action="<?php echo $RAIZ_SITIO; ?>scripts/admin/nuevo_proyecto.php" method="post" class="mt-1">
					<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">

					<h5 class="text-center pb-3">INGRESA NUEVO PROYECTO</h5>
					<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto"></div></div>

					<div class="form-row pb-1">
						<div class="form-group col-3"></div>
						<div class="form-group col-6">
							<label for="name" class="control-label text-dark-gray">Proyecto:</label>
							<input type="text" class="form-control rounded text-center" name="name" id="name" aria-describedby="name_help" required>
							<small id="name_help" class="form-text text-dark-gray w200">Distintos proyectos pueden tener patrocinadores diferentes</small>
						</div>
						<?php $validaciones[] = array('name', 'name_input', "'Error en Nombre de Proyecto. Favor de corregir.'"); ?>
						<div class="form-group col-3"></div>
					</div>
					<div class="row pb-1">
						<div class="col text-center">
							<button type="submit" class="btn btn-warning text-center px-5 my-2" name="guardar" id="guardar">Crear Proyecto</button>
							<button type="button" class="btn btn-dark text-center px-5 my-2" name="cancelar" id="cancelar" onclick="location.reload()">Cancelar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<hr class="oscura">
		<div class="card shadow mb-5 min-width:300px">
			<div class="card-header text-center bg-dark-blue text-white text-spaced-3" id="card-title">PROYECTOS REGISTRADOS</div>
			<div class="card-body">
				<div id="proyectos_registrados"></div>
			</div>
		</div>
	</div>

	<!-- Tab para patrocinadores -->
	<div class="tab-pane fade mb-5" id="nav-patrocinadores" role="tabpanel" aria-labelledby="nav-patrocinadores-tab">
		<div class="card shadow min-width:300px">
			<div class="card-header text-center bg-dark-blue text-white text-spaced-3">NUEVO PATROCINADOR</div>
			<div class="card-body">

				<form action="<?php echo $RAIZ_SITIO; ?>scripts/admin/nuevo_patrocinador.php" method="post" class="mt-1" enctype="multipart/form-data">
					<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">

					<h5 class="text-center pb-3">INGRESA NUEVO PATROCINADOR</h5>

					<div class="text-center mb-3"><div id="error2" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto"></div></div>

					<div class="col-12 text-center">
						<img src="<?php echo $RAIZ_SITIO . 'images/perfiles/perfil.png'; ?>" width="230" class="rounded mx-auto d-blocks img-thumbnail" id="image_profile">
					</div>
					<div class="col-12 text-center">
						<div class="col-3"></div>
						<div class="custom-file mb-3 mt-1 col-6">
							<input id="upload" name="upload" type="file" class="custom-file-input" onchange="readUpload(this);" accept="image/*" required>
							<label for="upload" class="custom-file-label">Logotipo del patrocinador</label>
						</div>
						<div class="col-3"></div>
					</div>
					<?php $validaciones2[] = array('upload', 'upload_input', "'Error en Logotipo. Favor de subir archivo de tipo imagen.'"); ?>

					<div class="form-row pb-1 justify-content-center">
						<div class="form-group col-6">
							<label for="nombre" class="control-label text-dark-gray">Patrocinador:</label>
							<input type="text" class="form-control rounded text-center" name="nombre" id="nombre" aria-describedby="nombre_help" required>
							<small id="nombre_help" class="form-text text-dark-gray w200">Nombre del Patrocinador</small>
						</div>
					</div>
					<?php $validaciones2[] = array('nombre', 'nombre_input', "'Error en Patrocinador. Favor de corregir.'"); ?>

					<div class="row pb-1">
						<div class="col text-center">
							<button type="submit" class="btn btn-warning text-center px-5 my-2" name="guardar" id="guardar">Registrar patrocinador</button>
							<button type="button" class="btn btn-dark text-center px-5 my-2" name="cancelar" id="cancelar" onclick="location.reload()">Cancelar</button>
						</div>
					</div>

				</form>
			</div>
		</div>
		<hr class="oscura">
		<div class="card shadow mb-5 min-width:300px">
			<div class="card-header text-center bg-dark-blue text-white text-spaced-3" id="card-title">PAROCINADORES REGISTRADOS</div>
			<div class="card-body">
				<div id="patrocinadores_registrados"></div>
			</div>
		</div>
	</div>

	<!-- Tab para asignación de patrocinadores a proyectos -->
	<div class="tab-pane fade mb-5" id="nav-patrocproy" role="tabpanel" aria-labelledby="nav-patrocproy-tab">
		<div class="card shadow mb-5 pb-5">
			<div class="card-header text-center bg-dark-blue text-white text-spaced-3" id="card-title">ASIGNAR PATROCINADORES AL PROYECTO</div>
			<div class="card-body">
				<h6 class="text-center text-dark_gray pt-1 pb-1">Asocia a los patrocinadores que forman parte de cada proyecto. Selecciona un proyecto para iniciar.</h6>
				<div class="row pb-3">
					<div class="col-4"></div>
					<div class="col-4">
						<?php echo $select_proyectos; ?>
					</div>
					<div class="col-4"></div>
				</div>

				<div class="row col-sm-12">
					<div class="col-sm-6">
						<div class="card shadow">
							<div class="card-header text-center bg-dark-blue text-white text-spaced-3">Patrocinadores disponibles (activos)</div>
							<div class="card-body">
								<p class="card-text pb-2">Se muestran los patrocinadores activos no asociados con el proyecto.</p>
								<div id="patroc_disponibles"></div>
								<div class="row pb-1 pt-2">
									<div class="col text-center">
										<button type="button" class="btn btn-warning text-center px-5 my-2" onclick="asociar_patroc('Si')">Asociar patrocinadores seleccionados</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card shadow">
							<div class="card-header text-center bg-dark-blue text-white text-spaced-3">Patrocinadores participantes del proyecto</div>
							<div class="card-body">
								<p class="card-text pb-2">Deselecciona los patrocinadores que no participan más del proyecto.</p>
								<div id="patroc_asociados"></div>
								<div class="row pb-1 pt-2">
									<div class="col text-center">
										<button type="button" class="btn btn-warning text-center px-5 my-2" onclick="asociar_patroc('No')">Dejar de asociar patrocinadores</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal y Toast de Nuevo Estatus -->
<div class="modal fade" tabindex="-1" id="modalEstatus" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="form-row pb-1">
						<div class="form-group col-2"></div>
						<div class="form-group col-8">
							<input name="Proyecto_ID_nuevo_estatus" type="hidden" id="Proyecto_ID_nuevo_estatus" value="">
							<div>
								<select name="nuevo_estatus" type="text" id="nuevo_estatus" class="form-control rounded" aria-describedby="tipo_help">
									<option value="activo"><?php echo $lang["volunt_modal_estatus_2"]; ?></option>
									<option value="inactivo"><?php echo $lang["volunt_modal_estatus_3"]; ?></option>
								</select>
							</div>
						</div>
						<div class="form-group col-2"></div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang["btn_cancelar"]; ?></button>
				<button type="button" class="btn btn-warning submitBtn" onclick="nuevo_estatus()"><?php echo $lang["volunt_modal_estatus_4"]; ?></button>
			</div>
		</div>
	</div>
</div>
<div class="toast estatus" data-delay="5000" style="position: fixed; top: 10%; right: 2%; z-index: 2000;">
	<div class="toast-header">
		<strong class="mr-auto text-primary"><?php echo $lang["volunt_modal_estatus_5"]; ?></strong>
		<small class="text-muted"></small>
		<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
	</div>
	<div class="toast-body">
		<?php echo $lang["actualizar_pagina"]; ?>
	</div>
</div>

<!-- Modal de Nuevo Estatus 2 -->
<div class="modal fade" tabindex="-1" id="modalEstatus2" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="form-row pb-1">
						<div class="form-group col-2"></div>
						<div class="form-group col-8">
							<input name="Patrocinador_ID_nuevo_estatus" type="hidden" id="Patrocinador_ID_nuevo_estatus" value="">
							<div>
								<select name="nuevo_estatus2" type="text" id="nuevo_estatus2" class="form-control rounded" aria-describedby="tipo_help">
									<option value="activo">Activo</option>
									<option value="inactivo">Inactivo</option>
								</select>
							</div>
						</div>
						<div class="form-group col-2"></div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-warning submitBtn" onclick="nuevo_estatus2()">Guardar</button>
			</div>
		</div>
	</div>
</div>

<!-- Toast de asociar patrocinadores a proyectos -->
<div class="toast asociar" data-delay="2000" style="position: fixed; top: 10%; right: 2%; z-index: 2000;">
	<div class="toast-header">
		<strong class="mr-auto text-primary toast_titulo"></strong>
		<small class="text-muted"></small>
		<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
	</div>
	<div class="toast-body">
		<?php echo $lang["actualizar_pagina"]; ?>
	</div>
</div>


<script type="text/javascript">
	// Funciones de validación
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

	var error2 = document.getElementById('error2');
<?php
	for ($i = 0; $i <= sizeof($validaciones2) - 1; $i++) {
		echo "var " . $validaciones2[$i][1] . " = document.getElementById('" . $validaciones2[$i][0] . "');";
		echo $validaciones2[$i][1] . ".addEventListener('invalid', function(event){
			event.preventDefault();
			if (! event.target.validity.valid) {
				error2.textContent   = " . $validaciones2[$i][2] . ";
				error2.style.display = 'block';
				error2.classList.add('animated');
				error2.classList.add('shake');
				" . $validaciones2[$i][1] . ".classList.add('input_error');
			}
		});

		" . $validaciones2[$i][1] . ".addEventListener('input', function(event){
			if ( 'block' === error2.style.display ) {
				error2.style.display = 'none';
			" . $validaciones2[$i][1] . ".classList.remove('input_error');
			}
		});
		";
	}
?>

	$(document).ready(function(){
		$.ajax({ //proyectos registrados
			url: '../scripts/admin/proyectos_ver_ajax.php',
			success: function(data)
			{
				$('#proyectos_registrados').html(data)
				$('#proyectos_table').DataTable({
					"pagingType": "simple",
					"pageLength": 100,
					"scrollX": true,
					"order": [[1, "asc"]]
				});
				$('#proyectos_table_wrapper div.row').addClass('col-sm-12');
				$('.dataTables_length').parent().addClass('d-flex justify-content-start');
				$('.dataTables_filter').parent().addClass('d-flex justify-content-end');
				$('ul.pagination').addClass('pagination-sm');

				$('[data-toggle="tooltip"]').tooltip();

				$('.select_nuevo_estatus i').click(function(){
					$('#modalEstatus .modal-title').text('<?php echo $lang["volunt_modal_estatus_6"]; ?>' + $(this).data('nombre'));
					$('#Proyecto_ID_nuevo_estatus').val($(this).data('proyecto'));
					$('#nuevo_estatus').val($(this).data('estatus'));
					$('#modalEstatus').modal('show');
				})
			}
		})

		$.ajax({ //patrocinadores registrados
			url: '../scripts/admin/patrocinadores_ver_ajax.php',
			success: function(data)
			{
				$('#patrocinadores_registrados').html(data)
				$('#patrocinadores_table').DataTable({
					"pagingType": "simple",
					"pageLength": 100,
					"scrollX": true,
					"order": [[1, "asc"]]
				});
				$('#patrocinadores_table_wrapper div.row').addClass('col-sm-12');
				$('.dataTables_length').parent().addClass('d-flex justify-content-start');
				$('.dataTables_filter').parent().addClass('d-flex justify-content-end');
				$('ul.pagination').addClass('pagination-sm');

				$('.select_nuevo_estatus2 i').click(function(){
					$('#modalEstatus2 .modal-title').text('<?php echo $lang["volunt_modal_estatus_6"]; ?>' + $(this).data('nombre'));
					$('#Patrocinador_ID_nuevo_estatus').val($(this).data('patrocinador'));
					$('#nuevo_estatus2').val($(this).data('estatus'));
					$('#modalEstatus2').modal('show');
				})
			}
		})
	});

	function readUpload(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#image_profile').attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});

	// función para cambio de estatus de proyecto
	function nuevo_estatus(){
		var Proyecto_ID_nuevo_estatus = document.getElementById("Proyecto_ID_nuevo_estatus").value;
		var nuevo_estatus = document.getElementById("nuevo_estatus").selectedIndex;
		var parametros = {
			"nuevo_estatus" : nuevo_estatus,
			"Proyecto_ID_nuevo_estatus" : Proyecto_ID_nuevo_estatus,
		};
		$.ajax({
			data:  parametros,
			url: '../scripts/admin/proyecto_nuevo_estatus_ajax.php',
			type: 'post',
			success: function(data)
			{
				$('.toast.estatus').toast('show');
				$('#modalEstatus').modal('hide');
				setTimeout(function(){location.reload()}, 3000);
			}
		});
	}

	// función para cambio de estatus de patrocinador
	function nuevo_estatus2(){
		var Patrocinador_ID_nuevo_estatus = document.getElementById("Patrocinador_ID_nuevo_estatus").value;
		var nuevo_estatus2 = document.getElementById("nuevo_estatus2").selectedIndex;
		var parametros = {
			"nuevo_estatus2" : nuevo_estatus2,
			"Patrocinador_ID_nuevo_estatus" : Patrocinador_ID_nuevo_estatus,
		};
		$.ajax({
			data:  parametros,
			url: '../scripts/admin/patrocinador_nuevo_estatus_ajax.php',
			type: 'post',
			success: function(data)
			{
				$('.toast.estatus').toast('show');
				$('#modalEstatus2').modal('hide');
				setTimeout(function(){location.reload()}, 3000);
			}
		});
	}

	// función para validar proyecto
	function validar_proyecto(){
		var select_proyectos = document.getElementById("select_proyectos").value;
		if (select_proyectos==0) {
			$('#patroc_disponibles').html("");
			$('#patroc_asociados').html("");
		} else {
			$('#patroc_disponibles').html("");
			$('#patroc_asociados').html("");
			var parametros = {
				"Proyecto_ID" : select_proyectos,
			};
			$.ajax({ //Patrocinadores disponibles
			  data:  parametros,
			  url: '../scripts/admin/patrocinadores_disponibles_ajax.php',
			  type: 'post',
			  success: function(data)
			  {
			  	$('#patroc_disponibles').html(data)
				$('#patrocinadores_disp_table').DataTable( {
					"pagingType": "simple",
					responsive: true,
					"pageLength": 100,
				} );
				$('#patrocinadores_disp_table_wrapper div.row').addClass('col-sm-12');
			  }
			});
			$.ajax({ //Patrocinadores asociados
			  data:  parametros,
			  url: '../scripts/admin/patrocinadores_asociados_ajax.php',
			  type: 'post',
			  success: function(data)
			  {
			  	$('#patroc_asociados').html(data)
				$('#patrocinadores_asoc_table').DataTable( {
					"pagingType": "simple",
					responsive: true,
					"pageLength": 100,
				} );
				$('#patrocinadores_asoc_table_wrapper div.row').addClass('col-sm-12');
			  }
			});
		}
	}

	// función para asociar patrocinador
	function asociar_patroc(opcion){
		var select_proyectos = document.getElementById("select_proyectos").value;
		var Array_asociar_patroc = new Array();
		if (opcion == "Si") {
			$('input[type=checkbox].select_asociar_patroc:checked').each(function() {
				Array_asociar_patroc.push($(this).prop("id"));
			});
		} else if (opcion == "No") {
			$('input[type=checkbox].select_desasociar_patroc:not(:checked)').each(function() {
				Array_asociar_patroc.push($(this).prop("id"));
			});
		}
		var parametros = {
			"Proyecto_ID" : select_proyectos,
			"Array_asociar_patroc" : Array_asociar_patroc,
			"Asociar" : opcion,
		};
		$.ajax({
			data:  parametros,
			url: '../scripts/admin/asociar_patroc_ajax.php',
			type: 'post',
			success: function(data)
			{
				$('.toast_titulo').html('Patrocinador asociado/cancelado con éxito');
				$('.toast').toast('show');
				setTimeout(function(){location.reload()}, 2000);
			}
		});
	}

</script>

<?php
	}
	include_once('../includes/admin_footer.php');
?>

