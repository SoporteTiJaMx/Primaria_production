<?php
	include_once('../includes/superadmin_header.php');
	include_once('../scripts/funciones.php');
	include_once('../superadmin/side_navbar.php');
	$_SESSION["token"] = md5(uniqid(mt_rand(), true));

	if ($_SESSION["tipo"] != "Sadmin") {
		header('Location: ../error.php');
	} else {
?>

<link rel="stylesheet" href="../css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="../css/responsive.bootstrap4.css">
<script src="../js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../js/dataTables.responsive.min.js" crossorigin="anonymous"></script>
<script src="../js/responsive.bootstrap4.min.js" crossorigin="anonymous"></script>


<nav class="mx-5 my-3">
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-crear-tab" data-toggle="tab" href="#nav-crear" role="tab" aria-controls="nav-crear" aria-selected="true">Ingresar nuevo centro operador</a>
    <a class="nav-item nav-link" id="nav-gestion-tab" data-toggle="tab" href="#nav-gestion" role="tab" aria-controls="nav-gestion" aria-selected="false">Administrar centros</a>
  </div>
</nav>
<div class="tab-content mx-5 px-3 mb-5" id="nav-tabContent" >
	<!-- Tab para crear un nuevo centro -->
	<div class="tab-pane fade show active" id="nav-crear" role="tabpanel" aria-labelledby="nav-crear-tab">
		<div class="card shadow">
			<div class="card-header text-center text-dark-gray text-spaced-3">CREAR NUEVO CENTRO OPERADOR</div>
			<div class="card-body">

				<form action="<?php echo $RAIZ_SITIO; ?>scripts/superadmin/nuevo_centro.php" method="post" class="mt-1" enctype="multipart/form-data">
					<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">

					<div class="col-12 text-center">
						<img src="<?php echo $RAIZ_SITIO . 'images/perfiles/perfil.png'; ?>" width="130" class="rounded mx-auto d-blocks img-thumbnail" id="image_profile">
					</div>
					<div class="col-12 text-center">
						<div class="col-3"></div>
						<div class="custom-file mb-3 mt-1 col-6">
							<input id="upload" name="upload" type="file" class="custom-file-input" onchange="readUpload(this);">
							<label for="upload" class="custom-file-label">Logotipo del centro</label>
						</div>
						<div class="col-3"></div>
					</div>

					<div class="form-row pb-1 justify-content-center">
						<div class="form-group col-6">
							<label for="centro" class="control-label text-dark-gray">Nombre:</label>
							<input type="text" class="form-control rounded text-center" name="centro" id="centro" aria-describedby="centro_help">
							<small id="correo_help" class="form-text text-dark-gray w200">Nombre del Centro</small>
						</div>
					</div>

					<div class="row pb-1">
						<div class="col text-center">
							<button type="submit" class="btn btn-warning text-center px-5 my-2" name="guardar" id="guardar">Registrar centro</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
	<!-- Tab para administración de centros -->
	<div class="tab-pane fade mb-5" id="nav-gestion" role="tabpanel" aria-labelledby="nav-gestion-tab">
	    <div class="card shadow mb-5 pb-5 min-width:300px">
	        <div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">ADMINISTRAR CENTROS</div>
	        <div class="card-body">

    		<div id="result"></div>
	        </div>
	    </div>
	</div>
</div>


<script type="text/javascript">

	function readUpload(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#image_profile')
					.attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(".custom-file-input").on("change", function() {
	  var fileName = $(this).val().split("\\").pop();
	  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});

	$(document).ready(function(){
	    $.ajax({
	      url: '../scripts/ajax/centros_ver_ajax.php',
	      success: function(data)
	      {
	      	$('#result').html(data)
		    $('#centros_table').DataTable( {
		        "pagingType": "simple",
	            responsive: true,
		    } );
		    $('#centros_table_wrapper div.row').addClass('col-sm-12');
		    $('.dataTables_length').parent().addClass('d-flex justify-content-start');
		    $('.dataTables_filter').parent().addClass('d-flex justify-content-end');
		    $('ul.pagination').addClass('pagination-sm');
		    $('[data-toggle="tooltip"]').tooltip();
	      }
	    });
	});

</script>

<?php
	include_once('../includes/superadmin_footer.php');
	}
?>
