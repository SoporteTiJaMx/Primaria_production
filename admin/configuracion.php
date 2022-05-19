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

<h5 class="text-center text-dark_gray pt-3 pb-1">Configura a los distintos participantes del ciclo<?php if (isset($_SESSION['nombre_licencia'])) { echo " " . $_SESSION['nombre_licencia']; } ?>.</h5>

<nav class="mx-5 my-3">
	<div class="nav nav-tabs" id="nav-tab" role="tablist">
		<a class="nav-item nav-link active" id="nav-patroc-tab" data-toggle="tab" href="#nav-patroc" role="tab" aria-controls="nav-patroc" aria-selected="true">Patrocinadores</a>
		<a class="nav-item nav-link" id="nav-escuelas-tab" data-toggle="tab" href="#nav-escuelas" role="tab" aria-controls="nav-escuelas" aria-selected="false">Escuelas</a>
		<a class="nav-item nav-link" id="nav-empresas-tab" data-toggle="tab" href="#nav-empresas" role="tab" aria-controls="nav-empresas" aria-selected="false"> Empresas juveniles </a>
		<a class="nav-item nav-link" id="nav-asesores-tab" data-toggle="tab" href="#nav-asesores" role="tab" aria-controls="nav-asesores" aria-selected="false"> Empresa - Asesor </a>
		<a class="nav-item nav-link" id="nav-ajustes-tab" data-toggle="tab" href="#nav-ajustes" role="tab" aria-controls="nav-ajustes" aria-selected="false"> Variables </a>
	</div>
