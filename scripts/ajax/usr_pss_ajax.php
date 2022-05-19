<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$User_ID = $_POST['User_ID'];
	if ($_POST["csrf"] == $_SESSION["token"]) {
		$query = "UPDATE usuarios SET Usuario=?, Contrasena=?, Temp_usr_pss=?, Temp_pss=? WHERE User_ID=?";
		if ($stmt = $con->prepare($query)) {
			$pass_hash = password_hash($pass, PASSWORD_DEFAULT);
			$temp_usr_pss = "";
			$temp_pss = "";
			$stmt->bind_param("ssssi", $user,$pass_hash,$temp_usr_pss,$temp_pss,$User_ID);
			$stmt->execute();
			$stmt->close();
		}
	}
} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../index.php'>";
	include_once('../../includes/header.php');
?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../index.php" class="btn btn-warning">Ir</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once('../../includes/footer.php');
}

?>