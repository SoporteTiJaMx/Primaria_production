<?php
include_once('conexion.php');
include_once('funciones.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$pass = (isset($_POST["pass"])) ? sanitizar($_POST["pass"]) : null;
	$User_ID = (isset($_POST["User_ID"])) ? sanitizar($_POST["User_ID"]) : null;

	if ($_POST["csrf"] == $_SESSION["token"]) {
		$query = "UPDATE usuarios SET Contrasena=?, Temp_usr_pss=?, Temp_pss=? WHERE User_ID=?";
		if ($stmt = $con->prepare($query)) {
			$pass_hash = password_hash($pass, PASSWORD_DEFAULT);
			$temp_usr_pss = "";
			$temp_pss = "";
			$stmt->bind_param("sssi", $pass_hash,$temp_usr_pss,$temp_pss,$User_ID);
			$stmt->execute();
			$stmt->close();
			header("Location: ../ok.php");
		}
	}

} else {

	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=index.php'>";
	include_once('includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
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