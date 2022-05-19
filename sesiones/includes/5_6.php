			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 5 <i class="fas fa-angle-right fa-lg fa-fw"></i> La Identidad Empresarial <i class="fas fa-angle-right fa-lg fa-fw"></i> Objetivos Generales
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Objetivos de la Empresa</h5>
					<div class="card-text px-5">
						<?php if ($_SESSION['tipo'] != "Alumn") {?>
							<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/registrar_5_6.php" method="post" class="mt-1">
								<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">

								<p class="text-justify">En esta sección podrás ver los objetivos planteados por cada área de la empresa a la que asesoras, lee cada <b>Objetivo</b>, <b>Meta</b> y <b>Plan de Acción</b> y luego haz comentarios a tu equipo. <br></p>
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
								<div class="form-row pb-1">
									<div class="form-group col-2"></div>
									<div class="form-group row col-8">
										<label for="select_area_emp" class="col-sm-2 col-form-label text-right">Área:</label>
										<div class="col-sm-10">
											<select name="select_area_emp" type="text" id="select_area_emp" class="form-control rounded" onChange="filtro_area_emp()" disabled>
												<option value="0">Selecciona un Área</option>
												<option value="dg">Dirección General</option>
												<option value="df">Área de Finanzas</option>
												<option value="dm">Área de Marketing</option>
												<option value="dv">Área de Ventas</option>
												<option value="dp">Área de Producción</option>
												<option value="drrhh">Área de Recursos Humanos</option>
											</select>
										</div>
									</div>
									<div class="form-group col-1"></div>
								</div>
						<?php } else { ?>
								<p class="text-justify">En esta pestaña podrás ver los <b>Objetivos</b>, <b>Metas</b> y <b>Planes de Acción</b> que tus compañeros propusieron, revisenlos y dense retroalimentación para mejorarlos o aprobarlos.</p>
								<p class="text-justify">Igualmente podrás ver los comentarios de tu <b>Asesor</b> tomalos en cuenta y haz las correciones pertinentes con base en ellos.</p>
								<div class="form-row pb-1">
									<div class="form-group col-2"></div>
									<div class="form-group row col-8">
										<label for="select_area_emp" class="col-sm-2 col-form-label text-right">Área:</label>
										<div class="col-sm-10">
											<select name="select_area_emp" type="text" id="select_area_emp" class="form-control rounded" onChange="filtro_area_emp()">
												<option value="0">Selecciona un Área</option>
												<option value="dg">Dirección General</option>
												<option value="df">Área de Finanzas</option>
												<option value="dm">Área de Marketing</option>
												<option value="dv">Área de Ventas</option>
												<option value="dp">Área de Producción</option>
												<option value="drrhh">Área de Recursos Humanos</option>
											</select>
										</div>
									</div>
								</div>
						<?php } ?>
								<br><br>
								<div>
									<div id="result" class="py-1"></div>
									<div class="form-row pb-1" id="div_coments_asesor">
										<div class="form-group col-2"></div>
										<div class="form-group col-8">
											<?php if ($_SESSION['tipo'] == "Alumn" AND isset($_SESSION["sesion5_6"]) AND $_SESSION["sesion5_6"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
											<label for="coments_asesor" class="control-label text-dark-gray">Comentarios del Asesor:</label>
											<textarea class="form-control rounded" name="coments_asesor" id="coments_asesor" rows="3" <?php echo $_SESSION['enable_disable_asesor']; ?>></textarea>
										</div>
										<div class="form-group col-2"></div>
									</div>
									<?php if ($_SESSION['tipo'] == "Volun") { ?>
									<div class="row pb-3">
										<div class="col text-center">
											<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_registrar" id="btn_registrar">Registrar comentario</button>
										</div>
									</div>
									<?php } ?>
								</div>
						<?php if ($_SESSION['tipo'] != "Alumn") {?>
							</form>
						<?php } ?>
						<br>
						<div class="row">
							<div class="text-left col-6">
								<a href="<?php echo $uri_sola . '=4'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a>
							</div>
							<div class="text-right col-6">
								<a href="<?php echo $uri_sola . '=6'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(56)" <?php } ?>>Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a>
							</div>
						</div>
						<br><br>
					</div>
				</div>
			</div>
			<script>
				<?php if ($_SESSION['tipo'] == "Admin") {?>
					$(document).ready(function(){
						var parametros = {
							"seccion" : "5_6",
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
							"seccion" : "5_6",
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
							"seccion" : "5_6",
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
				<?php } ?>
				<?php if ($_SESSION['tipo'] != "Alumn") { ?>
					$("#btn_registrar").hide();
					$("#div_coments_asesor").hide();
					function filtro_empresa(){
						Empresa_ID = document.getElementById("select_empresa").value;
						$("#select_area_emp").val('0');
						$('#result').html('');
						if (Empresa_ID > 0) {
							$("#select_area_emp").prop('disabled', false);
						} else {
							$("#select_area_emp").prop('disabled', true);
						}
					}
					function filtro_area_emp(){
						var Empresa_ID = document.getElementById("select_empresa").value;
						var Area_empresa = document.getElementById("select_area_emp").value;
						var parametros = {
							"Empresa_ID" : Empresa_ID,
							"Area_empresa" : Area_empresa,
						};
						$.ajax({
							data:  parametros,
							url: '../scripts/asesor/tabla_5_6_ajax.php',
							type: 'post',
							success: function(data)
							{
								var array = JSON.parse(data);
								$('#result').html(array.tabla);
								$('#coments_asesor').html(array.coment);
								$('#s_5_6_table').DataTable({
									"pagingType": "simple",
									"pageLength": 100,
									"scrollX": true,
								});
								$('#s_5_6_table_wrapper div.row').addClass('col-sm-12');
								$('.dataTables_length').parent().addClass('d-flex justify-content-start');
								$('.dataTables_filter').parent().addClass('d-flex justify-content-end');
								$('ul.pagination').addClass('pagination-sm');
								$("#div_coments_asesor").show();
								<?php if ($_SESSION['tipo'] == "Volun") { ?>
									$("#btn_registrar").show();
								<?php } ?>
							}
						})
					}
				<?php } ?>
				<?php if ($_SESSION['tipo'] == "Alumn") { ?>
					function filtro_area_emp(){
						var Area_empresa = document.getElementById("select_area_emp").value;
						var parametros = {
							"Area_empresa" : Area_empresa,
						};
						$.ajax({
							data:  parametros,
							url: '../scripts/asesor/tabla_5_6_ajax.php',
							type: 'post',
							success: function(data)
							{
								var array = JSON.parse(data);
								$('#result').html(array.tabla);
								$('#coments_asesor').html(array.coment);
								$('#s_5_6_table').DataTable({
									"pagingType": "simple",
									"pageLength": 100,
									"scrollX": true,
								});
								$('#s_5_6_table_wrapper div.row').addClass('col-sm-12');
								$('.dataTables_length').parent().addClass('d-flex justify-content-start');
								$('.dataTables_filter').parent().addClass('d-flex justify-content-end');
								$('ul.pagination').addClass('pagination-sm');
							}
						})
					}
				<?php } ?>

			</script>