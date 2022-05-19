<?php
	include_once('../includes/coordinador_header.php');
	include_once('../scripts/funciones.php');
	include_once('../coordinador/side_navbar.php');

	if ($_SESSION["tipo"] != 'Coord') {
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
		<a class="nav-item nav-link active" id="nav-empresas-tab" data-toggle="tab" href="#nav-empresas" role="tab" aria-controls="nav-empresas" aria-selected="true">Empresas Juveniles</a>
		<a class="nav-item nav-link" id="nav-crear-tab" data-toggle="tab" href="#nav-crear" role="tab" aria-controls="nav-crear" aria-selected="false">Ingresar alumnos de la empresa</a>
	</div>
</nav>
<div class="tab-content mx-5 px-3 mb-5" id="nav-tabContent" >
	<!-- Tab para revisión de empresa juveniles -->
	<div class="tab-pane fade show active" id="nav-empresas" role="tabpanel" aria-labelledby="nav-empresas-tab">
		<h5 class="text-center text-dark_gray pt-1 pb-1" id="ciclo"></h5>
		<h6 class="text-center text-dark_gray pt-1 pb-1" id="cuantas"></h6>
		<h6 class="text-center text-dark_gray pt-1 pb-1" id="subttl1"></h6>
		<h6 class="text-center text-dark_gray pt-1 pb-1" id="subttl2"></h6>
		<div class="card shadow mb-5 pb-5 min-width:300px">
			<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">EMPRESAS JUVENILES DE <?php if (isset($_SESSION['Escuela_nombre'])) { echo " " . strtoupper($_SESSION['Escuela_nombre']); } ?></div>
			<div class="card-body">
				<div id="empresas_juveniles"></div>
			</div>
		</div>
	</div>
	<!-- Tab para crear una nueva empresa -->
	<div class="tab-pane fade" id="nav-crear" role="tabpanel" aria-labelledby="nav-crear-tab">
		<h5 class="text-center text-dark_gray pt-1 pb-1" id="faltantes"></h5>
		<h6 class="text-center text-dark_gray pt-1 pb-1" id="explic1">Éste alumno, que fungirá como Director General de su Empresa hasta que sus trabajos les permitan definir sus puestos, se encargará de registrar a los demás miembros del equipo.</h6>
		<h6 class="text-center text-dark_gray pt-1 pb-1" id="explic2">Te sugerimos que este alumno registrado se destaque por su compromiso y entusiasmo, para que pueda desempeñaR de la mejor forma su labor.</h6>
		<div class="card shadow">
			<div class="card-header text-center text-dark-gray text-spaced-3">INGRESAR ALUMNO DE NUEVA EMPRESA JUVENIL</div>
			<div class="card-body">

				<form action="<?php echo $RAIZ_SITIO; ?>scripts/coordinador/crear_usuario.php" method="post" class="mt-1">
					<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
					<input name="tipo" type="hidden" id="tipo" value="5">
					<input name="licencia" type="hidden" id="licencia" value="">

					<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto mb-2"></div></div>

					<div class="form-row pb-1">
						<div class="form-group col-2"></div>
						<div class="form-group col-4">
							<label for="nombre" class="control-label text-dark-gray">Alumno de contacto:</label>
							<input type="text" class="form-control rounded text-center" name="nombre" id="nombre" aria-describedby="nombre_help" required>
							<small id="nombre_help" class="form-text text-dark-gray w200">Nombre(s)</small>
						</div>
						<?php $validaciones[] = array('nombre', 'nombre_input', "'Error en Nombre. Favor de corregir.'"); ?>

						<div class="form-group col-4">
							<label for="ap_paterno" class="control-label text-pale-gray">.</label>
							<input type="text" class="form-control rounded text-center" name="ap_paterno" id="ap_paterno" aria-describedby="ap_paterno_help" required>
							<small id="ap_paterno_help" class="form-text text-dark-gray w200">Apellido(s)</small>
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
							<label for="nombre_empresa" class="control-label text-dark-gray">Nombre de Empresa:</label>
							<input type="text" class="form-control rounded text-center" name="nombre_empresa" id="nombre_empresa" aria-describedby="nombre_empresa_help" required>
							<small id="nombre_empresa_help" class="form-text text-dark-gray w200">Nombre preliminar</small>
						</div>
						<?php $validaciones[] = array('nombre_empresa', 'nombre_empresa_input', "'Error en nombre de Empresa. Favor de corregir.'"); ?>
						<div class="form-group col-2"></div>
					</div>

					<div class="row pb-1">
						<div class="col text-center">
							<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_nueva_empresa" id="btn_nueva_empresa">Registrar nueva empresa</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			url: '../coordinador/ajax/empresas_juveniles.php',
			type: 'post',
			success: function(data)
			{
				$('#empresas_juveniles').html(data)
				$('#empresas_juveniles_table').DataTable( {
					"paging": false,
					"info": false,
					"searching": false,
					responsive: true,
				});
				$('#empresas_juveniles_table_wrapper div.row').addClass('col-sm-12');

				$('[data-toggle="tooltip"]').tooltip();
			}
		});
		$.ajax({
			url: '../coordinador/ajax/num_empresas.php',
			type: 'post',
			success: function(data)
			{
				var array = JSON.parse(data);
				if (array.Licencia_ID != null) {
					$("#ciclo").html(array.Licencia_nombre);
					$("#licencia").val(array.Licencia_ID);
					$("#subttl1").html("A continuación puedes revisar tus Empresas Juveniles participantes.");
					$("#subttl2").html("En la pestaña 'Ingresar alumnos de la empresa' podrás registrar a un alumno de cada empresa para que inicien sus trabajos.");
					$("#cuantas").html("JA México ha aprobado para <strong><?php if (isset($_SESSION['Escuela_nombre'])) { echo $_SESSION['Escuela_nombre']; } ?></strong> la participación de <strong>"+array.Num_empresas+" Empresas Juveniles</strong> en este ciclo.");
					$("#faltantes").html("Ingresa a un alumno para las <strong>"+array.Faltantes+" Empresas Juveniles </strong> pendientes de registrar.");
					if (array.Faltantes==0) {
						$("#faltantes").html("Ya están registradas todas las Empresas Juveniles posibles, agradecemos tu apoyo para motivar el mejor desempeño de cada una de ellas. Muchas gracias.");
						$("#explic1").html("");
						$("#explic2").html("");
						$("#nombre").prop("disabled", true );
						$("#ap_paterno").prop("disabled", true );
						$("#correo").prop("disabled", true );
						$("#nombre_empresa").prop("disabled", true );
						$("#btn_nueva_empresa").prop("disabled", true );
					}
				} else {
					$("#subttl1").html("Actualmente tu escuela no participa en el Programa Emprendedores y Empresarios.");
					$("#subttl2").html("");
					$("#explic1").html("No hay Empresas Juveniles a las que asignar alumnos.");
					$("#explic2").html("");
					$("#nombre").prop("disabled", true );
					$("#ap_paterno").prop("disabled", true );
					$("#correo").prop("disabled", true );
					$("#nombre_empresa").prop("disabled", true );
					$("#btn_nueva_empresa").prop("disabled", true );
				}
			}
		});

		$('.dataTables_length').parent().addClass('d-flex justify-content-start');
		$('.dataTables_filter').parent().addClass('d-flex justify-content-end');
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
					$('#btn_nueva_empresa').prop('disabled', true);
				} else if (data != "erro") {
					$('#btn_nueva_empresa').prop('disabled', false);
				}
			}
		});
	});

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

</script>

<?php
	}
	include_once('../includes/coordinador_footer.php');
?>

