<?php
	if ($_SESSION["tipo"] == "Alumn") {
		$target_dir = $_SERVER['DOCUMENT_ROOT'] . $RAIZ_SITIO_nohttp . "images/carta_compromiso/";
		if (isset($_SESSION["Alumno_ID"])) {
			if (is_file($target_dir . $_SESSION["Alumno_ID"] . '.jpg')) {
				$imagen = $RAIZ_SITIO . "images/carta_compromiso/" . $_SESSION["Alumno_ID"] . '.jpg';
				$con_imagen = "si";
			} else {
				$imagen = $RAIZ_SITIO . "images/carta_compromiso/" . 'perfil.png';
				$con_imagen = "no";
			}
		} else {
			$imagen = $RAIZ_SITIO . "images/carta_compromiso/" . 'perfil.png';
			$con_imagen = "no";
		}
	} else {
		$imagen = $RAIZ_SITIO . "images/carta_compromiso/" . 'perfil.png';
		$con_imagen = "no";
	}
?>

			<div class="card shadow mb-1">
				<div class="card-header">
					Bienvenida
				</div>
				<div class="card-body px-5">
					<?php if ($_SESSION["tipo"] == "Sadmin" OR $_SESSION["tipo"] == "Admin") {?>
					<nav class="mx-5 my-3">
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active" id="nav-asesor-tab" data-toggle="tab" href="#nav-asesor" role="tab" aria-controls="nav-asesor" aria-selected="true">Bienvenida Asesor</a>
							<a class="nav-item nav-link" id="nav-alumno-tab" data-toggle="tab" href="#nav-alumno" role="tab" aria-controls="nav-alumno" aria-selected="false">Bienvenida Alumno</a>
						</div>
					</nav>
					<div class="tab-content mx-5 px-3 mb-5" id="nav-tabContent" >
						<div class="tab-pane fade show active" id="nav-asesor" role="tabpanel" aria-labelledby="nav-asesor-tab">
						<?php } ?>
							<?php if ($_SESSION["tipo"] == "Volun" OR $_SESSION["tipo"] == "Sadmin" OR $_SESSION["tipo"] == "Admin") {?>
							<h5 class="card-title">Estimado(a) Voluntario(a):</h5>
							<div class="card-text pl-2 pl-lg-5 pr-lg-5">
								<p class="text-justify">Bienvenida(o) al Programa Emprendedores y Empresarios, para JA México es importante contar con tu apoyo y participación en este programa, el cual tiene como objetivo desarrollar actitudes y aptitudes emprendedoras, así como habilidades empresariales a través de la creación de una empresa educativa durante 17 semanas.</p>
								<p class="text-justify">El tiempo que generosamente, invertirás como voluntaria(o), es sumamente valiosa y representa un ejemplo para las y los jóvenes con los que vas a convivir durante el desarrollo del programa. Como Asesor, podrás indicar y guiar acerca de cómo afrontar adecuadamente retos y riesgos que se presentarán durante el programa, además de motivar y guiar a  los alumnos a desarrollar habilidades y actitudes que son necesarias para la época en que estas viviendo.</p>
								<p class="text-justify">
									Emprendedores y Empresarios es un programa forma parte de la red de programas de JA México®, que trabaja desde 1974, inspirando a niños y jóvenes para que aprendan cómo funciona nuestra economía, qué influencia tiene en su vida diaria y cómo utilizarla para mejorar su calidad de vida, enseñando al mismo tiempo, los principios de la creación de las empresas como motor de desarrollo social y económico.<br><br>
									Los tres pilares de los programas JA México® son:
								</p><br>
								<div class="ml-1 ml-lg-4">
								<i class="fas fa-check fa-lg fa-fw text-pale-green"></i>Espíritu Emprendedor.<br><br>
								<i class="fas fa-check fa-lg fa-fw text-pale-green"></i>Educación Financiera.<br><br>
								<i class="fas fa-check fa-lg fa-fw text-pale-green"></i>Preparación para el trabajo.<br><br>
								</div>

								Durante el desarrollo del programa contarás con la presencia de un ejecutivo(a) de JA México quien estará para apoyarte en lo que requieras.<br><br>
								¡Gracias por tu apoyo y participación!<br><br>

							</div>
						<?php if ($_SESSION["tipo"] == "Sadmin" OR $_SESSION["tipo"] == "Admin") {?>
						</div>
						<div class="tab-pane fade mb-5" id="nav-alumno" role="tabpanel" aria-labelledby="nav-alumno-tab">
						<?php } ?>
							<?php }
							if ($_SESSION["tipo"] != "Volun") {?>
							<h5 class="card-title">¡Bienvenido Joven Emprendedor!</h5>
							<div class="card-text pl-2 pl-lg-5 pr-lg-5">
								<p class="text-justify">A partir de hoy comenzarás una aventura en la que tendrás la oportunidad de vivir la experiencia de ser un emprendedor. Te enfrentarás a los retos que conlleva la creación de tu propia empresa o de un proyecto social o productivo y también experimentarás la satisfacción de lo que representa el esfuerzo y tenacidad para lograr un propósito.</p>
								<p class="text-justify">Este ejercicio te permitirá desarrollar habilidades valoradas por las empresas líderes a nivel mundial como trabajo en equipo, toma de decisiones, comunicación, organización, puntualidad, inteligencia emocional, sociabilidad, adaptación, pensamiento crítico y creatividad, entre otras.</p>
								<p class="text-justify">El ejercicio lo realizarás a través de esta plataforma que incluye contenidos y actividades, así como documentos descargables para profundizar en cada tema.  Durante el proceso un asesor y la plataforma son tus principales aliados para construir un modelo de negocios que te será de utilidad para la creación de una empresa o proyecto.</p>
								<p class="text-justify">¿Listo para el desafío?</p>
								<p class="text-justify">Para verificar que estas listo, necesitamos conocer tu compromiso con este proyecto, descargando el formato <strong><i>E&ES0 - CARTA COMPROMISO ALUMNO</i></strong> <a href="../sesiones/docs/E&ES0 - CARTA COMPROMISO ALUMNO.docx" download><span class="badge badge-warning text-center px-3 py-2">AQUÍ</span></a>, llenarlo con tus datos, firmarlo y volverlo a subir a continuación, como imagen (¡tómale una foto!).</p>

								<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/registrar_0_1.php" method="post" class="mt-1" enctype="multipart/form-data">
									<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">

									<p class="text-justify">Realiza tu <strong>Carta Compromiso</strong> y súbela a continuación.</p>
									<div class="container py-2">
										<div class="row justify-content-md-center">
											<div class="col-md-auto px-5 text-center">
											<?php if ($_SESSION["tipo"]=="Alumn") {
											if (isset($_SESSION["carta_compromiso"]) AND $_SESSION["carta_compromiso"]==0) { ?>
												<h5><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><span class="badge badge-success px-3 py-3"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Sube tu carta y obtén <span class="text-yellow">10 estrellas</span></span></h5>
											<?php } else { ?>
												<h5><span class="badge badge-success px-3 py-3"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp;<span class="text-yellow">10 estrellas</span> obtenidas</span></h5>
											<?php }
											} else { ?>
												<h5><span class="badge badge-success px-3 py-3"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Subir la carta compromiso otorga <span class="text-yellow">10 estrellas</span> de manera individual</span></h5>
											<?php } ?>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-12 text-center img_container">
											<img src="<?php echo $imagen . "?x=" . md5(time()); ?>" width="230" class="rounded mx-auto d-blocks img-thumbnail" id="image_profile">
										</div>
									</div>
									<div class="row text-center">
										<div class="custom-file mb-3 mt-1 col-12 offset-lg-2 col-lg-8">
											<input id="upload" name="upload" type="file" class="custom-file-input" <?php echo $_SESSION['enable_disable']; ?> accept="image/jpeg, image/png, image/gif, image/pjpeg" onChange='LimitAttach(this);' >
											<label for="upload" class="custom-file-label">Seleccionar imagen</label>
										</div>
									</div>

									<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto mb-2"></div></div>

									<div class="row pb-1">
										<div class="col text-center">
											<?php if ($_SESSION['tipo'] == "Alumn") { ?>
												<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_carta" id="btn_carta" disabled>Subir 'Carta Compromiso'</button>
											<?php } ?>
										</div>
									</div>
								</form>
								<p class="text-justify">A continuación, el Director General de la Empresa Juvenil debe registrar a los demás integrantes de su equipo.</p>
							</div>
							<?php } ?>
						<?php if ($_SESSION["tipo"] == "Sadmin" OR $_SESSION["tipo"] == "Admin") {?>
						</div>
					</div>
					<?php } ?>
					<div class="text-right"><a href="<?php echo $uri_sola . '=1'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(1)" <?php } ?>>Siguiente <i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a></div>

				</div>
			</div>

			<?php if ($_SESSION['tipo'] == "Alumn") { ?>
			<script type="text/javascript">
				$(document).ready(function(){
					<?php if ($con_imagen=="si") { ?>
						$(".img_container").addClass("zoom");
					<?php } else if ($con_imagen=="no"){ ?>
						$(".img_container").removeClass("zoom");
					<?php } ?>
				});

				function LimitAttach(tField) {
					file = tField.value;
					extArray = new Array(".gif",".jpg",".png");
					allowSubmit = false;
					if (!file) return;
					while (file.indexOf("\\") != -1) file = file.slice(file.indexOf("\\") + 1);
					ext = file.slice(file.indexOf(".")).toLowerCase();
					for (var i = 0; i < extArray.length; i++) {
						if (extArray[i] == ext) {
							allowSubmit = true;
							break;
							}
					}
					var error = document.getElementById('error');
					if (allowSubmit) {
						error.style.display = 'none';
						error.classList.remove('animated');
						error.classList.remove('shake');
						readUpload(tField);
					} else {
						tField.value="";
						error.textContent = "Sólo puedes subir archivos tipo " + (extArray.join(" ")) + "\nPor favor inténtalo de nuevo.";
						error.style.display = 'block';
						error.classList.add('animated');
						error.classList.add('shake');
					}
				}

				function readUpload(input) {
					if (input.files && input.files[0]) {
						var reader = new FileReader();
						reader.onload = function (e) {
							$('#image_profile').attr('src', e.target.result);
							$('#btn_carta').attr('disabled', false);
						};
						reader.readAsDataURL(input.files[0]);
					}
				}

				function siguiente_seccion(num){
					var parametros = {
						"num" : num,
						"id" : <?php echo $_SESSION["Alumno_ID"]; ?>
					};

					$.ajax({
					  data:  parametros,
					  url: '../alumno/ajax/siguiente.php',
					  type: 'post',
					  success: function(data)
					  {
					  }
					});
				}

			</script>
			<?php } ?>