			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 4 <i class="fas fa-angle-right fa-lg fa-fw"></i> Selección de Roles <i class="fas fa-angle-right fa-lg fa-fw"></i> Actividades
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Actividades</h5>
					<div class="card-text px-5">
						<div class="row mb-3">
							<div class="col-2"><strong>Objetivo:</strong></div>
							<div class="col-10">Tener completo el diseño organizacional de su empresa juvenil.</div>
						</div>
						<div class="row mb-3">
							<div class="col-2"><strong>Tipo de entrega:</strong></div>
							<div class="col-10">Individual / Grupal.</div>
						</div>
						<div class="row mb-3">
							<div class="col-2"><strong>Recompensa:</strong></div>
							<div class="col-10"><strong>50 estrellas a la empresa</strong>, si TODOS los participantes completan las actividades de manera puntual.</div>
						</div>
						<div class="row mb-3">
							<div class="col-2"><strong>Fecha límite:</strong></div>
							<div class="col-10"><?php if (isset($_SESSION["Sesion_5_fin"])) { echo ucfirst(strftime("%A, %d de %B de %Y", strtotime('-1 hour', strtotime(date($_SESSION["Sesion_5_fin"]))))); } else { echo "Depende de la licencia que se active.";} ?></div>
						</div>
						<div class="row mb-3">
							<div class="col-2"><strong>Instrucciones:</strong></div>
							<div class="col-10">
								<ul style="padding-left: 1em">
									<li class="pb-2">TODOS los participantes deben haber realizado su Test de Perfil.</li>
									<li class="pb-2">TODOS los participantes deben haber subido su CV en la plataforma.</li>
									<li>El equipo, a través de su Director General o de su Director de Recursos Humanos, debe haber hecho la asignación de puestos a TODOS los integrantes de la empresa.</li>
								</ul>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-2"><strong>Formato de entrega:</strong></div>
							<div class="col-10">Información ingresada en la plataforma.</div>
						</div>
					</div>

					<div class="card-text px-5">
						<div class="row">
							<div class="text-left col-6"><a href="<?php echo $uri_sola . '=4'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a></div>
							<?php if ($_SESSION['tipo'] != "Alumn") { ?>
							<div class="text-right col-6"><a href="<?php echo $uri_sola . '=6'; ?>" class="btn btn-warning">Siguiente &nbsp;&nbsp;<i class="fas fa-chevron-right fa-lg fa-fw faa-passing animated"></i></a></div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>