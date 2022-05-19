<?php
if ($_SESSION["tipo"]=="Alumn") {
	include_once('../scripts/conexion.php');
	$fila = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(Alumno_ID) FROM empresas_info_s4_3 WHERE Alumno_ID=" . $_SESSION["Alumno_ID"]));
	$_SESSION["test_de_perfil"] = $fila[0];
}
?>
			<script src="../js/Chart.js"></script>
			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 4 <i class="fas fa-angle-right fa-lg fa-fw"></i> Selección de Roles <i class="fas fa-angle-right fa-lg fa-fw"></i> Detección de Habilidades
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Detección de Habilidades</h5>
					<div class="card-text px-5">
						<br>
						<p class="text-justify">Para tomar la decisión de qué área deberías elegir, es muy importante conocer y reconocer cuáles son tus mejores habilidades, recuerda que todos tenemos cualidades que nos permiten desempeñarnos de mejor manera en ciertas áreas, algunos son muy buenos para matemáticas, otros para hablar en público, otros para dibujar y todos esos talentos son necesarios en cualquier organización.</p>
						<p class="text-justify">Esto se llama <strong>AUTOCONOCIMIENTO</strong> , el cual consiste no solo en saber para qué <b>SÍ</b> soy bueno, sino también reconocer para que otras cosas <b>NO</b> soy tan bueno, ya que esto nos permitirá reconocer las cualidades de los demás y armar un gran equipo para tu empresa, sumando todas sus habilidades. Piensa en tus gustos, intereses, habilidades y valores. Estos aspectos son fundamentales en la planeación y desarrollo de nuestra vida.</p>
						<div class="row justify-content-center">
							<div class="d-none col-lg-2"></div>
							<div class="col-12 col-lg-8">
								<img src="../sesiones/images/4.3_autoconocimiento.png" alt="autoconocimiento" class="img-fluid">
							</div>
							<div class="d-none col-lg-2"></div>
						</div>
						<p class="text-justify mt-5">Realiza el siguiente ejercicio para conocer un poco más de ti y que eso te ayude a elegir el área en la que te gustaría desempeñarte a lo largo del programa.</p>
						<p class="text-justify mb-2"><div class="text-orange text-center">Del siguiente listado de características de una persona, selecciona aquellas que consideras que te definen.</div></p>
						<p class="text-justify mb-2"><div class="text-orange text-center">Sólo podrás realizar este test <b>UNA VEZ</b>, por lo que te sugerimos hacer esta selección con objetividad, para que el ejercicio pueda darte un resultado más preciso.</div></p>

						<?php if ($_SESSION['tipo'] != "Alumn") { ?>
							<div class="text-orange text-center pb-3 pl-5 pr-5">NOTA PARA <b>ASESORES Y COORDINADORES</b>. El resumen de información de esta sesión, lo podrás revisar en la sección de <b>Revisión</b>, sólo accesible para ustedes.</div>
						<?php } ?>

						<div class="container py-2">
							<div class="row justify-content-md-center">
								<div class="col-md-auto px-5 text-center">
								<?php if ($_SESSION["tipo"]=="Alumn") {
								if (isset($_SESSION["test_de_perfil"]) AND $_SESSION["test_de_perfil"]==0) { ?>
									<h5><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><span class="badge badge-success px-3 py-3"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Realiza tu test y obtén <span class="text-yellow">15 estrellas</span> en lo individual</span></h5>
								<?php } else { ?>
									<h5><span class="badge badge-success px-3 py-3"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp;<span class="text-yellow">15 estrellas</span> obtenidas</span></h5>
								<?php }
								} else { ?>
									<h5><span class="badge badge-success px-3 py-3"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Realizar el test otorga <span class="text-yellow">15 estrellas</span> de manera individual</span></h5>
								<?php } ?>
								</div>
							</div>
						</div>

						<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/registrar_4_3.php" method="post" class="mt-1">
							<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
							<input name="Empresa_ID" type="hidden" id="Empresa_ID" value="<?php if ($_SESSION['tipo'] == "Alumn") { echo $_SESSION['Empresa_ID']; } else { echo ''; } ?>">

							<?php if ($_SESSION['tipo'] != "Alumn") {?>
							<div class="text-center">
								<div id="actualizados" style="display: none" class="bg-success w-50 py-2 text-center text-white rounded mx-auto mb-2"></div>
							</div>
							<div class="form-row pb-1">
								<div class="form-group col-2"></div>
								<div class="form-group row col-8">
									<label for="select_empresa" class="col-sm-2 col-form-label text-right">Empresa:</label>
									<div class="col-sm-10">
										<select name="select_empresa" type="text" id="select_empresa" class="form-control rounded" onChange="filtro_empresa()"></select>
									</div>
								</div>
								<div class="form-group col-1"></div>
							</div><br>
							<?php } ?>

							<div class="border px-5 py-3 mb-4" id="test">
								<h5 class="card-title text-center">TEST DE PERFIL</h5><br>
								<div class="row">
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac1' name='ac1' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac1' style='cursor:pointer'>Disciplinado</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac2' name='ac2' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac2' style='cursor:pointer'>Confiable</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac3' name='ac3' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac3' style='cursor:pointer'>Adaptable</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac4' name='ac4' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac4' style='cursor:pointer'>Ordenado</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac5' name='ac5' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac5' style='cursor:pointer'>Seguro</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac6' name='ac6' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac6' style='cursor:pointer'>Formal</label>
										</div>
									</div>
								</div><br>
								<div class="row">
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac7' name='ac7' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac7' style='cursor:pointer'>Influyente</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac8' name='ac8' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac8' style='cursor:pointer'>Constante</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac9' name='ac9' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac9' style='cursor:pointer'>Atento</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac10' name='ac10' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac10' style='cursor:pointer'>Armonioso</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac11' name='ac11' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac11' style='cursor:pointer'>Jovial</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac12' name='ac12' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac12' style='cursor:pointer'>Audaz</label>
										</div>
									</div>
								</div><br>
								<div class="row">
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac13' name='ac13' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac13' style='cursor:pointer'>Sociable</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac14' name='ac14' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac14' style='cursor:pointer'>Claro</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac15' name='ac15' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac15' style='cursor:pointer'>Competitivo</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac16' name='ac16' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac16' style='cursor:pointer'>Sincero</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac17' name='ac17' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac17' style='cursor:pointer'>Reflexivo</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac18' name='ac18' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac18' style='cursor:pointer'>Cooperativo</label>
										</div>
									</div>
								</div><br>
								<div class="row">
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac19' name='ac19' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac19' style='cursor:pointer'>Exigente</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac20' name='ac20' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac20' style='cursor:pointer'>Ético</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac21' name='ac21' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac21' style='cursor:pointer'>Determinado</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac22' name='ac22' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac22' style='cursor:pointer'>Perfeccionista</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac23' name='ac23' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac23' style='cursor:pointer'>Lógico</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac24' name='ac24' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac24' style='cursor:pointer'>Comprometido</label>
										</div>
									</div>
								</div><br>
								<div class="row">
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac25' name='ac25' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac25' style='cursor:pointer'>Preciso</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac26' name='ac26' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac26' style='cursor:pointer'>Razonable</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac27' name='ac27' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac27' style='cursor:pointer'>Meticuloso</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac28' name='ac28' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac28' style='cursor:pointer'>Con estilo</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac29' name='ac29' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac29' style='cursor:pointer'>Firme</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac30' name='ac30' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac30' style='cursor:pointer'>Diplomático</label>
										</div>
									</div>
								</div><br>
								<div class="row">
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac31' name='ac31' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac31' style='cursor:pointer'>Convincente</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac32' name='ac32' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac32' style='cursor:pointer'>Estimulante</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac33' name='ac33' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac33' style='cursor:pointer'>Prudente</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac34' name='ac34' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac34' style='cursor:pointer'>Arriesgado</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac35' name='ac35' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac35' style='cursor:pointer'>Directo</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac36' name='ac36' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac36' style='cursor:pointer'>Insistente</label>
										</div>
									</div>
								</div><br>
								<div class="row">
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac37' name='ac37' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac37' style='cursor:pointer'>Cauto</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac38' name='ac38' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac38' style='cursor:pointer'>Seguro de sí mismo</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac39' name='ac39' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac39' style='cursor:pointer'>De mente abierta</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac40' name='ac40' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac40' style='cursor:pointer'>Con don de gentes</label>
										</div>
									</div>
									<div class="col">
										<div class='checkbox checkbox-green' style='cursor:pointer'>
											<input type='checkbox' class='custom-control-input' id='ac41' name='ac41' style='cursor:pointer' disabled>
											<label class='custom-control-label pt-1' for='ac41' style='cursor:pointer'>De buen carácter</label>
										</div>
									</div>
									<div class="col"></div>
								</div><br><br>
								<div class="card px-3 py-2" id="graficos"></div><br><br>
							</div>
							<div class="row pb-1">
								<div class="col text-center">
									<?php if ($_SESSION['tipo'] == "Alumn") { ?>
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_registrar" id="btn_registrar" <?php echo $_SESSION['enable_disable']; ?>>Procesar test</button>
										<button type="button" class="btn btn-warning text-center px-5 my-2" name="limpiar" id="limpiar" onclick="location.reload()">Limpiar</button>
									<?php } ?>
								</div>
							</div>
						</form>
						<div class="row">
							<div class="text-left col-6">
								<a href="<?php echo $uri_sola . '=1'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a>
							</div>
							<div class="text-right col-6">
								<a href="<?php echo $uri_sola . '=3'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(43)" <?php } ?>>Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<script type="text/javascript">
				<?php if ($_SESSION['tipo'] == "Admin") { ?>
					$(document).ready(function(){
						$.ajax({
							url: '../admin/ajax/mis_empresas.php',
							success: function(data)
							{
								$('#select_empresa').append(data);
							}
						});
					});
				<?php } else if ($_SESSION['tipo'] == "Coord") { ?>
					$(document).ready(function(){
						$.ajax({
							url: '../coordinador/ajax/mis_empresas.php',
							success: function(data)
							{
								$('#select_empresa').append(data);
							}
						});
					});
				<?php } else if ($_SESSION['tipo'] == "Volun") { ?>
					$(document).ready(function(){
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
							data: parametros,
							url: '../alumno/ajax/empresas_info_s4_3_data.php',
							type: 'post',
							success: function(data)
							{
								var array = JSON.parse(data);
								$("#graficos").html(array[1]);
								for (var i = 1; i <= 41; i++) {
									val_chk = array[0].charAt(i-1);
									if (val_chk == 1) {
										$("#ac"+i).prop('checked', true);
									}
									if (array[0] != "") {
										$("#ac"+i).prop('disabled', true);
									} else {
										$("#ac"+i).prop('disabled', false);
									}
								}
								if (array[0] != "") {
									$("#btn_registrar").prop('disabled', true);
									$("#limpiar").prop('disabled', true);
								}
							}
						});
					});

				<?php }

				if ($_SESSION['tipo'] != "Alumn") { ?>
					function filtro_empresa(){
						var Empresa_ID = document.getElementById("select_empresa").value;
						var parametros = {
							"Empresa_ID" : Empresa_ID,
						};
						$("#Empresa_ID").val(Empresa_ID);

						$.ajax({
							data: parametros,
							url: '../alumno/ajax/empresas_info_s4_3_data.php',
							type: 'post',
							success: function(data)
							{
								var array = JSON.parse(data);
								$("#graficos").html(array[0]);
							}
						});
					}
				<?php } ?>
			</script>