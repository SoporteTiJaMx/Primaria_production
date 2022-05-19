<?php
include_once('scripts/conexion.php');

session_start();
function sanitizar($dato){
	return strip_tags(trim($dato));
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$Empresa_ID = (isset($_POST["Empresa_ID"])) ? sanitizar($_POST["Empresa_ID"]) : null;
	$web_ID = (isset($_POST["web_ID"])) ? sanitizar($_POST["web_ID"]) : null;
	$nombre = (isset($_POST["nombre"])) ? sanitizar($_POST["nombre"]) : null;
	$email = (isset($_POST["email"])) ? sanitizar($_POST["email"]) : null;
	$phone = (isset($_POST["phone"])) ? sanitizar($_POST["phone"]) : null;
	$donation = (isset($_POST["donation"])) ? sanitizar($_POST["donation"]) : null;
	if (isset($_POST["csrf"]) && $_POST["csrf"] == $_SESSION["token"]) {
		$query = "INSERT INTO donantes (Empresa_ID, Donantes_nombre, Donantes_email, Donantes_tel, Donantes_donacion_inic) VALUES (?, ?, ?, ?, ?)";
		if ($stmt = $con->prepare($query)) {
			$stmt->bind_param("isssi", $Empresa_ID, $nombre, $email, $phone, $donation);
			$stmt->execute();
			$stmt->close();
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='10;URL=web.php?id=" . $web_ID . "'>";
  			include_once('includes/header.php');
			echo "
				<div class='container h-100'>
					<div class='row align-items-center h-100'>
						<div class='col-6 mx-auto'>
							<div class='card shadow'>
								<div class='card-body'>
									<h5 class='card-title mb-5 align-middle'><i class='fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green'></i>Datos registrados exitosamente.</h5>
									<p class='card-text'>Tu donación para esta empresa ha quedado registrada.</p>
									<p class='card-text'>En breve los jóvenes de esta empresa educativa se pondrán en contacto contigo para acordar la entrega de la donación.</p>
									<p class='card-text'>Te agradecemos profundamente por tu contribución para brindar oportunidades educativas a los jóvenes.</p>
									<p class='card-text'>En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
									<div class='text-right mt-5'><a href='web.php?id=" . $web_ID . "' class='btn btn-warning'>Ir</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			";
  			include_once('includes/footer.php');
		}
	}

} else {

	echo "<META HTTP-EQUIV='REFRESH' CONTENT='10;URL=web.php?id=" . $web_ID . "'>";

	include_once('includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ha ocurrido un error.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="index.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php

	include_once('includes/footer.php');

}

?>