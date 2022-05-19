<?php
	include_once('../includes/vinculador_header.php');
	include_once('../scripts/funciones.php');
	include_once('../vinculador/side_navbar.php');
	include_once('../scripts/conexion.php');

	if ($_SESSION["tipo"] != 'Vincu') {
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
	<script src="../js/tableToExcel.js" crossorigin="anonymous"></script>

	<div class="tab-content mx-5 px-3 mb-5 mt-2">
		<div class="tab-pane fade mb-5 show active">
			<div class="card shadow mb-5 pb-5 min-width:300px">
				<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">TABLERO DE CONTROL PARA: <?php echo mb_strtoupper($_SESSION['Escuela_nombre'],'utf-8'); ?></div>
				<div class="card-body">
					<p align='justify'>Este Tablero de Control ayudará en la gestión y el seguimiento de las empresas juveniles asignadas al plantel.</p>
					<div class="mx-5">
						Se ofrecen dos filtros:<br><br>
						Filtro <strong>"Todas las Empresas"</strong> en el que se puede ver la información comparada de las actividades de todas las empresas del ciclo, así como sesión por sesión.<br><br>
						Filtro <strong>"[Nombre de la Empresa]"</strong> donde se muestra la actividad personal de cada integrante, sólo en aquellas sesiones donde hay elementos individuales por registrar.<br><br>
						En ambos casos es posible exportar la tabla a excel.
					</div>
					<div class="row pb-1 pt-2">
						<div class="col text-center">
							<button type="button" id="tableToExcel" class="btn btn-warning text-center px-5 my-2" onclick="tableToExcel('Datos-filtrados','Datos')" disabled>Exportar a Excel</button>
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

	</div>
	<script>
		$.ajax({
			url: 'ajax/mis_empresas_filtro.php',
			success: function(data)
			{
				$('#select_empresa').append(data);
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
	</script>

<?php
	}
	include_once('../includes/vinculador_footer.php');
?>