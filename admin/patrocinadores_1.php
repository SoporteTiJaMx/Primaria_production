<?php
	include_once('../includes/admin_header.php');
	include_once('../scripts/funciones.php');
	include_once('../admin/side_navbar.php');

  if ($_SESSION["tipo"] != "Admin") {
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


<nav class="mx-5 my-3">
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link" id="nav-crear-tab" data-toggle="tab" href="#nav-crear" role="tab" aria-controls="nav-crear" aria-selected="true">Ingresar nuevo patrocinador</a>
    <a class="nav-item nav-link" id="nav-gestion-tab" data-toggle="tab" href="#nav-gestion" role="tab" aria-controls="nav-gestion" aria-selected="false">Administrar patrocinadores</a>
	<a class="nav-item nav-link" id="nav-proyectos-tab" data-toggle="tab" href="#nav-proyectos" role="tab" aria-controls="nav-proyectos" aria-selected="false">Proyectos</a>
  </div>
</nav>
<div class="tab-content mx-5 px-3 mb-5" id="nav-tabContent" >
	<!-- Tab para crear un nuevo proyecto -->
	<div class="tab-pane fade" id="nav-proyectos" role="tabpanel" aria-labelledby="nav-proyectos-tab">
		<div class="card shadow min-width:300px">
			<div class="card-header text-center bg-dark-blue text-white text-spaced-3">NUEVO PROYECTO</div>
			<div class="card-body">
				<form action="<?php echo $RAIZ_SITIO; ?>scripts/admin/nuevo_proyecto.php" method="post" class="mt-1">
					<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">

					<h5 class="text-center pb-3">INGRESA NUEVO PROYECTO</h5>
					<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto"></div></div>

					<div class="form-row pb-1">
						<div class="form-group col-3"></div>
						<div class="form-group col-6">
							<label for="name" class="control-label text-dark-gray">Proyecto:</label>
							<input type="text" class="form-control rounded text-center" name="name" id="name" aria-describedby="name_help" required>
							<small id="name_help" class="form-text text-dark-gray w200">Distintos proyectos pueden tener patrocinadores diferentes</small>
						</div>
						<?php $validaciones[] = array('name', 'name_input', "'Error en Nombre de Proyecto. Favor de corregir.'"); ?>
						<div class="form-group col-3"></div>
					</div>
					<div class="row pb-1">
						<div class="col text-center">
							<button type="submit" class="btn btn-warning text-center px-5 my-2" name="guardar" id="guardar">Crear Proyecto</button>
							<button type="button" class="btn btn-dark text-center px-5 my-2" name="cancelar" id="cancelar" onclick="location.reload()">Cancelar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<hr class="oscura">
		<div class="card shadow mb-5 min-width:300px">
			<div class="card-header text-center bg-dark-blue text-white text-spaced-3" id="card-title">PROYECTOS REGISTRADOS</div>
			<div class="card-body">
				<div id="proyectos_registrados"></div>
			</div>
		</div>
	</div>
	<!-- Tab para crear un nuevo patrocinador -->
	<div class="tab-pane fade show active" id="nav-crear" role="tabpanel" aria-labelledby="nav-crear-tab">
		<div class="card shadow">
			<div class="card-header text-center text-dark-gray text-spaced-3">INGRESAR NUEVO PATROCINADOR PARA <?php echo mb_strtoupper($_SESSION['centro'],'utf-8'); ?></div>
			<div class="card-body">

				<form action="<?php echo $RAIZ_SITIO; ?>scripts/admin/nuevo_patrocinador.php" method="post" class="mt-1" enctype="multipart/form-data">
					<input name="csrf" type="hidden" id="csrf" value="<?php echo $_SESSION['token']; ?>">
					<input name="centro" type="hidden" id="centro" value="<?php echo $_SESSION['centro_ID']; ?>">

					<div class="col-12 text-center">
						<img src="<?php echo $RAIZ_SITIO . 'images/perfiles/perfil.png'; ?>" width="130" class="rounded mx-auto d-blocks img-thumbnail" id="image_profile">
					</div>
					<div class="col-12 text-center">
						<div class="col-3"></div>
						<div class="custom-file mb-3 mt-1 col-6">
							<input id="upload" name="upload" type="file" class="custom-file-input" onchange="readUpload(this);" required>
							<label for="upload" class="custom-file-label">Logotipo del patrocinador</label>
						</div>
						<div class="col-3"></div>
					</div>
                    <?php $validaciones[] = array('upload', 'upload_input', "'Error en Logo. Favor de corregir.'"); ?>

					<div class="text-center"><div id="error" style="display: none" class="bg-danger w-50 py-2 text-center text-white rounded mx-auto"></div></div>

					<div class="form-row pb-1 justify-content-center">
						<div class="form-group col-6">
							<label for="nombre" class="control-label text-dark-gray">Nombre:</label>
							<input type="text" class="form-control rounded text-center" name="nombre" id="nombre" aria-describedby="nombre_help" required>
							<small id="nombre_help" class="form-text text-dark-gray w200">Nombre del Patrocinador</small>
						</div>
					</div>
                    <?php $validaciones[] = array('nombre', 'nombre_input', "'Error en Nombre. Favor de corregir.'"); ?>

	        		<div class="form-row pb-1">
						<div class="form-group col-4"></div>

						<div class="form-group col-4">
							<label for="estatus" class="control-label text-dark-gray">Estatus:</label>
							<select name="estatus" type="text" id="estatus" class="form-control rounded" aria-describedby="estatus_help" required>
								<option value="">Selecciona estatus del Patrocinador</option>
								<option value="1">Activo</option>
								<option value="2">Inactivo</option>
							</select>
	        				<small id="estatus_help" class="form-text text-dark-gray w200">Estatus del Patrocinador</small>
						</div>
	                    <?php $validaciones[] = array('estatus', 'estatus_input', "'Error en Estatus. Debes seleccionar el estatus del Patrocinador.'"); ?>

	        		</div>

					<div class="row pb-1">
						<div class="col text-center">
							<button type="submit" class="btn btn-warning text-center px-5 my-2" name="guardar" id="guardar">Registrar patrocinador</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
	<!-- Tab para administración de patrocinadores -->
	<div class="tab-pane fade mb-5" id="nav-gestion" role="tabpanel" aria-labelledby="nav-gestion-tab">
	    <div class="card shadow mb-5 pb-5 min-width:300px">
	        <div class="card-header text-center text-dark-gray text-spaced-3" id="card-title">ADMINISTRAR PATROCINADORES DE <?php echo mb_strtoupper($_SESSION['centro'],'utf-8'); ?></div>
	        <div class="card-body">

    		<div id="result"></div>
	        </div>
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
		    				<input name="Patroc_ID_nuevo_estatus" type="hidden" id="Patroc_ID_nuevo_estatus" value="">
						    <div>
								<select name="nuevo_estatus" type="text" id="nuevo_estatus" class="form-control rounded" aria-describedby="nuevo_estatus_help">
									<option value="1">Activo</option>
									<option value="2">Inactivo</option>
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
<div class="toast estatus" data-delay="5000" style="position: fixed; top: 10%; right: 2%; z-index: 2000;">
	<div class="toast-header">
		<strong class="mr-auto text-primary">Estatus actualizado con éxito</strong>
		<small class="text-muted"></small>
		<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
	</div>
	<div class="toast-body">
		Actualiza la página para ver los cambios y poder seguir gestionando tus patrocinadores.
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

	// Funciones de validación al crear nuevo patrocinador
  	var error = document.getElementById('error');
<?php
    for ($i = 0; $i <= sizeof($validaciones) - 1; $i++) {
        echo "var " . $validaciones[$i][1] . " = document.getElementById('" . $validaciones[$i][0] . "');";
        echo $validaciones[$i][1] . ".addEventListener('invalid', function(event){
            event.preventDefault();
            if (! event.target.validity.valid) {
                error.textContent   = " . $validaciones[$i][2] . ";
                error.style.display = 'block';
                error.classList.add('animated');
                error.classList.add('shake');
                " . $validaciones[$i][1] . ".classList.add('input_error');
            }
        });

        " . $validaciones[$i][1] . ".addEventListener('input', function(event){
            if ( 'block' === error.style.display ) {
                error.style.display = 'none';
            " . $validaciones[$i][1] . ".classList.remove('input_error');
            }
        });
        ";
    }
