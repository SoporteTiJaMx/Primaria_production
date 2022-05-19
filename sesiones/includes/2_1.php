			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 2 <i class="fas fa-angle-right fa-lg fa-fw"></i> El arte de crear I <i class="fas fa-angle-right fa-lg fa-fw"></i> Design Thinking
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">¿Qué es Design Thinking?</h5>
					<div class="card-text px-5">
						<br>
						<p class="text-justify"><strong>Design Thinking</strong> es un método para generar ideas innovadoras que centra su eficacia en entender y dar solución a las necesidades reales de los clientes. Proviene de la forma en la que <strong>trabajan los diseñadores de producto. El propósito de esta herramienta es analizar</strong> un problema con pensamiento de diseño para buscar solución óptima, nos ayuda a tener estructura mental.</p>
						<p class="text-justify">Con Design Thinking, pueden “descomponer” un problema o proyecto, el cual se divide en partes más pequeñas, se analizan, se piensa sin límites, todo lo que podamos y todo lo que se nos ocurra, de manera empática y junto a otros miembros del equipo.</p>
						<p class="text-justify">La metodología Design Thinking tiene su origen como tantas otras cosas relacionadas con la innovación, en la Universidad de Stanford de California (<a href="http://www.stanford.edu">www.stanford.edu</a>). Los expertos en este tipo de metodologías se enfocan en “rediseño de experiencias”, más que en “rediseño del producto” como tal. Veamos aquí un ejemplo: <a href="https://www.ted.com/talks/david_kelley_how_to_build_your_creative_confidence" target="_blank">ver video</a></p>
						<p class="text-justify">Descarga los contenidos <strong><i>E&ES2 - 2. Design Thinking</i></strong> <a href="../sesiones/docs/E&ES2 - 2. DESIGN THINKING.pdf" download><span class="badge badge-warning text-center px-3 py-2">AQUÍ</span></a> para reforzar tus conocimientos en el tema y en equipo realiza las actividades marcadas en cada una de las etapas (da click en cada sección de la imagen inferior, y descargarás el material específico de esa etapa). Una vez que termines cada etapa uno de los integrantes deberá subir la información a la plataforma.</p><br>
						<div class="row justify-content-center">
							<div class="col-2"></div>
							<div class="col-8">
								<img src='../sesiones/images/2.2_Design_Thinking.png' alt='Design Thinking' usemap="#design-thinking-map" class="map img-fluid" id='Design_Thinking'>
							</div>
							<div class="col-2"></div>
						</div><br><br>
						<map name="design-thinking-map">
							<area shape="poly" title="Da click para descargar el material 'E&ES2 - 2.1.1 EMPATIZAR'" coords="6,190,194,90,194,284" data-maphilight='{"stroke":false,"fillColor":"000000","fillOpacity":0.6}' data-toggle='tooltip' data-placement='right' href="../sesiones/docs/E&ES2 - 2.1.1 EMPATIZAR.pdf" download />
							<area shape="poly" title="Da click para descargar el material 'E&ES2 - 2.1.2 DEFINIR'" coords="203,90,390,144,390,230,203,283" data-maphilight='{"stroke":false,"fillColor":"000000","fillOpacity":0.6}' data-toggle='tooltip' data-placement='right' href="../sesiones/docs/E&ES2 - 2.1.2 DEFINIR.pdf" download />
							<area shape="poly" title="Da click para descargar el material 'E&ES2 - 2.1.3 IDEAR - BRAINSTORM'" coords="398,144,586,90,586,283,398,230" data-maphilight='{"stroke":false,"fillColor":"000000","fillOpacity":0.6}' data-toggle='tooltip' data-placement='right' href="../sesiones/docs/E&ES2 - 2.1.3 IDEAR - BRAINSTORM.pdf" download />
							<area shape="poly" title="Da click para descargar el material 'E&ES2 - 2.1.4 PROTOTIPAR'" coords="594,90,784,144,784,230,594,283" data-maphilight='{"stroke":false,"fillColor":"000000","fillOpacity":0.6}' data-toggle='tooltip' data-placement='right' href="../sesiones/docs/E&ES2 - 2.1.4 PROTOTIPAR.pdf" download />
							<area shape="poly" title="Da click para descargar el material 'E&ES2 - 2.1.5 VALIDAR'" coords="792,146,1000,190,792,230" data-maphilight='{"stroke":false,"fillColor":"000000","fillOpacity":0.6}' data-toggle='tooltip' data-placement='right' href="../sesiones/docs/E&ES2 - 2.1.5 VALIDAR.pdf" download />
						</map>

						<div class="row">
							<div class="text-left col-6"><a href="<?php echo $uri_sola . '=0'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a></div>

							<div class="text-right col-6"><a href="<?php echo $uri_sola . '=2'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(22)" <?php } ?>>Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a></div>
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