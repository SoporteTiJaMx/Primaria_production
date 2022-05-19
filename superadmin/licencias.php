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
    <a class="nav-item nav-link active" id="nav-crear-tab" data-toggle="tab" href="#nav-crear" role="tab" aria-controls="nav-crear" aria-selected="true">Crear licencias</a>
    <a class="nav-item nav-link" id="nav-gestion-tab" data-toggle="tab" href="#nav-gestion" role="tab" aria-controls="nav-gestion" aria-selected="false">Revisar licencias</a>
  </div>
</nav>
<div class="tab-content mx-5 px-3 mb-5" id="nav-tabContent" >
	<!-- Tab para crear una nueva licencia -->
	<div class="tab-pane fade show active" id="nav-crear" role="tabpanel" aria-labelledby="nav-crear-tab">
	    <div class="card shadow">
	        <div class="card-header text-center text-dark-gray text-spaced-3">CREAR NUEVA LICENCIA</div>
	        <div class="card-body">

	        	<form action="<?php echo $RAIZ_SITIO; ?>scripts/superadmin/crear_licencia.php" method="post" class="mt-1">
	        		<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">

	                <div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto"></div></div>

	        		<div class="form-row pb-1">
	        			<div class="form-group col-2"></div>
	        			<div class="form-group col-4">
							<label for="centro" class="control-label text-dark-gray">Centro:</label>
							<select name="centro" type="text" id="centro" class="form-control rounded" aria-describedby="centro_help">

							</select>
	        				<small id="centro_help" class="form-text text-dark-gray w200">Centro al que se asignará la licencia</small>
	        			</div>
	        			<div class="form-group col-4">
							<label for="duracion" class="control-label text-dark-gray">Duración:</label>
							<select name="duracion" type="text" id="duracion" class="form-control rounded" aria-describedby="duracion_help">
								<option value="0">Selecciona duración</option>
								<option value="6">6 meses</option>
								<option value="9">9 meses</option>
								<option value="12">12 meses</option>
							</select>
	        				<small id="duracion_help" class="form-text text-dark-gray w200">Duración de la licencia</small>
	        			</div>
	        			<div class="form-group col-2"></div>
	        		</div>

	                <div class="row pb-1">
	                    <div class="col text-center">
	                        <button type="submit" class="btn btn-warning text-center px-5 my-2" name="crear" id="crear">Crear licencia</button>
	                    </div>
	                </div>

	        	</form>
	        </div>
	    </div>
	</div>
	<!-- Tab para administración de licencias -->
	<div class="tab-pane fade mb-5" id="nav-gestion" role="tabpanel" aria-labelledby="nav-gestion-tab">
	    <div class="card shadow mb-5 pb-5 min-width:300px">
	        <div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">REVISAR LICENCIAS</div>
	        <div class="card-body">

    		<div id="result"></div>
	        </div>
	    </div>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function(){
	    $.ajax({
	      url: '../includes/centros_todos.php',
	      success: function(data)
	      {
	      	$('#centro').html("<option value=''>Selecciona centro</option>" + data);
	      }
	    });
	    $.ajax({
	      url: '../scripts/ajax/licencias_ver_ajax.php',
	      success: function(data)
	      {
	      	$('#result').html(data)
		    $('#licencias_table').DataTable( {
		        "pagingType": "simple",
	            responsive: true,
		    } );
		    $('#licencias_table_wrapper div.row').addClass('col-sm-12');
		    $('.dataTables_length').parent().addClass('d-flex justify-content-start');
		    $('.dataTables_filter').parent().addClass('d-flex justify-content-end');
		    $('ul.pagination').addClass('pagination-sm');
	      }
	    });
	});

</script>

<?php
	include_once('../includes/superadmin_footer.php');
	}
?>

