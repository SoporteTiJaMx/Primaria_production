<?php

    include_once('../includes/admin_header.php');
    include_once('../scripts/funciones.php');
    include_once('../scripts/conexion.php');
    include_once('../scripts/conexion2.php');
    include_once('../admin/side_navbar.php');

  if ($_SESSION["tipo"] != "Admin") {
    header('Location: ../error.php');
  } else {
	$centro_ID = $_SESSION["centro_ID"];
	$stmt=$con->prepare("SELECT proyectos.Proyecto_ID, proyectos.Proyecto_nombre FROM proyectos WHERE Proyecto_estatus='activo' AND Centro_ID = ? ORDER BY Proyecto_nombre");
	$stmt->bind_param("i", $centro_ID);
	$stmt->execute();
	$stmt->bind_result($Proyecto_ID, $Proyecto_nombre);
	$select_proyectos = "<select name='select_proyectos' type='text' id='select_proyectos' class='form-control rounded' onchange='validar_proyectos();' disabled>";
	$select_proyectos2 = "<select name='select_proyectos2' type='text' id='select_proyectos2' class='form-control rounded'>";
	$select_proyectos.= "<option value='0'>Selecciona proyecto</option>";
	$select_proyectos2.= "<option value='0'>Selecciona proyecto</option>";
	while ($result=$stmt->fetch()) {
		$select_proyectos.="<option value='" . $Proyecto_ID . "'>" . $Proyecto_nombre . "</option>";
		$select_proyectos2.="<option value='" . $Proyecto_ID . "'>" . $Proyecto_nombre . "</option>";
	}
	$select_proyectos.="</select>";
	$select_proyectos2.="</select>";
	$stmt->close();

	$stmt2=$con2->prepare("SELECT instituciones.Institucion_ID, instituciones.Institucion_nombre FROM instituciones WHERE instituciones.Centro_ID=$centro_ID");
	$stmt2->execute();
	$stmt2->bind_result($inst_id, $inst_nombre);
	$select_inst_options = "";
	while($stmt2->fetch()){
		$select_inst_options .= '
			<option value="-1" class="">Selecciona una institución</option>
			<option value="0" class="">Escuelas sin institución</option>
			<option value="'.$inst_id.'" class="">'.$inst_nombre.'</option>
		';
	}
	$select_inst = '
		<select name="institucion_id_1" id="institucion_id_1" class="form-control" onchange="escuelas_inst();">
			'.$select_inst_options.'
		</select>
	';
	$select_inst2 = '
		<select name="institucion_id_2" id="institucion_id_2" class="form-control" onchange="escuelas_inst2();">
			'.$select_inst_options.'
		</select>
	';
	$select_inst3 = '
		<select name="institucion_id_3" id="institucion_id_3" class="form-control" onchange="escuelas_inst3();">
			'.$select_inst_options.'
		</select>
	';
	$select_inst4 = '
		<select name="institucion_id_4" id="institucion_id_4" class="form-control" onchange="escuelas_inst4();">
			'.$select_inst_options.'
		</select>
	';

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
	<div class="nav nav-tabs" id="nav-tab" role="tablist">
		<a class="nav-item nav-link active" id="nav-crear-tab" data-toggle="tab" href="#nav-crear" role="tab" aria-controls="nav-crear" aria-selected="true">Crear Grupos</a>
		<a class="nav-item nav-link" id="nav-gestion-tab" data-toggle="tab" href="#nav-gestion" role="tab" aria-controls="nav-gestion" aria-selected="false">Gestionar Grupos</a>
		<a class="nav-item nav-link" id="nav-volgrup-tab" data-toggle="tab" href="#nav-volgrup" role="tab" aria-controls="nav-volgrup" aria-selected="false">Asignar Voluntarios a Grupos</a>
		<a class="nav-item nav-link" id="nav-proggrup-tab" data-toggle="tab" href="#nav-proggrup" role="tab" aria-controls="nav-proggrup" aria-selected="false">Asignar Programas a Grupos</a>
	</div>
</nav>
<div class="tab-content mx-5 pt-2 pb-5" id="nav-tabContent" >
	<!-- Tab para crear un nuevo grupo -->
	<div class="tab-pane fade show active" id="nav-crear" role="tabpanel" aria-labelledby="nav-crear-tab">
		<div class="card shadow">
			<div class="card-header text-center bg-dark-blue text-dark text-spaced-3"><?php echo strtoupper($lang["grupos_ttl"]); ?></div>
			<div class="card-body">

				<form action="<?php echo $RAIZ_SITIO; ?>scripts/admin/nuevo_grupo.php" method="post" class="mt-1">
					<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">

					<h5 class="text-center pb-3">Carga Manual de Grupos</h5>
					<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-dark rounded mx-auto"></div></div>
					<div class="row pb-3">
						<div class="col-12 offset-lg-3 col-lg-6">
							<label for="institucion_id_1" class="control-label text-dark-gray">Institución:</label>
							<?php echo $select_inst; ?>
							<small id="institucion_id_1_help" class="form-text text-dark-gray w200">Selecciona la institución a la que asociarás el grupo</small>
						</div>
					</div>
					<div class="form-row pb-1">
						<div class="form-group col-12 offset-lg-3 col-lg-6">
							<label for="select_escuela_1" class="control-label text-dark-gray">Escuela:</label>
							<select name="select_escuela_1" id="select_escuela_1" class="form-control" onchange="activar_proyecto();" require disabled>
								
							</select>
							<small id="select_escuela_1_help" class="form-text text-dark-gray w200">Selecciona la escuela a la que asociarás el grupo</small>
						</div>
					</div>
					<div class="row pb-3">
						<div class="col-12 offset-lg-3 col-lg-6">
							<label for="select_proyectos" class="control-label text-dark-gray">Proyecto:</label>
							<?php echo $select_proyectos; ?>
							<small id="select_proyectos_help" class="form-text text-dark-gray w200">Selecciona la escuela a la que asociarás el grupo</small>
						</div>
					</div>

					<div class="form-row pb-1">
						<div class="form-group col-3"></div>
						<div class="form-group col-6">
							<label for="name" class="control-label text-dark-gray">Nombre:</label>
							<input type="text" class="form-control rounded text-center" name="name" id="name" aria-describedby="name_help" required disabled>
							<small id="name_help" class="form-text text-dark-gray w200">Nombre de Grupo (ej, 1°A, 3°B, etc)</small>
						</div>
						<?php $validaciones[] = array('name', 'name_input', "'Ocurrió un error'"); ?>
						<div class="form-group col-3"></div>
					</div>
					<div class="row pb-3">
						<div class="col-12 offset-lg-3 col-lg-6">
							<label for="" class="control-label text-dark-gray">Grado al que pertenece:</label>
						</div>
						<div class="col-12 offset-lg-3 col-lg-6">
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="grupo1" name="grado" value="1" class="custom-control-input" disabled>
								<label class="custom-control-label" for="grupo1">1</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="grupo2" name="grado" value="2" class="custom-control-input" disabled>
								<label class="custom-control-label" for="grupo2">2</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="grupo3" name="grado" value="3" class="custom-control-input" disabled>
								<label class="custom-control-label" for="grupo3">3</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="grupo4" name="grado" value="4" class="custom-control-input" disabled>
								<label class="custom-control-label" for="grupo4">4</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="grupo5" name="grado" value="5" class="custom-control-input" disabled>
								<label class="custom-control-label" for="grupo5">5</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="grupo6" name="grado" value="6" class="custom-control-input" disabled>
								<label class="custom-control-label" for="grupo6">6</label>
							</div>
						</div>
						<div class="col-12 offset-lg-3 col-lg-6">
							<small id="name_help" class="form-text text-dark-gray w200">Indica el grado del grupo que estás cargando.</small>
						</div>
					</div>

					<div class="row pb-1">
						<div class="col text-center">
							<button type="submit" class="btn btn-warning text-center px-5 my-2" name="guardar" id="guardar" disabled>Crear Grupo</button>
							<button type="button" class="btn btn-dark text-center px-5 my-2" name="cancelar" id="cancelar" onclick="location.reload()">Cancelar</button>
						</div>
					</div>
				</form>
				<hr class="oscura">
				<form action="<?php echo $RAIZ_SITIO; ?>scripts/admin/muchos_grupos.php" method="post" class="mt-1" enctype="multipart/form-data">
					<h5 class="text-center pb-3">Carga Masiva de Grupos</h5>
					<div class="row pb-3">
						<div class="col-3"></div>
						<div class="col-6">
							<div><?php echo $lang["grupos_inst_1"]; ?>:</div><br>
							<div><i class="fas fa-chevron-right pr-2"></i>Primero selecciona el proyecto al que estará vinculado el grupo.</div>
							<div><i class="fas fa-chevron-right pr-2"></i>Descarga la plantilla <a href="carga_masiva_grupos.csv" download>AQUÍ</a> .</div>
							<div><i class="fas fa-chevron-right pr-2"></i>Ingresa tantas filas como grupos desees agregar (no modifiques los encabezados de columna).</div>
							<div><i class="fas fa-chevron-right pr-2"></i>Guárdalo y súbelo. Asegúrate que sea un archivo .CSV.</div>
						</div>
						<div class="col-3"></div>
					</div>
					<div class="row mt-3 errores_docs mb-3">
						<div class="col-3"></div>
						<div class="col-6">
							<div class="text-center"><div id="error2" class="bg-danger w-75 py-2 text-center text-dark rounded mx-auto">Error al cargar el archivo</div></div>
						</div>
						<div class="col-3"></div>
					</div>
					<div class="row pb-3">
						<div class="col-12 offset-lg-3 col-lg-6">
							<?php echo $select_proyectos2; ?>
						</div>
					</div>
					<div class="row pb-3">
						<div class="col-12 offset-lg-3 col-lg-6">
							<?php echo $select_escuela2; ?>
						</div>
					</div>
					<div class="col-12 text-center">
						<div class="col-3"></div>
						<div class="custom-file mb-3 mt-1 col-6">
							<input id="upload" name="upload" type="file" class="custom-file-input" accept=".csv" onchange="validar_csv(upload);">
							<label for="upload" class="custom-file-label">Selecciona un archivo</label>
						</div>
						<div class="col-3"></div>
					</div>
					<div class="row pb-1">
						<div class="col text-center">
							<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_subir_csv" id="btn_subir_csv" disabled>Crear Grupos</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
	<!-- Tab para administración de grupos -->
	<div class="tab-pane fade mb-5" id="nav-gestion" role="tabpanel" aria-labelledby="nav-gestion-tab">
		<div class="card shadow mb-5 pb-5 min-width:300px">
			<div class="card-header text-center bg-dark-blue text-dark text-spaced-3" id="card-title">Administrar Grupos</div>
			<div class="card-body">
				<div class="row pb-3">
					<div class="col-12 offset-lg-3 col-lg-6">
						<label for="institucion_id_1" class="control-label text-dark-gray">Institución:</label>
						<?php echo $select_inst2; ?>
						<small id="institucion_id_1_help" class="form-text text-dark-gray w200">Selecciona la institución para filtrar escuelas.</small>
					</div>
				</div>
				<div class="form-row pb-1">
					<div class="form-group col-12 offset-lg-3 col-lg-6">
						<label for="select_escuela_2" class="control-label text-dark-gray">Escuela:</label>
						<select name="select_escuela_2" id="select_escuela_2" class="form-control" onchange="activar_proyecto2();" require disabled>
							
						</select>
						<small id="select_escuela_2_help" class="form-text text-dark-gray w200">Selecciona la escuela para filtrar grupos.</small>
					</div>
				</div>
				<div id="result"></div>
			</div>
		</div>
	</div>
	<!-- Tab para asignación de voluntarios -->
	<div class="tab-pane fade mb-5" id="nav-volgrup" role="tabpanel" aria-labelledby="nav-volgrup-tab">
		<div class="card shadow mb-5 pb-5 min-width:300px">
			<div class="card-header text-center bg-dark-blue text-dark text-spaced-3" id="card-title">Asignar Voluntario a Grupo</div>
			<div class="card-body">
			<form action="<?php echo $RAIZ_SITIO; ?>scripts/admin/registrar_voluntarios.php" method="post" class="mt-1" enctype="multipart/form-data">
				<input name="csrf1" type="hidden" id="csrf1" value="<?php echo $_SESSION['token']; ?>">
				<div class="col-12 offset-lg-3 col-lg-6">
					<label for="institucion_id_3" class="control-label text-dark-gray">Institución:</label>
					<?php echo $select_inst3; ?>
					<small id="institucion_id_3_help" class="form-text text-dark-gray w200">Selecciona la institución para filtrar escuelas.</small>
				</div>
				<div class="form-group col-12 offset-lg-3 col-lg-6">
					<label for="select_escuela_3" class="control-label text-dark-gray">Escuela:</label>
					<select name="select_escuela_3" id="select_escuela_3" class="form-control" onchange="activar_proyecto3();" require disabled>
						
					</select>
					<small id="select_escuela_3_help" class="form-text text-dark-gray w200">Selecciona la escuela para filtrar grupos.</small>
				</div>
				<div class="col-12" id="result2"></div>
				<div class="row pb-1 pt-2">
					<div class="col text-center">
						<button type="submit" class="btn btn-warning text-center px-5 my-2">Asignar Voluntarios</button>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
	<!-- Tab para asignar programas a grupos -->
	<div class="tab-pane fade mb-5" id="nav-proggrup" role="tabpanel" aria-labelledby="nav-proggrup-tab">
		<div class="card shadow mb-5 pb-5 min-width:300px">
			<div class="card-header text-center bg-dark-blue text-dark text-spaced-3" id="card-title">Asignar Voluntario a Grupo</div>
			<div class="card-body">
			<form action="<?php echo $RAIZ_SITIO; ?>scripts/admin/registrar_programas.php" method="post" class="mt-1" enctype="multipart/form-data">
				<input name="csrf2" type="hidden" id="csrf2" value="<?php echo $_SESSION['token']; ?>">
				<div class="col-12 offset-lg-3 col-lg-6">
					<label for="institucion_id_4" class="control-label text-dark-gray">Institución:</label>
					<?php echo $select_inst4; ?>
					<small id="institucion_id_4_help" class="form-text text-dark-gray w200">Selecciona la institución para filtrar escuelas.</small>
				</div>
				<div class="form-group col-12 offset-lg-3 col-lg-6">
					<label for="select_escuela_4" class="control-label text-dark-gray">Escuela:</label>
					<select name="select_escuela_4" id="select_escuela_4" class="form-control" onchange="activar_proyecto4();" require disabled>
						
					</select>
					<small id="select_escuela_4_help" class="form-text text-dark-gray w200">Selecciona la escuela para filtrar grupos.</small>
				</div>
				<div class="col-12" id="result3"></div>
				<div class="row pb-1 pt-2">
					<div class="col text-center">
						<button type="submit" class="btn btn-warning text-center px-5 my-2">Asignar Programas</button>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>

<!-- Toast de asociar voluntarios -->
<div class="toast asociar" data-delay="2000" style="position: fixed; top: 10%; right: 2%; z-index: 2000;">
	<div class="toast-header">
		<strong class="mr-auto text-primary toast_titulo"></strong>
		<small class="text-muted"></small>
		<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
	</div>
	<div class="toast-body">
		Actualizar Página
	</div>
</div>

<!-- Modal y Toast de Nuevo Estatus -->
<div class="modal fade" tabindex="-1" id="modalEstatus" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Estatus del voluntario</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="form-row pb-1">
						<div class="form-group col-2"></div>
						<div class="form-group col-8">
		    				<input name="Grupo_ID_nuevo_estatus" type="hidden" id="Grupo_ID_nuevo_estatus" value="">
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
		<strong class="mr-auto text-primary">Estatus</strong>
		<small class="text-muted"></small>
		<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
	</div>
	<div class="toast-body">
		Recargar
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
			" . $validaciones[$i][1] . ".classList.remove('input_error');
			}
		});
		";
	}
