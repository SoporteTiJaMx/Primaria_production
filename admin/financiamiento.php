<?php
include_once('../includes/admin_header.php');
include_once('../scripts/funciones.php');
include_once('../admin/side_navbar.php');
if ($_SESSION["tipo"] != "Admin") {
	header('Location: ../error.php');
} else {
	$_SESSION["token"] = md5(uniqid(mt_rand(), true));
?>
<link rel="stylesheet" href="../css/responsive.bootstrap4.css">
<link rel="stylesheet" href="../css/bootstrap-datepicker.css">

<?php if(isset($_SESSION["licencia_activa"])){ ?>
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
<?php } else{ ?>
	<div class="card shadow mx-2 my-4">
		<div class="card-header my-2">
			<h5>Accionistas y Donantes</h5>
		</div>
		<div class="card-body py-2 px-2">
			<p class="text-center">Actualmente no tienes licencia habilitada para revisar la sección de Accionistas y Donantes. <br><br> Dirígete a <a href="
				<?php echo $RAIZ_SITIO; ?>admin/licencias.php"><span class="badge badge-warning text-center px-3 py-2">LICENCIAS</span></a>
				para seleccionar una que se encuentre activa, y en "Acciones" marca la opción de "Habilitar licencia".
			</p>
		</div>
	</div>
<?php } ?>
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

include_once('../includes/admin_footer.php');
?>