<?php
$le_compete = "disabled";
if ($_SESSION['tipo']=="Alumn" AND ($_SESSION['Puesto_ID'] == 3 OR $_SESSION['Puesto_ID'] == 4 OR $_SESSION['Puesto_ID'] == 8 OR $_SESSION['Puesto_ID'] == 9)) { //Areas de ventas y marketing
	$le_compete = "";
}
?>
			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 6 <i class="fas fa-angle-right fa-lg fa-fw"></i> Factibilidad Técnica <i class="fas fa-angle-right fa-lg fa-fw"></i> Canales de Distribución
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Canales de Distribución</h5>
					<div class="card-text pl-5 pr-5">
						<p class="text-justify">Como último punto de la factibilidad técnica están los <strong>Canales de Distribución </strong>:</p>
						<div class="card bg-success border-success px-3 py-3 mb-3">
							<p class="text-justify text-white"><b>Canales de Distribución</b>.</p>
							<p class="text-justify text-white">Son los medios a través de los cuales se harán llegar los productos o servicios al consumidor final.Los canales dependerán delo lossegmento quese hayandefinido; deben elegirse cuidadosamente para encontrar el más efectivo: canales directos, mayoristas, puntos de venta propios, catálogos o páginas de internet.</p>
						</div>
						<p class="text-justify">Los canales están clasificados de la siguiente manera:</p>
						<div class="row justify-content-center">
							<div class="d-none col-lg-2"></div>
							<div class="col-12 col-lg-8">
								<img src="../sesiones/images/6.6_canales_distribucion.png" alt="canales" class="img-fluid">
							</div>
							<div class="d-none col-lg-2"></div>
						</div>
						<br>
						<p class="text-justify">Ejemplo. Producto: Perfumes ecológicos “ROLLROSE"</p>
						<div class="row justify-content-center">
							<div class="d-none col-lg-1"></div>
							<div class="col-12 col-lg-10">
								<table class="table table-bordered table-responsive">
									<thead class="">
										<tr>
											<th>Canal</th>
											<th>Tipo de canal</th>
											<th>Ejemplo</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td  class="text-left">RedPack</td>
											<td>Indirecto</td>
											<td>Plataforma que recoge los productos en su lugar de elaboración y entrega a los compradores finales.<br>Costo Aprox. 60 –120 pesos</td>
										</tr>
										<tr>
											<td  class="text-left">Estética "Rosita"</td>
											<td>Canal distribuidor - productor</td>
											<td>Vender el producto a estéticas locales que lo puedan revender entre sus clientas.<br>Costo: Venta mínima por docena</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="d-none col-lg-1"></div>
						</div>
						<p class="text-justify">Con base en la información anterior, selección los canales ideales para hacer llegar su producto o servicio a los clientes potenciales.</p>
						<p class="text-justify">Ahora con tu equipo, define al menos 1 y hasta 4 canales de distribución que van a trabajar para hacer llegar el producto al consumidor final. Si defines más de 4 canales, todos ellos los podrás ingresar en tu bloque de canvas respectivo.</p>
						<p class="text-justify">No olviden considerar:</p>
						<div class="mx-5">
							<i class="fas fa-check fa-lg fa-fw text-pale-green"></i>Las características de los clientes.<br><br>
							<i class="fas fa-check fa-lg fa-fw text-pale-green"></i>El producto o servicio que ofreces.<br><br>
							<i class="fas fa-check fa-lg fa-fw text-pale-green"></i>Los Intermediarios (si los hubiera).<br><br>
							<i class="fas fa-check fa-lg fa-fw text-pale-green"></i>La competencia.<br><br>
						</div>
						<p class="text-justify">El personal del <b>Área de Ventas y del Área de Marketing</b>, coordinados, deberán ingresar la información de estos Canales de Distribución.</p>

						<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/registrar_6_6.php" method="post" class="mt-1">
							<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
							<input name="Empresa_ID" type="hidden" id="Empresa_ID" value="<?php if ($_SESSION['tipo'] == "Alumn") { echo $_SESSION['Empresa_ID']; } else { echo ""; } ?>">

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

							<div class="row justify-content-center">
								<div class="d-none col-lg-1"></div>
								<div class="col-12 col-lg-10">
									<table class="table table-hover">
										<thead class="">
											<tr>
												<th>No.</th>
												<th>Canal</th>
												<th>Tipo de canal</th>
												<th>Ejemplo</th>
											</tr>
										</thead>
										<tbody>
											<?php for ($i=1; $i <=4 ; $i++) { ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><textarea class="form-control" id="canal_<?php echo $i; ?>" name="canal_<?php echo $i; ?>" rows="2" <?php echo $le_compete; ?>></textarea></td>
												<td><textarea class="form-control" id="tipo_canal_<?php echo $i; ?>" name="tipo_canal_<?php echo $i; ?>" rows="2" <?php echo $le_compete; ?>></textarea></td>
												<td><textarea class="form-control" id="ejemplo_canal_<?php echo $i; ?>" name="ejemplo_canal_<?php echo $i; ?>" rows="2" <?php echo $le_compete; ?>></textarea></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
								<div class="d-none col-lg-1"></div>
							</div>

							<div class="form-row pb-1">
								<div class="form-group col-2"></div>
								<div class="form-group col-8">
									<?php if ($_SESSION['tipo'] == "Alumn" AND isset($_SESSION["sesion6_6"]) AND $_SESSION["sesion6_6"]==1) { ?><i class="fas fa-exclamation-circle fa-lg fa-fw faa-burst animated"></i><?php } ?>
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
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_canales" id="btn_canales" disabled>Registrar comentario</button>
									<?php } else if ($_SESSION['tipo'] == "Alumn") { ?>
										<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_canales" id="btn_canales" <?php echo $le_compete; ?>>Agregar 'Canales'</button>
									<?php } ?>
								</div>
							</div>
						</form>

						<p class="text-justify">Con lo trabajado en esta sesión, en la sección de Actividades deberán continuar con el llenado de su modelo canvas</p>

						<div class="row">
							<div class="text-left col-6"><a href="<?php echo $uri_sola . '=4'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a></div>

							<div class="text-right col-6"><a href="<?php echo $uri_sola . '=6'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(66)" <?php } ?>>Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a></div>
						</div>
					</div>

				</div>
			</div>

			<script type="text/javascript">
				<?php if ($_SESSION['tipo'] == "Admin") {?>
					$(document).ready(function(){
						var parametros = {
							"seccion" : "6_6",
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
							"seccion" : "6_6",
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
							"seccion" : "6_6",
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
						  url: '../alumno/ajax/empresas_info_s6_6_data.php',
						  type: 'post',
						  success: function(data)
						  {
							var array = JSON.parse(data);
							$("#coments_asesor").html(array[1]);
							for (var i = 1; i <= 4; i++) {
								$("#canal_"+i).html(array[0][i-1]['canal']);
								$("#tipo_canal_"+i).html(array[0][i-1]['tipo_canal']);
								$("#ejemplo_canal_"+i).html(array[0][i-1]['ejemplo_canal']);
							}
							if (array[0] != "") {
								$("#btn_canales").text("Actualizar 'Canales'");
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
						$('#btn_canales').prop('disabled', false);

						$.ajax({
						  data:  parametros,
						  url: '../alumno/ajax/empresas_info_s6_6_data.php',
						  type: 'post',
						  success: function(data)
						  {
							var array = JSON.parse(data);
							$("#coments_asesor").html(array[1]);
							for (var i = 1; i <= 4; i++) {
								$("#canal_"+i).html(array[0][i-1]['canal']);
								$("#tipo_canal_"+i).html(array[0][i-1]['tipo_canal']);
								$("#ejemplo_canal_"+i).html(array[0][i-1]['ejemplo_canal']);
							}
							if (array[0] != "") {
								<?php if ($_SESSION['tipo'] == "Volun") {?>
									$("#btn_canales").text("Actualizar comentario");
									if (Empresa_ID > 0) {
										$('#btn_canales').prop('disabled', false);
									}
								<?php } ?>
							}
							if (Empresa_ID == 0) {
								$('#btn_canales').prop('disabled', true);
							}
						  }
						});
					}
				<?php } ?>
			</script>