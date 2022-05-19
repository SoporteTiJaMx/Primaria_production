<?php
	$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/storyboards/";
	if (isset($_SESSION["Empresa_ID"])) {
		if (is_file($target_dir . $_SESSION["Empresa_ID"] . '.jpg')) {
			$imagen = $RAIZ_SITIO . "images/storyboards/" . $_SESSION["Empresa_ID"] . '.jpg';
			$con_imagen = "si";
		} else {
			$imagen = $RAIZ_SITIO . "images/storyboards/" . 'perfil.png';
			$con_imagen = "no";
		}
	} else {
		$imagen = $RAIZ_SITIO . "images/storyboards/" . 'perfil.png';
		$con_imagen = "no";
	}
?>

			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 2 <i class="fas fa-angle-right fa-lg fa-fw"></i> El arte de crear I <i class="fas fa-angle-right fa-lg fa-fw"></i> Ideación
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Idear: Brainstorm o lluvia de ideas</h5>
					<div class="card-text px-5">
						<p class="text-justify">Esta es la última etapa que revisaremos en esta sesión. Este momento será clave para aprovechar todo el trabajo que ya has realizado en las dos etapas anteriores.</p>
						<p class="text-justify">Si aún no descargas el material descriptivo de "Idear" para trabajar esta sección, hazlo <a href="../sesiones/docs/E&ES2 - 2.1.3 IDEAR - BRAINSTORM.pdf" download><span class="badge badge-warning text-center px-3 py-2">AQUÍ</span></a>.</p>
						<p class="text-justify">Una vez finalizado el ejercicio de lluvia de ideas y realizada la votación para seleccionar sus <strong>dos mejores ideas</strong>, ingresa aquí una breve descripción de cada una.</p>

						<?php if ($_SESSION['tipo'] == "Alumn") {?>
						<div class="text-orange text-center">Nota: para evitar pérdida o sobreescritura de información, durante toda esta sesión designen a un integrante del equipo para subir la información a cada sección luego de trabajarla en conjunto.</div><br>
						<?php } else { ?>
						<div class="text-orange text-center">Nota: Sugiere a los estudiantes que, para evitar pérdida o sobreescritura de información, durante toda esta sesión designen a uno de ellos para subir la información a cada sección luego de trabajarla en conjunto.</div><br>
						<?php } ?>

						<div class="row justify-content-md-center">
							<div class="col-md-auto px-5 text-center">
							<?php if ($_SESSION["tipo"]=="Alumn") { ?>
								<h5><span class="badge badge-success px-3 py-3 text-wrap"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Realicen la actividad, junto con todas las de la sesión, y obtengan <span class="text-yellow">50 estrellas</span> para su empresa</span></h5>
							<?php } else { ?>
								<h5><span class="badge badge-success px-3 py-3 text-wrap"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Realizar la actividad, junto con todas las de la sesión, otorga <span class="text-yellow">50 estrellas a la empresa</span></span></h5>
							<?php } ?>
							</div>
						</div>

						<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/registrar_2_4.php" method="post" class="mt-1" enctype="multipart/form-data">
							<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
							<input name="Empresa_ID" type="hidden" id="Empresa_ID" value="<?php if ($_SESSION['tipo'] == "Alumn") { echo $_SESSION['Empresa_ID']; } else { echo ""; } ?>">
							<input name="action" type="hidden" id="action" value="new">

							<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto mb-2"></div></div>
							<br>

							<?php if ($_SESSION['tipo'] != "Alumn") {?>
							<div class="text-center"><div id="actualizados" style="display: none" class="bg-success w-50 py-2 text-center text-white rounded mx-auto mb-2"></div></div>
							<div class="form-row pb-3">
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

							<?php if ($_SESSION['tipo'] == "Admin") {?>
							<div class="text-orange text-center">¡IMPORTANTE! <br>Administrador, en esta sección como staff de JA México debes aprobar una de las 2 ideas propuestas por cada empresa, para que los empresarios puedan seguir trabajado en su validación. Mientras no lo apruebes, los jóvenes empresarios no podrán avanzar en el portal.</div><br>
							<?php } else if ($_SESSION['tipo'] == "Coord") {?>
							<div class="text-orange text-center">¡IMPORTANTE! <br>Coordinador, en esta sección los jóvenes empresarios deben esperar que el staff de JA México apruebe una de las 2 ideas propuestas por cada empresa, para que puedan seguir trabajado en su validación. Mientras no lo haga, los jóvenes empresarios no podrán avanzar en el portal.</div><br>
							<?php } else if ($_SESSION['tipo'] == "Volun") {?>
							<div class="text-orange text-center">¡IMPORTANTE! <br>Asesor, en esta sección los jóvenes empresarios deben esperar que el staff de JA México apruebe una de las 2 ideas propuestas por cada empresa, para que puedan seguir trabajado en su validación. Mientras no lo haga, los jóvenes empresarios no podrán avanzar en el portal. Asimismo, en esta sección sólo el Administrador de JA México podrá comentar la información ingresada.</div><br>
							<?php } else if ($_SESSION['tipo'] == "Alumn") {?>
							<div class="text-orange text-center">¡IMPORTANTE! <br>Jóvenes emprendedores, en esta sección deben esperar que el staff de JA México apruebe una de sus 2 ideas propuestas, para que puedan seguir trabajado en su validación. Mientras no lo haga, no podrán avanzar en el portal. Asimismo, en esta sección sólo el Administrador de JA México podrá comentar la información que ingresen.</div><br>
							<?php } ?>

							<label class="control-label text-dark-gray">Idea 1:</label>
							<div class="card px-3 py-2">
								<div class="form-row pb-1">
									<div class="form-group col-4">
										<label for="idea1" class="control-label text-dark-gray">Idea:</label>
										<textarea class="form-control rounded" name="idea1" id="idea1" aria-describedby="idea1_help" rows="3" <?php echo $_SESSION['enable_disable']; ?> required></textarea>
										<small id="idea1_help" class="form-text text-dark-gray w200">¿Qué producto han ideado para resolver el problema?</small>
									</div>
									<?php $validaciones[] = array('idea1', 'idea1_input', "'Error en Idea 1. Favor de corregir.'"); ?>
									<div class="form-group col-7">
										<label for="descripcion1" class="control-label text-dark-gray">Descripcion:</label>
										<textarea class="form-control rounded" name="descripcion1" id="descripcion1" aria-describedby="descripcion1_help" rows="3" <?php echo $_SESSION['enable_disable']; ?> required></textarea>
										<small id="descripcion1_help" class="form-text text-dark-gray w200">Describe brevemente en qué consiste la Idea 1.</small>
									</div>
									<?php $validaciones[] = array('descripcion1', 'descripcion1_input', "'Error en Descripcion Idea 1. Favor de corregir.'"); ?>
									<div class="form-group col-1">
										<label for="aprobacion1" class="control-label text-black-green">Aprobado</label>
										<div class="checkbox checkbox-green pt-1 text-center">
											<input type="radio" class="custom-control-input" id="aprobacion1" name="aprobacion" value="1" disabled>
											<label class="custom-control-label" for="aprobacion1"></label>
										</div>
									</div>
								</div>
							</div><br><br>

							<label class="control-label text-dark-gray">Idea 2:</label>
							<div class="card px-3 py-2">
								<div class="form-row pb-1">
									<div class="form-group col-4">
										<label for="idea2" class="control-label text-dark-gray">Idea:</label>
										<textarea class="form-control rounded" name="idea2" id="idea2" aria-describedby="idea2_help" rows="3" <?php echo $_SESSION['enable_disable']; ?> required></textarea>
										<small id="idea2_help" class="form-text text-dark-gray w200">¿Qué otra idea tuvieron para resolver el problema?</small>
									</div>
									<?php $validaciones[] = array('idea2', 'idea2_input', "'Error en Idea 2. Favor de corregir.'"); ?>
									<div class="form-group col-7">
										<label for="descripcion2" class="control-label text-dark-gray">Descripcion:</label>
										<textarea class="form-control rounded" name="descripcion2" id="descripcion2" aria-describedby="descripcion2_help" rows="3" <?php echo $_SESSION['enable_disable']; ?> required></textarea>
										<small id="descripcion2_help" class="form-text text-dark-gray w200">Describe brevemente en qué consiste la Idea 2.</small>
									</div>
									<?php $validaciones[] = array('descripcion2', 'descripcion2_input', "'Error en Descripcion Idea 2. Favor de corregir.'"); ?>
									<div class="form-group col-1">
										<label for="aprobacion2" class="control-label text-black-green">Aprobado</label>
										<div class="checkbox checkbox-green pt-1 text-center">
											<input type="radio" class="custom-control-input" id="aprobacion2" name="aprobacion" value="2" disabled>
											<label class="custom-control-label" for="aprobacion2"></label>
										</div>
									</div>
								</div>
							</div><br><br>

							A continuación, elabora tu <strong>storyboard</strong> y súbelo como evidencia.<br><br>
							<div class="col-12 text-center img_container">
								<img src="<?php echo $imagen . "?x=" . md5(time()); ?>" width="230" class="rounded mx-auto d-blocks img-thumbnail" id="image_profile">
							</div>
							<div class="col-12 text-center">
								<div class="col-3"></div>
								<div class="custom-file mb-3 mt-1 col-6">
									<label class="control-label text-dark-gray">Storyboard:</label>
									<input id="upload" name="upload" type="file" class="custom-file-input" onchange="readUpload(this);" <?php echo $_SESSION['enable_disable']; ?>>
									<label for="upload" class="custom-file-label">Seleccionar imagen</label>
								</div>
								<div class="col-3"></div>
							</div>

							<div class="form-row pb-1 pt-3">
								<div class="form-group col-2"></div>
								<div class="form-group col-8">
									<?php if ($_SESSION['tipo'] == "Alumn" AND isset($_SESSION["sesion2_4"]) AND $_SESSION["sesion2_4"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
									<label for="coments_asesor" class="control-label text-dark-gray">Comentarios del Administrador de JA México:</label>
									<textarea class="form-control rounded" name="coments_asesor" id="coments_asesor" rows="3" <?php if ($_SESSION['tipo'] != "Admin"){echo "disabled";} ?>></textarea>
								</div>
								<div class="form-group col-2"></div>
							</div>

							<?php if ($_SESSION['tipo'] == "Admin") {?>
							<div class="form-row pb-1">
								<div class="form-group col-2"></div>
								<div class="form-group col-8 text-center">
									<div class="checkbox checkbox-green">
										<input type="checkbox" class="custom-control-input" id="validacionAsesor" name="validacionAsesor" value="1" <?php if ($_SESSION['tipo'] != "Admin"){echo "disabled";} ?>>
										<label class="custom-control-label" for="validacionAsesor">Validación del Administrador de JA México. Estoy de acuerdo con la información ingresada. Ya no haré más comentarios.</label>
									</div>
								</div>
								<div class="form-group col-2"></div>
							</div>
							<?php } ?>

							<div class="row pb-1">
								<div class="col text-center">
									<?php if ($_SESSION['tipo'] == "Admin") {?>
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_nueva_idea" id="btn_nueva_idea" disabled>Registrar aprobacion / comentario</button>
									<?php } else if ($_SESSION['tipo'] == "Alumn") { ?>
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_nueva_idea" id="btn_nueva_idea" <?php echo $_SESSION['enable_disable']; ?>>Agregar 'Ideas'</button>
										<button type="button" class="btn btn-warning text-center px-5 my-2" name="limpiar" id="limpiar" onclick="location.reload()">Limpiar</button>
									<?php } ?>
								</div>
							</div>

						</form>

						<div class="border border-warning borde-info px-5 mb-3">
							<p class="text-justify pt-3">En pocas palabras…</p>
							<p class="text-justify">Design Thinking es una metodología que te ayudará a analizar con mayor detalle el problema que quieres resolver y las personas que consumirán tu producto, para verificar que estés creando un proyecto que sea atractivo y funcional para tus usuarios.</p>
							<p class="text-justify">Ya elaboraste los procesos de: empatía, definición e ideación, en la siguiente sesión vas a realizar un prototipo de tu idea y a validar si a tu público le pareció acertada o si debes realizar modificaciones.</p>
							<p class="text-center">¡Continúa aprendiendo!</p>
						</div>

						<div class="row">
							<div class="text-left col-6"><a href="<?php echo $uri_sola . '=3'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a></div>

							<div class="text-right col-6"><a href="<?php echo $uri_sola . '=5'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(25)" <?php } ?>>Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a></div>
						</div>
					</div>
				</div>
			</div>

			<script type="text/javascript">

				<?php if ($_SESSION['tipo'] == "Admin") {?>
					$(document).ready(function(){
						var parametros = {
							"seccion" : "2_4",
						};
						$.ajax({
							data:	parametros,
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
							"seccion" : "2_4",
						};
						$.ajax({
							data:	parametros,
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
							"seccion" : "2_4",
						};
						$.ajax({
							data:	parametros,
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
							data:	parametros,
							url: '../alumno/ajax/empresas_info_s2_4_data.php',
							type: 'post',
							success: function(data)
							{
								var array = JSON.parse(data);
								$("#idea1").html(array.idea1);
								$("#descripcion1").html(array.descripcion1);
								$("#idea2").html(array.idea2);
								$("#descripcion2").html(array.descripcion2);
								if (array.aprobado>0) {
									$('#aprobacion'+array.aprobado).attr('checked', 'checked');
									$('#idea1').prop('disabled', true);
									$('#descripcion1').prop('disabled', true);
									$('#idea2').prop('disabled', true);
									$('#descripcion2').prop('disabled', true);
								}

								$("#coments_asesor").html(array.coments_asesor);
								if (array.idea1 != "") {
									$("#action").val("update");
									$("#btn_nueva_idea").text("Actualizar 'Ideas'");
									if (array.aprobado>0) {
										$("#action").val("story");
										$("#btn_nueva_idea").text("Actualizar 'Storyboard'");
									}
								}
							}
						});
						<?php if ($con_imagen=="si") { ?>
							$(".img_container").addClass("zoom");
						<?php } else if ($con_imagen=="no"){ ?>
							$(".img_container").removeClass("zoom");
						<?php } ?>
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

						var error = document.getElementById('error');
				<?php
					for ($i = 0; $i <= sizeof($validaciones) - 1; $i++) {
						echo "var " . $validaciones[$i][1] . " = document.getElementById('" . $validaciones[$i][0] . "');";
						echo $validaciones[$i][1] . ".addEventListener('invalid', function(event){
							event.preventDefault();
							if (! event.target.validity.valid) {
								error.textContent	 = " . $validaciones[$i][2] . ";
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
						$('#btn_nueva_idea').prop('disabled', false);
						$('#aprobacion1').attr('checked', false);
						$('#aprobacion2').attr('checked', false);
						$('#validacionAsesor').prop('checked', false);
						$('#validacionAsesor').prop('disabled', false);
						$('#coments_asesor').prop('disabled', false);

						$.ajax({
							url: '../images/storyboards/'+Empresa_ID+'.jpg',
							success: function(data){
								$("#image_profile").attr("src","../images/storyboards/"+Empresa_ID+ ".jpg");
								$(".img_container").addClass("zoom");
								var img1 = document.getElementById('image_profile');
								img1.onerror = defaultImage;
							},
							error: function(data){
								$("#image_profile").attr("src","../images/storyboards/perfil.png");
								$(".img_container").removeClass("zoom");
							},
						})

						$.ajax({
							data:	parametros,
							url: '../alumno/ajax/empresas_info_s2_4_data.php',
							type: 'post',
							success: function(data)
							{
							var array = JSON.parse(data);
							$("#idea1").html(array.idea1);
							$("#descripcion1").html(array.descripcion1);
							$("#idea2").html(array.idea2);
							$("#descripcion2").html(array.descripcion2);
							$("#coments_asesor").html(array.coments_asesor);
							if (array.idea1 != "") {
									$("#action").val("update");
									<?php if ($_SESSION['tipo'] == "Admin") {?>
										$("#btn_nueva_idea").text("Actualizar comentario / Aprobar idea");
										if (Empresa_ID > 0) {
											$('#btn_nueva_idea').prop('disabled', false);
										}
									$('#aprobacion1').prop('disabled', false);
									$('#aprobacion2').prop('disabled', false);
								<?php } ?>
								} else {
									$("#action").val("new");
									$('#aprobacion1').prop('disabled', true);
									$('#aprobacion2').prop('disabled', true);
								}
								if (array.aprobado>0) {
									$('#idea1').prop('disabled', true);
									$('#descripcion1').prop('disabled', true);
									$('#idea2').prop('disabled', true);
									$('#descripcion2').prop('disabled', true);
									$('#aprobacion'+array.aprobado).attr('checked', 'checked');
									$('#aprobacion1').prop('disabled', true);
									$('#aprobacion2').prop('disabled', true);
									if (array.act_alumno == 0 && array.act_asesor == 0) {
										$('#validacionAsesor').prop('checked', true);
										$('#validacionAsesor').prop('disabled', true);
										$('#btn_nueva_idea').prop('disabled', true);
										$('#coments_asesor').prop('disabled', true);
									}
								}

								if (Empresa_ID == 0) {
									$('#btn_nueva_idea').prop('disabled', true);
								}
							}
						});
					}

					function defaultImage(e){
						e.target.src= "<?php echo $RAIZ_SITIO . "images/storyboards/perfil.png";?>";
						$(".img_container").removeClass("zoom");
					}
				<?php } ?>

			</script>