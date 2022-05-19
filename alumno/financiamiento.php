<?php
include_once('../includes/alumno_header.php');
include_once('../scripts/funciones.php');
include_once('../alumno/side_navbar.php');
if ($_SESSION["tipo"] != "Alumn") {
	header('Location: ../error.php');
} else {
	$_SESSION["token"] = md5(uniqid(mt_rand(), true));
	
?>
<link rel="stylesheet" href="../css/responsive.bootstrap4.css">
<link rel="stylesheet" href="../css/bootstrap-datepicker.css">


	<div class="card shadow mx-2 my-4">
		<div class="card-header my-2">
			<h5>Accionistas y Donantes</h5>
		</div>
		<div class="card-body py-2 px-2">
			<div id="info_financiamiento"></div>
		</div>
	</div>
    <br><br>
	<script type="text/javascript">
				
        $(document).ready(function(){
			var parametros = {
				"Empresa_ID" : <?php echo $_SESSION['Empresa_ID']; ?>,
			};
		    $.ajax({
				data:  parametros,
				url: 'ajax/empresas_info_financiamiento_data.php',
				type: 'post',
				success: function(data)
				{
				    //alert(data);
					$("#info_financiamiento").html(data);
				}
			});
		});				
	</script>
			
<?php }

include_once('../includes/alumno_footer.php');
?>