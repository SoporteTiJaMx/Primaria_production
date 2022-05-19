			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 2 <i class="fas fa-angle-right fa-lg fa-fw"></i> El arte de crear II <i class="fas fa-angle-right fa-lg fa-fw"></i> Actividades
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Actividades</h5>
					<div class="card-text px-5">
						<div class="row mb-3">
							<div class="col-2"><strong>Objetivo:</strong></div>
							<div class="col-10">Desarrollar las siguientes 2 etapas de la metodología Design Thinking, Prototipado y Validación, para concluir todos los procesos e identificar la idea de negocio más viable.</div>
						</div>
						<div class="row mb-3">
							<div class="col-2"><strong>Tipo de entrega:</strong></div>
							<div class="col-10">En equipo.</div>
						</div>
						<div class="row mb-3">
							<div class="col-2"><strong>Recompensa:</strong></div>
							<div class="col-10"><strong>50 estrellas a la empresa</strong>, si entregaron las actividades completas y antes de que inicie la Sesión 4.</div>
						</div>
						<div class="row mb-3">
							<div class="col-2"><strong>Fecha límite:</strong></div>
							<div class="col-10"><?php if (isset($_SESSION["Sesion_4_fin"])) { echo ucfirst(strftime("%A, %d de %B de %Y", strtotime('-1 hour', strtotime(date($_SESSION["Sesion_4_fin"]))))); } else { echo "Depende de la licencia que se active.";} ?></div>
						</div>
						<div class="row mb-3">
							<div class="col-2"><strong>Instrucciones:</strong></div>
							<div class="col-10">
								<ol style="padding-left: 1em">
									<li class="pb-2">Verifica que al menos una persona del equipo subiera a la plataforma las actividades completas.</li>
									<ul class="pb-2">
										<li>Prototipo</li>
										<li>Validación</li>
									</ul>
									<li>Completen los apartados de su Modelo CANVAS que se indican.</li>
								</ol>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-2"><strong>Formato de entrega:</strong></div>
							<div class="col-10">
								<ol style="padding-left: 1em">
									<li class="pb-2">Las actividades de cada etapa del Design Thinking se realizan dentro de cada pestaña correspondiente.</li>
									<li>Los campos del Modelo CANVAS se rellenan a continuación.</li>
								</ol>
							</div>
						</div>
					</div>

					<div class="container py-2">
						<div class="row justify-content-md-center">
							<div class="col-md-auto px-5 text-center">
							<?php if ($_SESSION["tipo"]=="Alumn") { ?>
								<h5><span class="badge badge-success px-3 py-3 text-wrap"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Realicen la actividad, junto con todas las de la sesión, y obtengan <span class="text-yellow">50 estrellas</span> para su empresa</span></h5>
							<?php } else { ?>
								<h5><span class="badge badge-success px-3 py-3 text-wrap"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Realizar la actividad, junto con todas las de la sesión, otorga <span class="text-yellow">50 estrellas a la empresa</span></span></h5>
							<?php } ?>
							</div>
						</div>
					</div>

					<div class="text-orange text-center">A continuación llena el bloque de la "Propuesta de Valor" de tu modelo de negocio Canvas, apoyándote en la siguiente guía:</div><br>
					<div class="row text-center text-orange px-5">
						<div class="col"><u><b>Propuesta de valor</u></b><br><br>En este apartado tendremos que dejar de forma clara, simple y sencilla, qué hace especial tu solución y cómo vas a ayudar a tus clientes a resolver su problema. ¿Qué obtiene el cliente cuando te paga? Establezcan las 3 características más importantes de tu producto o servicio que les van a ayudar a resolver los problemas a sus clientes.<br><br></div>
					</div>
				</div>

					<?php if ($_SESSION['tipo'] == "Alumn") {
						echo '<div class="px-2">';
						include_once('_Canvas_a.php');
						echo '</div>';
					} ?>

				<div class="card-body px-5">
					<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/registrar_idea_canvas_coments.php" method="post" class="mt-1">
						<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
						<input name="Empresa_ID" type="hidden" id="Empresa_ID" value="<?php if ($_SESSION['tipo'] == "Alumn") { echo $_SESSION['Empresa_ID']; } else { echo ""; } ?>">
						<input name="sesion" type="hidden" id="sesion" value="3_4">
						<?php if ($_SESSION['tipo'] == "Volun" OR $_SESSION['tipo'] == "Alumn") {?>
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

						<?php if ($_SESSION['tipo'] != "Alumn") {
							echo '<div class="card border-0 mb-5" id="canvas">';
							include_once('_Canvas_v_vacio.php');
							echo '</div>';
						} ?>

						<div class="form-row pb-1">
							<div class="form-group col-2"></div>
							<div class="form-group col-8">
								<?php if ($_SESSION['tipo'] == "Alumn" AND isset($_SESSION["sesion3_4"]) AND $_SESSION["sesion3_4"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
								<label for="coments_asesor" class="control-label text-dark-gray">Comentarios del Asesor:</label>
								<textarea class="form-control rounded" name="coments_asesor" id="coments_asesor" rows="3" <?php echo $_SESSION['enable_disable_asesor']; ?> disabled></textarea>
							</div>
							<div class="form-group col-2"></div>
						</div>

						<div class="row pb-1">
							<div class="col text-center">
								<?php if ($_SESSION['tipo'] == "Volun") {?>
									<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_registrar_problemas" id="btn_registrar_problemas" disabled>Registrar comentario</button>
								<?php } ?>
							</div>
						</div>
					</form>

					<div class="card-text px-5">
						<div class="row">
							<div class="text-left col-6"><a href="<?php echo $uri_sola . '=2'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a></div>
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
						  url: '../alumno/ajax/empresas_info_canvas_data.php',
						  type: 'post',
						  success: function(data)
						  {
							var array = JSON.parse(data);
							$("#coments_asesor").html(array.coments_asesor);
						  }
						});
					});
				<?php } ?>

				<?php if ($_SESSION['tipo'] != "Alumn") { ?>
					function filtro_empresa(){
						var Empresa_ID = document.getElementById("select_empresa").value;
						var parametros = {
							"Empresa_ID" : Empresa_ID,
							"sesion" : "3_3",
						};
						$("#Empresa_ID").val(Empresa_ID);
						$.ajax({
						  data:  parametros,
						  url: 'includes/_Canvas_v.php',
						  type: 'post',
						  success: function(data)
						  {
							$("#canvas").html(data);
						  }
						});
						$.ajax({
						  data:  parametros,
						  url: '../alumno/ajax/empresas_info_canvas_data.php',
						  type: 'post',
						  success: function(data){
							var array = JSON.parse(data);
							$("#coments_asesor").val(array.coments_asesor);
							<?php if ($_SESSION['tipo'] == "Volun") {?>
							$('#coments_asesor').prop('disabled', false);
							$('#btn_registrar_problemas').prop('disabled', false);
							<?php } ?>
						  }
						})
					}
				<?php } ?>

			</script>