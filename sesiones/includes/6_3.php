			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 6 <i class="fas fa-angle-right fa-lg fa-fw"></i> Factibilidad Técnica <i class="fas fa-angle-right fa-lg fa-fw"></i> Recursos: materias primas
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Recursos: materias primas</h5>
					<div class="card-text pl-5 pr-5">
						<p class="text-justify">¡Es tu Turno!</p>
						<p class="text-justify">Comenzaremos identificando las <b>materias primas o servicios</b> que necesita nuestra empresa para planear la elaboración de nuestro producto o servicio.</p>
						<p class="text-justify">Elaboren una lista de las materias primas y servicios que la Empresa va a necesitar; posteriormente deberán identificar por lo menos tres proveedores para cada insumo. Una vez hecho esto, se analizará lo que ofrece cada proveedor para seleccionar la mejor opción sobre la base del costo-beneficio.</p>
						<p class="text-justify">Ejemplo: Para la Elaboración de un Perfume</p>
						<div class="row justify-content-center">
							<div class="d-none col-lg-1"></div>
							<div class="col-12 col-lg-10">
								<table class="table table-bordered table-responsive text-center">
									<thead class="">
										<tr class="">
											<th>Materia Prima y/o Servicio</th>
											<th>Proveedores</th>
											<th>Costo Apróximado</th>
											<th>Ventajas</th>
											<th>Desventajas</th>
										</tr>
									</thead>
									<tbody>
										<tr class="">
											<td rowspan="3">Botellas Para Envasado</td>
											<td>Plásticos "San Patricio"</td>
											<td>$100 por una docena de botellas</td>
											<td>Son económicas y no son pesadas de transportar</td>
											<td>El plástico puede modificar el aroma del perfuma</td>
										</tr>
										<tr>
											<td>Farmacia París</td>
											<td>$250 por 10 piezas de cristal con tapa de 200ml.</td>
											<td>Mantiene las esencias por más tiempo</td>
											<td>Frágiles</td>
										</tr>
										<tr bgcolor= "#8FC440" style="color: #fff">
											<td>Mercería "Santana"</td>
											<td>$150 por doce piezas de plástico reciclado y enmicado de 200 ml.</td>
											<td>El enmicado permite mantener el aroma más tiempo. Costo accesible.</td>
											<td>No es ni más costoso ni más económico.</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="d-none col-lg-1"></div>
						</div>
						<p class="text-justify">Para este ejemplo, después de hacer el análisis de costo-beneficio, elegiríamos la opción resaltada.</p>
						<p class="text-justify">A continuación, el <b>Director de Producción y sus Gerentes</b>, previa integración de la información recopilada con todos los colaboradores, podrán ingresar las materias primas o insumos requeridos para la fabricación de su producto o servicio, así como los posibles proveedores en cada caso.</p>
						<p class="text-justify">Apóyate del siguiente formato para recopilar esta información, previo a su ingreso en esta plataforma. Los costos de las materias primas los utilizarás más delante para determinar el costo de tu producto. <br><br> <a href="../sesiones/docs/E&ES6 - 6.2 IDENTIFICACIÓN DE MATERIAS PRIMAS.pdf" download><span class="badge badge-warning text-center px-3 py-2">Identificación de Materias Primas</span></a></p>

						<div class="row justify-content-md-center">
							<div class="col-md-auto px-5 text-center">
							<?php if ($_SESSION["tipo"]=="Alumn") { ?>
								<h5><span class="badge badge-success px-3 py-3 text-wrap"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Realicen la actividad, junto con todas las de la sesión, y obtengan <span class="text-yellow">100 estrellas</span> para su empresa</span></h5>
							<?php } else { ?>
								<h5><span class="badge badge-success px-3 py-3 text-wrap"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Realizar la actividad, junto con todas las de la sesión, otorga <span class="text-yellow">100 estrellas a la empresa</span></span></h5>
							<?php } ?>
							</div>
						</div>

						<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/registrar_6_3.php" method="post" class="mt-1" enctype="multipart/form-data">
							<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
							<input name="Empresa_ID" type="hidden" id="Empresa_ID" value="<?php if ($_SESSION['tipo'] == "Alumn") { echo $_SESSION['Empresa_ID']; } else { echo ""; } ?>">
							<input name="seccion" type="hidden" id="seccion" value="6_3">
							<?php if ($_SESSION['tipo'] == "Volun" OR $_SESSION['tipo'] == "Alumn") {?>
							<input name="action" type="hidden" id="action" value="new">
							<input name="ids" type="hidden" id="ids" value="">

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

							<div class="tab-pane fade show active" id="nav-insumos" role="tabpanel" aria-labelledby="nav-insumos-tab">
								<h5 class="card-title">Materias primas o Servicios requeridos</h5>
								<div class="card-body">

									<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto"></div></div>
									<div class="insumos"></div>

									<?php if ($_SESSION['tipo'] == "Alumn" AND ($_SESSION['Puesto_ID'] == 5 OR $_SESSION['Puesto_ID'] == 10)) { ?>
									<div class="form-row mb-2 text-right">
										<div class="col text-right">
											<button type="button" class="btn btn-warning px-5 my-2" name="mas_insumos" id="mas_insumos" onclick="agregar_insumos();"> <i class="fas fa-plus"></i> </button>
											<button type="button" class="btn btn-warning px-5 my-2" name="menos_insumos" id="menos_insumos" onclick="quitar_insumos();" disabled> <i class="fas fa-minus"></i> </button>
										</div>
									</div>
									<?php } ?>

								</div>
							</div>

							<div class="form-row pb-1">
								<div class="form-group col-2"></div>
								<div class="form-group col-8">
									<?php if ($_SESSION['tipo'] == "Alumn" AND isset($_SESSION["sesion6_3"]) AND $_SESSION["sesion6_3"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
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
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_registrar_insumos" id="btn_registrar_insumos" disabled>Registrar comentario</button>
									<?php } else if ($_SESSION['tipo'] == "Alumn") { ?>
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_registrar_insumos" id="btn_registrar_insumos" disabled>Registrar 'Materias primas'</button>
									<?php } ?>
								</div>
							</div>
						</form>

						<div class="row">
							<div class="text-left col-6"><a href="<?php echo $uri_sola . '=1'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a></div>

							<div class="text-right col-6"><a href="<?php echo $uri_sola . '=3'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(63)" <?php } ?>>Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a></div>
						</div>
					</div>

				</div>
			</div>

			<script type="text/javascript">

				<?php if ($_SESSION['tipo'] == "Admin") {?>
					$(document).ready(function(){
						var parametros = {
							"seccion" : "6_3",
						};
						$.ajax({
							data: parametros,
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
							"seccion" : "6_3",
						};
						$.ajax({
							data: parametros,
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
							"seccion" : "6_3",
						};
						$.ajax({
							data: parametros,
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
							"tipo_seccion" : 1,
						};
						$.ajax({
							data: parametros,
							url: '../alumno/ajax/empresas_info_s6_3_data.php',
							type: 'post',
							success: function(data)
							{
								var array = JSON.parse(data);
								$('.insumos').append(array[0]);
								$("#coments_asesor").html(array[1]);
								$("#ids").val(array[2]);
								if (array[1]!="" && array[1]!=null) {
									$("#btn_registrar_insumos").text("Actualizar 'Materias primas'");
									$("#action").val("update");
								}
								<?php if ($_SESSION['Puesto_ID'] == 5 OR $_SESSION['Puesto_ID'] == 10) { ?>
									$('#btn_registrar_insumos').prop('disabled', false);
								<?php } ?>
							}
						});
					});

					<?php if ($_SESSION['Puesto_ID'] == 5 OR $_SESSION['Puesto_ID'] == 10) { ?>
					function agregar_insumos(){
						var input = $('.row_insumos:last .campo1');
						var id_last_row = input.attr('id');
						var res = id_last_row.split("_");
						new_id = parseInt(res[2])+1;
						$('.row_insumos:last').clone().insertAfter('.row_insumos:last');
						$('.row_insumos:last .campo1').attr({ id:'selecttipo_n_'+new_id, name:'selecttipo_n_'+new_id });
						$('.row_insumos:last .campo2').attr({ id:'requerimiento_n_'+new_id, name:'requerimiento_n_'+new_id });
						$('.row_insumos:last .campo2').val('');
						$('.row_insumos:last .campo3').attr({ id:'proveedor1_n_'+new_id, name:'proveedor1_n_'+new_id });
						$('.row_insumos:last .campo3').val('');
						$('.row_insumos:last .campo4').attr({ id:'proveedor1vents_n_'+new_id, name:'proveedor1vents_n_'+new_id });
						$('.row_insumos:last .campo4').val('');
						$('.row_insumos:last .campo5').attr({ id:'proveedor2_n_'+new_id, name:'proveedor2_n_'+new_id });
						$('.row_insumos:last .campo5').val('');
						$('.row_insumos:last .campo6').attr({ id:'proveedor2vents_n_'+new_id, name:'proveedor2vents_n_'+new_id });
						$('.row_insumos:last .campo6').val('');
						$('.row_insumos:last .campo7').attr({ id:'proveedor3_n_'+new_id, name:'proveedor3_n_'+new_id });
						$('.row_insumos:last .campo7').val('');
						$('.row_insumos:last .campo8').attr({ id:'proveedor3vents_n_'+new_id, name:'proveedor3vents_n_'+new_id });
						$('.row_insumos:last .campo8').val('');
						$('#menos_insumos').prop('disabled', false);
					};
					function quitar_insumos(){
						var input = $('.row_insumos:last .campo1');
						var id_last_row = input.attr('id');
						var res = id_last_row.split("_");
						removed_id = parseInt(res[2]);
						if (removed_id==2) {
							$('#menos_insumos').prop('disabled', true);
						} else {
							$('#menos_insumos').prop('disabled', false);
						}
						var form_inputs = $('.row_insumos:last');
						form_inputs.remove();
					};
					<?php }
				}

				if ($_SESSION['tipo'] != "Alumn") { ?>
					function filtro_empresa(){
						var Empresa_ID = document.getElementById("select_empresa").value;
						var parametros = {
							"Empresa_ID" : Empresa_ID,
							"tipo_seccion" : 1,
						};
						$("#Empresa_ID").val(Empresa_ID);
						$('#btn_registrar_insumos').prop('disabled', false);

						$.ajax({
							data: parametros,
							url: '../alumno/ajax/empresas_info_s6_3_data.php',
							type: 'post',
							success: function(data)
							{
								var array = JSON.parse(data);
								$('.insumos').html(array[0]);
								$("#coments_asesor").html(array[1]);
								$("#ids").val(array[2]);
								if (array[1]!="" && array[1]!=null) {
									<?php if ($_SESSION['tipo'] == "Volun") {?>
										$("#btn_registrar_insumos").text("Actualizar comentario");
										if (Empresa_ID > 0) {
											$('#btn_registrar_insumos').prop('disabled', false);
											$("#action").val("update");
										} else {
											$('#btn_registrar_insumos').prop('disabled', true);
											$("#action").val("new");
										}
									<?php } ?>
								}
								if (array[0]!="") {
									$("#action").val("update");
								}
							}
						});
					}
				<?php } ?>

			</script>