</nav>
<?php if (isset($_SESSION["licencia_activa"])) { ?>
	<div class="tab-content mx-5 px-3 mb-5" id="nav-tabContent" >
		<!-- Tab para asociación patrocinadores -->
		<div class="tab-pane fade show active" id="nav-patroc" role="tabpanel" aria-labelledby="nav-patroc-tab">
			<h6 class="text-center text-dark_gray pt-1 pb-1">Asocia a los patrocinadores que forman parte de este ciclo (licencia).</h6>
			<div class="row col-sm-12">
				<div class="col-sm-6">
					<div class="card shadow">
						<div class="card-header text-center text-dark-gray text-spaced-3">Patrocinadores disponibles (activos)</div>
						<div class="card-body">
							<p class="card-text pb-2">Se muestran los patrocinadores activos no asociados con el ciclo.</p>
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
						<div class="card-header text-center text-dark-gray text-spaced-3">Patrocinadores participantes del ciclo</div>
						<div class="card-body">
							<p class="card-text pb-2">Deselecciona los patrocinadores que no participan más del ciclo.</p>
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
		<!-- Tab para asociación escuelas -->
		<div class="tab-pane fade mb-5" id="nav-escuelas" role="tabpanel" aria-labelledby="nav-escuelas-tab">
			<h6 class="text-center text-dark_gray pt-1 pb-1">Asocia a las escuelas que forman parte de este ciclo (licencia).</h6>
			<div class="row col-sm-12">
				<div class="col-sm-6">
					<div class="card shadow">
						<div class="card-header text-center text-dark-gray text-spaced-3">Escuelas disponibles</div>
						<div class="card-body">
							<p class="card-text pb-2">Se muestran las escuelas activas no asociadas con el ciclo.</p>
							<div id="escuelas_disponibles"></div>
							<div class="row pb-1 pt-2">
								<div class="col text-center">
									<button type="button" class="btn btn-warning text-center px-5 my-2" onclick="asociar_escuelas('Si')">Asociar escuelas seleccionadas</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card shadow">
						<div class="card-header text-center text-dark-gray text-spaced-3">Escuelas participantes del ciclo</div>
						<div class="card-body">
							<p class="card-text pb-2">Deselecciona las escuelas que no participan más del ciclo.</p>
							<div id="escuelas_asociadas"></div>
							<div class="row pb-1 pt-2">
								<div class="col text-center">
									<button type="button" class="btn btn-warning text-center px-5 my-2" onclick="asociar_escuelas('No')">Dejar de asociar escuelas</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Tab para empresas juveniles -->
		<div class="tab-pane fade mb-5" id="nav-empresas" role="tabpanel" aria-labelledby="nav-empresas-tab">
			<h6 class="text-center text-dark_gray pt-1 pb-1">Asigna el número de empresas juveniles a cada escuela participante.</h6>
			<div class="row col-sm-12">
				<div class="col-sm-6">
					<div class="card shadow">
						<div class="card-header text-center text-dark-gray text-spaced-3">Empresas por escuela</div>
						<div class="card-body">
							<p class="card-text pb-2">Asigna cuantas empresas juveniles coordinará cada escuela.</p>
							<div id="num_empresas_escuelas"></div>
							<div class="row pb-1 pt-2">
								<div class="col text-center">
									<button type="button" class="btn btn-warning text-center px-5 my-2" onclick="guardar_empresas_por_escuela()">Guardar cambios</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card shadow">
						<div class="card-header text-center text-dark-gray text-spaced-3">Ingresar nueva empresa juvenil</div>
						<div class="card-body">
							<p class="card-text pb-2">Selecciona la escuela a la que pertenece esta empresa juvenil.</p>

							<form action="<?php echo $RAIZ_SITIO; ?>scripts/admin/crear_usuario.php" method="post" class="mt-1">
								<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
								<input name="tipo" type="hidden" id="tipo" value="5">

								<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto mb-2"></div></div>

								<div class="form-row pb-1">
									<div class="form-group col-1"></div>
									<div class="form-group row col-10">
										<label for="tipo_filtro" class="col-sm-3 col-form-label text-right">Escuela:</label>
										<div class="col-sm-9">
											<select name="select_escuela_nueva_empresa" type="text" id="select_escuela_nueva_empresa" class="form-control rounded" onChange="filtro_escuela_nueva_empresa()">
											</select>
										</div>
									</div>
									<div class="form-group col-1"></div>
								</div>

								<div class="form-row pb-1">
									<div class="form-group col-1"></div>
									<div class="form-group col-5">
										<label for="nombre" class="control-label text-dark-gray">Alumno de contacto:</label>
										<input type="text" class="form-control rounded text-center" name="nombre" id="nombre" aria-describedby="nombre_help" required>
										<small id="nombre_help" class="form-text text-dark-gray w200">Nombre(s)</small>
									</div>
									<?php $validaciones[] = array('nombre', 'nombre_input', "'Error en Nombre. Favor de corregir.'"); ?>

									<div class="form-group col-5">
										<label for="ap_paterno" class="control-label text-pale-gray">.</label>
										<input type="text" class="form-control rounded text-center" name="ap_paterno" id="ap_paterno" aria-describedby="ap_paterno_help" required>
										<small id="ap_paterno_help" class="form-text text-dark-gray w200">Apellido(s)</small>
									</div>
									<?php $validaciones[] = array('ap_paterno', 'ap_paterno_input', "'Error en Apellido. Favor de corregir.'"); ?>
									<div class="form-group col-1"></div>
								</div>

								<div class="form-row pb-1">
									<div class="form-group col-1"></div>
									<div class="form-group col-5">
										<label for="correo" class="control-label text-dark-gray">E-mail:</label>
										<input type="text" class="form-control rounded text-center" name="correo" id="correo" aria-describedby="correo_help" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
										<small id="correo_help" class="form-text text-dark-gray w200">Correo electrónico</small>
									</div>
									<?php $validaciones[] = array('correo', 'correo_input', "'Error en E-mail. Favor de corregir.'"); ?>

									<div class="form-group col-5">
										<label for="nombre_empresa" class="control-label text-dark-gray">Nombre de Empresa:</label>
										<input type="text" class="form-control rounded text-center" name="nombre_empresa" id="nombre_empresa" aria-describedby="nombre_empresa_help" required>
										<small id="nombre_empresa_help" class="form-text text-dark-gray w200">Nombre preliminar</small>
									</div>
									<?php $validaciones[] = array('nombre_empresa', 'nombre_empresa_input', "'Error en nombre de Empresa. Favor de corregir.'"); ?>
								</div>

								<div class="row pb-1">
									<div class="col text-center">
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_nueva_empresa" id="btn_nueva_empresa" disabled>Crear nueva empresa</button>
										<button type="button" class="btn btn-warning text-center px-5 my-2" name="limpiar" id="limpiar" onclick="location.reload()">Limpiar</button>
									</div>
								</div>

							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Tab para empresa - asesor -->
		<div class="tab-pane fade mb-5" id="nav-asesores" role="tabpanel" aria-labelledby="nav-asesores-tab">
			<h6 class="text-center text-dark_gray pt-1 pb-1">Gestiona las empresas juveniles registradas y asocia al asesor que le corresponde.</h6>
			<div class="card shadow mb-5 pb-5 min-width:300px">
				<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">ADMINISTRAR EMPRESAS JUVENILES</div>
				<div class="card-body">
				<div id="empresas_juveniles"></div>
				<div class="row pb-1 pt-2">
					<div class="col text-center">
						<button type="button" class="btn btn-warning text-center px-5 my-2" onclick="guardar_asesor_por_empresa()">Guardar Asesores por Empresa</button>
					</div>
				</div>
				</div>
			</div>
		</div>
		<!-- Tab para ajustes -->
		<div class="tab-pane fade mb-5" id="nav-ajustes" role="tabpanel" aria-labelledby="nav-ajustes-tab">
			<h6 class="text-center text-dark_gray pt-1 pb-1">Configura las diversas variables del ciclo operativo.</h6>
			<div class="card shadow mb-5 pb-5 min-width:300px">
				<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">AJUSTES DEL CICLO</div>
				<div class="card-body">

					<div class="form-row pb-1">
						<div class="form-group col-2"></div>
						<div class="form-group col-8">
							<label for="accion" class="control-label text-dark-gray">Valor de la Acción: **</label>
							<input type="number" class="form-control rounded text-center" name="accion" id="accion" aria-describedby="user_help" min="75" max="100" required>
							<small id="user_help" class="form-text text-dark-gray w200">Los valores pueden ser entre $75 a $100. También determina la donación máxima que se aceptará a través de Crowdfunding</small>
						</div>
						<div class="form-group col-2"></div>
					</div>
					<div class="row pb-1 pt-2">
						<div class="col text-center">
							<button type="button" class="btn btn-warning text-center px-5 my-2" onclick="guardar_variables()">Guardar Variables</button>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="text-center"><div style="display: block" class="w-50 py-2 text-center text-dark_gray rounded mx-auto">Actualmente no tienes licencia habilitada para configurar. Dirígete a <a href="<?php echo $RAIZ_SITIO; ?>admin/licencias.php"><span class="badge badge-warning text-center px-3 py-2">LICENCIAS</span></a> para seleccionar una que se encuentre activa, y en "Acciones" marca la opción de "Habilitar licencia".</div></div>
<?php } ?>

