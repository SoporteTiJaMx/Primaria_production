			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 4 <i class="fas fa-angle-right fa-lg fa-fw"></i> Selección de Roles <i class="fas fa-angle-right fa-lg fa-fw"></i> Revisión
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Revisión</h5>
					<div class="card-text px-5">
						<p class="text-justify">En esta sección podrás filtrar por cada empresa, para revisar los avances de los jóvenes emprendedores en esta sesión.</p>
						<p class="text-justify">Podrás ver si han realizado, o no, su Test de Perfil, así como si han subido su CV y que puesto le ha asignado en la estructura organizacional.</p>
						<p class="text-justify">A continuación selecciona a la empresa que deseas revisar:</p>
						<div class="text-center mb-3"><div id="actualizados" style="display: none" class="bg-success w-50 py-2 text-center text-white rounded mx-auto mb-2"></div></div>
						<div class="form-row">
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
					</div>
				</div>
				<div class="px-5">
					<div id="result" class="py-1"></div>
				</div>
				<div class="card-body px-5">
					<div class="card-text px-5">
						<div class="row">
							<div class="text-left col-6"><a href="<?php echo $uri_sola . '=5'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a></div>
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
				<?php } ?>
				<?php if ($_SESSION['tipo'] != "Alumn") { ?>
					function filtro_empresa(){
						var Empresa_ID = document.getElementById("select_empresa").value;
						var parametros = {
							"Empresa_ID" : Empresa_ID,
						};
						$.ajax({
							data:  parametros,
							url: '../scripts/asesor/tabla_4_7_ajax.php',
							type: 'post',
							success: function(data)
							{
								$('#result').html(data);
								$('#s_4_7_table').DataTable({
									"pagingType": "simple",
									"pageLength": 100,
									"scrollX": true,
								});
								$('#s_4_7_table_wrapper div.row').addClass('col-sm-12');
								$('.dataTables_length').parent().addClass('d-flex justify-content-start');
								$('.dataTables_filter').parent().addClass('d-flex justify-content-end');
								$('ul.pagination').addClass('pagination-sm');
							}
						})
					}
				<?php } ?>
			</script>