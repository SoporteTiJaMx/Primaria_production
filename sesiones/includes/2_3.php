
<?php
	$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/mapas_trayectoria/";
	if (isset($_SESSION["Empresa_ID"])) {
		if (is_file($target_dir . $_SESSION["Empresa_ID"] . '.jpg')) {
			$imagen = $RAIZ_SITIO . "images/mapas_trayectoria/" . $_SESSION["Empresa_ID"] . '.jpg';
			$con_imagen = "si";
		} else {
			$imagen = $RAIZ_SITIO . "images/mapas_trayectoria/" . 'perfil.png';
			$con_imagen = "no";
		}
	} else {
		$imagen = $RAIZ_SITIO . "images/mapas_trayectoria/" . 'perfil.png';
		$con_imagen = "no";
	}
?>

			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 2 <i class="fas fa-angle-right fa-lg fa-fw"></i> El arte de crear I <i class="fas fa-angle-right fa-lg fa-fw"></i> Definición
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Definir: Mapa de trayectoria y Point of View</h5>
					<div class="card-text px-5">
						<p class="text-justify">Una vez que conseguiste tener un mayor conocimiento de tu usuario con el Mapa de empatía, la siguiente etapa del proceso de ideación consiste en definir el problema para crear la solución correcta. Si no tenemos claro qué queremos resolver y para qué queremos hacerlo, nuestro producto no partirá de una necesidad real.</p>
						<p class="text-justify">Si aún no descargas el material descriptivo de "Definir" para trabajar esta sección, hazlo <a href="../sesiones/docs/E&ES2 - 2.1.2 DEFINIR.pdf" download><span class="badge badge-warning text-center px-3 py-2">AQUÍ</span></a>.</p>
						<p class="text-justify">Para que trabajes el "Point o View" con tus compañeros, <a href="../sesiones/docs/2.1.2_Point_of_view.png" download><span class="badge badge-warning text-center px-3 py-2">AQUÍ</span></a> puedes descargarlo vacío. No olvides subirlo en esta sección cuando terminen, para que lo revise tu Asesor.</p>
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

						<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/registrar_2_3.php" method="post" class="mt-1" enctype="multipart/form-data">
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
							<br>
							<?php } ?>

							<p class="text-justify">Elabora tu <strong>Mapa de Trayectoria</strong> y súbelo como evidencia.</p>
							<div class="col-12 text-center img_container">
								<img src="<?php echo $imagen . "?x=" . md5(time()); ?>" width="230" class="rounded mx-auto d-blocks img-thumbnail" id="image_profile">
							</div>
							<div class="col-12 text-center mb-3">
								<div class="col-2"></div>
								<div class="custom-file mb-3 mt-1 col-8">
									<label class="control-label text-dark-gray">Mapa de Trayectoria:</label>
									<input id="upload" name="upload" type="file" class="custom-file-input" onchange="readUpload(this);" <?php echo $_SESSION['enable_disable']; ?>>
									<label for="upload" class="custom-file-label">Seleccionar imagen</label>
								</div>
								<div class="col-2"></div>
							</div>

							<p class="text-justify">Ingresa aquí el <strong>Point of View</strong> definido:</p>
							<div class="card px-3 py-2">
								<div class="form-row pb-1">
									<div class="form-group col-4">
										<label for="usuario" class="control-label text-dark-gray">Usuario:</label>
										<textarea class="form-control rounded" name="usuario" id="usuario" rows="2" <?php echo $_SESSION['enable_disable']; ?> required></textarea>
										<small id="usuario_help" class="form-text text-dark-gray w200">Nombre / Descripción del usuario.</small>
									</div>
									<?php $validaciones[] = array('usuario', 'usuario_input', "'Error en Usuario. Favor de corregir.'"); ?>
									<div class="form-group col-4">
										<label for="necesidad" class="control-label text-dark-gray">Necesidad:</label>
										<textarea class="form-control rounded" name="necesidad" id="necesidad" rows="2" <?php echo $_SESSION['enable_disable']; ?> required></textarea>
										<small id="necesidad_help" class="form-text text-dark-gray w200">Deseo o necesidad del usuario.</small>
									</div>
									<?php $validaciones[] = array('necesidad', 'necesidad_input', "'Error en Necesidad. Favor de corregir.'"); ?>
									<div class="form-group col-4">
										<label for="percepcion" class="control-label text-dark-gray">Porque:</label>
										<textarea class="form-control rounded" name="percepcion" id="percepcion" rows="2" <?php echo $_SESSION['enable_disable']; ?> required></textarea>
										<small id="percepcion_help" class="form-text text-dark-gray w200">Porque tiene el deseo o necesidad (insights).</small>
									</div>
									<?php $validaciones[] = array('percepcion', 'percepcion_input', "'Error en Percepcion. Favor de corregir.'"); ?>
								</div>
							</div>
							<br>

							<div class="form-row pb-1">
								<div class="form-group col-2"></div>
								<div class="form-group col-8">
									<?php if ($_SESSION['tipo'] == "Alumn" AND isset($_SESSION["sesion2_3"]) AND $_SESSION["sesion2_3"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
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
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_nuevo_point" id="btn_nuevo_point" disabled>Registrar comentario</button>
									<?php } else if ($_SESSION['tipo'] == "Alumn") { ?>
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_nuevo_point" id="btn_nuevo_point" <?php echo $_SESSION['enable_disable']; ?>>Agregar 'Point of View'</button>
										<button type="button" class="btn btn-warning text-center px-5 my-2" name="limpiar" id="limpiar" onclick="location.reload()">Limpiar</button>
									<?php } ?>
								</div>
							</div>

						</form>

						<div class="row">
							<div class="text-left col-6"><a href="<?php echo $uri_sola . '=2'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a></div>

							<div class="text-right col-6"><a href="<?php echo $uri_sola . '=4'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(24)" <?php } ?>>Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a></div>
						</div>
					</div>
				</div>
			</div>

			<script type="text/javascript">

				<?php if ($_SESSION['tipo'] == "Admin") {?>
					$(document).ready(function(){
						var parametros = {
							"seccion" : "2_3",
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
							"seccion" : "2_3",
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
							"seccion" : "2_3",
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
						  url: '../alumno/ajax/empresas_info_s2_3_data.php',
						  type: 'post',
						  success: function(data)
						  {
							var array = JSON.parse(data);
							$("#usuario").html(array.usuario);
							$("#necesidad").html(array.necesidad);
							$("#percepcion").html(array.percepcion);
							$("#coments_asesor").html(array.coments_asesor);
							if (array.usuario != "") {
								$("#action").val("update");
								$("#btn_nuevo_point").text("Actualizar 'Point of View'");
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
						$('#btn_nuevo_point').prop('disabled', false);

						$.ajax({
							url: '../images/mapas_trayectoria/'+Empresa_ID+'.jpg',
							success: function(data){
								$("#image_profile").attr("src","../images/mapas_trayectoria/"+Empresa_ID+ ".jpg");
								$(".img_container").addClass("zoom");
								var img1 = document.getElementById('image_profile');
								img1.onerror = defaultImage;
							},
							error: function(data){
								$("#image_profile").attr("src","../images/mapas_trayectoria/perfil.png");
								$(".img_container").removeClass("zoom");
							},
						})

						$.ajax({
						  data:  parametros,
						  url: '../alumno/ajax/empresas_info_s2_3_data.php',
						  type: 'post',
						  success: function(data)
						  {
							var array = JSON.parse(data);
							$("#usuario").html(array.usuario);
							$("#necesidad").html(array.necesidad);
							$("#percepcion").html(array.percepcion);
							$("#coments_asesor").html(array.coments_asesor);
							if (array.usuario != "") {
								$("#action").val("update");
								<?php if ($_SESSION['tipo'] == "Volun") {?>
									$("#btn_nuevo_point").text("Actualizar comentario");
									if (Empresa_ID > 0) {
										$('#btn_nuevo_point').prop('disabled', false);
									}
								<?php } ?>
							} else {
								$("#action").val("new");
							}

							if (Empresa_ID == 0) {
								$('#btn_nuevo_point').prop('disabled', true);
							}
						  }
						});
					}

					function defaultImage(e){
						e.target.src= "<?php echo $RAIZ_SITIO . "images/mapas_trayectoria/perfil.png";?>";
						$(".img_container").removeClass("zoom");
					}
				<?php } ?>

			</script>