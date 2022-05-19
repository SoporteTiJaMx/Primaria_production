<?php
	include_once('../includes/superadmin_header.php');
	include_once('../scripts/funciones.php');
	include_once('../superadmin/side_navbar.php');
	$_SESSION["token"] = md5(uniqid(mt_rand(), true));

	if ($_SESSION["tipo"] != "Sadmin") {
		header('Location: ../error.php');
	} else {
?>

<link rel="stylesheet" href="../css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="../css/responsive.bootstrap4.css">
<script src="../js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.responsive.min.js" crossorigin="anonymous"></script>
<script src="../js/responsive.bootstrap4.min.js" crossorigin="anonymous"></script>


<nav class="mx-5 my-3">
	<div class="nav nav-tabs" id="nav-tab" role="tablist">
		<a class="nav-item nav-link active" id="nav-crear-tab" data-toggle="tab" href="#nav-crear" role="tab" aria-controls="nav-crear" aria-selected="true">Crear usuarios</a>
		<a class="nav-item nav-link" id="nav-gestion-tab" data-toggle="tab" href="#nav-gestion" role="tab" aria-controls="nav-gestion" aria-selected="false">Administrar usuarios</a>
	</div>
</nav>
<div class="tab-content mx-5 px-3 mb-5" id="nav-tabContent" >
	<!-- Tab para crear un nuevo usuario -->
	<div class="tab-pane fade show active" id="nav-crear" role="tabpanel" aria-labelledby="nav-crear-tab">
		<div class="card shadow">
			<div class="card-header text-center text-dark-gray text-spaced-3">CREAR NUEVO USUARIO</div>
			<div class="card-body">

				<form action="<?php echo $RAIZ_SITIO; ?>scripts/superadmin/crear_usuario.php" method="post" class="mt-1">
					<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">

					<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto"></div></div>

					<div class="form-row pb-1">
						<div class="form-group col-2"></div>
						<div class="form-group col-4">
							<label for="nombre" class="control-label text-dark-gray">Nombre:</label>
							<input type="text" class="form-control rounded text-center" name="nombre" id="nombre" aria-describedby="nombre_help" required>
							<small id="nombre_help" class="form-text text-dark-gray w200">Nombre(s)</small>
						</div>
						<?php $validaciones[] = array('nombre', 'nombre_input', "'Error en Nombre. Favor de corregir.'"); ?>

						<div class="form-group col-4">
							<label for="ap_paterno" class="control-label text-pale-gray">.</label>
							<input type="text" class="form-control rounded text-center" name="ap_paterno" id="ap_paterno" aria-describedby="ap_paterno_help" required>
							<small id="ap_paterno_help" class="form-text text-dark-gray w200">Apellido</small>
						</div>
						<?php $validaciones[] = array('ap_paterno', 'ap_paterno_input', "'Error en Apellido. Favor de corregir.'"); ?>
						<div class="form-group col-2"></div>
					</div>

					<div class="form-row pb-1">
						<div class="form-group col-2"></div>
						<div class="form-group col-4">
							<label for="correo" class="control-label text-dark-gray">E-mail:</label>
							<input type="text" class="form-control rounded text-center" name="correo" id="correo" aria-describedby="correo_help" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
							<small id="correo_help" class="form-text text-dark-gray w200">Correo electrónico</small>
						</div>
						<?php $validaciones[] = array('correo', 'correo_input', "'Error en E-mail. Favor de corregir.'"); ?>
						<div class="form-group col-4">
							<label for="tipo" class="control-label text-dark-gray">Tipo:</label>
							<select name="tipo" type="text" id="tipo" class="form-control rounded" aria-describedby="tipo_help" onChange="validar()" required>
								<option value="0">Selecciona tipo de usuario</option>
								<option value="1">Superadministrador</option>
								<option value="2">Administrador</option>
								<?php /*
								<option value="3">Vinculador/Coordinador</option>
								<option value="4">Asesor</option>
								<option value="5">Participante</option>
								*/ ?>
							</select>
							<small id="tipo_help" class="form-text text-dark-gray w200">Tipo de usuario</small>
						</div>
						<div class="form-group col-2"></div>
					</div>

					<div class="form-row pb-1">
						<div class="form-group col-6"></div>
						<div class="form-group col-4">
							<label for="centro" class="control-label text-dark-gray">Centro:</label>
							<select name="centro" type="text" id="centro" class="form-control rounded" aria-describedby="centro_help" disabled required>

							</select>
							<small id="centro_help" class="form-text text-dark-gray w200">Centro del Administrador</small>
						</div>
						<div class="form-group col-2"></div>
					</div>
					<?php $validaciones[] = array('centro', 'centro_input', "'Error en Centro. Debes seleccionar uno.'"); ?>

					<div class="row pb-1">
						<div class="col text-center">
							<button type="submit" class="btn btn-warning text-center px-5 my-2" name="crear" id="crear" disabled>Crear usuario</button>
							<button type="button" class="btn btn-warning text-center px-5 my-2" name="limpiar" id="limpiar" onclick="location.reload()">Limpiar</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
	<!-- Tab para administración de usuarios -->
	<div class="tab-pane fade mb-5" id="nav-gestion" role="tabpanel" aria-labelledby="nav-gestion-tab">
		<div class="card shadow mb-5 pb-5 min-width:300px">
			<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">ADMINISTRAR USUARIOS</div>
			<div class="card-body">

			<div class="form-row pb-1">
				<div class="form-group col-2"></div>
				<div class="form-group row col-8">
					<label for="tipo_filtro" class="col-sm-2 col-form-label text-right">Filtrar por:</label>
					<div class="col-sm-8">
						<select name="tipo_filtro" type="text" id="tipo_filtro" class="form-control rounded" aria-describedby="tipo_help" onChange="filtrar()">
							<option value="0">Selecciona tipo de usuario</option>
							<option value="1">Superadministrador</option>
							<option value="2">Administrador</option>
							<option value="6">Vinculador</option>
							<option value="3">Coordinador</option>
							<option value="4">Asesor</option>
							<option value="5">Participante</option>
						</select>
					</div>
				</div>
				<div class="form-group col-2"></div>
			</div>
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
							<input name="User_ID_nuevo_estatus" type="hidden" id="User_ID_nuevo_estatus" value="">
							<input name="tipo_nuevo_estatus" type="hidden" id="tipo_nuevo_estatus" value="">
							<div>
								<select name="nuevo_estatus" type="text" id="nuevo_estatus" class="form-control rounded" aria-describedby="tipo_help">
									<option value="0">Pendiente de perfil</option>
									<option value="1">Activo</option>
									<option value="2">Suspendido</option>
									<option value="3">Cancelado</option>
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
<div class="toast estatus" data-delay="5000" style="position: fixed; top: 10%; right: 2%; z-index: 2000;">
	<div class="toast-header">
		<strong class="mr-auto text-primary">Estatus actualizado con éxito</strong>
		<small class="text-muted"></small>
		<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
	</div>
	<div class="toast-body">
		Puedes seguir gestionando tus usuarios.
	</div>
</div>

<!-- Modal y Toast de Resetear datos -->
<div class="modal fade" tabindex="-1" id="modalResetear" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Resetear datos de acceso</h5>
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
							<input name="tipo_resetear_datos" type="hidden" id="tipo_resetear_datos" value="">
							<div>
								<select name="accion_resetear" type="text" id="accion_resetear" class="form-control rounded" aria-describedby="tipo_help" onChange="validar_accion_resetear()">
									<option value="0">Selecciona tipo de reseteo</option>
									<option value="1">Resetear usuario y contraseña</option>
									<option value="2">Resetear sólo contraseña</option>
								</select>
							</div>
						</div>
						<div class="form-group col-2"></div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-warning submitBtn" name="enviar_mail" id="enviar_mail"  onclick="resetear_datos()" disabled>Enviar mail para reseteo</button>
			</div>
		</div>
	</div>
</div>
<div class="toast resetear" data-delay="5000" style="position: fixed; top: 10%; right: 2%; z-index: 2000;">
	<div class="toast-header">
		<strong class="mr-auto text-primary">E-mail enviado con éxito</strong>
		<small class="text-muted"></small>
		<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
	</div>
	<div class="toast-body">
		Se ha enviado el e-mail con las instrucciones para el reseteo al usuario seleccionado.
	</div>
</div>

<script type="text/javascript">
	// Funciones de validación al crear nuevo usuario
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
				error.className = '';
			" . $validaciones[$i][1] . ".classList.remove('input_error');
			}
		});
		";
	}
