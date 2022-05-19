<?php
include_once('../includes/coordinador_header.php');
include_once('../scripts/funciones.php');
include_once('../coordinador/side_navbar.php');
if ($_SESSION["tipo"] != "Coord") {
	header('Location: ../error.php');
} else {
	$_SESSION["token"] = md5(uniqid(mt_rand(), true));
	include_once('../scripts/conexion.php');
	$datos = mysqli_fetch_row(mysqli_query($con, "SELECT Licencia_nombre FROM licencias WHERE Licencia_ID=" . $_SESSION['Licencia_ID']));
	$_SESSION['licencia_nombre'] = $datos[0];
?>
<link rel="stylesheet" href="../css/responsive.bootstrap4.css">
<link rel="stylesheet" href="../css/bootstrap-datepicker.css">


	<div class="card shadow mx-2 my-4">
		<div class="card-header my-2">
			<h5>Accionistas y Donantes</h5>
		</div>
		<div class="card-body py-2 px-2">
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
			<div id="info_financiamiento"></div>
		</div>
	</div>
    <br><br>
	<script type="text/javascript">
				
		$(document).ready(function(){
			$.ajax({
				url: 'ajax/mis_empresas.php',
				success: function(data)
					{
						$('#select_empresa').append(data);
				    }
			});
		});
		function filtro_empresa(){
			var parametros = {
				"Empresa_ID" : document.getElementById("select_empresa").value,
			};
			$.ajax({
				data:  parametros,
				url: '../alumno/ajax/empresas_info_financiamiento_data.php',
				type: 'post',
				success: function(data)
					{
						//alert(data);
						$("#info_financiamiento").html(data);
					}
			});
		}				
	</script>
			
<?php }

include_once('../includes/coordinador_footer.php');
?>