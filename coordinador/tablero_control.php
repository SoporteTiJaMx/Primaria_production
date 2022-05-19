<?php
	include_once('../includes/coordinador_header.php');
	include_once('../scripts/funciones.php');
	include_once('../coordinador/side_navbar.php');
	include_once('../scripts/conexion.php');

	if ($_SESSION["tipo"] != 'Coord') {
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
	<script src="../js/Chart.js"></script>
	<script src="../js/chartjs-plugin-labels.min.js"></script>

	<nav class="mx-5 my-3">
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-empresas-tab" data-toggle="tab" href="#nav-gestion-empresas" role="tab" aria-controls="nav-gestion-empresas" aria-selected="false">Empresas operación</a>
			<a class="nav-item nav-link" id="nav-graficas_puntos-tab" data-toggle="tab" href="#nav-gestion-graficas_puntos" role="tab" aria-controls="nav-gestion-graficas_puntos" aria-selected="false">Empresas puntajes</a>
			<a class="nav-item nav-link" id="nav-puntos_personal-tab" data-toggle="tab" href="#nav-gestion-puntos_personal" role="tab" aria-controls="nav-gestion-puntos_personal" aria-selected="false">Puntajes individuales</a>
		</div>
	</nav>

	<div class="tab-content mx-5 px-3 mb-5" id="nav-tabContent" >
			<!-- Tab para Gestionar por empresa operaciones-->
		<div class="tab-pane fade mb-5 show active" id="nav-gestion-empresas" role="tabpanel" aria-labelledby="nav-empresas-tab">
			<div class="card shadow mb-5 pb-5 min-width:300px">
				<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">TABLERO DE CONTROL PARA: <?php echo mb_strtoupper($_SESSION['Escuela_nombre'],'utf-8'); ?></div>
				<div class="card-body">
					<p align='justify'>Este Tablero de Control ayudará en la gestión y el seguimiento de las empresas juveniles asignadas al plantel.</p>
					<div class="mx-5">
						Se ofrecen dos filtros:<br><br>
						Filtro <strong>"Todas las Empresas"</strong> en el que se puede ver la información comparada de las actividades de todas las empresas asignadas a tu escuela, así como sesión por sesión.<br><br>
						Filtro <strong>"[Nombre de la Empresa]"</strong> donde se muestra la actividad personal de cada integrante, así como sus avances en cada sesión seleccionada.<br><br>
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
				<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">PUNTOS OBTENIDOS POR EMPRESAS JUVENILES DE: <?php echo mb_strtoupper($_SESSION['Escuela_nombre'],'utf-8'); ?></div>
				<div class="card-body">
					<div id="tabla3"></div>
				</div>
			</div>
		</div>
			<!-- Tab para Gestionar por puntajes individuales-->
		<div class="tab-pane fade mb-5" id="nav-gestion-puntos_personal" role="tabpanel" aria-labelledby="nav-puntos_personal-tab">
			<div class="card shadow mb-5 pb-5 min-width:300px">
				<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">PUNTAJES POR PARTICIPANTE DE: <?php echo mb_strtoupper($_SESSION['Escuela_nombre'],'utf-8'); ?></div>

				<div class="card-body">
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
			} else {
				$("#select_sesion").val(0);
				$("#select_sesion").attr('disabled', 'disabled');
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
					//alert(data);
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

<?php
	}
	include_once('../includes/coordinador_footer.php');
?>