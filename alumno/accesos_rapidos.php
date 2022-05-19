<?php
	include_once('../includes/alumno_header.php');
	include_once('../scripts/funciones.php');
	include_once('../alumno/side_navbar.php');

	if ($_SESSION["tipo"] != "Alumn") {
		header('Location: ../error.php');
	} else {

	$_SESSION["token"] = md5(uniqid(mt_rand(), true));
?>

		<div class="mx-5 mt-3">
			<div class="row">
				<div class="col">
					<div class="card shadow">
						<div class="card-header">
							Acceso rápidos para gestión de la Empresa
						</div>
						<div class="card-body">
							<div class="card-text">A continuación encontrarás una serie de "Accesos Rápidos" para las principales secciones de gestión de la empresa Juvenil. Por supuesto que toda la información que se les solicita en el portal es necesaria, pero éstas son las secciones principales de su ejercicio empresarial.</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-sm-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title">Nuevos integrantes de la empresa</h5>
							<p class="card-text">En esta sección el Director General de la Empresa puede ingresar a nuevos colaboradores.</p>
							<div class="text-right"><a href="../sesiones/0.php?id=1" class="btn btn-warning">Aquí</a></div>
						</div>
					</div>
				</div>
				<?php if ($_SESSION["subseccion_general"]>27) { ?>
				<div class="col-sm-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title">Producto que elaborará la Empresa</h5>
							<p class="card-text">En esta sección podrán detallar su Producto, así como los primeros dos bloques del CANVAS.</p>
							<div class="text-right"><a href="../sesiones/2.php?id=8" class="btn btn-warning">Aquí</a></div>
						</div>
					</div>
				</div>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>28) { ?>
				<div class="col-sm-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title">Perfil de la Empresa</h5>
							<p class="card-text">En esta sección se registra el Nombre, Eslogan, Logotipo, Misión, Visión, Valores y Objetivos de tu Empresa.</p>
							<div class="text-right"><a href="../sesiones/3.php?id=1" class="btn btn-warning">Aquí</a></div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="row mt-2">
				<?php if ($_SESSION["subseccion_general"]>34) { ?>
				<div class="col-sm-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title">Organigrama</h5>
							<p class="card-text">En esta sección pueden establecer el rol que cada uno de los miembros del equipo jugará en su Empresa.</p>
							<div class="text-right"><a href="../sesiones/3.php?id=4" class="btn btn-warning">Aquí</a></div>
						</div>
					</div>
				</div>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>35) { ?>
				<div class="col-sm-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title">Esquema de Financiamiento</h5>
							<p class="card-text">En esta sección puedes elegir si se capitalizarán a través de la venta de Acciones o el Crowdfunding.</p>
							<div class="text-right"><a href="../sesiones/3.php?id=6" class="btn btn-warning">Aquí</a></div>
						</div>
					</div>
				</div>
				<?php } ?>
				<?php if ($_SESSION["subseccion_general"]>36) { ?>
				<div class="col-sm-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title">Registro de Accionistas / Donantes</h5>
							<p class="card-text">En esta sección puedes llevar el registro de tus Accionistas o Donantes.</p>
							<div class="text-right"><a href="../sesiones/4.php?id=1" class="btn btn-warning">Aquí</a></div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="row mt-2 mb-5 pb-5">
				<?php if ($_SESSION["subseccion_general"]>44) { ?>
				<div class="col-sm-4">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title">Bloques 3-8 del CANVAS</h5>
							<p class="card-text">En esta sección puedes registrar los bloques 3 al 8 del CANVAS.</p>
							<div class="text-right"><a href="../sesiones/4.php?id=5" class="btn btn-warning">Aquí</a></div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>


<?php
	}
	include_once('../includes/alumno_footer.php');
?>