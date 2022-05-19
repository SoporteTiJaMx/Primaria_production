<?php
echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=index.php'>";

  include_once('includes/header.php');
?>

	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-triangle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Hubo un error en el acceso a tu cuenta.</h5>
						<p class="card-text">Si estás debidamente registrado y te surge este error, notifica al administrador local de JA México para corregirlo. En unos segundos serás redirigido.</p>
						<div class="text-right mt-5"><a href="index.php" class="btn btn-warning">Ir al inicio</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
  include_once('includes/footer.php');
?>
