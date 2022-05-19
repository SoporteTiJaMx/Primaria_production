<?php
	include_once('../includes/admin_header.php');
	include_once('../scripts/funciones.php');
	include_once('../admin/side_navbar.php');
	include_once('../scripts/conexion.php');

	if ($_SESSION["tipo"] != "Admin") {
		header('Location: ../error.php');
	} else {

	$_SESSION["token"] = md5(uniqid(mt_rand(), true));
	?>
	<link rel="stylesheet" href="../css/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="../css/responsive.bootstrap4.css">
	<script src="../js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
	<script src="../js/dataTables.bootstrap.min.js" crossorigin="anonymous"></script>
	<script src="../js/dataTables.responsive.min.js" crossorigin="anonymous"></script>
	<script src="../js/responsive.bootstrap4.min.js" crossorigin="anonymous"></script>
	<script src="../js/export_excel.js" crossorigin="anonymous"></script>
	<script src="../js/Chart.js"></script>
	<script src="../js/chartjs-plugin-labels.min.js"></script>

	<?php if (isset($_SESSION["licencia_activa"])) { ?>
	<nav class="mx-5 my-3">
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-crear-tab" data-toggle="tab" href="#nav-crear" role="tab" aria-controls="nav-crear" aria-selected="true">Inicio</a>
			<a class="nav-item nav-link" id="nav-empresas-tab" data-toggle="tab" href="#nav-gestion-empresas" role="tab" aria-controls="nav-gestion-empresas" aria-selected="false">Empresas operación</a>
			<a class="nav-item nav-link" id="nav-graficas_puntos-tab" data-toggle="tab" href="#nav-gestion-graficas_puntos" role="tab" aria-controls="nav-gestion-graficas_puntos" aria-selected="false">Empresas puntajes</a>
			<a class="nav-item nav-link" id="nav-puntos_personal-tab" data-toggle="tab" href="#nav-gestion-puntos_personal" role="tab" aria-controls="nav-gestion-puntos_personal" aria-selected="false">Puntajes individuales</a>
			<?php /*
			<a class="nav-item nav-link" id="nav-puesto-tab" data-toggle="tab" href="#nav-gestion-puesto" role="tab" aria-controls="nav-gestion-puesto" aria-selected="false">puesto</a>
			<a class="nav-item nav-link" id="nav-coord-tab" data-toggle="tab" href="#nav-gestion-coord" role="tab" aria-controls="nav-gestion-coord" aria-selected="false">Coordinadores</a>
			<a class="nav-item nav-link" id="nav-ases-tab" data-toggle="tab" href="#nav-gestion-ases" role="tab" aria-controls="nav-gestion-ases" aria-selected="false">Asesores</a>
			*/?>
		</div>
	</nav>
	<div class="tab-content mx-5 px-3 mb-5" id="nav-tabContent" >
			<!-- Tab principal -->
		<div class="tab-pane fade mb-5 show active" id="nav-crear" role="tabpanel" aria-labelledby="nav-crear-tab">
			<div class="card shadow mb-5 pb-5 min-width:300px">
				<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">TABLERO DE CONTROL PARA: <?php echo mb_strtoupper($_SESSION['centro'],'utf-8') . ", CICLO: " . mb_strtoupper($_SESSION['nombre_licencia'],'utf-8'); ?></div>
				<div class="card-body">
						<div id="result1">
							 <p align='justify'>Este Tablero de Control ayudará en la gestión y el seguimiento de las distintas empresas juveniles y usuarios de la plataforma.</p>
							 <p align='justify'>En las pestañas podrás realizar distintos filtros según el tipo de información que deseas obtener.</p>
						</div>
				</div>
			</div>
		</div>
			<!-- Tab para Gestionar por empresa operaciones-->
		<div class="tab-pane fade mb-5" id="nav-gestion-empresas" role="tabpanel" aria-labelledby="nav-empresas-tab">
			<div class="card shadow mb-5 pb-5 min-width:300px">
				<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">FILTRO POR EMPRESAS DE: <?php echo mb_strtoupper($_SESSION['centro'],'utf-8') . ", CICLO: " . mb_strtoupper($_SESSION['nombre_licencia'],'utf-8'); ?></div>

				<div class="card-body">
					<div class="mx-5">
						Se ofrecen dos filtros:<br><br>
						Filtro <strong>"Todas las Empresas"</strong> en el que se puede ver la información comparada de las actividades de todas las empresas del ciclo, así como sesión por sesión.<br><br>
						Filtro <strong>"[Nombre de la Empresa]"</strong> donde se muestra la actividad personal de cada integrante, sólo en aquellas sesiones donde hay elementos individuales por registrar.<br><br>
						En ambos casos es posible exportar la tabla a excel.
					</div>
					<div class="row pb-1 pt-2">
						<div class="col text-center">
							<button type="button" id="tableToExcel" class="btn btn-warning text-center px-5 my-2" onclick="Exporter.export(tabla, 'DatosEyE.xls','Impulsa'); return false;" disabled>Exportar a Excel</button>
							<?php /*
							<button type="button" id="tableToExcel" class="btn btn-warning text-center px-5 my-2" onclick="tableToExcel('Datos-filtrados','Datos')" disabled>Exportar a Excel</button>
							*/ ?>
						</div>
					</div>
					<div class="form-row pb-1">
						<div class="form-group col-1"></div>
						<div class="form-group row col-8">
							<label for="select_empresa" class="col-sm-3 col-form-label text-right">Empresa:</label>
							<div class="col-sm-9">
							<select name="select_empresa" type="text" id="select_empresa" class="form-control rounded" onChange="filtro_empresa()">
							</select>
							</div>
						</div>
						<div class="form-group col-1"></div>
					</div>
					<div class="form-row pb-1">
						<div class="form-group col-1"></div>
						<div class="form-group row col-8">
							<label for="select_sesion" class="col-sm-3 col-form-label text-right">Sesión:</label>
							<div class="col-sm-9">
							<select name="select_sesion" type="text" id="select_sesion" class="form-control rounded" onChange="filtro_empresa()" disabled>
							</select>
							</div>
						</div>
						<div class="form-group col-1"></div>
					</div>
					<div id="tabla"></div>
				</div>
			</div>
		</div>
			<!-- Tab para Gestionar por empresa puntajes-->
		<div class="tab-pane fade mb-5" id="nav-gestion-graficas_puntos" role="tabpanel" aria-labelledby="nav-graficas_puntos-tab">
			<div class="card shadow mb-5 pb-5 min-width:300px">
				<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">PUNTOS OBTENIDOS POR EMPRESAS JUVENILES DE: <?php echo mb_strtoupper($_SESSION['centro'],'utf-8') . ", CICLO: " . mb_strtoupper($_SESSION['nombre_licencia'],'utf-8'); ?></div>
				<div class="card-body">
					<div class="row pb-1 pt-2">
						<?php /*
						<div class="col text-center">
							<button type="button" id="tableToExcel" class="btn btn-warning text-center px-5 my-2" onclick="Exporter.export(tabla, 'DatosEyE.xls','Impulsa'); return false;" disabled>Exportar a Excel</button>
						</div>
						*/ ?>
					</div>
					<div id="tabla3"></div>
				</div>
			</div>
		</div>
			<!-- Tab para Gestionar por puntajes individuales-->
		<div class="tab-pane fade mb-5" id="nav-gestion-puntos_personal" role="tabpanel" aria-labelledby="nav-puntos_personal-tab">
			<div class="card shadow mb-5 pb-5 min-width:300px">
				<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">PUNTAJES POR PARTICIPANTE DE: <?php echo mb_strtoupper($_SESSION['centro'],'utf-8') . ", CICLO: " . mb_strtoupper($_SESSION['nombre_licencia'],'utf-8'); ?></div>

				<div class="card-body">
					<div class="row pb-1 pt-2">
						<div class="col text-center">
							<button type="button" id="tableToExcel2" class="btn btn-warning text-center px-5 my-2" onclick="Exporter.export(tabla, 'DatosEyE.xls','Impulsa'); return false;" disabled>Exportar a Excel</button>
						</div>
					</div>
					<div class="form-row pb-1">
						<div class="form-group col-1"></div>
						<div class="form-group row col-8">
							<label for="select_empresa2" class="col-sm-3 col-form-label text-right">Empresa:</label>
							<div class="col-sm-9">
							<select name="select_empresa2" type="text" id="select_empresa2" class="form-control rounded" onChange="filtro_empresa2()">
							</select>
							</div>
						</div>
						<div class="form-group col-1"></div>
					</div>
					<div id="tabla2"></div>
				</div>
			</div>
		</div>
		<?php /*
			<!-- Tab para Gestionar por puesto-->
		<div class="tab-pane fade mb-5" id="nav-gestion-puesto" role="tabpanel" aria-labelledby="nav-puesto-tab">
			<div class="card shadow mb-5 pb-5 min-width:300px">
				puesto
			</div>
		</div>
			<!-- Tab para Gestionar por coordinador-->
		<div class="tab-pane fade mb-5" id="nav-gestion-coord" role="tabpanel" aria-labelledby="nav-coord-tab">
			<div class="card shadow mb-5 pb-5 min-width:300px">
				coord
			</div>
		</div>
			<!-- Tab para Gestionar por asesor-->
		<div class="tab-pane fade mb-5" id="nav-gestion-ases" role="tabpanel" aria-labelledby="nav-ases-tab">
			<div class="card shadow mb-5 pb-5 min-width:300px">
				ases
			</div>
		</div>
		*/?>
	</div>
	<script>
		$.ajax({
			url: 'ajax/mis_empresas_filtro.php',
			success: function(data)
			{
				$('#select_empresa').append(data);
				$('#select_empresa2').append(data);
			}
		});
		$.ajax({
			url: 'ajax/sesiones_filtro.php',
			success: function(data)
			{
				$('#select_sesion').append(data);
			}
		});
		function filtro_empresa(){
			var Empresa_ID = document.getElementById("select_empresa").value;
			var Sesion_ID = document.getElementById("select_sesion").value;
			if (Empresa_ID!=0) {
				$("#select_sesion").removeAttr('disabled');
				$("#tableToExcel").removeAttr('disabled');
			} else {
				$("#select_sesion").val(0);
				$("#select_sesion").attr('disabled', 'disabled');
				$("#tableToExcel").attr('disabled', 'disabled');
				$("#tabla").empty();
			}
			var parametros = {
				"Empresa_ID" : Empresa_ID,
				"Sesion_ID" : Sesion_ID,
			};
			$.ajax({
				data:	parametros,
				url: "ajax/tablero_querys.php",
				type: 'post',
				success: function(data)
				{
					$("#tabla").html(data)
					$('#Datos-filtrados').DataTable( {
						"pagingType": "simple",
						"pageLength": 100,
						"scrollX": true,
					} );
					$('#Datos-filtrados_wrapper div.row').addClass('col-sm-12');
				}
			});
		}
		function filtro_empresa2(){
			var Empresa_ID = document.getElementById("select_empresa2").value;
			if (Empresa_ID!=0) {
				$("#tableToExcel2").removeAttr('disabled');
			} else {
				$("#tableToExcel2").attr('disabled', 'disabled');
				$("#tabla2").empty();
			}
			var parametros = {
				"Empresa_ID" : Empresa_ID,
			};
			$.ajax({
				data:	parametros,
				url: "ajax/tablero_individual.php",
				type: 'post',
				success: function(data)
				{
					$("#tabla2").html(data)
					$('#Datos-filtrados2').DataTable( {
						"pagingType": "simple",
						"pageLength": 100,
						"scrollX": true,
						"order": [[1, "desc"]]
					} );
					$('#Datos-filtrados2_wrapper div.row').addClass('col-sm-12');
				}
			});
		}
		$(document).ready(function(){
			if (location.hash) {
				$("a[href='" + location.hash + "']").tab("show");
			}
			$(document.body).on("click", "a[data-toggle='tab']", function(event) {
				location.hash = this.getAttribute("href");
			});

			$.ajax({
				url: "ajax/tablero_empresas.php",
				success: function(data)
				{
					$("#tabla3").html(data)
					$('#Datos-filtrados3').DataTable( {
						"pagingType": "simple",
						"pageLength": 100,
						"scrollX": true,
						"order": [[1, "desc"]]
					} );
					$('#Datos-filtrados3_wrapper div.row').addClass('col-sm-12');
				}
			});
		});
	</script>

<?php } else { ?>
<br>
<br>
<div class="text-center">
		<div style="display: block" class="w-50 py-2 text-center text-dark_gray rounded mx-auto">
				Actualmente no tienes licencia habilitada para revisar el Tablero de Control. Dirígete a <a href="
<?php echo $RAIZ_SITIO; ?>admin/licencias.php"><span class="badge badge-warning text-center px-3 py-2">LICENCIAS</span></a>
				para seleccionar una que se encuentre activa, y en "Acciones" marca la opción de "Habilitar licencia".
		</div>
</div>
<?php }
	}
	include_once('../includes/admin_footer.php');
?>