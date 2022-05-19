			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 3 <i class="fas fa-angle-right fa-lg fa-fw"></i> El arte de crear II <i class="fas fa-angle-right fa-lg fa-fw"></i> Validación
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Validación: Encuesta de Mercado</h5>
					<div class="card-text px-5">
						<br>
						<p class="text-justify">Si aún no descargas el material descriptivo de "Validación" para trabajar esta sección, hazlo <a href="../sesiones/docs/E&ES2 - 2.1.5 VALIDAR.pdf" download><span class="badge badge-warning text-center px-3 py-2">AQUÍ</span></a>.</p>
						<p class="text-justify">La plataforma te ayudará a generar una encuesta de mercado que usarás para validar tu producto ante tus clientes potenciales.</p>
						<p class="text-justify">Para ello, captura entre 5-8 preguntas cerradas, cada una con entre 2-5 respuestas posibles (estás serán las que podrás procesar en la plataforma) y puedes incluir hasta dos preguntas abiertas cuyo procesamiento deberás hacer por tu cuenta (por ejemplo a través del "Grid de retroalimentación").</p>
						<p class="text-justify">Una vez ingresadas todas las preguntas, da clic en "Genera Encuesta" para descargarla, imprimirla y ¡a encuestar clientes!</p>
						<p class="text-justify"><strong>IMPORTANTE: No apliques la encuesta hasta que tu asesor la valide.</strong></p>
						<p class="text-justify"><strong>PARA TU CONOCIMIENTO: La encuesta que se generará, por sistema, ya incluye la pregunta del Género y Edad de los encuestados.</strong></p>
						<p class="text-justify"></p>
						<p class="text-justify"></p>

						<p class="text-justify">
							<?php if ($_SESSION['tipo'] == "Alumn") {?>
							<div class="text-orange text-center">Nota: para evitar pérdida o sobreescritura de información, durante toda esta sesión designen a un integrante del equipo para subir la información a cada sección luego de trabajarla en conjunto</div><br>
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

						<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/registrar_3_3.php" method="post" class="mt-1" enctype="multipart/form-data">
							<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
							<input name="Empresa_ID" type="hidden" id="Empresa_ID" value="<?php if ($_SESSION['tipo'] == "Alumn") { echo $_SESSION['Empresa_ID']; } else { echo ""; } ?>">
							<?php if ($_SESSION['tipo'] == "Volun" OR $_SESSION['tipo'] == "Alumn") {?>
							<input name="action" type="hidden" id="action" value="new">

							<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto mb-2"></div></div>
							<br>
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

							<label class="control-label text-dark-gray">Preguntas cerradas:</label>
							<div class="card px-3 py-2">
								<div class="form-row pb-1">
									<div class="form-group col-12">
										<label for="pregunta_cerrada1" class="control-label text-dark-gray">Pregunta 1:</label>
										<input type="text" class="form-control rounded" name="pregunta_cerrada1" id="pregunta_cerrada1" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
								</div>
								<div class="form-row pb-1">
									<div class="form-group col-1"></div>
									<div class="form-group col-2">
										<label for="opcion1_1" class="control-label text-dark-gray">Opción 1:</label>
										<input type="text" class="form-control rounded" name="opcion1_1" id="opcion1_1" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion2_1" class="control-label text-dark-gray">Opción 2:</label>
										<input type="text" class="form-control rounded" name="opcion2_1" id="opcion2_1" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion3_1" class="control-label text-dark-gray">Opción 3:</label>
										<input type="text" class="form-control rounded" name="opcion3_1" id="opcion3_1" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion4_1" class="control-label text-dark-gray">Opción 4:</label>
										<input type="text" class="form-control rounded" name="opcion4_1" id="opcion4_1" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion5_1" class="control-label text-dark-gray">Opción 5:</label>
										<input type="text" class="form-control rounded" name="opcion5_1" id="opcion5_1" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-1"></div>
								</div>
								<hr>

								<div class="form-row pb-1">
									<div class="form-group col-12">
										<label for="pregunta_cerrada2" class="control-label text-dark-gray">Pregunta 2:</label>
										<input type="text" class="form-control rounded" name="pregunta_cerrada2" id="pregunta_cerrada2" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
								</div>
								<div class="form-row pb-1">
									<div class="form-group col-1"></div>
									<div class="form-group col-2">
										<label for="opcion1_2" class="control-label text-dark-gray">Opción 1:</label>
										<input type="text" class="form-control rounded" name="opcion1_2" id="opcion1_2" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion2_2" class="control-label text-dark-gray">Opción 2:</label>
										<input type="text" class="form-control rounded" name="opcion2_2" id="opcion2_2" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion3_2" class="control-label text-dark-gray">Opción 3:</label>
										<input type="text" class="form-control rounded" name="opcion3_2" id="opcion3_2" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion4_2" class="control-label text-dark-gray">Opción 4:</label>
										<input type="text" class="form-control rounded" name="opcion4_2" id="opcion4_2" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion5_2" class="control-label text-dark-gray">Opción 5:</label>
										<input type="text" class="form-control rounded" name="opcion5_2" id="opcion5_2" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-1"></div>
								</div>
								<hr>

								<div class="form-row pb-1">
									<div class="form-group col-12">
										<label for="pregunta_cerrada3" class="control-label text-dark-gray">Pregunta 3:</label>
										<input type="text" class="form-control rounded" name="pregunta_cerrada3" id="pregunta_cerrada3" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
								</div>
								<div class="form-row pb-1">
									<div class="form-group col-1"></div>
									<div class="form-group col-2">
										<label for="opcion1_3" class="control-label text-dark-gray">Opción 1:</label>
										<input type="text" class="form-control rounded" name="opcion1_3" id="opcion1_3" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion2_3" class="control-label text-dark-gray">Opción 2:</label>
										<input type="text" class="form-control rounded" name="opcion2_3" id="opcion2_3" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion3_3" class="control-label text-dark-gray">Opción 3:</label>
										<input type="text" class="form-control rounded" name="opcion3_3" id="opcion3_3" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion4_3" class="control-label text-dark-gray">Opción 4:</label>
										<input type="text" class="form-control rounded" name="opcion4_3" id="opcion4_3" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion5_3" class="control-label text-dark-gray">Opción 5:</label>
										<input type="text" class="form-control rounded" name="opcion5_3" id="opcion5_3" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-1"></div>
								</div>
								<hr>

								<div class="form-row pb-1">
									<div class="form-group col-12">
										<label for="pregunta_cerrada4" class="control-label text-dark-gray">Pregunta 4:</label>
										<input type="text" class="form-control rounded" name="pregunta_cerrada4" id="pregunta_cerrada4" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
								</div>
								<div class="form-row pb-1">
									<div class="form-group col-1"></div>
									<div class="form-group col-2">
										<label for="opcion1_4" class="control-label text-dark-gray">Opción 1:</label>
										<input type="text" class="form-control rounded" name="opcion1_4" id="opcion1_4" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion2_4" class="control-label text-dark-gray">Opción 2:</label>
										<input type="text" class="form-control rounded" name="opcion2_4" id="opcion2_4" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion3_4" class="control-label text-dark-gray">Opción 3:</label>
										<input type="text" class="form-control rounded" name="opcion3_4" id="opcion3_4" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion4_4" class="control-label text-dark-gray">Opción 4:</label>
										<input type="text" class="form-control rounded" name="opcion4_4" id="opcion4_4" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion5_4" class="control-label text-dark-gray">Opción 5:</label>
										<input type="text" class="form-control rounded" name="opcion5_4" id="opcion5_4" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-1"></div>
								</div>
								<hr>

								<div class="form-row pb-1">
									<div class="form-group col-12">
										<label for="pregunta_cerrada5" class="control-label text-dark-gray">Pregunta 5:</label>
										<input type="text" class="form-control rounded" name="pregunta_cerrada5" id="pregunta_cerrada5" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
								</div>
								<div class="form-row pb-1">
									<div class="form-group col-1"></div>
									<div class="form-group col-2">
										<label for="opcion1_5" class="control-label text-dark-gray">Opción 1:</label>
										<input type="text" class="form-control rounded" name="opcion1_5" id="opcion1_5" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion2_5" class="control-label text-dark-gray">Opción 2:</label>
										<input type="text" class="form-control rounded" name="opcion2_5" id="opcion2_5" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion3_5" class="control-label text-dark-gray">Opción 3:</label>
										<input type="text" class="form-control rounded" name="opcion3_5" id="opcion3_5" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion4_5" class="control-label text-dark-gray">Opción 4:</label>
										<input type="text" class="form-control rounded" name="opcion4_5" id="opcion4_5" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion5_5" class="control-label text-dark-gray">Opción 5:</label>
										<input type="text" class="form-control rounded" name="opcion5_5" id="opcion5_5" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-1"></div>
								</div>
								<hr>

								<div class="form-row pb-1">
									<div class="form-group col-12">
										<label for="pregunta_cerrada6" class="control-label text-dark-gray">Pregunta 6:</label>
										<input type="text" class="form-control rounded" name="pregunta_cerrada6" id="pregunta_cerrada6" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
								</div>
								<div class="form-row pb-1">
									<div class="form-group col-1"></div>
									<div class="form-group col-2">
										<label for="opcion1_6" class="control-label text-dark-gray">Opción 1:</label>
										<input type="text" class="form-control rounded" name="opcion1_6" id="opcion1_6" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion2_6" class="control-label text-dark-gray">Opción 2:</label>
										<input type="text" class="form-control rounded" name="opcion2_6" id="opcion2_6" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion3_6" class="control-label text-dark-gray">Opción 3:</label>
										<input type="text" class="form-control rounded" name="opcion3_6" id="opcion3_6" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion4_6" class="control-label text-dark-gray">Opción 4:</label>
										<input type="text" class="form-control rounded" name="opcion4_6" id="opcion4_6" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion5_6" class="control-label text-dark-gray">Opción 5:</label>
										<input type="text" class="form-control rounded" name="opcion5_6" id="opcion5_6" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-1"></div>
								</div>
								<hr>

								<div class="form-row pb-1">
									<div class="form-group col-12">
										<label for="pregunta_cerrada7" class="control-label text-dark-gray">Pregunta 7:</label>
										<input type="text" class="form-control rounded" name="pregunta_cerrada7" id="pregunta_cerrada7" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
								</div>
								<div class="form-row pb-1">
									<div class="form-group col-1"></div>
									<div class="form-group col-2">
										<label for="opcion1_7" class="control-label text-dark-gray">Opción 1:</label>
										<input type="text" class="form-control rounded" name="opcion1_7" id="opcion1_7" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion2_7" class="control-label text-dark-gray">Opción 2:</label>
										<input type="text" class="form-control rounded" name="opcion2_7" id="opcion2_7" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion3_7" class="control-label text-dark-gray">Opción 3:</label>
										<input type="text" class="form-control rounded" name="opcion3_7" id="opcion3_7" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion4_7" class="control-label text-dark-gray">Opción 4:</label>
										<input type="text" class="form-control rounded" name="opcion4_7" id="opcion4_7" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion5_7" class="control-label text-dark-gray">Opción 5:</label>
										<input type="text" class="form-control rounded" name="opcion5_7" id="opcion5_7" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-1"></div>
								</div>
								<hr>

								<div class="form-row pb-1">
									<div class="form-group col-12">
										<label for="pregunta_cerrada8" class="control-label text-dark-gray">Pregunta 8:</label>
										<input type="text" class="form-control rounded" name="pregunta_cerrada8" id="pregunta_cerrada8" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
								</div>
								<div class="form-row pb-1">
									<div class="form-group col-1"></div>
									<div class="form-group col-2">
										<label for="opcion1_8" class="control-label text-dark-gray">Opción 1:</label>
										<input type="text" class="form-control rounded" name="opcion1_8" id="opcion1_8" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion2_8" class="control-label text-dark-gray">Opción 2:</label>
										<input type="text" class="form-control rounded" name="opcion2_8" id="opcion2_8" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion3_8" class="control-label text-dark-gray">Opción 3:</label>
										<input type="text" class="form-control rounded" name="opcion3_8" id="opcion3_8" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion4_8" class="control-label text-dark-gray">Opción 4:</label>
										<input type="text" class="form-control rounded" name="opcion4_8" id="opcion4_8" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-2">
										<label for="opcion5_8" class="control-label text-dark-gray">Opción 5:</label>
										<input type="text" class="form-control rounded" name="opcion5_8" id="opcion5_8" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
									<div class="form-group col-1"></div>
								</div>
							</div><br><br>

							<label class="control-label text-dark-gray">Preguntas abiertas:</label>
							<div class="card px-3 py-2">
								<div class="form-row pb-1">
									<div class="form-group col-12">
										<label for="pregunta_abierta1" class="control-label text-dark-gray">Pregunta 1:</label>
										<input type="text" class="form-control rounded" name="pregunta_abierta1" id="pregunta_abierta1" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
								</div>
								<div class="form-row pb-1">
									<div class="form-group col-12">
										<label for="pregunta_abierta2" class="control-label text-dark-gray">Pregunta 2:</label>
										<input type="text" class="form-control rounded" name="pregunta_abierta2" id="pregunta_abierta2" <?php echo $_SESSION['enable_disable']; ?>>
									</div>
								</div>
							</div><br><br>

							<div class="form-row pb-1">
								<div class="form-group col-2"></div>
								<div class="form-group col-8">
									<?php if ($_SESSION['tipo'] == "Alumn" AND isset($_SESSION["sesion3_3"]) AND $_SESSION["sesion3_3"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
									<label for="coments_asesor" class="control-label text-dark-gray">Comentarios del Asesor:</label>
									<textarea class="form-control rounded" name="coments_asesor" id="coments_asesor" rows="3" <?php echo $_SESSION['enable_disable_asesor']; ?>></textarea>
								</div>
								<div class="form-group col-2"></div>
							</div>

							<?php if ($_SESSION['tipo'] == "Volun") {?>
							<div class="form-row pb-1">
								<div class="form-group col-3"></div>
								<div class="form-group col-6 text-center">
									<div class="checkbox checkbox-green">
										<input type="checkbox" class="custom-control-input" id="validacionAsesor" name="validacionAsesor" value="1">
										<label class="custom-control-label" for="validacionAsesor">Validación del Asesor. Estoy de acuerdo con la información ingresada. Ya no haré más comentarios.</label>
									</div>
								</div>
								<div class="form-group col-3"></div>
							</div>
							<?php } ?>

							<div class="row pb-1">
								<div class="col text-center">
									<?php if ($_SESSION['tipo'] == "Volun") {?>
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_registrar" id="btn_registrar" disabled>Registrar comentario</button>
									<?php } else if ($_SESSION['tipo'] == "Alumn") { ?>
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_registrar" id="btn_registrar" <?php echo $_SESSION['enable_disable']; ?>>Agregar 'Preguntas'</button>
										<button type="button" class="btn btn-warning text-center px-5 my-2" name="limpiar" id="limpiar" onclick="location.reload()">Limpiar</button>
									<?php } ?>
										<button type="button" class="btn btn-warning text-center px-5 my-2" name="btn_generar" id="btn_generar" disabled onclick="generar_encuesta();">Genera Encuesta</button>
								</div>
							</div>

						</form>

						<div class="border border-warning borde-info px-5 mb-3">
							<p class="text-justify pt-3">En pocas palabras…</p>
							<p class="text-justify">¡Bien hecho! Ya tienes un producto que fue diseñado a partir de escuchar las necesidades de tu cliente, identificar cuáles son sus problemas y verificar si tu propuesta le parecía buena idea. Este proceso se utiliza en las grandes empresas para estar constantemente verificando que sus productos están diseñados para responder a las necesidades de sus clientes, así que ahora sabes que no solo se utiliza al principio de la creación de una empresa, es muy útil para tener una validación constante y un acercamiento permanente con los clientes.</p>
							<p class="text-justify">Con el producto seleccionado, están listos para comenzar con el proceso de construir su empresa.</p>
							<p class="text-center">¡Continúa aprendiendo!</p>
						</div>

						<div class="row">
							<div class="text-left col-6"><a href="<?php echo $uri_sola . '=1'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a></div>

							<div class="text-right col-6"><a href="<?php echo $uri_sola . '=3'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(33)" <?php } ?>>Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a></div>
						</div>
					</div>
				</div>
			</div>

			<script type="text/javascript">

				<?php if ($_SESSION['tipo'] == "Admin") {?>
					$(document).ready(function(){
						var parametros = {
							"seccion" : "3_3",
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
							"seccion" : "3_3",
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
							"seccion" : "3_3",
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
						  url: '../alumno/ajax/empresas_info_s3_3_data.php',
						  type: 'post',
						  success: function(data)
						  {
							var array = JSON.parse(data);
							cerradas = 1;
							abiertas = 1;
							for (var i = 1; i <= array.length; i++) {
								if (array[i-1].tipo == 0) {
									$("#pregunta_cerrada"+cerradas).val(array[i-1].pregunta);
									$("#opcion1_"+cerradas).val(array[i-1].opcion1);
									$("#opcion2_"+cerradas).val(array[i-1].opcion2);
									$("#opcion3_"+cerradas).val(array[i-1].opcion3);
									$("#opcion4_"+cerradas).val(array[i-1].opcion4);
									$("#opcion5_"+cerradas).val(array[i-1].opcion5);
									cerradas++;
								} else if (array[i-1].tipo == 1) {
									$("#pregunta_abierta"+abiertas).val(array[i-1].pregunta);
									abiertas++;
								}
							}
							$("#coments_asesor").html(array[0].coments_asesor);
							if (array[0].pregunta != "") {
								$("#action").val("update");
								$("#btn_registrar").text("Actualizar 'Preguntas'");
								$("#btn_generar").prop('disabled', false);
							}
						  }
						});
					});

				<?php }

				if ($_SESSION['tipo'] != "Alumn") { ?>
					function filtro_empresa(){
						var Empresa_ID = document.getElementById("select_empresa").value;
						var parametros = {
							"Empresa_ID" : Empresa_ID,
						};
						$("#Empresa_ID").val(Empresa_ID);
						$('#btn_registrar').prop('disabled', false);

						$.ajax({
						  data:  parametros,
						  url: '../alumno/ajax/empresas_info_s3_3_data.php',
						  type: 'post',
						  success: function(data)
						  {
							for (var i = 1; i <= 8; i++) {
								$("#pregunta_cerrada"+i).val('');
								$("#opcion1_"+i).val('');
								$("#opcion2_"+i).val('');
								$("#opcion3_"+i).val('');
								$("#opcion4_"+i).val('');
								$("#opcion5_"+i).val('');
							}
							$("#pregunta_abierta1").val('');
							$("#pregunta_abierta2").val('');
							var array = JSON.parse(data);
							cerradas = 1;
							abiertas = 1;
							for (var i = 1; i <= array.length; i++) {
								if (array[i-1].tipo == 0) {
									$("#pregunta_cerrada"+cerradas).val(array[i-1].pregunta);
									$("#opcion1_"+cerradas).val(array[i-1].opcion1);
									$("#opcion2_"+cerradas).val(array[i-1].opcion2);
									$("#opcion3_"+cerradas).val(array[i-1].opcion3);
									$("#opcion4_"+cerradas).val(array[i-1].opcion4);
									$("#opcion5_"+cerradas).val(array[i-1].opcion5);
									cerradas++;
								} else if (array[i-1].tipo == 1) {
									$("#pregunta_abierta"+abiertas).val(array[i-1].pregunta);
									abiertas++;
								}
								$("#coments_asesor").html(array[0].coments_asesor);
							}
							if (array[0].pregunta != "") {
								$("#action").val("update");
								$("#btn_registrar").text("Actualizar comentario");
								$("#btn_generar").prop('disabled', false);
							} else {
								$("#btn_generar").prop('disabled', true);
								$("#action").val("new");
							}

							if (Empresa_ID == 0) {
								$('#btn_registrar').prop('disabled', true);
							}
						  }
						});
					}
				<?php } ?>

				function generar_encuesta()
				{
					<?php if ($_SESSION['tipo'] != "Alumn") { ?>
						var Empresa_ID = document.getElementById("select_empresa").value;
						window.location = "<?php echo $RAIZ_SITIO_nohttp; ?>scripts/alumno/generar_encuesta.php?ID="+Empresa_ID;
					<?php } else if ($_SESSION['tipo'] == "Alumn") { ?>
						window.location = "<?php echo $RAIZ_SITIO_nohttp; ?>scripts/alumno/generar_encuesta.php";
					<?php } ?>
				}

			</script>