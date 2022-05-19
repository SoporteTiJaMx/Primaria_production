<?php
	include_once('../includes/admin_header.php');
	include_once('../scripts/funciones.php');
	include_once('../admin/side_navbar.php');

	if ($_SESSION["tipo"] != "Admin") {
		header('Location: ../error.php');
	} else {

	$_SESSION["token"] = md5(uniqid(mt_rand(), true));
?>


<div class="toast" data-delay="7000" style="position: fixed; top: 10%; right: 2%; z-index: 2000;">
	<div class="toast-header">
		<strong class="mr-auto text-primary">¡Habilita y/o nombra tus licencias!</strong>
		<small class="text-muted"></small>
		<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
	</div>
	<div class="toast-body">
		<p>Este nombre es como la identificarás en tu operación, por ejemplo: "Ciclo 20xx-20xx en <?php echo $_SESSION["centro"]; ?>", "Generación XXXX de Emprendedores y Empresarios en <?php echo $_SESSION["centro"]; ?>".</p>
		<p>Da click en el botón <i class='fas fa-edit text-dark-gray'></i> de la licencia que desees modificar/activar.</p>
		<p>Puedes habilitar la licencia activa que desees para gestionar su operación.</p>
		<p>Una vez activada una licencia, ya no es posible inactivarla.</p>
	</div>
</div>

<link rel="stylesheet" href="../css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="../css/responsive.bootstrap4.css">
<script src="../js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.responsive.min.js" crossorigin="anonymous"></script>
<script src="../js/responsive.bootstrap4.min.js" crossorigin="anonymous"></script>

<div class="mx-5 px-5 mt-3 mb-5 pb-5">
	<div class="card shadow mb-5 pb-5 min-width:300px">
		<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">LICENCIAS ADQUIRIDAS</div>
		<div class="card-body">
			<?php if (!isset($_SESSION["licencia_activa"]) || $_SESSION["licencia_activa"]==0) { ?>
				<div class="text-center"><div id="error" style="display: block" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto">Actualmente no tienes licencia habilitada para operar. Selecciona la "Acción" de licencia "Activa" que deseas usar y marca la opción de "Habilitar licencia".</div></div>
			<?php } ?>

		<div id="result"></div>
		</div>
	</div>
</div>

<!-- Modal y Toast de activar licencia -->
<div class="modal fade" tabindex="-1" id="modalLicencia" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Modificar / activar / habilitar licencia</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="form-row pb-1">
						<div class="form-group col-2"></div>
						<div class="form-group col-8">
							<input name="Licencia_ID_modificada" type="hidden" id="Licencia_ID_modificada" value="">
							<input name="Licencia_duracion" type="hidden" id="Licencia_duracion" value="">
							<input name="Licencia_inicio" type="hidden" id="Licencia_inicio" value="">
							<div class="form-group">
								<label for="Licencia_nombre" class="control-label">Nombre:</label>
								<input name="Licencia_nombre" type="text" id="Licencia_nombre" aria-describedby="licencia_help" class="form-control rounded" value="">
								<small id="licencia_help" class="form-text w200">Como identificarás esta licencia en tu operación cotidiana.</small>
							</div>
							<div class="form-group">
								<label for="nuevo_estatus" class="control-label">Estatus:</label>
								<select name="nuevo_estatus" type="text" id="nuevo_estatus" class="form-control rounded" aria-describedby="nuevo_estatus_help" disabled>
									<option value="1">Activa</option>
									<option value="2">Inactiva</option>
								</select>
								<small id="nuevo_estatus_help" class="form-text w200">Activa tu licencia para comenzar a utilizarla. Una vez activada no será posible inactivarla.</small>
							</div>
							<div class="checkbox checkbox-green">
								<input type="checkbox" class="custom-control-input" id="habilitarLicencia" style='cursor:pointer'>
								<label class="custom-control-label" for="habilitarLicencia" style='cursor:pointer'>Habilita esta licencia para gestionarla (es necesaria licencia activa).</label>
							</div>
						<div class="form-group col-2"></div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-warning submitBtn" onclick="modificar_licencia()">Modificar licencia</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function(){
		$.ajax({
		  url: '../scripts/ajax/licencias_admin_ajax.php',
		  success: function(data)
		  {
		  	$('#result').html(data)
			$('#licencias_table').DataTable( {
				"pagingType": "simple",
				responsive: true,
				"pageLength": 100,
				"order": [[ 3, "desc" ]]
			} );
			$('#licencias_table_wrapper div.row').addClass('col-sm-12');
			$('.dataTables_length').parent().addClass('d-flex justify-content-start');
			$('.dataTables_filter').parent().addClass('d-flex justify-content-end');
			$('ul.pagination').addClass('pagination-sm');
			$('[data-toggle="tooltip"]').tooltip();

			$('.modificar_licencia i').click(function(){
				$('#Licencia_ID_modificada').val($(this).data('licencia'));
				$('#Licencia_duracion').val($(this).data('duracion'));
				$('#Licencia_inicio').val($(this).data('inicio'));
				$('#Licencia_nombre').val($(this).data('nombre'));
				$('#nuevo_estatus').val($(this).data('estatus')).change();
				if ($(this).data('estatus') == 1) {  //Activa
					$('#nuevo_estatus').prop('disabled', true);
					$('#habilitarLicencia').prop('disabled', false);
				} else {
					$('#nuevo_estatus').prop('disabled', false);
					$('#habilitarLicencia').prop('disabled', true);
					$('#habilitarLicencia').prop('checked', false);
				}
				if ($(this).data('habilitada') == 1) {
					$('#habilitarLicencia').prop('checked', true);
				} else {
					$('#habilitarLicencia').prop('checked', false);
				}
			})

		  }
		});
		$('.toast').toast('show');
	});

	function modificar_licencia(){
		var Licencia_ID_modificada = document.getElementById("Licencia_ID_modificada").value;
		var Licencia_nombre = document.getElementById("Licencia_nombre").value;
		var Licencia_duracion = document.getElementById("Licencia_duracion").value;
		var Licencia_inicio = document.getElementById("Licencia_inicio").value;
		var nuevo_estatus = document.getElementById("nuevo_estatus").value;
		var habilitarLicencia = document.getElementById("habilitarLicencia").checked;
		var parametros = {
			"nuevo_estatus" : nuevo_estatus,
			"Licencia_nombre" : Licencia_nombre,
			"Licencia_duracion" : Licencia_duracion,
			"Licencia_inicio" : Licencia_inicio,
			"Licencia_ID_modificada" : Licencia_ID_modificada,
			"habilitarLicencia" : habilitarLicencia
		};
		$.ajax({
			data:  parametros,
			url: '../scripts/ajax/licencias_nuevo_estatus_ajax.php',
			type: 'post',
			success: function(data)
			{
				//alert(data);
				$('#modalLicencia').modal('hide');
				location.reload();
			}
		});
	}

</script>

<?php
	}
	include_once('../includes/admin_footer.php');
?>

