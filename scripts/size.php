<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('conexion.php');
	session_start();

	$User_ID = $_SESSION['User_ID'];
	$ancho = $_POST['width'];
	$query = "UPDATE usuarios SET ancho=? WHERE User_ID=?";
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("ii", $ancho,$User_ID);
		$stmt->execute();
		$stmt->close();
		$_SESSION['ancho']=$ancho;
	}
}
?>