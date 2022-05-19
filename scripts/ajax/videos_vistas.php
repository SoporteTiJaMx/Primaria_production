<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');

	$User_ID = $_SESSION["User_ID"];
	$capacitacion = $_POST['capacitacion'];
	$tiempo = $_POST['tiempo'];

	$query = "INSERT videos_vistas SET User_ID=?, video=?, tiempo=?";
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("iss", $User_ID, $capacitacion, $tiempo);
		$stmt->execute();
		$stmt->close();
	}
}
?>