?>

	$(document).ready(function(){
		$('.errores_docs').hide();
		
	});

	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});

	function validar_proyectos(){
		var select_proyectos = document.getElementById("select_proyectos").selectedIndex;
		if (select_proyectos==0) {
			$('.error').hide();
			$('#guardar').prop('disabled', true);
			$('#name').prop('disabled', true);
			$('#grupo1').prop('disabled', true);
			$('#grupo2').prop('disabled', true);
			$('#grupo3').prop('disabled', true);
			$('#grupo4').prop('disabled', true);
			$('#grupo5').prop('disabled', true);
			$('#grupo6').prop('disabled', true);
		} else {
			$('.error').show();
			$('#guardar').prop('disabled', false);
			$('#name').prop('disabled', false);
			$('#grupo1').prop('disabled', false);
			$('#grupo2').prop('disabled', false);
			$('#grupo3').prop('disabled', false);
			$('#grupo4').prop('disabled', false);
			$('#grupo5').prop('disabled', false);
			$('#grupo6').prop('disabled', false);
		}
	}

	function validar_csv(id){
		var select_proyectos2 = document.getElementById("select_proyectos2").selectedIndex;
		var archivo = $(id).val();
		var extension = archivo.substring(archivo.lastIndexOf("."));
		if(extension != ".csv"){
			$('.errores_docs').show();
			$('#btn_subir_csv').prop('disabled', true);
		} else {
			if (select_proyectos2==0) {
				$('#error2').html('Debes seleccionar proyecto primero');
				$('.errores_docs').show();
				$('#btn_subir_csv').prop('disabled', true);
			} else {
				$('#error2').html('<?php echo $lang["error_csv"]; ?>');
				$('.errores_docs').hide();
				$('#btn_subir_csv').prop('disabled', false);
			}
		}
	}

	// función para guardar_voluntario_por_grupo
	function guardar_voluntario_por_grupo(){
		var Array_voluntario_por_grupo = new Array();
		$('select[type=text].select_grupos').each(function() {
			var row = [$(this).prop("id"), $(this).val()];
			Array_voluntario_por_grupo.push(row);
		});
	    var parametros = {
			"Array_voluntario_por_grupo" : Array_voluntario_por_grupo,
	    };
	    $.ajax({
			data:  parametros,
			url: '../scripts/admin/guardar_voluntario_por_grupo_ajax.php',
			type: 'post',
			success: function(data)
			{
				$('.toast_titulo').html('<?php echo $lang["grupos_volunt_guardar"]; ?>');
				$('.toast.asociar').toast('show');
				setTimeout(function(){location.reload()}, 3000);
			}
	    });
	}

	// función para cambio de estatus de grupo
	function nuevo_estatus(){
		var Grupo_ID_nuevo_estatus = document.getElementById("Grupo_ID_nuevo_estatus").value;
		var nuevo_estatus = document.getElementById("nuevo_estatus").selectedIndex;
		var parametros = {
			"nuevo_estatus" : nuevo_estatus,
			"Grupo_ID_nuevo_estatus" : Grupo_ID_nuevo_estatus,
		};
		$.ajax({
			data:  parametros,
			url: '../scripts/admin/grupo_nuevo_estatus_ajax.php',
			type: 'post',
			success: function(data)
			{
				//alert(data);
				$('.toast.estatus').toast('show');
				$('#modalEstatus').modal('hide');
				setTimeout(function(){location.reload()}, 3000);
			}
		});
	}
	function escuelas_inst(){
		let institucion_id = document.getElementById("institucion_id_1").value;
		if(institucion_id >= 0){
			//console.log(institucion_id);
			$("#select_escuela_1").removeAttr('disabled');
		}else{
			$("#select_escuela_1").attr("disabled", true);
			$("#name").attr("disabled", true);
		}
		var param = {
			"Institucion_ID": institucion_id,
			"Centro_ID": <?php echo $_SESSION["centro_ID"]; ?>
		};
		$.ajax({
			data: param,
			url: 'ajax/escuelas_inst_filtro.php',
			type: 'post',
			success: function(data)
			{
				//console.log(data);
				$("#select_escuela_1").html(data);
			}
		})
	}
	function activar_proyecto(){
		let escuela_id = document.getElementById("select_escuela_1").value;
		if(escuela_id > 0){
			$("#select_proyectos").removeAttr('disabled');
		}else{
			$("#select_proyectos").attr("disabled", true);
		}
	}
	function escuelas_inst2(){
		let institucion_id = document.getElementById("institucion_id_2").value;
		if(institucion_id >= 0){
			console.log(institucion_id);
			$("#select_escuela_2").removeAttr('disabled');
		}else{
			$("#select_escuela_2").attr("disabled", true);
		}
		var param = {
			"Institucion_ID": institucion_id,
			"Centro_ID": <?php echo $_SESSION["centro_ID"]; ?>
		};
		$.ajax({
			data: param,
			url: 'ajax/escuelas_inst_filtro.php',
			type: 'post',
			success: function(data)
			{
				//console.log(data);
				$("#select_escuela_2").html(data);
			}
		})
	}
	function activar_proyecto2(){
		let escuela_id = document.getElementById("select_escuela_2").value;
		param = {
			"Escuela_ID": escuela_id,
		}
		$.ajax({
			data: param,
			url: '../scripts/admin/grupos_administrar_ajax.php',
			type: 'post',
			success: function(data)
			{
				//console.log(data);
				$('#result').html(data)
				$('#grupos_table').DataTable({
					"pagingType": "simple",
			        "pageLength": 100,
			        "scrollX": true,
			        "order": [[1, "asc"]]
				});
				$('#grupos_table_wrapper div.row').addClass('col-sm-12');
				$('.dataTables_length').parent().addClass('d-flex justify-content-start');
				$('.dataTables_filter').parent().addClass('d-flex justify-content-end');
				$('ul.pagination').addClass('pagination-sm');

			    $('[data-toggle="tooltip"]').tooltip();

				$('.select_nuevo_estatus i').click(function(){
					$('#modalEstatus .modal-title').text('<?php echo $lang["volunt_modal_estatus_6"]; ?>' + $(this).data('nombre'));
					$('#Grupo_ID_nuevo_estatus').val($(this).data('grupo'));
					$('#nuevo_estatus').val($(this).data('estatus'));
					$('#modalEstatus').modal('show');
				})

			}
		})
	}
	function escuelas_inst3(){
		let institucion_id = document.getElementById("institucion_id_3").value;
		if(institucion_id >= 0){
			//console.log(institucion_id);
			$("#select_escuela_3").removeAttr('disabled');
		}else{
			$("#select_escuela_3").attr("disabled", true);
		}
		var param = {
			"Institucion_ID": institucion_id,
			"Centro_ID": <?php echo $_SESSION["centro_ID"]; ?>
		};
		$.ajax({
			data: param,
			url: 'ajax/escuelas_inst_filtro.php',
			type: 'post',
			success: function(data)
			{
				//console.log(data);
				$("#select_escuela_3").html(data);
			}
		})
	}
	function activar_proyecto3(){
		let escuela_id = document.getElementById("select_escuela_3").value;
		param = {
			"Escuela_ID": escuela_id,
		}
		$.ajax({
			data: param,
			url: '../scripts/admin/voluntario_mostrar_ajax.php',
			type: 'post',
			success: function(data)
			{
				//console.log(data);
				$('#result2').html(data)
				$('#vol_grupo_table').DataTable({
					"pagingType": "simple",
			        "pageLength": 100,
			        "scrollX": true,
			        "order": [[1, "asc"]]
				});
				$('#vol_grupo_table_wrapper div.row').addClass('col-sm-12');
			}
		})
	}
	function escuelas_inst4(){
		let institucion_id = document.getElementById("institucion_id_4").value;
		if(institucion_id >= 0){
			//console.log(institucion_id);
			$("#select_escuela_4").removeAttr('disabled');
		}else{
			$("#select_escuela_4").attr("disabled", true);
		}
		var param = {
			"Institucion_ID": institucion_id,
			"Centro_ID": <?php echo $_SESSION["centro_ID"]; ?>
		};
		$.ajax({
			data: param,
			url: 'ajax/escuelas_inst_filtro.php',
			type: 'post',
			success: function(data)
			{
				//console.log(data);
				$("#select_escuela_4").html(data);
			}
		})
	}
	function activar_proyecto4(){
		let escuela_id = document.getElementById("select_escuela_4").value;
		param = {
			"Escuela_ID": escuela_id,
		}
		$.ajax({
			data: param,
			url: '../scripts/admin/grupos_proyecto_ajax.php',
			type: 'post',
			success: function(data)
			{
				//console.log(data);
				$('#result3').html(data)
				$('#prog_grupo_table').DataTable({
					"pagingType": "simple",
			        "pageLength": 100,
			        "scrollX": true,
			        "order": [[1, "asc"]]
				});
				$('#prog_grupo_table_wrapper div.row').addClass('col-sm-12');
			}
		})
	}
</script>

<?php
	}
	include_once('../includes/admin_footer.php');
?>

