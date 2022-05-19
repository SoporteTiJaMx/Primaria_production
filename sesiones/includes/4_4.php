<?php
if ($_SESSION["tipo"]=="Alumn") {
	$ID_alumno = $_SESSION["Alumno_ID"];
	$nombre_alumno = $_SESSION["nombre"];

	$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/cvs/";

	if (is_file($target_dir . "CV_" . $ID_alumno . "_" . $nombre_alumno . ".pdf")) {
		$_SESSION["cv_alumno"] = 1;
	} else {
		$_SESSION["cv_alumno"] = 0;
	}
}
?>
			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 4 <i class="fas fa-angle-right fa-lg fa-fw"></i> Selección de Roles <i class="fas fa-angle-right fa-lg fa-fw"></i> Procesos de Selección
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">¿Qué es un Proceso de Selección?</h5>
					<div class="card-text px-5">
						<br>
						<div class="card mb-0 bg-success border-success px-3 py-3 mb-3">
							<p class="text-justify text-white">El proceso de selección laboral consiste en <b>identificar</b> un conjunto de personas que pueden ser <b>candidatos</b> a ocupar un puesto dentro de una empresa u organización. Basándose en las <b>necesidades de la organización</b> se establece el perfil que debe cumplir la persona <b>seleccionada</b> para el cargo.</p>
						</div>
						<br>
						<div>
							<p class="tex-justify">A continuación, te compartimos una infografía con los pasos clave a seguir.</p>
						</div>
						<br>
						<div class="row justify-content-center">
							<div class="d-none col-lg-2"></div>
							<div class="col-12 col-lg-8">
								<img src="../sesiones/images/4.4_proceso_seleccion.png" alt="Organigrama de Empresa" class="img-fluid">
							</div>
							<div class="d-none col-lg-2"></div>
						</div>
						<br>
						<div>
							<p class="text-justify">Como puedes observar, una de las herramientas más importantes para presentarte a solicitar un empleo es el <strong>Currículum Vitae (CV)</strong>. En este documento debes colocar la información más importante sobre ti y tu perfil profesional. <a href="../sesiones/docs/E&ES4 - 4.4 CURRICULUM VITAE.pdf" download><span class="badge badge-warning text-center px-3 py-2">AQUÍ</span></a> te  dejamos unos tips y sugerencias de como armar tu CV.</p>
							<p class="text-justify"><b>¡Es tu momento!</b> Sube aquí tu CV. Recuerda que durante su sesión con tu asesor(a), harán una pequeña simulación de entrevista para que, entre todos, elijan a los mejores candidatos para cubrir cada área de su empresa.</p>
						</div>
						<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/registrar_4_4.php" method="post" class="mt-1" enctype="multipart/form-data">
							<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
							<input name="Empresa_ID" type="hidden" id="Empresa_ID" value="<?php if ($_SESSION['tipo'] == "Alumn") { echo $_SESSION['Empresa_ID']; } else { echo ""; } ?>">

							A continuación, sube tu <strong>CV</strong> en formato PDF.<br><br>

							<?php if ($_SESSION['tipo'] != "Alumn") { ?>
								<div class="text-orange text-center pb-3 pl-5 pr-5">NOTA PARA <b>ASESORES Y COORDINADORES</b>. Los currículos de cada uno de los jóvenes empresarios, así como el resumen de información de esta sesión, los podrán revisar en la sección de <b>Revisión</b>, sólo accesible para ustedes.</div>
							<?php } ?>

							<div class="container py-2">
								<div class="row justify-content-md-center">
									<div class="col-md-auto px-5 text-center">
									<?php if ($_SESSION["tipo"]=="Alumn") {
									if (isset($_SESSION["cv_alumno"]) AND $_SESSION["cv_alumno"]==0) { ?>
										<h5><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><span class="badge badge-success px-3 py-3"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Sube tu CV y obtén <span class="text-yellow">20 estrellas</span> en lo individual</span></h5>
									<?php } else { ?>
										<h5><span class="badge badge-success px-3 py-3"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp;<span class="text-yellow">20 estrellas</span> obtenidas</span></h5>
									<?php }
									} else { ?>
										<h5><span class="badge badge-success px-3 py-3"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Subir su CV otorga <span class="text-yellow">20 estrellas</span> de manera individual</span></h5>
									<?php } ?>
									</div>
								</div>
							</div>

							<div class="col-12 text-center">
								<div class="col-3"></div>
								<div class="custom-file mb-3 mt-1 col-6">
									<input id="upload" name="upload" type="file" class="custom-file-input" accept="application/pdf" <?php echo $_SESSION['enable_disable']; ?> onchange="validar_pdf(this);">
									<label for="upload" class="custom-file-label">Seleccionar documento (sólo PDF)</label>
								</div>
								<div class="col-3"></div>
							</div>

							<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto">El archivo debe ser en formato PDF</div></div>

							<?php if ($_SESSION['tipo'] == "Alumn") { ?>
							<div class="col-12 text-center" id="CV_subido">
								<div class="col-1"></div>
								<div class="custom-file my-1 col-10" id="CV_link"></div>
								<div class="col-1"></div>
							</div>
							<?php } ?>

							<div class="row pb-1">
								<div class="col text-center">
									<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_subir_cv" id="btn_subir_cv" disabled>Subir 'CV'</button>
								</div>
							</div>
						</form>

						<div class="border border-warning borde-info px-5 mt-2 mb-3">
							<p class="text-justify pt-3">Para su empresa tendrán la siguiente distribución:</p>
							<p class="text-justify"><li>Únicamente 5 puestos Directivos, es decir, sólo un director(a) por área.</li></p>
							<p class="text-justify"><li>El resto de los integrantes del equipo fungirán como gerentes de área (puede haber de 2 a 3 gerentes por área).</li></p>
							<p class="text-center">TODO EL EQUIPO ES IMPORTANTE Y TENDRÁN SUS RESPONSABILIDADES, ASÍ QUE TODOS DEBEN DAR SU MÁXIMO ESFUERZO.</p>
							<p class="text-center">¡ÉXITO EN TU EMPRESA!</p>
						</div>

						<div class="row">
							<div class="text-left col-6">
								<a href="<?php echo $uri_sola . '=2'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a>
							</div>
							<div class="text-right col-6">
								<a href="<?php echo $uri_sola . '=4'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(44)" <?php } ?>>Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				<?php if ($_SESSION['tipo'] == "Alumn") { ?>
					$(document).ready(function(){
					    $.ajax({
					      url: '../scripts/alumno/ver_cv.php',
					      success: function(data)
					      {
					      	$("#CV_link").html(data);
					      	$("#btn_subir_cv").text("Actualizar 'Currículo' (sólo PDF)");
					      }
					    });
					});

					$(".custom-file-input").on("change", function() {
						var fileName = $(this).val().split("\\").pop();
						$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
					});

					function validar_pdf(){
						var archivo = $("#upload").val();
						var extension = archivo.substring(archivo.lastIndexOf("."));
						if(extension != ".pdf"){
						    $('#btn_subir_cv').prop('disabled', true);
						    $('#error').show();
						} else {
						    $('#btn_subir_cv').prop('disabled', false);
						    $('#error').hide();
						}
					}
				<?php } ?>
			</script>