<!-- Toast de Asociar -->
<div class="toast" data-delay="2000" style="position: fixed; top: 10%; right: 2%; z-index: 2000;">
	<div class="toast-header">
		<strong class="mr-auto text-primary toast_titulo"></strong>
		<small class="text-muted"></small>
		<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
	</div>
	<div class="toast-body">
		Se actualizará la página para ver los cambios y poder seguir configurando.
	</div>
</div>

<!-- Modal de Nuevo Estatus -->
<div class="modal fade" tabindex="-1" id="modalEstatus" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Nuevo Estatus</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="form-row pb-1">
						<div class="form-group col-2"></div>
						<div class="form-group col-8">
							<input name="Empresa_ID_nuevo_estatus" type="hidden" id="Empresa_ID_nuevo_estatus" value="">
							<div>
								<select name="nuevo_estatus" type="text" id="nuevo_estatus" class="form-control rounded" aria-describedby="nuevo_estatus_help">
									<option value="1">Activa</option>
									<option value="2">Inactiva</option>
									<option value="3">Cancelada</option>
								</select>
							</div>
						</div>
						<div class="form-group col-2"></div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-warning submitBtn" onclick="nuevo_estatus()">Cambiar estatus</button>
			</div>
		</div>
	</div>
</div>




<script type="text/javascript">
	$(document).ready(function(){
		var parametros = {
			"Centro_ID" : <?php echo $_SESSION['centro_ID']; ?>,
			"Licencia_ID" : <?php if (isset($_SESSION["licencia_activa"])) { echo $_SESSION['licencia_activa']; } else { echo "0";}?>
		};
		$.ajax({ //Patrocinadores disponibles
		  data:  parametros,
		  url: '../admin/ajax/patrocinadores_disponibles.php',
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
		  url: '../admin/ajax/patrocinadores_asociados.php',
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

		$.ajax({ //Escuelas disponibles
		  data:  parametros,
		  url: '../admin/ajax/escuelas_disponibles.php',
		  type: 'post',
		  success: function(data)
		  {
		  	$('#escuelas_disponibles').html(data)
			$('#escuelas_disp_table').DataTable( {
				"pagingType": "simple",
				responsive: true,
				"pageLength": 100,
			} );
			$('#escuelas_disp_table_wrapper div.row').addClass('col-sm-12');
		  }
		});

		$.ajax({ //Escuelas asociadas
		  data:  parametros,
		  url: '../admin/ajax/escuelas_asociadas.php',
		  type: 'post',
		  success: function(data)
		  {
		  	$('#escuelas_asociadas').html(data)
			$('#escuelas_asoc_table').DataTable( {
				"pagingType": "simple",
				responsive: true,
				"pageLength": 100,
			} );
			$('#escuelas_asoc_table_wrapper div.row').addClass('col-sm-12');
		  }
		});

		$.ajax({ //Empresas por escuela
		  data:  parametros,
		  url: '../admin/ajax/num_empresas_escuelas.php',
		  type: 'post',
		  success: function(data)
		  {
		  	$('#num_empresas_escuelas').html(data)
			$('#num_empresas_escuelas_table').DataTable( {
				"paging": false,
				"info": false,
				"searching": false,
				responsive: true,
				"pageLength": 100,
			} );
			$('#num_empresas_escuelas_table_wrapper div.row').addClass('col-sm-12');
		  }
		});

		$.ajax({ //Select escuela nueva empresa
		  data:  parametros,
		  url: '../admin/ajax/escuelas_asociadas_select.php',
		  type: 'post',
		  success: function(data)
		  {
		  	$('#select_escuela_nueva_empresa').append(data)
		  }
		});

		$.ajax({ //Empresas juveniles registradas
		  data:  parametros,
		  url: '../admin/ajax/empresas_juveniles.php',
		  type: 'post',
		  success: function(data)
		  {
		  	$('#empresas_juveniles').html(data)
			$('#empresas_juveniles_table').DataTable( {
				"paging": false,
				"info": false,
				"pageLength": 100,
				"scrollX": true,
			} );
			$('#empresas_juveniles_table_wrapper div.row').addClass('col-sm-12');

			$('[data-toggle="tooltip"]').tooltip();

			$('.select_nuevo_estatus i').click(function(){
				$('#modalEstatus .modal-title').text('Nuevo estatus para ' + $(this).data('nombre'));
				$('#Empresa_ID_nuevo_estatus').val($(this).data('empresa'));
				$('#nuevo_estatus').val($(this).data('estatus'));
				$('#modalEstatus').modal('show');
			})

		  }
		});

		$.ajax({ //Variables del ciclo
		  url: '../admin/ajax/mis_variables.php',
		  success: function(data)
		  {
		  	var array = JSON.parse(data);
		  	$("#accion").val(array.valor_accion);
		  }
		});

		$('.dataTables_length').parent().addClass('d-flex justify-content-start');
		$('.dataTables_filter').parent().addClass('d-flex justify-content-end');


		if (location.hash) {
			$("a[href='" + location.hash + "']").tab("show");
		}
		$(document.body).on("click", "a[data-toggle='tab']", function(event) {
			location.hash = this.getAttribute("href");
		});
	});

	// función para asociar patrocinador
	function asociar_patroc(opcion){
		var Licencia_ID = <?php if (isset($_SESSION["licencia_activa"])) { echo $_SESSION['licencia_activa']; } else { echo "0";}?>;
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
			"Licencia_ID" : Licencia_ID,
			"Array_asociar_patroc" : Array_asociar_patroc,
			"Asociar" : opcion,
		};
		$.ajax({
			data:  parametros,
			url: '../admin/ajax/asociar_patroc_ajax.php',
			type: 'post',
			success: function(data)
			{
				$('.toast_titulo').html('Patrocinador asociado/cancelado con éxito');
				$('.toast').toast('show');
				setTimeout(function(){location.reload()}, 2000);
			}
		});
	}

	// función para asociar escuela
	function asociar_escuelas(opcion){
		var Licencia_ID = <?php if (isset($_SESSION["licencia_activa"])) { echo $_SESSION['licencia_activa']; } else { echo "0";}?>;
		var Array_asociar_escuela = new Array();
		if (opcion == "Si") {
			$('input[type=checkbox].select_asociar_escuela:checked').each(function() {
				Array_asociar_escuela.push($(this).prop("id"));
			});
		} else if (opcion == "No") {
			$('input[type=checkbox].select_desasociar_escuela:not(:checked)').each(function() {
				Array_asociar_escuela.push($(this).prop("id"));
			});
		}
		var parametros = {
			"Licencia_ID" : Licencia_ID,
			"Array_asociar_escuela" : Array_asociar_escuela,
			"Asociar" : opcion,
		};
		$.ajax({
			data:  parametros,
			url: '../admin/ajax/asociar_escuela_ajax.php',
			type: 'post',
			success: function(data)
			{
				$('.toast_titulo').html('Escuela asociada/cancelada con éxito');
				$('.toast').toast('show');
				setTimeout(function(){location.reload()}, 2000);
			}
		});
	}

	// función para guardar_empresas_por_escuela
	function guardar_empresas_por_escuela(){
		var Licencia_ID = <?php if (isset($_SESSION["licencia_activa"])) { echo $_SESSION['licencia_activa']; } else { echo "0";}?>;
		var Array_empresas_por_escuela = new Array();
			$('input[type=number].input_empresas_por_escuela').each(function() {
				var row = [$(this).prop("id"), $(this).val()];
				Array_empresas_por_escuela.push(row);
			});
		var parametros = {
			"Licencia_ID" : Licencia_ID,
			"Array_empresas_por_escuela" : Array_empresas_por_escuela,
		};
		$.ajax({
			data:  parametros,
			url: '../admin/ajax/guardar_empresas_por_escuela.php',
			type: 'post',
			success: function(data)
			{
				$('.toast_titulo').html('Empresas por escuela almacenadas con éxito');
				$('.toast').toast('show');
				setTimeout(function(){location.reload()}, 2000);
			}
		});
	}

	function filtro_escuela_nueva_empresa(){
		var Escuela_ID = document.getElementById("select_escuela_nueva_empresa").value;
		if (Escuela_ID > 0) {
			$('#btn_nueva_empresa').prop('disabled', false);
		} else {
			$('#btn_nueva_empresa').prop('disabled', true);
		}
	}

	// función para cambio de estatus de empresa juvenil
	function nuevo_estatus(){
		var Empresa_ID_nuevo_estatus = document.getElementById("Empresa_ID_nuevo_estatus").value;
		var nuevo_estatus = document.getElementById("nuevo_estatus").value;
		var parametros = {
			"nuevo_estatus" : nuevo_estatus,
			"Empresa_ID_nuevo_estatus" : Empresa_ID_nuevo_estatus,
		};
		$.ajax({
			data:  parametros,
			url: '../admin/ajax/empresas_nuevo_estatus.php',
			type: 'post',
			success: function(data)
			{
				$('.toast_titulo').html('Estatus de empresa juvenil modificado con éxito');
				$('.toast').toast('show');
				$('#modalEstatus').modal('hide');
				setTimeout(function(){location.reload()}, 2000);
			}
		});
	}

	// función para guardar_asesor_por_empresa
	function guardar_asesor_por_empresa(){
		var Licencia_ID = <?php if (isset($_SESSION["licencia_activa"])) { echo $_SESSION['licencia_activa']; } else { echo "0";}?>;
		var Array_asesor_por_empresa = new Array();
			$('select[type=text].select_asesores').each(function() {
				var row = [$(this).prop("id"), $(this).val()];
				Array_asesor_por_empresa.push(row);
			});
		var parametros = {
			"Licencia_ID" : Licencia_ID,
			"Array_asesor_por_empresa" : Array_asesor_por_empresa,
		};
		$.ajax({
			data:  parametros,
			url: '../admin/ajax/guardar_asesor_por_empresa.php',
			type: 'post',
			success: function(data)
			{
				$('.toast_titulo').html('Asesores asignados con éxito.');
				$('.toast').toast('show');
				setTimeout(function(){location.reload()}, 2000);
			}
		});
	}

	// función para guardar variables
	function guardar_variables(){
		var Licencia_ID = <?php if (isset($_SESSION["licencia_activa"])) { echo $_SESSION['licencia_activa']; } else { echo "0";}?>;
		var valor_Accion = document.getElementById('accion').value;
		var parametros = {
			"Licencia_ID" : Licencia_ID,
			"valor_Accion" : valor_Accion,
		};
		$.ajax({
			data:  parametros,
			url: '../admin/ajax/guardar_variables.php',
			type: 'post',
			success: function(data)
			{
				$('.toast_titulo').html('Variables registradas con éxito.');
				$('.toast').toast('show');
				setTimeout(function(){location.reload()}, 2000);
			}
		});
	}

	// Funciones de validación al crear nuevo usuario
  	var error = document.getElementById('error');
<?php if (isset($_SESSION["licencia_activa"])) {
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
}
?>

</script>

<?php
	}
	include_once('../includes/admin_footer.php');
?>
