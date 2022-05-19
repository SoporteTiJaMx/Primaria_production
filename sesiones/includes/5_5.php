			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 5 <i class="fas fa-angle-right fa-lg fa-fw"></i> La Identidad Empresarial <i class="fas fa-angle-right fa-lg fa-fw"></i> Objetivos por Área
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Objetivos por Área</h5>
					<div class="card-text px-5">
						<p class="text-justify">Es importante trabajar en el proceso de planeación de nuestra empresa. Para esto, <b>tenemos que definir cuáles son los pasos intermedios para obtener los resultados esperados.</b></p>
						<p class="text-justify">Al iniciar, lo que deben hacer es definir cuáles son sus objetivos y metas. Un <strong>objetivo</strong> <b>define el fin o fines que se proponen obtener</b>, da una dirección a seguir y es el punto de partida en el proceso de planeación. Por ejemplo, "<i>Aumentar las ventas</i>", "<i>dar a conocer nuestra marca</i>", etc.</p>
						<p class="text-justify">El <strong>Plan de Acción</strong> es una herramienta para definir el método para el logro de los objetivos y metas; debe contener mínimamente el objetivo y meta a alcanzar, la fecha de elaboración, la fecha de cumplimiento final y las actividades a realizar para cumplir con la meta respondiendo las preguntas <b>¿Qué se va a hacer?</b> y <b>¿Cuándo se va a hacer?</b></p>
						<p class="text-justify">Para plantear objetivos, también pueden utilizar el método <strong>SMART</strong></p>
						<br><br>
						<div class="row justify-content-center">
							<div class="d-none col-lg-2"></div>
							<div class="col-12 col-lg-8">
								<img src="../sesiones/images/5.4.1_objetivos_smart.png" alt="Objetivos SMART" class="img-fluid">
							</div>
							<div class="d-none col-lg-2"></div>
						</div>
						<br><br>
						<p class="text-justify">Para que puedan definir sus objetivos, metas y plan de acción como Empresa del programa <strong>Emprendedores y Empresarios Impulsa</strong>, deberán realizar el siguiente ejercicio:</p>
						<ol>
							<li class="text-justify">Escribir los 5 objetivos más importantes por cada área de la Empresa, incluyendo la Dirección General, es decir, cada director de área con su equipo definirán sus objetivos. </li><br>
							<li class="text-justify">Para lograr los objetivos se tiene que definir una forma de medir los logros, para lo que definirán las metas. Una <strong>meta es un objetivo al que se le asignan cantidades y fechas</strong>. Ejemplo: "<i>Aumentar las ventas un 50% para mayo del 2021</i>", "<i>Reducir los costos en un tercio para abril del 2021</i>", etc. Describan las metas de cada objetivo propuesto. (Nota: para lograr un objetivo, a veces se necesita más de una meta).</li><br>
							<li class="text-justify">Definir cómo lograr las metas, para lo que se usa un plan de acción. La siguiente tabla puede servir de ejemplo para tener un plan de acción.</li><br>
							<li class="text-justify">Cargar esta información por cada área, para que en la siguiente sección toda la empresa pueda ver los objetivos globales que han establecido.</li><br>
						</ol>
						<div class="row justify-content-center">
							<div class="d-none col-lg-3"></div>
							<div class="col-12 col-lg-6">
								<img src="../sesiones/images/5.4.2_plan_accion.png" alt="Objetivos SMART" class="img-fluid">
							</div>
							<div class="d-none col-lg-3"></div>
						</div>
						<br><br>
						<div class="row justify-content-md-center">
							<div class="col-md-auto px-5 text-center">
							<?php if ($_SESSION["tipo"]=="Alumn") { ?>
								<h5><span class="badge badge-success px-3 py-3 text-wrap"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Realicen la actividad para obtener <span class="text-yellow">40 estrellas</span> para su empresa</span></h5>
							<?php } else { ?>
								<h5><span class="badge badge-success px-3 py-3 text-wrap"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Realizar la actividad otorga <span class="text-yellow">40 estrellas a la empresa</span></span></h5>
							<?php } ?>
							</div>
						</div>
						<br><br>
						<?php if ($_SESSION['tipo'] != "Alumn") {?>
							<div id="info_objetivos"></div>
							<br>
						<?php } else { ?>
							<div id="info_objetivos"></div>
						<?php } ?>
						<br><br>
						<div class="row">
							<div class="text-left col-6">
								<a href="<?php echo $uri_sola . '=3'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a>
							</div>
							<div class="text-right col-6">
								<a href="<?php echo $uri_sola . '=5'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(55)" <?php } ?>>Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a>
							</div>
						</div>
						<br><br>
					</div>
				</div>
			</div>
			<script>
				<?php if ($_SESSION['tipo'] == "Alumn") { ?>
					$(document).ready(function(){
						var parametros = {
							"Empresa_ID" : <?php echo $_SESSION['Empresa_ID']; ?>,
						};
						$.ajax({
						  data:  parametros,
						  url: '../alumno/ajax/empresas_info_s5_5_data.php',
						  type: 'post',
						  success: function(data)
						  {
							$("#info_objetivos").html(data);
						  }
						});
					});

					function addmeta(i){
						var meta_last = $('#moremetas'+i+' .meta'+i).last().attr('id');
						var res = meta_last.split("_");
						new_num_id = parseInt(res[1])+1;
						$('#metaini'+i+' .meta'+i+'div').clone().find('textarea').val("").end().appendTo('#moremetas'+i);
						$('#moremetas'+i+' .meta'+i).last().attr('id', 'meta_'+i+'_'+new_num_id).end();
						$('#moremetas'+i+' .pa'+i).last().attr('id', 'pa_'+i+'_'+new_num_id).end();
						$('#btnrmv'+i).removeClass('disabled');
					}
					function rmvmeta(i){
						var meta_last = $('#moremetas'+i+' .meta'+i).last().attr('id');
						var res = meta_last.split("_");
						id = parseInt(res[2]);
						if (id == 2) {
							$('#btnrmv'+i).addClass('disabled');
						}
						$('#moremetas'+i+' .meta'+i+'div').last().remove();
					}
				<?php } ?>
				<?php if ($_SESSION['tipo'] != "Alumn") { ?>
					$(document).ready(function(){
						$.ajax({
						  url: '../alumno/ajax/empresas_info_s5_5_data.php',
						  success: function(data)
						  {
							$("#info_objetivos").html(data);
						  }
						});
					});
				<?php } ?>
			</script>