<?php
	include_once('../includes/admin_header.php');
	include_once('../scripts/funciones.php');
	include_once('../admin/side_navbar.php');
	include_once('../scripts/conexion.php');

	if ($_SESSION["tipo"] != "Admin") {
		header('Location: ../error.php');
	} else {

	$_SESSION["token"] = md5(uniqid(mt_rand(), true));
?>

<link rel="stylesheet" href="../css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="../css/responsive.bootstrap4.css">
<link rel="stylesheet" href="../css/bootstrap-datepicker.css">
<script src="../js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.responsive.min.js" crossorigin="anonymous"></script>
<script src="../js/responsive.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="../js/bootstrap-datepicker.js"></script>
<script src="../js/bootstrap-datepicker.es.min.js"></script>


<?php if (isset($_SESSION["licencia_activa"])) { ?>
<nav class="mx-5 my-3">
	<div class="nav nav-tabs" id="nav-tab" role="tablist">
		<a class="nav-item nav-link active" id="nav-crear-tab" data-toggle="tab" href="#nav-crear" role="tab" aria-controls="nav-crear" aria-selected="true">Ingresar nuevo aviso</a>
		<a class="nav-item nav-link" id="nav-gestion-tab" data-toggle="tab" href="#nav-gestion" role="tab" aria-controls="nav-gestion" aria-selected="false">Revisar / actualizar avisos</a>
	</div>
</nav>
<div class="tab-content mx-5 px-3 mb-5" id="nav-tabContent" >
	<!-- Tab para crear nuevo aviso -->
	<div class="tab-pane fade show active" id="nav-crear" role="tabpanel" aria-labelledby="nav-crear-tab">
		<div class="card shadow">
			<div class="card-header text-center text-dark-gray text-spaced-3">INGRESAR NUEVO AVISO PARA <?php echo mb_strtoupper($_SESSION['nombre_licencia'],'utf-8'); ?></div>
			<div class="card-body">

				<form action="<?php echo $RAIZ_SITIO; ?>scripts/admin/nuevo_aviso.php" method="post" class="mt-1">
					<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
					<input name="accion" type="hidden" value="nueva">

					<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto"></div></div>

					<div class="form-row pb-1">
						<div class="form-group col-1"></div>
						<div class="form-group col-5">
							<label for="fecha_ini" class="control-label text-dark-gray">Mostrar aviso desde: **</label>
							<input type="text" class="form-control rounded text-center datepicker" name="fecha_ini" id="fecha_ini" aria-describedby="fecha_ini_help" required>
							<small id="fecha_ini_help" class="form-text text-dark-gray w200">A partir de esta fecha se mostrará el Aviso a los usuarios</small>
						</div>
						<?php $validaciones[] = array('fecha_ini', 'fecha_ini_input', "'Error en Fecha de inicio. Favor de corregir.'"); ?>

						<div class="form-group col-5">
							<label for="fecha_fin" class="control-label text-dark-gray">Mostrar aviso hasta: **</label>
							<input type="text" class="form-control rounded text-center datepicker" name="fecha_fin" id="fecha_fin" aria-describedby="fecha_fin_help" required>
							<small id="fecha_fin_help" class="form-text text-dark-gray w200">Hasta esta fecha se mostrará el Aviso a los usuarios</small>
						</div>
						<?php $validaciones[] = array('fecha_fin', 'fecha_fin_input', "'Error en Fecha final. Favor de corregir.'"); ?>
						<div class="form-group col-1"></div>
					</div>

					<div class="form-row pb-1">
						<div class="form-group col-1"></div>
						<div class="form-group col-10">
							<label for="asunto" class="control-label text-dark-gray">Asunto:</label>
							<textarea type="text" class="form-control rounded" name="asunto" id="asunto" aria-describedby="asunto_help" rows="1" required></textarea>
							<small id="asunto_help" class="form-text text-dark-gray w200">Asunto o tema del aviso.</small>
						</div>
						<?php $validaciones[] = array('asunto', 'asunto_input', "'Error en Asunto. Favor de corregir.'"); ?>
						<div class="form-group col-1"></div>
					</div>

					<div class="form-row pb-1">
						<div class="form-group col-1"></div>
						<div class="form-group col-10">
							<label for="aviso" class="control-label text-dark-gray">Aviso:</label>
							<textarea type="text" class="form-control rounded" name="aviso" id="aviso" aria-describedby="aviso_help" rows="15" required></textarea>
							<small id="aviso_help" class="form-text text-dark-gray w200">Aviso que se mostrará a los usuarios.</small>
						</div>
						<?php $validaciones[] = array('aviso', 'aviso_input', "'Error en Aviso. Favor de corregir.'"); ?>
						<div class="form-group col-1"></div>
					</div>

					<div class="row pb-1">
						<div class="col text-center">
							<button type="submit" class="btn btn-warning text-center px-5 my-2" name="guardar" id="guardar">Registrar aviso</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
	<!-- Tab para revisar avisos -->
	<div class="tab-pane fade mb-5" id="nav-gestion" role="tabpanel" aria-labelledby="nav-gestion-tab">
		<div class="card shadow mb-5 pb-5 min-width:300px">
			<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">REVISAR Y ADMINISTRAR AVISOS PARA <?php echo mb_strtoupper($_SESSION['nombre_licencia'],'utf-8'); ?></div>
			<div class="card-body">
				<form action="<?php echo $RAIZ_SITIO; ?>scripts/admin/nuevo_aviso.php" method="post" class="mt-1">
					<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
					<input name="accion" type="hidden" value="actualizacion">

					<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto"></div></div>

					<?php
						$avisos_all = mysqli_query($con, "SELECT avisos_ID, Avisos_asunto FROM avisos WHERE Centro_ID=".$_SESSION['centro_ID']." AND Licencia_ID=".$_SESSION['licencia_activa']." ORDER BY avisos_ID");
						if (mysqli_num_rows($avisos_all)>0) {
							$select_avisos = "<option value='0'>Selecciona aviso</option>";
							while ($fila = mysqli_fetch_row($avisos_all)) {
								$select_avisos .= "<option value=" . $fila[0] . ">" . $fila[1] . "</option>";
							}
						}

					?>

					<div class="form-row pb-1 pt-2">
						<div class="col-3"></div>
						<div class="form-group col-6">
							<label for="select_avisos" class="control-label text-dark-gray">Aviso: </label>
							<select name="select_avisos" type="text" id="select_avisos" class="form-control rounded" aria-describedby="select_avisos_help" onchange="filtro_aviso()" required>
							<?php echo $select_avisos; ?>
							</select>
							<small id="select_avisos_help" class="form-text text-dark-gray w200">Aviso a revisar / actualizar</small>
						</div>
						<div class="col-3"></div>
					</div>
					<div class="form-row pb-1 pt-2">
						<div class="col-3"></div>
						<div class="form-group col-6">
							<label for="estatus" class="control-label text-dark-gray">Estatus: </label>
							<select name="estatus" type="text" id="estatus" class="form-control rounded" aria-describedby="estatus_help" disabled>
								<option value="1">Activo</option>
								<option value="2">Inactivo / Finalizar</option>
							</select>
							<small id="estatus_help" class="form-text text-dark-gray w200">Estatus del aviso</small>
						</div>
						<div class="col-3"></div>
					</div>
					<div class="form-row pb-1">
						<div class="form-group col-1"></div>
						<div class="form-group col-5">
							<label for="fecha_ini_act" class="control-label text-dark-gray">Mostrar aviso desde: **</label>
							<input type="text" class="form-control rounded text-center datepicker" name="fecha_ini_act" id="fecha_ini_act" aria-describedby="fecha_ini_act_help" disabled required>
							<small id="fecha_ini_act_help" class="form-text text-dark-gray w200">A partir de esta fecha se mostrará el Aviso a los usuarios</small>
						</div>

						<div class="form-group col-5">
							<label for="fecha_fin_act" class="control-label text-dark-gray">Mostrar aviso hasta: **</label>
							<input type="text" class="form-control rounded text-center datepicker" name="fecha_fin_act" id="fecha_fin_act" aria-describedby="fecha_fin_act_help" disabled required>
							<small id="fecha_fin_act_help" class="form-text text-dark-gray w200">Hasta esta fecha se mostrará el Aviso a los usuarios</small>
						</div>
						<div class="form-group col-1"></div>
					</div>

					<div class="form-row pb-1">
						<div class="form-group col-1"></div>
						<div class="form-group col-10">
							<label for="asunto_act" class="control-label text-dark-gray">Asunto:</label>
							<textarea type="text" class="form-control rounded" name="asunto_act" id="asunto_act" aria-describedby="asunto_act_help" rows="1" disabled required></textarea>
							<small id="asunto_act_help" class="form-text text-dark-gray w200">Asunto o tema del aviso.</small>
						</div>
						<div class="form-group col-1"></div>
					</div>

					<div class="form-row pb-1">
						<div class="form-group col-1"></div>
						<div class="form-group col-10">
							<label for="aviso_act" class="control-label text-dark-gray">Aviso:</label>
							<textarea type="text" class="form-control rounded" name="aviso_act" id="aviso_act" aria-describedby="aviso_act_help" rows="15" disabled required></textarea>
							<small id="aviso_act_help" class="form-text text-dark-gray w200">Aviso que se mostrará a los usuarios.</small>
						</div>
						<div class="form-group col-1"></div>
					</div>

					<div class="row pb-1">
						<div class="col text-center">
							<button type="submit" class="btn btn-warning text-center px-5 my-2" name="guardar_act" id="guardar_act" disabled>Actualizar aviso</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	// Funciones de validación al crear aviso
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

	$('.datepicker').datepicker({
		format: "yyyy-mm-dd",
		maxViewMode: 1,
		language: "es",
		orientation: "bottom auto"
	})

	function filtro_aviso(){
		var Aviso_ID = document.getElementById("select_avisos").value;
		var parametros = {
			"Aviso_ID" : Aviso_ID,
		};
		$.ajax({
			data:  parametros,
			url: '../scripts/ajax/avisos_ver_ajax.php',
			type: 'post',
			success: function(data)
			{
				var array = JSON.parse(data);
				$("#fecha_ini_act").val(array.Avisos_inicio);
				$("#fecha_fin_act").val(array.Avisos_fin);
				$("#asunto_act").val(array.Avisos_asunto);
				$("#aviso_act").val(array.Avisos_aviso);
				$("#estatus").val(array.Avisos_estatus);
				if (Aviso_ID>0) {
					$('#guardar_act').prop('disabled', false);
					$('#fecha_ini_act').prop('disabled', false);
					$('#fecha_fin_act').prop('disabled', false);
					$('#asunto_act').prop('disabled', false);
					$('#aviso_act').prop('disabled', false);
					$('#estatus').prop('disabled', false);
				} else {
					$('#guardar_act').prop('disabled', true);
					$('#fecha_ini_act').prop('disabled', true);
					$('#fecha_fin_act').prop('disabled', true);
					$('#asunto_act').prop('disabled', true);
					$('#aviso_act').prop('disabled', true);
					$('#estatus').prop('disabled', true);
				}
			}
		});
	}
</script>

<?php } else { ?>
<br>
<br>
<div class="text-center">
	<div style="display: block" class="w-50 py-2 text-center text-dark_gray rounded mx-auto">
		Actualmente no tienes licencia habilitada para ingresar avisos. Dirígete a <a href="
<?php echo $RAIZ_SITIO; ?>admin/licencias.php"><span class="badge badge-warning text-center px-3 py-2">LICENCIAS</span></a>
		para seleccionar una que se encuentre activa, y en "Acciones" marca la opción de "Habilitar licencia".
	</div>
</div>
<?php }
	}
	include_once('../includes/admin_footer.php');
?>
