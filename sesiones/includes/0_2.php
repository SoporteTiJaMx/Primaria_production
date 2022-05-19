			<div class="card shadow mb-1">
				<div class="card-header">
					Registro de jóvenes paricipantes
				</div>
				<div class="card-body px-5">
					<?php if ($_SESSION['tipo'] == "Alumn") { ?>
						<h5 class="card-title">Agrega a los demás integrantes de la Empresa Juvenil</h5>
						<div class="card-text pl-5 pr-5">
							Solo el Director General de la Empresa puede agregar nuevos integrantes.
						</div>
					<?php } else { ?>
						<h5 class="card-title">En esta sección los jóvenes podrán ingresar a los demás integrantes de la Empresa.</h5>
						<div class="card-text pl-5 pr-5">
							Indícales que el Director General de la Empresa debe agregar a los nuevos integrantes.
						</div>
					<?php } ?>

					<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/crear_usuario.php" method="post" class="mt-1">
						<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
						<?php if ($_SESSION["tipo"] == "Alumn") { ?>
							<input name="Empresa_ID" type="hidden" id="Empresa_ID" value="<?php echo $_SESSION["Empresa_ID"]?>">
						<?php } ?>

						<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto mb-2"></div></div>
						<br>

						<div class="form-row pb-1">
							<div class="form-group col-12 offset-lg-1 col-lg-5">
								<label for="nombre" class="control-label text-dark-gray">Nombre del Integrante:</label>
								<input type="text" class="form-control rounded text-center" name="nombre" id="nombre" aria-describedby="nombre_help" required <?php echo $_SESSION['enable_disable']; ?> <?php if (isset($_SESSION['Puesto_nombre'])) { if ($_SESSION['Puesto_nombre'] != "Director General") { echo "disabled"; } } ?>>
								<small id="nombre_help" class="form-text text-dark-gray w200">Nombre(s)</small>
							</div>
							<?php $validaciones[] = array('nombre', 'nombre_input', "'Error en Nombre. Favor de corregir.'"); ?>

							<div class="form-group col-12 col-lg-5">
								<label for="ap_paterno" class="control-label text-pale-gray">.</label>
								<input type="text" class="form-control rounded text-center" name="ap_paterno" id="ap_paterno" aria-describedby="ap_paterno_help" required <?php echo $_SESSION['enable_disable']; ?> <?php if (isset($_SESSION['Puesto_nombre'])) { if ($_SESSION['Puesto_nombre'] != "Director General") { echo "disabled"; } } ?>>
								<small id="ap_paterno_help" class="form-text text-dark-gray w200">Apellido(s)</small>
							</div>
							<?php $validaciones[] = array('ap_paterno', 'ap_paterno_input', "'Error en Apellido. Favor de corregir.'"); ?>
						</div>

						<div class="form-row pb-1">
							<div class="form-group col-12 offset-lg-3 col-lg-6">
								<label for="correo" class="control-label text-dark-gray">E-mail:</label>
								<input type="text" class="form-control rounded text-center" name="correo" id="correo" aria-describedby="correo_help" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required <?php echo $_SESSION['enable_disable']; ?> <?php if (isset($_SESSION['Puesto_nombre'])) { if ($_SESSION['Puesto_nombre'] != "Director General") { echo "disabled"; } } ?>>
								<small id="correo_help" class="form-text text-dark-gray w200">Correo electrónico</small>
							</div>
							<?php $validaciones[] = array('correo', 'correo_input', "'Error en E-mail. Favor de corregir.'"); ?>

						</div>

						<?php if ($_SESSION["tipo"] == "Alumn") { ?>
						<div class="row pb-1">
							<div class="form-group col-12 offset-lg-1 col-lg-10 text-center">
								<small>A cada nuevo integrante ingresado se le enviará un email con indicaciones para acceder a la plataforma y comenzar a usarla.</small><br><br>
							</div>
						</div>

						<div class="row pb-1">
							<div class="col text-center">
								<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_nuevo_integrante" id="btn_nuevo_integrante" <?php echo $_SESSION['enable_disable']; ?>>Agregar nuevo integrante</button>
								<button type="button" class="btn btn-warning text-center px-5 my-2" name="limpiar" id="limpiar" onclick="location.reload()" <?php echo $_SESSION['enable_disable']; ?>>Limpiar</button>
							</div>
						</div>
						<?php } ?>

					</form>
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
		";}
?>


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
					$('#btn_nuevo_integrante').prop('disabled', true);
				} else if (data != "erro") {
					$('#btn_nuevo_integrante').prop('disabled', false);
				}
			}
		});
	});
</script>