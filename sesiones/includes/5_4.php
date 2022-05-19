<?php
	$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/logotipos/";
	if (isset($_SESSION["Empresa_ID"])) {
		if (is_file($target_dir . $_SESSION["Empresa_ID"] . '.jpg')) {
			$imagen = $RAIZ_SITIO . "images/logotipos/" . $_SESSION["Empresa_ID"] . '.jpg';
			$con_imagen = "si";
		} else {
			$imagen = $RAIZ_SITIO . "images/logotipos/" . 'perfil.png';
			$con_imagen = "no";
		}
	} else {
		$imagen = $RAIZ_SITIO . "images/logotipos/" . 'perfil.png';
		$con_imagen = "no";
	}

	$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/actas/";
	if (isset($_SESSION["Empresa_ID"])) {
		if (is_file($target_dir . "Acta_empresa_" . $_SESSION["Empresa_nombre"] . '.pdf')) {
			$con_file = "si";
			$nombre_acta = "Acta_empresa_" . $_SESSION["Empresa_nombre"] . '.pdf';
		} else {
			$con_file = "no";
		}
	} else {
		$con_file = "no";
	}

	$le_compete = "disabled";
	$read_only = "read_only";
	if ($_SESSION['tipo'] == "Alumn") {
		if ($_SESSION['Puesto_ID'] == 1) {
			$le_compete = "";
			$read_only = "";
		}
	}
