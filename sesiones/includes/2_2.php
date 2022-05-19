			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 2 <i class="fas fa-angle-right fa-lg fa-fw"></i> El arte de crear I <i class="fas fa-angle-right fa-lg fa-fw"></i> Empatía
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Empatizar: Mapa de Empatía</h5>
					<div class="card-text px-5">
						<p class="text-justify">Este tema es la clave para que puedas diseñar un producto que realmente sea atractivo para tu público objetivo. Revisa este breve video para conocer la importancia de la empatía: <a href="https://youtu.be/cD1nkJXeMMo" target="_blank">ver video</a></p>
						<p class="text-justify">Ahora que conoces la relevancia del tema, ¡A trabajar!</p>
						<p class="text-justify">Si aún no descargas el material descriptivo del "Mapa de Empatía" para trabajar esta sección, hazlo <a href="../sesiones/docs/E&ES2 - 2.1.1 EMPATIZAR.pdf" download><span class="badge badge-warning text-center px-3 py-2">AQUÍ</span></a>.</p>
						<p class="text-justify">Para que trabajes el "Mapa de Empatía" con tus compañeros, <a href="../sesiones/docs/2.1.1_Mapa_de_empatia.png" download><span class="badge badge-warning text-center px-3 py-2">AQUÍ</span></a> puedes descargarlo vacío. No olvides subirlo en esta sección cuando terminen, para que lo revise tu Asesor.</p>
						<p class="text-justify">
							<?php if ($_SESSION['tipo'] == "Alumn") {?>
							<div class="text-orange text-center">Nota: para evitar pérdida o sobreescritura de información, durante toda esta sesión designen a un integrante del equipo para subir la información a cada sección luego de trabajarla en conjunto.</div><br>
							<?php } else { ?>
							<div class="text-orange text-center">Nota: Sugiere a los estudiantes que, para evitar pérdida o sobreescritura de información, durante toda esta sesión designen a uno de ellos para subir la información a cada sección luego de trabajarla en conjunto.</div><br>
							<?php } ?>
						</p>

						<div class="row justify-content-md-center">
							<div class="col-md-auto px-5 text-center">
							<?php if ($_SESSION["tipo"]=="Alumn") { ?>
								<h5><span class="badge badge-success px-3 py-3 text-wrap"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Realicen la actividad, junto con todas las de la sesión, y obtengan <span class="text-yellow">50 estrellas</span> para su empresa</span></h5>
							<?php } else { ?>
								<h5><span class="badge badge-success px-3 py-3 text-wrap"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Realizar la actividad, junto con todas las de la sesión, otorga <span class="text-yellow">50 estrellas a la empresa</span></span></h5>
							<?php } ?>
							</div>
						</div>

						<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/registrar_2_2.php" method="post" class="mt-1">
							<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
							<input name="Empresa_ID" type="hidden" id="Empresa_ID" value="<?php if ($_SESSION['tipo'] == "Alumn") { echo $_SESSION['Empresa_ID']; } else { echo ""; } ?>">
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
							<div class="form-row pb-1">
								<div class="form-group col-1"></div>
								<div class="form-group col-10">
									<label for="segmentacion" class="control-label text-dark-gray">Segmentación:</label>
									<textarea class="form-control rounded" name="segmentacion" id="segmentacion" rows="2" <?php echo $_SESSION['enable_disable']; ?> required></textarea>
									<small id="segmentacion_help" class="form-text text-dark-gray w200">Público objetivo agrupado en función de una serie de características o atributos comunes.</small>
								</div>
								<?php $validaciones[] = array('segmentacion', 'segmentacion_input', "'Error en Segmentacion. Favor de corregir.'"); ?>
								<div class="form-group col-1"></div>
							</div>
							<div class="form-row pb-1">
								<div class="form-group col-1"></div>
								<div class="form-group col-10">
									<label for="humanizacion" class="control-label text-dark-gray">Humanización:</label>
									<textarea class="form-control rounded" name="humanizacion" id="humanizacion" rows="2" <?php echo $_SESSION['enable_disable']; ?> required></textarea>
									<small id="humanizacion_help" class="form-text text-dark-gray w200">Identifica a una persona del segmento elegido, asignándole características o atributos concretos.</small>
								</div>
								<?php $validaciones[] = array('humanizacion', 'humanizacion_input', "'Error en Humanizacion. Favor de corregir.'"); ?>
								<div class="form-group col-1"></div>
							</div>

							<label class="control-label text-dark-gray">Empatizar:</label>
							<div class="card px-3 py-2">
								<div class="form-row pb-1">
									<div class="form-group col-3"></div>
									<div class="form-group col-6">
										<label for="piensa" class="control-label text-dark-gray">¿Qué piensa y siente?:</label>
										<textarea class="form-control rounded" name="piensa" id="piensa" rows="2" <?php echo $_SESSION['enable_disable']; ?> required></textarea>
										<small id="piensa_help" class="form-text text-dark-gray w200">Principales preocupaciones, inquietudes y aspiraciones.</small>
									</div>
									<?php $validaciones[] = array('piensa', 'piensa_input', "'Error en ¿Qué piensa y siente? Favor de corregir.'"); ?>
									<div class="form-group col-3"></div>
								</div>
								<div class="form-row pb-1">
									<div class="form-group col-5">
										<label for="oye" class="control-label text-dark-gray">¿Qué oye?:</label>
										<textarea class="form-control rounded" name="oye" id="oye" rows="2" <?php echo $_SESSION['enable_disable']; ?> required></textarea>
										<small id="oye_help" class="form-text text-dark-gray w200">Lo que dice las personas que le rodean.</small>
									</div>
									<?php $validaciones[] = array('oye', 'oye_input', "'Error en ¿Qué oye? Favor de corregir.'"); ?>
									<div class="form-group row col-2 justify-content-center">
										<i class="far fa-user-circle fa-lg fa-fw fa-7x"></i>
									</div>
									<div class="form-group col-5">
										<label for="ve" class="control-label text-dark-gray">¿Qué ve?:</label>
										<textarea class="form-control rounded" name="ve" id="ve" rows="2" <?php echo $_SESSION['enable_disable']; ?> required></textarea>
										<small id="ve_help" class="form-text text-dark-gray w200">La oferta del mercado.</small>
									</div>
									<?php $validaciones[] = array('ve', 've_input', "'Error en ¿Qué ve? Favor de corregir.'"); ?>
								</div>
								<div class="form-row pb-1">
									<div class="form-group col-3"></div>
									<div class="form-group col-6">
										<label for="dice" class="control-label text-dark-gray">¿Qué dice y hace?:</label>
										<textarea class="form-control rounded" name="dice" id="dice" rows="2" <?php echo $_SESSION['enable_disable']; ?> required></textarea>
										<small id="dice_help" class="form-text text-dark-gray w200">Comportamiento hacia los demás.</small>
									</div>
									<?php $validaciones[] = array('dice', 'dice_input', "'Error en ¿Qué dice y hace? Favor de corregir.'"); ?>
									<div class="form-group col-3"></div>
								</div>
								<div class="form-row pb-1">
									<div class="form-group col-6">
										<label for="esfuerzos" class="control-label text-dark-gray">Esfuerzos:</label>
										<textarea class="form-control rounded" name="esfuerzos" id="esfuerzos" rows="2" <?php echo $_SESSION['enable_disable']; ?> required></textarea>
										<small id="esfuerzos_help" class="form-text text-dark-gray w200">Miedos, frustraciones, obstáculos.</small>
									</div>
									<?php $validaciones[] = array('esfuerzos', 'esfuerzos_input', "'Error en Esfuerzos. Favor de corregir.'"); ?>
									<div class="form-group col-6">
										<label for="resultados" class="control-label text-dark-gray">Resultados:</label>
										<textarea class="form-control rounded" name="resultados" id="resultados" rows="2" <?php echo $_SESSION['enable_disable']; ?> required></textarea>
										<small id="resultados_help" class="form-text text-dark-gray w200">Necesidades o deseos reales.</small>
									</div>
									<?php $validaciones[] = array('resultados', 'resultados_input', "'Error en Resultados. Favor de corregir.'"); ?>
								</div>
							</div>
							<br>

							<div class="form-row pb-1">
								<div class="form-group col-2"></div>
								<div class="form-group col-8">
									<?php if ($_SESSION['tipo'] == "Alumn" AND isset($_SESSION["sesion2_2"]) AND $_SESSION["sesion2_2"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
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
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_nuevo_mapa" id="btn_nuevo_mapa" disabled>Registrar comentario</button>
									<?php } else if ($_SESSION['tipo'] == "Alumn") { ?>
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_nuevo_mapa" id="btn_nuevo_mapa" <?php echo $_SESSION['enable_disable']; ?>>Agregar 'Mapa de Empatía'</button>
										<button type="button" class="btn btn-warning text-center px-5 my-2" name="limpiar" id="limpiar" onclick="location.reload()">Limpiar</button>
									<?php } ?>
								</div>
							</div>

						</form>
						<div class="row">
							<div class="text-left col-6"><a href="<?php echo $uri_sola . '=1'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a></div>

							<div class="text-right col-6"><a href="<?php echo $uri_sola . '=3'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(23)" <?php } ?>>Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a></div>
						</div>
					</div>
				</div>
			</div>

			<script type="text/javascript">

				<?php if ($_SESSION['tipo'] == "Admin") {?>
					$(document).ready(function(){
						var parametros = {
							"seccion" : "2_2",
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
							"seccion" : "2_2",
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
				<?php } if ($_SESSION['tipo'] == "Volun") {?>
					$(document).ready(function(){
						var parametros = {
							"seccion" : "2_2",
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
						  url: '../alumno/ajax/empresas_info_s2_2_data.php',
						  type: 'post',
						  success: function(data)
						  {
							var array = JSON.parse(data);
							$("#segmentacion").html(array.segmentacion);
							$("#humanizacion").html(array.humanizacion);
							$("#piensa").html(array.piensa);
							$("#oye").html(array.oye);
							$("#ve").html(array.ve);
							$("#dice").html(array.dice);
							$("#esfuerzos").html(array.esfuerzos);
							$("#resultados").html(array.resultados);
							$("#coments_asesor").html(array.coments_asesor);
							if (array.segmentacion != "") {
								$("#action").val("update");
								$("#btn_nuevo_mapa").text("Actualizar 'Mapa de Empatía'");
							}
						  }
						});
					});

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
								error.classList.remove('animated');
								error.classList.remove('shake');
							" . $validaciones[$i][1] . ".classList.remove('input_error');
							}
						});
						";
					}

				}

				if ($_SESSION['tipo'] != "Alumn") { ?>
					function filtro_empresa(){
						var Empresa_ID = document.getElementById("select_empresa").value;
						var parametros = {
							"Empresa_ID" : Empresa_ID,
						};
						$("#Empresa_ID").val(Empresa_ID);
						$('#btn_nuevo_mapa').prop('disabled', false);
						$.ajax({
						  data:  parametros,
						  url: '../alumno/ajax/empresas_info_s2_2_data.php',
						  type: 'post',
						  success: function(data)
						  {
							var array = JSON.parse(data);
							$("#segmentacion").html(array.segmentacion);
							$("#humanizacion").html(array.humanizacion);
							$("#piensa").html(array.piensa);
							$("#oye").html(array.oye);
							$("#ve").html(array.ve);
							$("#dice").html(array.dice);
							$("#esfuerzos").html(array.esfuerzos);
							$("#resultados").html(array.resultados);
							$("#coments_asesor").html(array.coments_asesor);
							if (array.segmentacion != "") {
								$("#action").val("update");
								<?php if ($_SESSION['tipo'] == "Volun") {?>
									$("#btn_nuevo_mapa").text("Actualizar comentario");
									if (Empresa_ID > 0) {
										$('#btn_nuevo_mapa').prop('disabled', false);
									}
								<?php } ?>
							} else {
								$("#action").val("new");
							}

							if (Empresa_ID == 0) {
								$('#btn_nuevo_mapa').prop('disabled', true);
							}
						  }
						});
					}
				<?php } ?>


			</script>