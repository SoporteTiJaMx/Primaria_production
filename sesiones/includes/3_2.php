<?php
	$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/prototipos/";
	if (isset($_SESSION["Empresa_ID"])) {
		if (is_file($target_dir . $_SESSION["Empresa_ID"] . '.jpg')) {
			$imagen = $RAIZ_SITIO . "images/prototipos/" . $_SESSION["Empresa_ID"] . '.jpg';
			$con_imagen = "si";
		} else {
			$imagen = $RAIZ_SITIO . "images/prototipos/" . 'perfil.png';
			$con_imagen = "no";
		}
	} else {
		$imagen = $RAIZ_SITIO . "images/prototipos/" . 'perfil.png';
		$con_imagen = "no";
	}
?>
			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 3 <i class="fas fa-angle-right fa-lg fa-fw"></i> El arte de crear II <i class="fas fa-angle-right fa-lg fa-fw"></i> Prototipar
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Prototipar</h5>
					<div class="card-text px-5">
						<br>
						<p class="text-justify">Para poder verificar si a tus clientes les gustará el producto que vas a realizar, es muy importante que realices un prototipo de tu producto, es decir, un modelo preliminar de cómo quedará el producto. No te preocupes, no tiene que ser exactamente con los materiales que utilizarías para elaborar el producto final, la clave de esta etapa del proceso es “Prototipar rápido y barato”. Aquí te dejo dos videos donde podrás observar algunos ejemplos:</p>
						<ul>
							<li><a href="https://youtu.be/an8H3f73-_I" target="_blank">Ver video de ejemplo 1</a></li>
							<li><a href="https://youtu.be/ICnDhZIWFow" target="_blank">ver video de ejemplo 2</a></li>
						</ul>
						<p class="text-justify">Si aún no descargas el material descriptivo de "Prototipar" para trabajar esta sección, hazlo <a href="../sesiones/docs/E&ES2 - 2.1.4 PROTOTIPAR.pdf" download><span class="badge badge-warning text-center px-3 py-2">AQUÍ</span></a></p>

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

						<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/registrar_3_2.php" method="post" class="mt-1" enctype="multipart/form-data">
							<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
							<input name="Empresa_ID" type="hidden" id="Empresa_ID" value="<?php if ($_SESSION['tipo'] == "Alumn") { echo $_SESSION['Empresa_ID']; } else { echo ""; } ?>">
							<?php if ($_SESSION['tipo'] == "Volun" OR $_SESSION['tipo'] == "Alumn") {?>
							<input name="ind_datos" type="hidden" id="ind_datos" value=0>
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

							A continuación, sube una fotografía de tu <strong>prototipo</strong><br><br>
							<div class="col-12 text-center img_container">
								<img src="<?php echo $imagen . "?x=" . md5(time()); ?>" width="230" class="rounded mx-auto d-blocks img-thumbnail" id="image_profile">
							</div>
							<div class="col-12 text-center">
								<div class="col-3"></div>
								<div class="custom-file mb-3 mt-1 col-6">
									<label class="control-label text-dark-gray">Prototipo:</label>
									<input id="upload" name="upload" type="file" class="custom-file-input" onchange="readUpload(this);" <?php echo $_SESSION['enable_disable']; ?>>
									<label for="upload" class="custom-file-label">Seleccionar imagen</label>
								</div>
								<div class="col-3"></div>
							</div>

							<div class="form-row pb-1">
								<div class="form-group col-2"></div>
								<div class="form-group col-8">
									<?php if ($_SESSION['tipo'] == "Alumn" AND isset($_SESSION["sesion3_2"]) AND $_SESSION["sesion3_2"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
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
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_nuevo_prototipo" id="btn_nuevo_prototipo" disabled>Registrar comentario</button>
									<?php } else if ($_SESSION['tipo'] == "Alumn") { ?>
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_nuevo_prototipo" id="btn_nuevo_prototipo" disabled>Agregar 'Prototipo'</button>
									<?php } ?>
								</div>
							</div>
						</form>

						<div class="row">
							<div class="text-left col-6"><a href="<?php echo $uri_sola . '=0'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a></div>

							<div class="text-right col-6"><a href="<?php echo $uri_sola . '=2'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(32)" <?php } ?>>Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a></div>
						</div>
					</div>
				</div>
			</div>

			<script type="text/javascript">

				<?php if ($_SESSION['tipo'] == "Admin") {?>
					$(document).ready(function(){
						var parametros = {
							"seccion" : "3_2",
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
							"seccion" : "3_2",
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
							"seccion" : "3_2",
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
						  url: '../alumno/ajax/empresas_info_s3_2_data.php',
						  type: 'post',
						  success: function(data)
						  {
							var array = JSON.parse(data);
							$("#coments_asesor").html(array.coments_asesor);
							$("#ind_datos").val(array.ind_datos);
							if (array.coments_asesor != "") {
								$("#btn_nuevo_prototipo").text("Actualizar 'Prototipo'");
							}
							if (array.ind_datos == 1) {
								$("#action").val("update");
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
								$('#btn_nuevo_prototipo').prop('disabled', false);
							};
							reader.readAsDataURL(input.files[0]);
						}
					}
				<?php }

				if ($_SESSION['tipo'] != "Alumn") { ?>
					function filtro_empresa(){
						var Empresa_ID = document.getElementById("select_empresa").value;
						var parametros = {
							"Empresa_ID" : Empresa_ID,
						};
						var ind_imagen;
						var ind_coment;
						$("#Empresa_ID").val(Empresa_ID);
						$('#btn_nuevo_prototipo').prop('disabled', false);

						$.ajax({
							url: '../images/prototipos/'+Empresa_ID+'.jpg',
							success: function(data){
								$("#image_profile").attr("src","../images/prototipos/"+Empresa_ID+ ".jpg");
								$(".img_container").addClass("zoom");
								ind_imagen = 1;
								var img1 = document.getElementById('image_profile');
								img1.onerror = defaultImage;
							},
							error: function(data){
								$("#image_profile").attr("src","../images/prototipos/perfil.png");
								$(".img_container").removeClass("zoom");
								ind_imagen = 2;
							},
						})

						function defaultImage(e){
							e.target.src= "<?php echo $RAIZ_SITIO . "images/prototipos/perfil.png";?>";
							$(".img_container").removeClass("zoom");
							ind_imagen = 0;
						}

						$.ajax({
						  data:  parametros,
						  url: '../alumno/ajax/empresas_info_s3_2_data.php',
						  type: 'post',
						  success: function(data)
						  {
							var array = JSON.parse(data);
							$("#coments_asesor").html(array.coments_asesor);
							$("#ind_datos").val(array.ind_datos);
							if (array.coments_asesor != "") {
								<?php if ($_SESSION['tipo'] == "Volun") {?>
									$("#btn_nuevo_prototipo").text("Actualizar comentario");
									if (Empresa_ID > 0) {
										$('#btn_nuevo_prototipo').prop('disabled', false);
									}
								<?php } ?>
							}
							if (array.ind_datos == 1) {
								$("#action").val("update");
							} else {
								$("#action").val("new");
							}

							if (Empresa_ID == 0) {
								$('#btn_nuevo_prototipo').prop('disabled', true);
							}
						  }
						});
					}


				<?php } ?>

			</script>