<?php
	$le_compete = "disabled";
	if ($_SESSION['tipo'] == "Alumn") {
		if ($_SESSION['Puesto_ID'] == 3 OR $_SESSION['Puesto_ID'] == 4 OR $_SESSION['Puesto_ID'] == 8 OR $_SESSION['Puesto_ID'] == 9) {
			$le_compete = "";
		}
	}
?>
			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 5 <i class="fas fa-angle-right fa-lg fa-fw"></i> La Identidad Empresarial <i class="fas fa-angle-right fa-lg fa-fw"></i> Filosofía Empresarial
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Definición del Producto</h5>
					<div class="card-text px-5 mb-4">
						<p class="text-justify">Es momento de definir de manera puntual su idea. En equipo, reflexionen y piensen ¿Cómo puedo transformar la idea que nos fue aprobada en un producto o servicio que pueda vender y obtener ganancias de ello? Revisa el siguiente ejemplo:</p>
						<div class="card-deck justify-content-center mb-4 px-5">
							<div class="card">
								<div class="card-header text-white background_black_green">Idea aprobada</div>
								<div class="card-body">
									<p class="card-text">Disminuir la contaminación de las industrias de perfumes que emiten toneladas de gases tóxicos que dañan la capa de ozono, elaborando productos amigables con el medio ambiente de manera local.</p>
								</div>
							</div>
							<div class="pt-5">
								<i class="fas fa-chevron-right fa-lg fa-fw fa-3x"></i>
							</div>
							<div class="card">
								<div class="card-header text-white background_pale_green">¿Que producto o servicio sería?</div>
								<div class="card-body">
									<p class="card-text">Perfume a base de esencias naturales con empaques reciclables.</p>
								</div>
							</div>
						</div>
						<p class="text-justify">Ahora es su turno:</p>
						<div class="text-orange text-center pb-3">NOTA. Esta sección podrá ser llenada por el <strong>Director de Marketing</strong> o el <strong>Director de Ventas</strong> de la Empresa.</div>
						<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/registrar_5_2.php" method="post" class="mt-1">
							<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
							<input name="Empresa_ID" type="hidden" id="Empresa_ID" value="<?php if ($_SESSION['tipo'] == "Alumn") { echo $_SESSION['Empresa_ID']; } else { echo ''; } ?>">
							<?php if ($_SESSION['tipo'] == "Volun" OR $_SESSION['tipo'] == "Alumn") {?>
							<input name="action" type="hidden" id="action" value="new">

							<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto mb-2"></div></div>
							<?php } ?>

							<?php if ($_SESSION['tipo'] != "Alumn") {?>
							<div class="text-center"><div id="actualizados" style="display: none" class="bg-success w-50 py-2 text-center text-white rounded mx-auto mb-2"></div></div>
							<div class="form-row pb-1">
								<div class="form-group col-2"></div>
								<div class="form-group row col-8">
									<label for="select_empresa" class="col-sm-2 col-form-label text-right">Empresa:</label>
									<div class="col-sm-10">
										<select name="select_empresa" type="text" id="select_empresa" class="form-control rounded" onChange="filtro_empresa()">
										</select>
									</div>
								</div>
								<div class="form-group col-1"></div>
							</div>
							<?php } ?>
							<br>

							<div class="card-deck justify-content-center mb-2 px-5">
								<div class="card">
									<div class="card-header text-white background_black_green">Idea aprobada</div>
									<div class="card-body">
										<p class="card-text">
											<textarea class="form-control rounded" name="idea_aprobada" id="idea_aprobada" rows="5" disabled></textarea>
											<small id="idea_aprobada_help" class="form-text text-dark-gray w200">Idea aprobada durante la Sesión 2.</small>
										</p>
									</div>
								</div>
								<div class="pt-5">
									<i class="fas fa-chevron-right fa-lg fa-fw fa-3x"></i>
								</div>
								<div class="card">
									<div class="card-header text-white background_pale_green">¿Que producto o servicio sería?</div>
									<div class="card-body">
											<textarea class="form-control rounded" name="producto" id="producto" rows="5" <?php echo $_SESSION['enable_disable']; ?> required <?php echo $le_compete; ?>></textarea>
											<small id="producto_help" class="form-text text-dark-gray w200">Define aqui brevemente el producto o servicio que ofrecerás.</small>
									</div>
								</div>
							</div>
							<br>
							<div class="form-row pb-1">
								<div class="form-group col-2"></div>
								<div class="form-group col-8">
									<?php if ($_SESSION['tipo'] == "Alumn" AND isset($_SESSION["sesion5_1"]) AND $_SESSION["sesion5_1"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
									<label for="coments_asesor" class="control-label text-dark-gray">Comentarios del Asesor:</label>
									<textarea class="form-control rounded" name="coments_asesor" id="coments_asesor" rows="3" <?php echo $_SESSION['enable_disable_asesor']; ?>></textarea>
								</div>
								<div class="form-group col-2"></div>
							</div>

							<?php if ($_SESSION['tipo'] == "Volun") {?>
							<div class="form-row pb-1">
								<div class="form-group col-2"></div>
								<div class="form-group col-8 text-center">
									<div class="checkbox checkbox-green">
										<input type="checkbox" class="custom-control-input" id="validacionAsesor" name="validacionAsesor" value="1">
										<label class="custom-control-label" for="validacionAsesor">Validación del Asesor. Estoy de acuerdo con la información ingresada. Ya no haré más comentarios.</label>
									</div>
								</div>
								<div class="form-group col-2"></div>
							</div>
							<?php } ?>

							<div class="row pb-1">
								<div class="col text-center">
									<?php if ($_SESSION['tipo'] == "Volun") {?>
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_registrar" id="btn_registrar" disabled>Registrar comentario</button>
									<?php } else if ($_SESSION['tipo'] == "Alumn" AND $le_compete == "") { ?>
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_registrar" id="btn_registrar" <?php echo $_SESSION['enable_disable']; ?>>Agregar Información</button>
										<button type="button" class="btn btn-warning text-center px-5 my-2" name="limpiar" id="limpiar" onclick="location.reload()">Limpiar</button>
									<?php } ?>
								</div>
							</div>
						</form>
					</div>
					<h5 class="card-title">Perfil de la Empresa</h5>
					<div class="card-text px-5">
						<p class="text-justify">Ahora que ya eligieron el producto o servicio que ofrecerá su empresa, y ya definieron su estructura organizacional, es momento de dar los siguientes pasos.</p>
						<p class="text-justify">Para darle un sentido a nuestra Empresa es importante pensar en los siguientes elementos:</p>
						<div class="px-5">
							<i class="fas fa-check fa-lg fa-fw text-pale-green"></i>Nombre de la Empresa<br><br>
							<i class="fas fa-check fa-lg fa-fw text-pale-green"></i>Eslogan de la Empresa y su Logotipo<br><br>
							<i class="fas fa-check fa-lg fa-fw text-pale-green"></i>Misión y Visión de la Empresa<br><br>
							<i class="fas fa-check fa-lg fa-fw text-pale-green"></i>Valores de la Empresa<br><br>
							<i class="fas fa-check fa-lg fa-fw text-pale-green"></i>Objetivos de la Empresa<br><br>
						</div>
						<p class="text-justify">A continuación, podrás encontrar información más detallada sobre los tres primeros elementos. En equipo deberán desarrollarlos y un poco más adelante, en esta misma sesión, los deberán agregar en esta plataforma.</p>
						<div class="row justify-content-center mb-2">
							<div class="d-none col-lg-2"></div>
							<div class="col-12 col-lg-8">
								<img src="../sesiones/images/5.2_identidad_empresarial.png" alt="La Identidad empresarial" class="img-fluid">
							</div>
							<div class="d-none col-lg-2"></div>
						</div>
						<p class="text-justify">En equipo realicen una lluvia de ideas para definir su nombre, eslogan y logotipo, más adelante podrán subir sus ideas finales. Te sugerimos utilizar herramientas digitales como <a href="https://stormboard.com/" target="_blank"><b>Stormboard</b></a> o <a href="https://edu.google.com/intl/es-419/products/jamboard/" target="_blank"><b>Jamboard</b></a> de Google.</p>
						<div class="row">
							<div class="text-left col-6">
								<a href="<?php echo $uri_sola . '=0'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a>
							</div>
							<div class="text-right col-6">
								<a href="<?php echo $uri_sola . '=2'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(52)" <?php } ?>>Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a>
							</div>
						</div>
					</div>

				</div>
			</div>

			<script type="text/javascript">
				<?php if ($_SESSION['tipo'] == "Admin") {?>
					$(document).ready(function(){
						var parametros = {
							"seccion" : "5_1",
						};
						$.ajax({
						  data:  parametros,
						  url: '../admin/ajax/actualizados.php',
						  type: 'post',
						  success: function(data)
						  {
							$('#actualizados').html(data);
							if (data != "") {
								$('#actualizados').show();
							}
						  }
						});
						$.ajax({
						  url: '../admin/ajax/mis_empresas.php',
						  success: function(data)
						  {
							$('#select_empresa').append(data);
						  }
						});
					});
				<?php } else if ($_SESSION['tipo'] == "Coord") {?>
					$(document).ready(function(){
						var parametros = {
							"seccion" : "5_1",
						};
						$.ajax({
						  data:  parametros,
						  url: '../coordinador/ajax/actualizados.php',
						  type: 'post',
						  success: function(data)
						  {
							$('#actualizados').html(data);
							if (data != "") {
								$('#actualizados').show();
							}
						  }
						});
						$.ajax({
						  url: '../coordinador/ajax/mis_empresas.php',
						  success: function(data)
						  {
							$('#select_empresa').append(data);
						  }
						});
					});
				<?php } else if ($_SESSION['tipo'] == "Volun") {?>
					$(document).ready(function(){
						var parametros = {
							"seccion" : "5_1",
						};
						$.ajax({
						  data:  parametros,
						  url: '../asesor/ajax/actualizados.php',
						  type: 'post',
						  success: function(data)
						  {
							$('#actualizados').html(data);
							if (data != "") {
								$('#actualizados').show();
							}
						  }
						});
						$.ajax({
						  url: '../asesor/ajax/mis_empresas.php',
						  success: function(data)
						  {
							$('#select_empresa').append(data);
						  }
						});
					});

				<?php } else if ($_SESSION['tipo'] == "Alumn") { ?>
					$(document).ready(function(){
						var parametros = {
							"Empresa_ID" : <?php echo $_SESSION['Empresa_ID']; ?>,
						};
						$.ajax({
						  data:  parametros,
						  url: '../alumno/ajax/empresas_info_s5_2_data.php',
						  type: 'post',
						  success: function(data)
						  {
							var array = JSON.parse(data);
							$("#idea_aprobada").html(array.idea);
							$("#producto").html(array.producto);
							$("#coments_asesor").html(array.coments_asesor);
							if (array.producto != "") {
								$("#action").val("update");
								$("#btn_registrar").text("Actualizar Información");
							}
						  }
						});
					});
				<?php } ?>

				<?php if ($_SESSION['tipo'] != "Alumn") { ?>
					function filtro_empresa(){
						var Empresa_ID = document.getElementById("select_empresa").value;
						var parametros = {
							"Empresa_ID" : Empresa_ID,
						};
						$("#Empresa_ID").val(Empresa_ID);
						$('#btn_registrar').prop('disabled', false);

						$.ajax({
						  data:  parametros,
						  url: '../alumno/ajax/empresas_info_s5_2_data.php',
						  type: 'post',
						  success: function(data)
						  {
							var array = JSON.parse(data);
							$("#idea_aprobada").html(array.idea);
							$("#producto").html(array.producto);
							$("#coments_asesor").html(array.coments_asesor);
							if (array.producto != "") {
								$("#action").val("update");
								<?php if ($_SESSION['tipo'] == "Volun") {?>
									$("#btn_registrar").text("Actualizar comentario");
									if (Empresa_ID > 0) {
										$('#btn_registrar').prop('disabled', false);
									}
								<?php } ?>
							} else {
								$("#action").val("new");
							}

							if (Empresa_ID == 0) {
								$('#btn_registrar').prop('disabled', true);
							}
						  }
						});
					}
				<?php } ?>
			</script>