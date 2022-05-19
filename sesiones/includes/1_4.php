			<div class="card shadow mb-1">
				<div class="card-header">
					Primero de Primaria <i class="fas fa-angle-right fa-lg fa-fw"></i> Actividad 4
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Actividades</h5>
					<div class="card-text px-lg-5">

					</div>
					<div class="row">
						<div class="text-left col-6"><a href="<?php echo $uri_sola . '=3'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a></div>
							<?php if ($_SESSION['tipo'] != "Alumn") { ?>
						<div class="text-right col-6"><a href="<?php echo $uri_sola . '=5'; ?>" class="btn btn-warning">Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a></div>
							<?php } ?>
					</div>
					
				</div>
			</div>