?>
			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 5 <i class="fas fa-angle-right fa-lg fa-fw"></i> La Identidad Empresarial <i class="fas fa-angle-right fa-lg fa-fw"></i> La Identidad Empresarial
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">La Identidad Empresarial</h5>
					<div class="card-text px-5">
						<div>
							<p class="text-justify">Después de haber trabajado en equipo, ya han definido los siguientes elementos:</p>
							<div class="px-5">
								<i class="fas fa-check fa-lg fa-fw text-pale-green"></i>Nombre de la Empresa
								<br><br>
								<i class="fas fa-check fa-lg fa-fw text-pale-green"></i>Eslogan de la Empresa y su Logotipo
								<br><br>
								<i class="fas fa-check fa-lg fa-fw text-pale-green"></i>Misión y Visión de la Empresa
								<br><br>
								<i class="fas fa-check fa-lg fa-fw text-pale-green"></i>Valores de la Empresa
								<br>
							</div>
							<br>
							<p class="text-justify">Están listos para ser cargados en la plataforma. Háganlo a continuación:</p>

							<div class="row justify-content-md-center">
								<div class="col-md-auto px-5 text-center">
								<?php if ($_SESSION["tipo"]=="Alumn") { ?>
									<h5><span class="badge badge-success px-3 py-3 text-wrap"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Realicen la actividad para obtener <span class="text-yellow">40 estrellas</span> para su empresa</span></h5>
								<?php } else { ?>
									<h5><span class="badge badge-success px-3 py-3 text-wrap"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Realizar la actividad otorga <span class="text-yellow">40 estrellas a la empresa</span></span></h5>
								<?php } ?>
								</div>
							</div>
							<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/registrar_5_4.php" method="post" class="mt-1" enctype="multipart/form-data">
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

								<div class="form-row pb-1">
									<div class="col-1"></div>
									<div class="form-group col-10">
										<label for="nombre_empresa" class="control-label text-dark-gray">Nombre de la Empresa:</label>
										<input type="text" class="form-control rounded" name="nombre_empresa" id="nombre_empresa" aria-describedby="nombre_empresa_help" <?php echo $_SESSION['enable_disable']; ?> required <?php echo $read_only; ?>>
										<small id="nombre_empresa_help" class="form-text text-dark-gray w200">Debe inspirar confianza y transmitir una percepción profesional.</small>
									</div>
									<?php $validaciones[] = array('nombre_empresa', 'nombre_empresa_input', "'Error en Nombre de Empresa. Favor de corregir.'"); ?>
									<div class="col-1"></div>
								</div><br>

								<div class="form-row pb-1">
									<div class="col-1"></div>
									<div class="form-group col-10">
										<label for="eslogan_empresa" class="control-label text-dark-gray">Eslogan de la Empresa:</label>
										<input type="text" class="form-control rounded" name="eslogan_empresa" id="eslogan_empresa" aria-describedby="eslogan_empresa_help" <?php echo $_SESSION['enable_disable']; ?> required <?php echo $read_only; ?>>
										<small id="eslogan_empresa_help" class="form-text text-dark-gray w200">Debe encender la chispa para la identificación inmediata de tu producto.</small>
									</div>
									<?php $validaciones[] = array('eslogan_empresa', 'eslogan_empresa_input', "'Error en Eslogan de Empresa. Favor de corregir.'"); ?>
									<div class="col-1"></div>
								</div><br>

								<div class="col-12 text-center img_container">
									<img src="<?php echo $imagen . "?x=" . md5(time()); ?>" width="180" class="rounded mx-auto d-blocks img-thumbnail" id="image_profile">
								</div>
								<div class="col-12 text-center">
									<div class="col-2"></div>
									<div class="custom-file mb-3 mt-1 col-8">
										<label class="control-label text-dark-gray">Logotipo de la Empresa:</label>
										<input id="upload" name="upload" type="file" class="custom-file-input" <?php echo $_SESSION['enable_disable']; ?> onchange="readUpload(this);" <?php echo $read_only; ?>>
										<label for="upload" class="custom-file-label">Cambiar logotipo</label>
									</div>
									<div class="col-2"></div>
								</div><br>

								<div class="form-row pb-1">
									<div class="form-group col-1"></div>
									<div class="form-group col-10">
										<label for="mision_empresa" class="control-label text-dark-gray">Misión de la Empresa:</label>
										<textarea class="form-control rounded" name="mision_empresa" id="mision_empresa" rows="3" <?php echo $_SESSION['enable_disable']; ?> required <?php echo $read_only; ?>></textarea>
										<small id="mision_empresa_help" class="form-text text-dark-gray w200">Es la “razón de ser” de la empresa. Responde al ¿qué?</small>
									</div>
									<?php $validaciones[] = array('mision_empresa', 'mision_empresa_input', "'Error en Misión de Empresa. Favor de corregir.'"); ?>
									<div class="form-group col-1"></div>
								</div>

								<div class="form-row pb-1">
									<div class="col-1"></div>
									<div class="form-group col-10">
										<label for="vision_empresa" class="control-label text-dark-gray">Visión de la Empresa:</label>
										<textarea class="form-control rounded" name="vision_empresa" id="vision_empresa" rows="3" <?php echo $_SESSION['enable_disable']; ?> required <?php echo $read_only; ?>></textarea>
										<small id="vision_empresa_help" class="form-text text-dark-gray w200">Es una expectativa ideal, lo que creemos que pasará cuando se cumpla la misión. Responde al ¿para qué?</small>
									</div>
									<?php $validaciones[] = array('vision_empresa', 'vision_empresa_input', "'Error en Visión de Empresa. Favor de corregir.'"); ?>
									<div class="col-1"></div>
								</div><br>

								<div class="form-row pb-1">
									<div class="col-1"></div>
									<div class="form-group col-10">
										<label for="valores_empresa" class="control-label text-dark-gray">Valores de la Empresa:</label>
										<textarea class="form-control rounded" name="valores_empresa" id="valores_empresa" rows="3" <?php echo $_SESSION['enable_disable']; ?> required <?php echo $read_only; ?>></textarea>
										<small id="valores_empresa_help" class="form-text text-dark-gray w200">Deben reflejar los intereses, sentimientos y convicciones más importantes de la Empresa.</small>
									</div>
									<?php $validaciones[] = array('valores_empresa', 'valores_empresa_input', "'Error en Valores de Empresa. Favor de corregir.'"); ?>
									<div class="col-1"></div>
								</div><br>

								<p class="text-justify">El siguiente paso hacia una empresa consolidada es que todos firmen su <strong>ACTA CONSTITUTIVA</strong>.</p>
								<p class="text-justify">Este documento avala oficialmente la formación de la Empresa. También señala los estatutos que todos deben acatar. A continuación, en equipo, descarguen y revisen el documento propuesto, posteriormente y con el apoyo de su Asesor, actualícenlo, fírmenlo todos los integrantes y súbanlo en esta sección. Pueden firmar digitalmente el documento.</p>
								<p class="text-justify">
									<div class="text-orange text-center">Todos los integrantes de la empresa pueden colaborar subiendo la información, sólo sugerimos se coordinen para evitar sobreescritura, pero <b>el Acta Constitutiva sólo la puede subir el Director General<b>, una vez que se encuentre bien llenada y firmada.</div><br>
								</p>

								<p class="text-justify">Descarga el formato <strong><i>E&ES5 - 5 ACTA CONSTITUTIVA Y ESTATUTOS</i></strong> <a href="../sesiones/docs/E&ES5 - 3 ACTA CONSTITUTIVA Y ESTATUTOS.docx" download><span class="badge badge-warning text-center px-3 py-2">AQUÍ</span></a>, y súbelo una vez revisado, actualizado, firmado y escaneado, a continuación:</p>
								<div class="col-12 text-center">
									<div class="col-3"></div>
									<div class="custom-file mb-3 mt-1 col-6">
										<input id="upload2" name="upload2" type="file" class="custom-file-input" accept="application/pdf" <?php echo $_SESSION['enable_disable']; ?> onchange="validar_pdf(this);" <?php echo $le_compete; ?>>
										<label for="upload2" class="custom-file-label">Seleccionar documento (sólo PDF)</label>
									</div>
									<div class="col-3"></div>
								</div>
								<div class="col-12 text-center" id="acta_subida">
									<div class="col-1"></div>
									<div class="custom-file mb-3 mt-1 col-10" id="acta_link"></div>
									<div class="col-1"></div>
								</div>

								<div class="form-row pb-1">
									<div class="form-group col-2"></div>
									<div class="form-group col-8">
										<?php if ($_SESSION['tipo'] == "Alumn" AND isset($_SESSION["sesion5_3"]) AND $_SESSION["sesion5_3"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
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
										<?php } else if ($_SESSION['tipo'] == "Alumn") { ?>
											<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_registrar" id="btn_registrar" <?php echo $_SESSION['enable_disable']; ?>>Agregar Información</button>
											<button type="button" class="btn btn-warning text-center px-5 my-2" name="limpiar" id="limpiar" onclick="location.reload()">Limpiar</button>
										<?php } ?>
									</div>
								</div>
							</form>
						</div>
						<br><br>
						<div class="row">
							<div class="text-left col-6">
								<a href="<?php echo $uri_sola . '=2'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a>
							</div>
							<div class="text-right col-6">
								<a href="<?php echo $uri_sola . '=4'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(54)" <?php } ?>>Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				<?php if ($_SESSION['tipo'] == "Admin") {?>
					$(document).ready(function(){
						var parametros = {
							"seccion" : "5_4",
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
							"seccion" : "5_4",
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
							"seccion" : "5_4",
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
						<?php if ($con_imagen=="si") { ?>
							$(".img_container").addClass("zoom");
						<?php } else if ($con_imagen=="no"){ ?>
							$(".img_container").removeClass("zoom");
						<?php } ?>
					});

				<?php } else if ($_SESSION['tipo'] == "Alumn") { ?>
					$(document).ready(function(){
						var parametros = {
							"Empresa_ID" : <?php echo $_SESSION['Empresa_ID']; ?>,
						};
						$.ajax({
						  data:  parametros,
						  url: '../alumno/ajax/empresas_info_s5_4_data.php',
						  type: 'post',
						  success: function(data)
						  {
							var array = JSON.parse(data);
							$("#nombre_empresa").val(array.nombre_empresa);
							$("#eslogan_empresa").val(array.eslogan_empresa);
							$("#mision_empresa").html(array.mision_empresa);
							$("#vision_empresa").html(array.vision_empresa);
							$("#valores_empresa").html(array.valores_empresa);
							$("#coments_asesor").html(array.coments_asesor);
							if (array.nombre_empresa != "") {
								$("#action").val("update");
								$("#btn_registrar").text("Actualizar Información");
							}
						  }
						});
						<?php if ($con_imagen=="si") { ?>
							$(".img_container").addClass("zoom");
						<?php } else if ($con_imagen=="no"){ ?>
							$(".img_container").removeClass("zoom");
						<?php } ?>
						$.ajax({
						  data:  parametros,
						  url: '../scripts/ajax/ver_acta_constitutiva.php',
						  type: 'post',
						  success: function(data)
						  {
							$("#acta_link").html(data);
						  }
						});
					});

					$(".custom-file-input").on("change", function() {
						var fileName = $(this).val().split("\\").pop();
						$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
					});

					function readUpload(input) {
						if (input.files && input.files[0]) {
							var reader = new FileReader();

							reader.onload = function (e) {
								$('#image_profile').attr('src', e.target.result);
							};
							reader.readAsDataURL(input.files[0]);
						}
					}

					function validar_pdf(){
						var archivo = $("#upload2").val();
						var extension = archivo.substring(archivo.lastIndexOf("."));
						if(extension != ".pdf"){
							$('#btn_nueva_acta').prop('disabled', true);
						} else {
							$('#btn_nueva_acta').prop('disabled', false);
						}
					}

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
						$('#btn_registrar').prop('disabled', false);

						$.ajax({
							url: '../images/logotipos/'+Empresa_ID+'.jpg',
							success: function(data){
								$("#image_profile").attr("src","../images/logotipos/"+Empresa_ID+ ".jpg");
								$(".img_container").addClass("zoom");
								var img1 = document.getElementById('image_profile');
								img1.onerror = defaultImage;
							},
							error: function(data){
								$("#image_profile").attr("src","../images/logotipos/perfil.png");
								$(".img_container").removeClass("zoom");
							},
						})

						$.ajax({
						  data:  parametros,
						  url: '../alumno/ajax/empresas_info_s5_4_data.php',
						  type: 'post',
						  success: function(data)
						  {
							var array = JSON.parse(data);
							$("#nombre_empresa").val(array.nombre_empresa);
							$("#eslogan_empresa").val(array.eslogan_empresa);
							$("#mision_empresa").html(array.mision_empresa);
							$("#vision_empresa").html(array.vision_empresa);
							$("#valores_empresa").html(array.valores_empresa);
							$("#coments_asesor").html(array.coments_asesor);
							if (array.nombre_empresa != "") {
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

						$.ajax({
						  data:  parametros,
						  url: '../scripts/ajax/ver_acta_constitutiva.php',
						  type: 'post',
						  success: function(data)
						  {
							$("#acta_link").html(data);
						  }
						});

						function defaultImage(e){
							e.target.src= "<?php echo $RAIZ_SITIO . "images/logotipos/perfil.png";?>";
							$(".img_container").removeClass("zoom");
						}
					}
				<?php } ?>
			</script>