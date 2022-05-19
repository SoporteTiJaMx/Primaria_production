<?php

    include_once('../includes/admin_header.php');
    include_once('../scripts/funciones.php');
    include_once('../scripts/conexion.php');
    include_once('../scripts/conexion2.php');
    include_once('../admin/side_navbar.php');
	

  if ($_SESSION["tipo"] != "Admin") {
    header('Location: ../error.php');
  } else {
    include_once('../scripts/conexion.php');
	$stmt=$con->prepare("SELECT Grupo_ID, Grupo_nombre FROM grupos WHERE Grupo_estatus='activo' ORDER BY Grupo_nombre");
	$stmt->execute();
    $stmt->bind_result($Grupo_ID, $Grupo_nombre);
	$select_grupos = "<select name='select_grupos' type='text' id='select_grupos' class='form-control rounded' onchange='validar_grupo();'>";
	$select_grupos.= "<option value='0'>Selecciona Grupo</option>";
	while ($result=$stmt->fetch()) {
		$select_grupos.="<option value='" . $Grupo_ID . "'>" . $Grupo_nombre . "</option>";
	}
	$select_grupos.="</select>";

	$_SESSION["token"] = md5(uniqid(mt_rand(), true));
?>

<link rel="stylesheet" href="../css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="../css/responsive.bootstrap4.css">
<script src="../js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.responsive.min.js" crossorigin="anonymous"></script>
<script src="../js/responsive.bootstrap4.min.js" crossorigin="anonymous"></script>

<nav class="mx-5 pt-2">
	<div class="text-right"><?php echo $lang["logueado_admin"]; ?> <strong><?php echo $_SESSION["nombre"];?></strong></div>
	<br>
	<div class="nav nav-pills" id="nav-tab" role="tablist">
		<a class="nav-item nav-link active" id="nav-crear-tab" data-toggle="tab" href="#nav-crear" role="tab" aria-controls="nav-crear" aria-selected="true">Crear Alumnos</a>
		<a class="nav-item nav-link" id="nav-gestion-tab" data-toggle="tab" href="#nav-gestion" role="tab" aria-controls="nav-gestion" aria-selected="false">Gestionar Alumnos</a>
	</div>
</nav>
<div class="tab-content mx-5 pt-2 pb-5" id="nav-tabContent" >
	<!-- Tab para añadir alumnos -->
	<div class="tab-pane fade show active" id="nav-crear" role="tabpanel" aria-labelledby="nav-crear-tab">
		<div class="card shadow">
			<div class="card-header text-center bg-dark-blue text-dark text-spaced-3">Crear Alumnos</div>
			<div class="card-body">

				<form action="<?php echo $RAIZ_SITIO; ?>scripts/admin/muchos_alumnos.php" method="post" class="mt-1" enctype="multipart/form-data">
					<h5 class="text-center pb-3">Cargar nuevos alumnos</h5>
					<div class="row pb-4">
						<div class="col-3"></div>
						<div class="col-6">
							<div>Instrucciones:</div><br>
							<div><i class="fas fa-chevron-right pr-2"></i>Selecciona el grupo en el que estarán los alumnos.</div>
							<div><i class="fas fa-chevron-right pr-2"></i>Descarga la platilla <a href="../docs/carga_masiva_alumnos.csv" download="">AQUÍ</a> </div>
							<div><i class="fas fa-chevron-right pr-2"></i>Ingresa tantas filas como alumnos desees agregar (no modifiques los encabezados de columna.</div>
							<div><i class="fas fa-chevron-right pr-2"></i>Guárdalo y súbelo. Asegúrate que sea un archivo .CSV.</div>
						</div>
						<div class="col-3"></div>
					</div>
					<div class="row mt-3 errores_gpo mb-3">
						<div class="col-3"></div>
						<div class="col-6">
							<div class="text-center"><div id="error3" class="bg-danger w-75 py-2 text-center text-dark rounded mx-auto">Ocurrió un error</div></div>
						</div>
						<div class="col-3"></div>
					</div>
					<div class="row pb-3">
						<div class="col-4"></div>
						<div class="col-4">
							<?php echo $select_grupos; ?>
						</div>
						<div class="col-4"></div>
					</div>
					<div class="row mt-3 errores_docs mb-3">
						<div class="col-3"></div>
						<div class="col-6">
							<div class="text-center"><div id="error2" class="bg-danger w-75 py-2 text-center text-dark rounded mx-auto">Error al cargar el archivo</div></div>
						</div>
						<div class="col-3"></div>
					</div>
					<div class="col-12 text-center">
						<div class="col-3"></div>
						<div class="custom-file mb-3 mt-1 col-6">
							<input id="upload" name="upload" type="file" class="custom-file-input" accept=".csv" onchange="validar_csv(upload);">
							<label for="upload" class="custom-file-label">Selecciona el archivo</label>
						</div>
						<div class="col-3"></div>
					</div>
					<div class="row pb-1">
						<div class="col text-center">
							<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_subir_csv" id="btn_subir_csv" disabled>Cargar alumnos</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
	<!-- Tab para administración de alumnos -->
	<div class="tab-pane fade mb-5" id="nav-gestion" role="tabpanel" aria-labelledby="nav-gestion-tab">
		<div class="card shadow mb-5 pb-5 min-width:300px">
			<div class="card-header text-center bg-dark-blue text-dark text-spaced-3" id="card-title">Administrar Alumnos</div>
			<div class="card-body">
				<div id="result"></div>
			</div>
		</div>
	</div>
</div>

<!-- Modal y Toast de Nuevo Estatus -->
<div class="modal fade" tabindex="-1" id="modalEstatus" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $lang["volunt_modal_estatus_1"]; ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="form-row pb-1">
						<div class="form-group col-2"></div>
						<div class="form-group col-8">
							<input name="User_ID_nuevo_estatus" type="hidden" id="User_ID_nuevo_estatus" value="">
							<div>
								<select name="nuevo_estatus" type="text" id="nuevo_estatus" class="form-control rounded" aria-describedby="tipo_help">
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
				<button type="button" class="btn btn-warning submitBtn" onclick="nuevo_estatus()">Guardar</button>
			</div>
		</div>
	</div>
</div>
<div class="toast estatus" data-delay="5000" style="position: fixed; top: 10%; right: 2%; z-index: 2000;">
	<div class="toast-header">
		<strong class="mr-auto text-primary">Cambiar estatus</strong>
		<small class="text-muted"></small>
		<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
	</div>
	<div class="toast-body">
		Regresar
	</div>
</div>

<!-- Modal y Toast de Resetear datos -->
<div class="modal fade" tabindex="-1" id="modalResetear" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Resetear datos</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="form-row pb-1">
						<div class="form-group col-2"></div>
						<div class="form-group col-8">
							<input name="User_ID_resetear_datos" type="hidden" id="User_ID_resetear_datos" value="">

							<label for="pass_nuevo" class="control-label text-dark-gray">Nueva contraseña:</label>
							<input type="text" class="form-control rounded text-center" name="pass_nuevo" id="pass_nuevo" aria-describedby="pass_help" required>
							<small id="pass_nuevo_help" class="form-text text-dark-gray w200">Ingresa la nueva contraseña</small>

						</div>
						<div class="form-group col-2"></div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-warning submitBtn" name="nuevo_password" id="nuevo_password"  onclick="resetear_datos()" >Resetear datos</button>
			</div>
		</div>
	</div>
</div>
<div class="toast resetear" data-delay="5000" style="position: fixed; top: 10%; right: 2%; z-index: 2000;">
	<div class="toast-header">
		<strong class="mr-auto text-primary">Resetear datos</strong>
		<small class="text-muted"></small>
		<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
	</div>
	<div class="toast-body">
		Regresar
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function(){
		$('.errores_docs').hide();
		$('.errores_gpo').hide();
		$.ajax({
			url: '../scripts/admin/alumnos_administrar_ajax.php',
			success: function(data)
			{
				//alert(data);
				$('#result').html(data)
				$('#alumnos_table').DataTable({
					"pagingType": "simple",
			        "pageLength": 100,
			        "scrollX": true,
			        "order": [[2, "asc"]]
				});
				$('#alumnos_table_wrapper div.row').addClass('col-sm-12');
				$('.dataTables_length').parent().addClass('d-flex justify-content-start');
				$('.dataTables_filter').parent().addClass('d-flex justify-content-end');
				$('ul.pagination').addClass('pagination-sm');

			    $('[data-toggle="tooltip"]').tooltip();

				$('.select_nuevo_estatus i').click(function(){
					$('#modalEstatus .modal-title').text('Se cabmió el estatus de' + $(this).data('nombre'));
					$('#User_ID_nuevo_estatus').val($(this).data('alumno'));
					$('#nuevo_estatus').val($(this).data('estatus'));
					$('#modalEstatus').modal('show');
				})
				$('.resetear_datos_acceso i').click(function(){
					$('#pass_nuevo').val("");
					$('#modalResetear .modal-title').text('Se resetearon los datos de' + $(this).data('nombre'));
					$('#User_ID_resetear_datos').val($(this).data('id_user'));
				})
			}
		})
	});

	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});

	function validar_csv(id){
		var archivo = $(id).val();
		var extension = archivo.substring(archivo.lastIndexOf("."));
		var select_grupos = document.getElementById("select_grupos").selectedIndex;
		if(extension != ".csv"){
			$('.errores_docs').show();
			$('#btn_subir_csv').prop('disabled', true);
		} else {
			if (select_grupos>0) {
				$('.errores_docs').hide();
				$('.errores_gpo').hide();
				$('#btn_subir_csv').prop('disabled', false);
			} else {
				$('.errores_gpo').show();
				$('#btn_subir_csv').prop('disabled', true);
			}
		}
	}
	function validar_grupo(){
		var archivo = $("#upload").val();
		var extension = archivo.substring(archivo.lastIndexOf("."));
		var select_grupos = document.getElementById("select_grupos").selectedIndex;
		if (select_grupos==0) {
			$('.errores_docs').hide();
			$('.errores_gpo').show();
			$('#btn_subir_csv').prop('disabled', true);
		} else {
			if(extension != ".csv"){
				$('.errores_docs').show();
				$('#btn_subir_csv').prop('disabled', true);
			} else {
				$('.errores_docs').hide();
				$('.errores_gpo').hide();
				$('#btn_subir_csv').prop('disabled', false);
			}
		}

	}

	// función para cambio de estatus de voluntario
	function nuevo_estatus(){
		var User_ID_nuevo_estatus = document.getElementById("User_ID_nuevo_estatus").value;
		var nuevo_estatus = document.getElementById("nuevo_estatus").selectedIndex;
		var parametros = {
			"nuevo_estatus" : nuevo_estatus,
			"User_ID_nuevo_estatus" : User_ID_nuevo_estatus,
		};
		$.ajax({
			data:  parametros,
			url: '../scripts/admin/alumno_nuevo_estatus_ajax.php',
			type: 'post',
			success: function(data)
			{
				$('.toast.estatus').toast('show');
				$('#modalEstatus').modal('hide');
				setTimeout(function(){location.reload()}, 3000);
			}
		});
	}

	// función para reseteo de datos de acceso de usuario
	function resetear_datos(){
		var User_ID_resetear_datos = document.getElementById("User_ID_resetear_datos").value;
		var nuevo_password = document.getElementById("pass_nuevo").value;
		var parametros = {
			"User_ID_resetear_datos" : User_ID_resetear_datos,
			"nuevo_password" : nuevo_password
		};
		$.ajax({
			data:  parametros,
			url: '../scripts/admin/usuarios_resetear_acceso_ajax.php',
			type: 'post',
			success: function(data)
			{
				$('.toast.resetear').toast('show');
				$('#modalResetear').modal('hide');
				setTimeout(function(){location.reload()}, 3000);
			}
		});
	}

</script>

<?php
	}
	include_once('../includes/admin_footer.php');
?>