?>

	// toggle button crear usuario
	function validar(){
		var indice = document.getElementById("tipo").selectedIndex;
		var centro = document.getElementById("centro").selectedIndex;
		if(indice != 0 && error.style.display!="block") {
			$('#crear').prop('disabled', false);
			if(indice == 2) {
				$('#centro').prop('disabled', false);
			} else {
				$('#centro').prop('disabled', true);
			}
		} else {
			$('#crear').prop('disabled', true);
			$('#centro').prop('disabled', true);
		}
	}

	// filtro administración de usuarios
	function filtrar(){
		var tipo_filtro = document.getElementById("tipo_filtro").value;
		if (tipo_filtro == 0) {
			$('#card-title').text("ADMINISTRAR USUARIOS")
		} else if (tipo_filtro == 1) {
			$('#card-title').text("ADMINISTRAR USUARIOS SUPERADMINISTRADORES")
		} else if (tipo_filtro == 2) {
			$('#card-title').text("ADMINISTRAR USUARIOS ADMINISTRADORES")
		} else if (tipo_filtro == 3) {
			$('#card-title').text("ADMINISTRAR USUARIOS COORDINADORES")
		} else if (tipo_filtro == 4) {
			$('#card-title').text("ADMINISTRAR USUARIOS ASESORES")
		} else if (tipo_filtro == 5) {
			$('#card-title').text("ADMINISTRAR USUARIOS JÓVENES PARTICIPANTES")
		} else if (tipo_filtro == 6) {
			$('#card-title').text("ADMINISTRAR USUARIOS VINCULADORES")
		}
		var parametros = {
		  "tipo" : tipo_filtro
		};
		$.ajax({
		  data:  parametros,
		  url: '../scripts/ajax/usuarios_administrar_ajax.php',
		  type: 'post',
		  success: function(data)
		  {
		  	$('#result').html(data)
			$('#usuarios_table').DataTable( {
				"pagingType": "simple",
				responsive: true,
			} );
			$('#usuarios_table_wrapper div.row').addClass('col-sm-12');
			$('.dataTables_length').parent().addClass('d-flex justify-content-start');
			$('.dataTables_filter').parent().addClass('d-flex justify-content-end');
			$('ul.pagination').addClass('pagination-sm');
			$('[data-toggle="tooltip"]').tooltip();
			$('.select_nuevo_estatus i').click(function(){
				$('#modalEstatus .modal-title').text('Nuevo estatus para ' + $(this).data('nombre'));
				$('#User_ID_nuevo_estatus').val($(this).data('user_id'));
				$('#tipo_nuevo_estatus').val($(this).data('tipo'));
				$('#nuevo_estatus').val($(this).data('estatus'));
			})
			$('.resetear_datos_acceso i').click(function(){
				$('#modalResetear .modal-title').text('Resetear datos de acceso de ' + $(this).data('nombre'));
				$('#User_ID_resetear_datos').val($(this).data('user_id'));
				$('#tipo_resetear_datos').val($(this).data('tipo'));
				$('#accion_resetear').val(0);
				$('#enviar_mail').prop('disabled', true);
			})
		  }
		});
	}

	// función para ir a tab en administración de usuarios
	function activaTab(tab){
		$('.nav-tabs a[href="#' + tab + '"]').tab('show');
	};

	// función para cambio de estatus de usuario
	function nuevo_estatus(){
		var User_ID_nuevo_estatus = document.getElementById("User_ID_nuevo_estatus").value;
		var tipo_nuevo_estatus = document.getElementById("tipo_nuevo_estatus").value;
		var nuevo_estatus = document.getElementById("nuevo_estatus").selectedIndex;
		var parametros = {
			"nuevo_estatus" : nuevo_estatus,
			"User_ID_nuevo_estatus" : User_ID_nuevo_estatus,
			"tipo_nuevo_estatus" : tipo_nuevo_estatus,
		};
		$.ajax({
			data:  parametros,
			url: '../scripts/ajax/usuarios_nuevo_estatus_ajax.php',
			type: 'post',
			success: function(data)
			{
				$('.toast.estatus').toast('show');
				$('#modalEstatus').modal('hide');
				activaTab('nav-gestion');
				$('#tipo_filtro').val(tipo_nuevo_estatus).change();
			}
		});
	}

	// toggle button Modal Datos de Acceso
	function validar_accion_resetear(){
		var indice_resetear = document.getElementById("accion_resetear").selectedIndex;
		if( indice_resetear != 0) {
			$('#enviar_mail').prop('disabled', false);
		} else {
			$('#enviar_mail').prop('disabled', true);
		}
	}

	// función para reseteo de datos de acceso de usuario
	function resetear_datos(){
		var User_ID_resetear_datos = document.getElementById("User_ID_resetear_datos").value;
		var tipo_resetear_datos = document.getElementById("tipo_resetear_datos").value;
		var accion_resetear = document.getElementById("accion_resetear").selectedIndex;
		var parametros = {
			"User_ID_resetear_datos" : User_ID_resetear_datos,
			"tipo_resetear_datos" : tipo_resetear_datos,
			"accion_resetear" : accion_resetear
		};
		$.ajax({
			data:  parametros,
			url: '../scripts/ajax/usuarios_resetear_acceso_ajax.php',
			type: 'post',
			success: function(data)
			{
				$('.toast.resetear').toast('show');
				$('#modalResetear').modal('hide');
				activaTab('nav-gestion');
				$('#tipo_filtro').val(tipo_resetear_datos).change();
			}
		});
	}

	$(document).ready(function(){
		$.ajax({
			url: '../includes/centros_todos.php',
			success: function(data)
			{
				$('#centro').html("<option value=''>Selecciona centro</option>" + data);
			}
		});
	});

	$('#correo').on('keyup', function(){
		var correo_input = document.getElementById('correo');
		var parametros = {
			"valor" : $(this).val(),
		};
		$.ajax({
			data:  parametros,
			url: '../includes/mail_bd.php',
			type: 'post',
			success: function(data)
			{
				if (data == "erro") {
					error.textContent   = "Correo ya registrado. Ingresar otro.";
					error.style.display = 'block';
					error.classList.add('animated');
					error.classList.add('shake');
					correo_input.classList.add('input_error');
					$('#crear').prop('disabled', true);
				} else if (data != "erro") {
				}
			}
		});
	});
</script>

<?php
	include_once('../includes/superadmin_footer.php');
	}
?>