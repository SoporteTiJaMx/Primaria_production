<?php
	include_once('../includes/alumno_header.php');
	include_once('../scripts/funciones.php');
	include_once('../alumno/side_navbar.php');

	if ($_SESSION["tipo"] != "Alumn") {
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

	<h6 class="text-center text-dark_gray pt-1 pb-1">Aquí se muestran los integrantes de tu Empresa Juvenil.</h6>

		<div class="card shadow mb-5 pb-5 min-width:300px">
			<div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">EMPRESA: <?php echo $_SESSION["Empresa_nombre"]; ?></div>
			<div class="card-body">
			<div id="empresas_juveniles"></div>
			</div>
		</div>

</div>


<!-- Modal y Toast de Nuevo Estatus -->
<div class="modal fade" tabindex="-1" id="modalEstatus" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Nuevo Estatus</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="form-row pb-1">
						<div class="form-group col-2"></div>
						<div class="form-group col-8">
							<input name="User_ID_nuevo_estatus" type="hidden" id="User_ID_nuevo_estatus" value="">
							<input name="tipo_nuevo_estatus" type="hidden" id="tipo_nuevo_estatus" value="">
							<div>
							<select name="nuevo_estatus" type="text" id="nuevo_estatus" class="form-control rounded" aria-describedby="tipo_help">
								<option value="0">Pendiente de perfil</option>
								<option value="1">Activo</option>
								<option value="2">Suspendido</option>
								<option value="3">Cancelado</option>
							</select>
							</div>
						</div>
						<div class="form-group col-2"></div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-warning submitBtn" onclick="nuevo_estatus()">Cambiar estatus</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function(){
		var parametros = {
		"Empresa_ID" : <?php echo $_SESSION['Empresa_ID']; ?>,
		};

		$.ajax({ //Integrantes de Empresa juvenil
			data:	parametros,
			url: 'ajax/usuarios_empresa.php',
			type: 'post',
			success: function(data)
			{
				$('#empresas_juveniles').html(data)
			$('#empresas_juveniles_table').DataTable({
				"pagingType": "simple",
				responsive: {
						details: {
								display: $.fn.dataTable.Responsive.display.childRow,
						}
				}
			});

			$('#empresas_juveniles_table_wrapper div.row').addClass('col-sm-12');
			$('.dataTables_length').parent().addClass('d-flex justify-content-start');
			$('.dataTables_filter').parent().addClass('d-flex justify-content-end');
			$('ul.pagination').addClass('pagination-sm');
			$('[data-toggle="tooltip"]').tooltip();

		$('.select_nuevo_estatus i').click(function(){
			$('#modalEstatus .modal-title').text('Nuevo estatus para ' + $(this).data('nombre'));
			$('#User_ID_nuevo_estatus').val($(this).data('user_id'));
			$('#tipo_nuevo_estatus').val($(this).data('tipo'));
			$('#nuevo_estatus').val($(this).data('estatus'));
			$('#modalEstatus').modal('show');
		})

			}
		});
	});

	// función para cambio de estatus de usuario
	function nuevo_estatus(){
		var User_ID_nuevo_estatus = document.getElementById("User_ID_nuevo_estatus").value;
		var tipo_nuevo_estatus = document.getElementById("tipo_nuevo_estatus").value;
		var nuevo_estatus = document.getElementById("nuevo_estatus").selectedIndex;
		var parametros = {
		"nuevo_estatus" : nuevo_estatus,
		"User_ID_nuevo_estatus" : User_ID_nuevo_estatus,
		"tipo_nuevo_estatus" : tipo_nuevo_estatus,
		};
		$.ajax({
		data:	parametros,
		url: '../scripts/ajax/usuarios_nuevo_estatus_ajax.php',
		type: 'post',
		success: function(data)
		{
			$('#modalEstatus').modal('hide');
			location.reload();
		}
		});
	}

</script>

<?php
	}
	include_once('../includes/alumno_footer.php');
?>

