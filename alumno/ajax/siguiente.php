<?php
if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	session_start();
	include_once('../../scripts/conexion.php');
	include_once('../../scripts/conexion2.php');

	$subseccion_siguiente = $_POST["num"];
	$Alumno_ID = $_POST["id"];
	$result = mysqli_fetch_array(mysqli_query($con, "SELECT Alumno_subseccion, Alumno_score FROM alumnos WHERE Alumno_ID=" . $Alumno_ID), MYSQLI_ASSOC);
	$subseccion_almacenada = $result["Alumno_subseccion"];
	$Alumno_score = $result["Alumno_score"];
	if ($subseccion_siguiente > $subseccion_almacenada) {
		$Alumno_score = $Alumno_score + 5;
		$query = "UPDATE alumnos SET Alumno_subseccion=?, Alumno_score=? WHERE Alumno_ID=?";
		if ($stmt = $con2->prepare($query)) {
			$stmt->bind_param("iii", $subseccion_siguiente, $Alumno_score, $Alumno_ID);
			if ($stmt->execute()) {
				$_SESSION["subseccion_general"] = $subseccion_siguiente;
				$_SESSION["alumno_score"] = $Alumno_score;
				$stmt->close();
			}
		}
	}
}