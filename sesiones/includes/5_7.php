			<div class="card shadow mb-1">
				<div class="card-header">
					Sesion 5 <i class="fas fa-angle-right fa-lg fa-fw"></i> La Identidad Empresarial <i class="fas fa-angle-right fa-lg fa-fw"></i> Actividades
				</div>
				<div class="card-body px-5">
					<h5 class="card-title">Actividades</h5>
					<div class="card-text px-5">
						<div>
							<div class="row mb-3">
								<div class="col-2"><strong>Objetivo:</strong></div>
								<div class="col-10">En la sección "<i>La Identidad Empresarial</i>" rellenar los campos con la información de tu empresa, así como elaborar y subir su Acta Constitutiva.</div>
							</div>
							<div class="row mb-3">
								<div class="col-2"><strong>Tipo de entrega:</strong></div>
								<div class="col-10">En equipo.</div>
							</div>
							<div class="row mb-3">
								<div class="col-2"><strong>Recompensa:</strong></div>
								<div class="col-10"><strong>40 estrellas a la empresa</strong>, si entregaron las actividades completas y antes de que inicie la Sesión 6.</div>
							</div>
							<div class="row mb-3">
								<div class="col-2"><strong>Fecha límite:</strong></div>
								<div class="col-10"><?php if (isset($_SESSION["Sesion_6_fin"])) { echo ucfirst(strftime("%A, %d de %B de %Y", strtotime('-1 hour', strtotime(date($_SESSION["Sesion_6_fin"]))))); } else { echo "Depende de la licencia que se active.";} ?>
							</div>
							</div>
							<div class="row mb-3">
								<div class="col-2"><strong>Instrucciones:</strong></div>
								<div class="col-10">
									<ol style="padding-left: 1em">
										<li>Llenar la sección de <i>La Identidad Empresarial</i>.</li>
										  <ul>
											<li>Nombre</li>
											<li>Eslogan</li>
											<li>Logotipo</li>
											<li>Misión</li>
											<li>Visión</li>
											<li>Valores</li>
										  </ul>
									</ol>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-2"><strong>Formato de entrega:</strong></div>
								<div class="col-10">
									<ol style="padding-left: 1em">
										<li>En la sección <i>La Identidad Empresarial</i> rellena los campos y sube el Acta Constitutiva debidamente actualizada.</li>
									</ol>
								</div>
							</div>
						</div>
						<br>
						<hr>
						<br><br>
						<div>
							<div class="row mb-3">
								<div class="col-2"><strong>Objetivo:</strong></div>
								<div class="col-10">Escribir 5 <strong>Objetivos</strong> de cada una de las áreas de nuestra Empresa, posteriormente escribir la(s) <strong>Meta(s)</strong> que permitan alcanzar dichos objetivos y, por último, enunciar el <strong>Plan de Acción</strong> con el que lograremos cada una de las metas.</div>
							</div>
							<div class="row mb-3">
								<div class="col-2"><strong>Tipo de entrega:</strong></div>
								<div class="col-10">Individual según el área de cada empresa. En equipo una vez que se llenen los objetivos de todas las áreas.</div>
							</div>
							<div class="row">
								<div class="col-2"><strong>Recompensa:</strong></div>
								<div class="col-10"><strong>40 estrellas a la empresa</strong>, si se entregaron los objetivos de todas las áreas, antes de que inicie la Sesión 6.</div>
							</div>
							<?php /*
							<div class="row mb-3">
								<div class="col-2"></div>
								<div class="col-10"><strong>30 estrellas a los integrantes del área de cada empresa</strong>, al subir los 5 objetivos de su área, antes de que inicie la Sesión 6.</div>
							</div> */ ?>
							<div class="row mb-3">
								<div class="col-2"><strong>Fecha límite:</strong></div>
								<div class="col-10"><?php if (isset($_SESSION["Sesion_6_fin"])) { echo ucfirst(strftime("%A, %d de %B de %Y", strtotime('-1 hour', strtotime(date($_SESSION["Sesion_6_fin"]))))); } else { echo "Depende de la licencia que se active.";} ?>
							</div>
							</div>
							<div class="row mb-3">
								<div class="col-2"><strong>Instrucciones:</strong></div>
								<div class="col-10">
									<ol style="padding-left: 1em">
										<li class="pb-2">Asegúrate de que cada área de tu empresa llene la sección <i>Objetivos por Área.</i></li>
										<ul class="pb-2">
											<li>Escribir sus 5 Objetivos</li>
											<li>Escribir las Metas respectivas</li>
											<li>Describir los Planes de Acción para cada Meta</li>
										</ul>
									</ol>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-2"><strong>Formato de entrega:</strong></div>
								<div class="col-10">
									<ol style="padding-left: 1em">
										<li class="pb-2">Rellena los campos respectivos en la sección de "<i>Objetivos por Área en tiempo y forma</i>".</li>
									</ol>
								</div>
							</div>
						</div>
						<br><br>
						<div class="row">
							<div class="text-left col-6">
								<a href="<?php echo $uri_sola . '=5'; ?>" class="btn btn-warning"><i class="fas fa-chevron-left fa-lg fa-fw faa-passing faa-reverse animated"></i>&nbsp;&nbsp; Anterior</a>
							</div>
						</div>
					</div>
				</div>
			</div>