?>

	$(document).ready(function(){
	    var parametros = {
			"Centro_ID" : <?php echo $_SESSION['centro_ID']; ?>
	    };
	    $.ajax({
	      data:  parametros,
	      url: '../scripts/ajax/patrocinadores_ver_ajax.php',
	      type: 'post',
	      success: function(data)
	      {
	      	$('#result').html(data)
		    $('#patrocinadores_table').DataTable( {
		        "pagingType": "simple",
		        "pageLength": 100,
	            responsive: true,
		    } );
		    $('#patrocinadores_table_wrapper div.row').addClass('col-sm-12');
		    $('.dataTables_length').parent().addClass('d-flex justify-content-start');
		    $('.dataTables_filter').parent().addClass('d-flex justify-content-end');
		    $('ul.pagination').addClass('pagination-sm');
		    $('[data-toggle="tooltip"]').tooltip();

			$('.select_nuevo_estatus i').click(function(){
				$('#modalEstatus .modal-title').text('Nuevo estatus para ' + $(this).data('nombre'));
				$('#Patroc_ID_nuevo_estatus').val($(this).data('patrocinador'));
				$('#nuevo_estatus').val($(this).data('estatus'));
			})

	      }
	    });

	});

	// función para ir a tab en administración de patrocinadores
	function activaTab(tab){
	    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
	};

	// función para cambio de estatus de patrocinador
	function nuevo_estatus(){
	    var Patroc_ID_nuevo_estatus = document.getElementById("Patroc_ID_nuevo_estatus").value;
	    var nuevo_estatus = document.getElementById("nuevo_estatus").value;
	    var parametros = {
			"nuevo_estatus" : nuevo_estatus,
			"Patroc_ID_nuevo_estatus" : Patroc_ID_nuevo_estatus,
	    };
	    $.ajax({
			data:  parametros,
			url: '../scripts/ajax/patrocinadores_nuevo_estatus_ajax.php',
			type: 'post',
			success: function(data)
			{
				$('.toast.estatus').toast('show');
				$('#modalEstatus').modal('hide');
				activaTab('nav-gestion');
			}
	    });
	}



</script>

<?php
	}
	include_once('../includes/admin_footer.php');
?>
