<?php
	$le_compete = "disabled";
	if ($_SESSION['tipo'] == "Alumn") {
		if ($_SESSION['Puesto_ID'] == 1 OR $_SESSION['Puesto_ID'] == 6) {
			$le_compete = "";
		}
	}
?>
			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 4 <i class="fas fa-angle-right fa-lg fa-fw"></i> Selección de Roles <i class="fas fa-angle-right fa-lg fa-fw"></i> Diseño Organizacional
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Y ahora... ¿Cómo nos organizamos?</h5>
					<div class="card-text px-5">
						<br>
						<p class="text-center bg-success rounded border-success px-2 py-2 text-white">Es momento de organizarnos, después de las entrevistas realizadas con tu mentor(a) comienza aquí a establecer qué rol tendrá cada uno dentro de la empresa, recuerda que esta información es de suma importancia para conocer su diseño organizacional, es decir, la manera en que estarán distribuidas las responsabilidades de cada área. Para organizarnos, la mejor herramienta es hacer un <strong>ORGANIGRAMA</strong>.</p>
						<br>
						<p class="text-justify">Los <strong>organigramas</strong> son la representación gráfica de la estructura orgánica de una empresa u organización que proyecta, en forma esquemática, la posición de las áreas que la integran, sus niveles jerárquicos, líneas de autoridad y asesoría. El objetivo de presentar un organigrama es observar los órganos, áreas y cantidad total de personas que trabajan en la empresa, así como la relación jerárquica que existe entre ellos, ya sean internos o como servicio externo.</p>
						<p class="text-justify">Te mostramos un ejemplo a continuación:</p>
						<div class="row justify-content-center">
							<div class="d-none col-lg-2"></div>
							<div class="col-12 col-lg-8">
								<img src="../sesiones/images/4.5_organigrama.png" alt="Organigrama de Empresa" class="img-fluid">
							</div>
							<div class="d-none col-lg-2"></div>
						</div>
					</div>
					<h5 class="card-title py-2">Designación de Puestos</h5>

					<div class="row justify-content-md-center">
						<div class="col-md-auto px-5 text-center">
						<?php if ($_SESSION["tipo"]=="Alumn") { ?>
							<h5><span class="badge badge-success px-3 py-3 text-wrap"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Realicen la actividad, junto con todas las de la sesión, y obtengan <span class="text-yellow">50 estrellas</span> para su empresa</span></h5>
						<?php } else { ?>
							<h5><span class="badge badge-success px-3 py-3 text-wrap"><i class="far fa-star fa-lg fa-fw"></i>&nbsp;&nbsp;&nbsp; Realizar la actividad, junto con todas las de la sesión, otorga <span class="text-yellow">50 estrellas a la empresa</span></span></h5>
						<?php } ?>
						</div>
					</div>

					<div class="card-text px-5">
						<div class="pb-3">Asigna a quienes encabezarán cada una de las áreas de la empresa y, en su caso, sus respectivas gerencias. En este momento, dependiendo de las entrevistas y postulación de cada integrante, incluso se puede designar a un nuevo Director General.</div>
						<div class="text-orange text-center pb-3">NOTA. Esta sección podrá ser llenada por el <strong>Director General</strong> o el <strong>Director de Recursos Humanos</strong> de la Empresa, una vez que éste sea designado en esta misma sección.</div>
					</div>

					<form action="<?php echo $RAIZ_SITIO; ?>scripts/alumno/registrar_4_5.php" method="post" class="mt-1 mb-5">
						<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">

						<?php if ($_SESSION['tipo'] != "Alumn") {?>
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


						<div class="row mx-2 mb-2">
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="pb-3"><strong><i>Directores de Área</i></strong></div>
										<div class="form-row pb-1 pl-3">
											<label for="select_dir_gral" class="col-sm-4 col-form-label text-left">Dir. General:</label>
											<div class="col-sm-8">
												<select name="select_dir_gral" type="text" id="select_dir_gral" class="form-control rounded" <?php echo $le_compete; ?>>
												</select>
											</div>
										</div>
										<div class="form-row pb-1 pl-3">
											<label for="select_dir_rrhh" class="col-sm-4 col-form-label text-left">Dir. de RRHH:</label>
											<div class="col-sm-8">
												<select name="select_dir_rrhh" type="text" id="select_dir_rrhh" class="form-control rounded" <?php echo $le_compete; ?>>
												</select>
											</div>
										</div>
										<div class="form-row pb-1 pl-3">
											<label for="select_dir_fnzs" class="col-sm-4 col-form-label text-left">Dir. de Finanzas:</label>
											<div class="col-sm-8">
												<select name="select_dir_fnzs" type="text" id="select_dir_fnzs" class="form-control rounded" <?php echo $le_compete; ?>>
												</select>
											</div>
										</div>
										<div class="form-row pb-1 pl-3">
											<label for="select_dir_mktg" class="col-sm-4 col-form-label text-left">Dir. de Marketing:</label>
											<div class="col-sm-8">
												<select name="select_dir_mktg" type="text" id="select_dir_mktg" class="form-control rounded" <?php echo $le_compete; ?>>
												</select>
											</div>
										</div>
										<div class="form-row pb-1 pl-3">
											<label for="select_dir_vnts" class="col-sm-4 col-form-label text-left">Dir. de Ventas:</label>
											<div class="col-sm-8">
												<select name="select_dir_vnts" type="text" id="select_dir_vnts" class="form-control rounded" <?php echo $le_compete; ?>>
												</select>
											</div>
										</div>
										<div class="form-row pb-1 pl-3">
											<label for="select_dir_prod" class="col-sm-4 col-form-label text-left">Dir. de Producción:</label>
											<div class="col-sm-8">
												<select name="select_dir_prod" type="text" id="select_dir_prod" class="form-control rounded" <?php echo $le_compete; ?>>
												</select>
											</div>
										</div>

									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="pb-3"><strong><i>Gerentes de Área</i></strong></div>
										<div class="form-row pb-1 pl-3">
											<label for="select_grnt_gral" class="col-sm-4 col-form-label text-left">Gte. de Resp. Social:</label>
											<div class="col-sm-8">
												<select name="select_grnt_gral" type="text" id="select_grnt_gral" class="form-control rounded" <?php echo $le_compete; ?>>
												</select>
											</div>
										</div>
										<div class="form-row pb-1 pl-3">
											<label for="select_grnt_rrhh" class="col-sm-4 col-form-label text-left">Gte. de RRHH:</label>
											<div class="col-sm-8">
												<select name="select_grnt_rrhh" type="text" id="select_grnt_rrhh" class="form-control rounded" <?php echo $le_compete; ?>>
												</select>
											</div>
										</div>
										<div class="form-row pb-1 pl-3">
											<label for="select_grnt_fnzs" class="col-sm-4 col-form-label text-left">Gte. de Finanzas:</label>
											<div class="col-sm-8">
												<select name="select_grnt_fnzs" type="text" id="select_grnt_fnzs" class="form-control rounded" <?php echo $le_compete; ?>>
												</select>
											</div>
										</div>
										<div class="form-row pb-1 pl-3">
											<label for="select_grnt_mktg" class="col-sm-4 col-form-label text-left">Gte. de Marketing:</label>
											<div class="col-sm-8">
												<select name="select_grnt_mktg" type="text" id="select_grnt_mktg" class="form-control rounded" <?php echo $le_compete; ?>>
												</select>
											</div>
										</div>
										<div class="form-row pb-1 pl-3">
											<label for="select_grnt_vnts" class="col-sm-4 col-form-label text-left">Gte. de Ventas:</label>
											<div class="col-sm-8">
												<select name="select_grnt_vnts" type="text" id="select_grnt_vnts" class="form-control rounded" <?php echo $le_compete; ?>>
												</select>
											</div>
										</div>
										<div class="form-row pb-1 pl-3">
											<label for="select_grnt_prod" class="col-sm-4 col-form-label text-left">Gte. de Producción:</label>
											<div class="col-sm-8">
												<select name="select_grnt_prod" type="text" id="select_grnt_prod" class="form-control rounded" <?php echo $le_compete; ?>>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row pb-1">
							<div class="col text-center">
								<?php if ($_SESSION['tipo'] == "Alumn" AND ($_SESSION['Puesto_ID'] == 1 OR $_SESSION['Puesto_ID'] == 6)) { ?>
									<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_registrar" id="btn_registrar" <?php echo $_SESSION['enable_disable']; ?>>Asignar puestos</button>
									<button type="button" class="btn btn-warning text-center px-5 my-2" name="limpiar" id="limpiar" onclick="location.reload()">Limpiar</button>
								<?php } ?>
								<?php if ($_SESSION['tipo'] == "Admin") { ?>
									<div class="px-5">
										<div class="text-orange text-center pb-3">NOTA. <strong>Administrador</strong> una vez que selecciones una empresa, podrás modificar los puestos de sus integrantes.</div>
									</div>
									<button type="button" class="btn btn-warning text-center px-5 my-2" name="btn_modif" id="btn_modificar" onclick="modif_puestos();" disabled>Permitir modificar puestos</button>
									<input type="hidden" name="Empresa_ID_Admin" id="Empresa_ID_Admin" value="">
									<button type="submit" class="btn btn-warning text-center px-5 my-2" name="admi_registrar" id="admi_registrar" disabled>Registrar puestos modificados</button>
									<button type="button" class="btn btn-warning text-center px-5 my-2" name="modif_cancel" id="modif_cancel" disabled onclick="cancel_modif_admi();">Cancelar modificación</button>
								<?php } ?>
							</div>
						</div>
					</form>

					<h5 class="card-title">Organigrama</h5>
					<div class="pb-3 mb-3">
						<div id="organigrama"></div>
					</div>
					<div class="card-text px-5">
						<div class="row">
							<div class="text-left col-6">
								<a href="<?php echo $uri_sola . '=3'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a>
							</div>
							<div class="text-right col-6">
								<a href="<?php echo $uri_sola . '=5'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(45)" <?php } ?>>Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				<?php if ($_SESSION['tipo'] == "Admin") {?>
					$(document).ready(function(){
						$.ajax({
						  url: '../admin/ajax/mis_empresas.php',
						  success: function(data)
						  {
							$('#select_empresa').append(data);
						  }
						});
					});

					function modif_puestos(){
						$('#select_dir_gral').removeAttr("disabled");
						$('#select_dir_rrhh').removeAttr("disabled");
						$('#select_dir_fnzs').removeAttr("disabled");
						$('#select_dir_mktg').removeAttr("disabled");
						$('#select_dir_vnts').removeAttr("disabled");
						$('#select_dir_prod').removeAttr("disabled");
						$('#select_grnt_gral').removeAttr("disabled");
						$('#select_grnt_rrhh').removeAttr("disabled");
						$('#select_grnt_fnzs').removeAttr("disabled");
						$('#select_grnt_mktg').removeAttr("disabled");
						$('#select_grnt_vnts').removeAttr("disabled");
						$('#select_grnt_prod').removeAttr("disabled");
						$('#admi_registrar').removeAttr("disabled");
						$('#modif_cancel').removeAttr("disabled");

					};
					function cancel_modif_admi(){
						$('#select_dir_gral').attr("disabled", true);
						$('#select_dir_rrhh').attr("disabled", true);
						$('#select_dir_fnzs').attr("disabled", true);
						$('#select_dir_mktg').attr("disabled", true);
						$('#select_dir_vnts').attr("disabled", true);
						$('#select_dir_prod').attr("disabled", true);
						$('#select_grnt_gral').attr("disabled", true);
						$('#select_grnt_rrhh').attr("disabled", true);
						$('#select_grnt_fnzs').attr("disabled", true);
						$('#select_grnt_mktg').attr("disabled", true);
						$('#select_grnt_vnts').attr("disabled", true);
						$('#select_grnt_prod').attr("disabled", true);
						$('#admi_registrar').attr("disabled", true);
						$('#modif_cancel').attr("disabled", true);
					};
				<?php } else if ($_SESSION['tipo'] == "Coord") {?>
					$(document).ready(function(){
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
						$.ajax({
						  url: '../alumno/ajax/empresarios.php',
						  success: function(data)
						  {
							$('#select_dir_gral').append(data);
							$('#select_dir_rrhh').append(data);
							$('#select_dir_fnzs').append(data);
							$('#select_dir_mktg').append(data);
							$('#select_dir_vnts').append(data);
							$('#select_dir_prod').append(data);
							$('#select_grnt_gral').append(data);
							$('#select_grnt_rrhh').append(data);
							$('#select_grnt_fnzs').append(data);
							$('#select_grnt_mktg').append(data);
							$('#select_grnt_vnts').append(data);
							$('#select_grnt_prod').append(data);
						  }
						});
						$.ajax({
						  url: '../alumno/ajax/empresas_info_s4_5_data.php',
						  success: function(data)
						  {
							var array = JSON.parse(data);
							$("#organigrama").html(array[1]);
							$('#select_dir_gral').val(array[0][1]);
							$('#select_dir_rrhh').val(array[0][6]);
							$('#select_dir_fnzs').val(array[0][2]);
							$('#select_dir_mktg').val(array[0][3]);
							$('#select_dir_vnts').val(array[0][4]);
							$('#select_dir_prod').val(array[0][5]);
							$('#select_grnt_gral').val(array[0][12]);
							$('#select_grnt_rrhh').val(array[0][11]);
							$('#select_grnt_fnzs').val(array[0][7]);
							$('#select_grnt_mktg').val(array[0][8]);
							$('#select_grnt_vnts').val(array[0][9]);
							$('#select_grnt_prod').val(array[0][10]);
						  }
						});
					});

				<?php

				}

				if ($_SESSION['tipo'] != "Alumn") { ?>
					function filtro_empresa(){
						var Empresa_ID = document.getElementById("select_empresa").value;
						var parametros = {
							"Empresa_ID" : Empresa_ID,
						};
						<?php if($_SESSION['tipo'] == "Admin"){ ?>
							$('#btn_modificar').removeAttr("disabled");
							$('#Empresa_ID_Admin').attr("value", Empresa_ID);
						<?php } ?>
						if (Empresa_ID == 0) {
							$('#btn_modificar').attr("disabled", true);
						}
						$.ajax({
						  data:  parametros,
						  url: '../alumno/ajax/empresarios.php',
						  type: 'post',
						  success: function(data)
						  {
							$('#select_dir_gral').empty();
							$('#select_dir_rrhh').empty();
							$('#select_dir_fnzs').empty();
							$('#select_dir_mktg').empty();
							$('#select_dir_vnts').empty();
							$('#select_dir_prod').empty();
							$('#select_grnt_gral').empty();
							$('#select_grnt_rrhh').empty();
							$('#select_grnt_fnzs').empty();
							$('#select_grnt_mktg').empty();
							$('#select_grnt_vnts').empty();
							$('#select_grnt_prod').empty();

							$('#select_dir_gral').append(data);
							$('#select_dir_rrhh').append(data);
							$('#select_dir_fnzs').append(data);
							$('#select_dir_mktg').append(data);
							$('#select_dir_vnts').append(data);
							$('#select_dir_prod').append(data);
							$('#select_grnt_gral').append(data);
							$('#select_grnt_rrhh').append(data);
							$('#select_grnt_fnzs').append(data);
							$('#select_grnt_mktg').append(data);
							$('#select_grnt_vnts').append(data);
							$('#select_grnt_prod').append(data);
						  }
						});
						$.ajax({
						  data:  parametros,
						  url: '../alumno/ajax/empresas_info_s4_5_data.php',
						  type: 'post',
						  success: function(data)
						  {
							var array = JSON.parse(data);
							$("#organigrama").html(array[1]);
							$('#select_dir_gral').val(array[0][1]);
							$('#select_dir_rrhh').val(array[0][6]);
							$('#select_dir_fnzs').val(array[0][2]);
							$('#select_dir_mktg').val(array[0][3]);
							$('#select_dir_vnts').val(array[0][4]);
							$('#select_dir_prod').val(array[0][5]);
							$('#select_grnt_gral').val(array[0][12]);
							$('#select_grnt_rrhh').val(array[0][11]);
							$('#select_grnt_fnzs').val(array[0][7]);
							$('#select_grnt_mktg').val(array[0][8]);
							$('#select_grnt_vnts').val(array[0][9]);
							$('#select_grnt_prod').val(array[0][10]);
						  }
						});
					}
				<?php } ?>
			</script>