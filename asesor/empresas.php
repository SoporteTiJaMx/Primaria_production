<?php
	include_once('../includes/asesor_header.php');
	include_once('../scripts/funciones.php');
	include_once('../asesor/side_navbar.php');

	if ($_SESSION["tipo"] != "Volun") {
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


<div class="mx-5 px-5 mt-3 mb-5 pb-5">

	<?php if (isset($_SESSION['num_empresas']) AND $_SESSION['num_empresas'] > 0) { ?>
		<h5 class="text-center text-dark_gray pt-1 pb-1"><?php if (isset($_SESSION['licencia_nombre'])) { echo " " . $_SESSION['licencia_nombre']; } ?></h5>
	<?php } ?>

	<h6 class="text-center text-dark_gray pt-1 pb-1">Actualmente asesoras <strong><?php if (isset($_SESSION['num_empresas']) AND $_SESSION['num_empresas'] > 0){ echo $_SESSION['num_empresas']; } else { echo 0;} ?></strong> Empresas Juveniles.</h6>
	<?php if (isset($_SESSION['num_empresas']) AND $_SESSION['num_empresas'] > 0) { ?>

		<h6 class="text-center text-dark_gray pt-1 pb-1">A continuación puedes revisar su información general.</h6>

	<?php } else { ?>

		<h6 class="text-center text-dark_gray pt-1 pb-1">Ponte en contacto con JA México para que te vinculen a una Empresa Juvenil.</h6>

	<?php } ?>

	<div class="card shadow mb-5 pb-5 min-width:300px">
		<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">EMPRESAS JUVENILES</div>
		<div class="card-body">
			<div id="empresas_juveniles"></div>
		</div>
	</div>

</div>

<script type="text/javascript">

	$(document).ready(function(){

		var parametros = {
			"Asesor_ID" : <?php echo $_SESSION['Asesor_ID']; ?>,
		};

		$.ajax({ //Empresas juveniles
			data:	parametros,
			url: '../asesor/ajax/empresas_juveniles.php',
			type: 'post',
			success: function(data)
			{
				$('#empresas_juveniles').html(data)
			$('#empresas_juveniles_table').DataTable( {
				"paging": false,
				"info": false,
				"searching": false,
				responsive: true,
			} );
			$('#empresas_juveniles_table_wrapper div.row').addClass('col-sm-12');

			}
		});

		$('.dataTables_length').parent().addClass('d-flex justify-content-start');
		$('.dataTables_filter').parent().addClass('d-flex justify-content-end');

	});

</script>

<?php
	}
	include_once('../includes/asesor_footer.php');
?>

