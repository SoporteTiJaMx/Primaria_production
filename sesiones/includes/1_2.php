			<div class="card shadow mb-1">
				<div class="card-header">
					Primero de Primaria <i class="fas fa-angle-right fa-lg fa-fw"></i> Actividad 2
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Actividad 2</h5>
					<div class="card-text px-lg-5">
						
					</div>
					<br>
					<div class="row">
						<div class="text-left col-6"><a href="<?php echo $uri_sola . '=1'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a></div>
						<div class="text-right col-6"><a href="<?php echo $uri_sola . '=3'; ?>" class="btn btn-warning" <?php if ($_SESSION['tipo'] == "Alumn") { ?> onclick="siguiente_seccion(13)" <?php } ?>>Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a></div>
					</div>
				</div>
			</div>