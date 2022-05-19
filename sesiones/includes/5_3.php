			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 5 <i class="fas fa-angle-right fa-lg fa-fw"></i> La Identidad Empresarial <i class="fas fa-angle-right fa-lg fa-fw"></i> Identificadores de la Empresa
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">La Misión y Visión</h5>
					<div class="card-text px-5">
						<p class="text-justify">Una vez que tengamos el nombre de nuestra empresa o una idea de él, nos enfocaremos a trabajar en la parte ideológica. Esta parte representa la <b><i>"forma de pensar"</i></b> de la Empresa, es decir, aquello que identifica al equipo y que expresa por qué existe; independientemente de los productos, el mercado, la innovación, la producción, etcétera. Para ello es importante definir la misión y visión de nuestra empresa. Conoce de qué se trata.</p>
						<p class="text-justify">Coloca tu cursor encima de la imagen para ver la descripción de cada concepto:</p>
						<div class="row justify-content-center">
							<div class="d-none col-lg-3"></div>
							<div class="col-12 col-lg-6">
								<img src="../sesiones/images/5.3.1_mision_vision.png" alt="mision_vision" usemap="#mision-vision-map" class="map img-fluid">
							</div>
							<div class="d-none col-lg-3"></div>
						</div>
						<map name="mision-vision-map">
							<area shape="rect" data-html="true" title="<br><b>Misión</b><br><br>Resume la <i>Razón de Ser</i> de la Empresa y el concepto o conceptos clave identificados, pero de una manera más amplia. <br><b>La MISIÓN responde al ¿QUÉ?</b><br><br>" coords="360,120,1030,295" data-maphilight='{"stroke":false,"fillColor":"000000","fillOpacity":0.6}' data-toggle='tooltip' data-placement='right'/>
							<area shape="rect" data-html="true" title="<br><b>Visión</b><br><br>Se refiere a una imagen que se plantea para el largo plazo, sobre cómo se espera que sea el futuro de la Empresa, es una expectativa ideal, lo que creemos que va a pasar cuando la misión se haya cumplido. <br><b>La VISIÓN responde al ¿PARA QUÉ?</b><br><br>" coords="410,440,1080,615" data-maphilight='{"stroke":false,"fillColor":"000000","fillOpacity":0.6}' data-toggle='tooltip' data-placement='right'/>
						</map>
						<br>
						<p class="text-justify">A continuación, encontrarás algunos tips y ejemplos para elaborar su misión y visión. Todo el equipo debe colaborar y llegar a los mismos acuerdos.</p>
						<br>
						<div class="row justify-content-center">
							<div class="d-none col-lg-1"></div>
							<div class="col-12 col-lg-10">
								<img src="../sesiones/images/5.3.2_mision_vision_tips.png" alt="mision_vision_tips"class="img-fluid">
							</div>
							<div class="d-none col-lg-1"></div>
						</div>
					</div>
					<h5 class="card-title">Los Valores de la Empresa</h5>
					<div class="card-text px-5">
						<p class="text-justify">Una vez que establecimos la misión y visión de nuestra Empresa, debemos dar paso a seleccionar los valores que regirán todas las actividades de la misma.</p>
						<p class="text-justify">Estos valores son creencias y principios fundamentales que ayudan a preferir y elegir unas cosas en lugar de otras o a comportarse de una manera u otra. En una Empresa <b>los valores reflejan los intereses, sentimientos y convicciones más importantes</b>. La discusión e integración de valores <b>de manera colectiva</b> dan la pauta para generar códigos de convivencia, reglas claras de comportamiento dentro de la Empresa, además de que sirven como referencia para formular algunas metas.</p>
						<p class="text-justify">Los Valores de una Empresa tienen, sobre todo, dos funciones principales:</p>
						<br>
						<div class="row justify-content-center">
							<div class="d-none col-lg-3"></div>
							<div class="col-12 col-lg-6">
								<img src="../sesiones/images/5.3.3_valores.png" alt="valores"class="img-fluid">
							</div>
							<div class="d-none col-lg-3"></div>
						</div>
						<br><br>
						<p class="text-justify">En equipo, realicen una lluvia de ideas para ir construyendo su misión, visión y definición de valores. Al finalizar esta sesión podrán subir sus ideas finales a esta plataforma. Te sugerimos utilizar herramientas digitales como <a href="https://stormboard.com/" target="_blank"><b>Stormboard</b></a> o <a href="https://edu.google.com/intl/es-419/products/jamboard/" target="_blank"><b>Jamboard</b></a> de Google.</p>
						<br><br>
						<div class="row">
							<div class="text-left col-6">
								<a href="<?php echo $uri_sola . '=1'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a>
							</div>
							<div class="text-right col-6">
								<a href="<?php echo $uri_sola . '=3'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(53)" <?php } ?>>Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a>
							</div>
						</div>
					</div>

				</div>
			</div>

			<script type="text/javascript">
				$(function() {
					$('.map').maphilight();
				});

				function findSizes(el, src) {
					if (!el || !src) {
						return false;
					} else {
						var wGCS = window.getComputedStyle,
							pI = parseInt,
							dimensions = {};
						dimensions.actualWidth = pI(wGCS(el, null).width.replace('px', ''), 10);
						var newImg = document.createElement('img');
						newImg.src = src;
						newImg.style.position = 'absolute';
						newImg.style.left = '-10000px';
						document.body.appendChild(newImg);
						dimensions.originalWidth = newImg.width;
						document.body.removeChild(newImg);
						return dimensions;
					}
				}

				function remap(imgElem) {
					if (!imgElem) {
						return false;
					} else {
						var mapName = imgElem
							.getAttribute('usemap')
							.substring(1),
							map = document.getElementsByName(mapName)[0],
							areas = map.getElementsByTagName('area'),
							imgSrc = imgElem.src,
							sizes = findSizes(imgElem, imgSrc),
							currentWidth = sizes.actualWidth,
							originalWidth = sizes.originalWidth,
							multiplier = currentWidth / originalWidth,
							newCoords;

						for (var i = 0, len = areas.length; i < len; i++) {
							newCoords = areas[i]
								.getAttribute('coords')
								.replace(/(\d+)/g,function(a){
									return Math.round(a * multiplier);
								});
							areas[i].setAttribute('coords',newCoords);
						}
					}
				}

				var imgElement = document.getElementsByClassName('map')[0];
				remap(imgElement);

				window.onload = function() {
					if(!window.location.hash) {
						window.location = window.location + '#loaded';
						window.location.reload();
					}
				}

				$(window).on("resize", function(event){
					document.location.reload(true);
				});


				$(document).ready(function(){
					$('[data-toggle="tooltip"]').tooltip();
					$('map').tooltip({ boundary: 'scrollParent', container: 'img' })
				});

			</script>