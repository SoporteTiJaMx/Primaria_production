<?php
	include_once('../includes/asesor_header.php');
	include_once('../scripts/funciones.php');
	include_once('../asesor/side_navbar.php');
	include_once('../scripts/conexion.php');

	if ($_SESSION["tipo"] != 'Volun') {
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

	<!-- <nav class="mx-5 my-3">
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-empresas-tab" data-toggle="tab" href="#nav-gestion-empresas" role="tab" aria-controls="nav-gestion-empresas" aria-selected="false">Activar Sesiones</a>
			<a class="nav-item nav-link" id="nav-graficas_puntos-tab" data-toggle="tab" href="#nav-gestion-graficas_puntos" role="tab" aria-controls="nav-gestion-graficas_puntos" aria-selected="false">Sesiones por grupo</a>
			<a class="nav-item nav-link" id="nav-puntos_personal-tab" data-toggle="tab" href="#nav-gestion-puntos_personal" role="tab" aria-controls="nav-gestion-puntos_personal" aria-selected="false"></a>
		</div>
	</nav> -->
			<div class="card shadow mx-3 mb-5 pb-5">
				<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">AQUÍ PODRÁS ACTIVAR LAS SESIONES DE TUS GRUPOS</div>
				<div class="card-body">
					<p class="text-justify">Selecciona el grupo para poder gestionar las sesiones.</p>
					
					<div class="form-row pb-1">
						<div class="form-group col-1"></div>
						<div class="form-group row col-8">
							<label for="select_grupo" class="col-sm-3 col-form-label text-right">Grupo:</label>
							<div class="col-sm-9">
							<select name="select_grupo" type="text" id="select_grupo" class="form-control rounded" onChange="filtro_grupo()">
							</select>
							</div>
						</div>
						<div class="form-group col-1"></div>
					</div>
					<form action="<?php echo $RAIZ_SITIO; ?>scripts/asesor/activar_sesiones.php" method="post" class="my-4 needs-validation" novalidate>
						<input name="csrf2" type="hidden" id="csrf2" value="<?php echo $_SESSION['token']; ?>">

						
						<div class="tabla-asignar" id="tabla"></div>
					

						<div class="row pb-1">
							<div class="col text-center">
								<?php if ($_SESSION['tipo'] == "Volun") {?>
									<button type="submit" class="btn btn-warning text-center px-5 my-2" name="btn_asignar" id="btn_asignar" >Asignar</button>
								<?php } ?>
							</div>
						</div>
					</form>
				</div>
			</div>

	<div class="tab-content mx-5 px-3 mb-5" id="nav-tabContent" >
			<!-- Tab para Gestionar por empresa operaciones-->
		<div class="tab-pane fade mb-5 show active" id="nav-gestion-empresas" role="tabpanel" aria-labelledby="nav-empresas-tab">
			
		</div>
			<!-- Tab para Gestionar por empresa puntajes-->
		<div class="tab-pane fade mb-5" id="nav-gestion-graficas_puntos" role="tabpanel" aria-labelledby="nav-graficas_puntos-tab">
			<div class="card shadow mb-5 pb-5 min-width:300px">
				<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">PUNTOS OBTENIDOS POR EMPRESAS JUVENILES</div>
				<div class="card-body">
					<div id="tabla31"></div>
				</div>
			</div>
		</div>
			<!-- Tab para Gestionar por puntajes individuales-->
		<div class="tab-pane fade mb-5" id="nav-gestion-puntos_personal" role="tabpanel" aria-labelledby="nav-puntos_personal-tab">
			<div class="card shadow mb-5 pb-5 min-width:300px">
				<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">PUNTAJES POR PARTICIPANTE</div>

				<div class="card-body">
					<div class="form-row pb-1">
						<div class="form-group col-1"></div>
						<div class="form-group row col-8">
							<label for="select_grupo2" class="col-sm-3 col-form-label text-right">Empresa:</label>
							<div class="col-sm-9">
							<select name="select_grupo2" type="text" id="select_grupo2" class="form-control rounded" onChange="filtro_grupo2()">
							</select>
							</div>
						</div>
						<div class="form-group col-1"></div>
					</div>
					<div id="tabla21"></div>
				</div>
			</div>
		</div>

	</div>
	<script>
		$.ajax({
			url: 'ajax/mis_grupos.php',
			success: function(data)
			{
				$('#select_grupo').append(data);
				$('#select_grupo2').append(data);
			}
		});
		$.ajax({
			url: 'ajax/sesiones_filtro.php',
			success: function(data)
			{
				$('#select_sesion').append(data);
			}
		});
		function filtro_grupo(){
			var Grupo_ID = document.getElementById("select_grupo").value;
		
			var parametros = {
				"Grupo_ID" : Grupo_ID
			};
			$.ajax({
				data:	parametros,
				url: "ajax/gestionar_sesiones.php",
				type: 'post',
				success: function(data)
				{
					//alert(data);
					$("#tabla").html(data)
					/* $('#Datos-filtrados').DataTable( {
							"pagingType": "simple",
							"pageLength": 100,
							"scrollX": true,
					} );
					$('#Datos-filtrados_wrapper div.row').addClass('col-sm-12'); */
				}
			});
		}
		function filtro_grupo2(){
			var Grupo_ID = document.getElementById("select_grupo2").value;
			if (Grupo_ID!=0) {
				$("#tableToExcel2").removeAttr('disabled');
			} else {
				$("#tableToExcel2").attr('disabled', 'disabled');
				$("#tabla2").empty();
			}
			var parametros = {
				"Grupo_ID" : Grupo_ID,
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
	include_once('../includes/asesor_footer.php');
?>