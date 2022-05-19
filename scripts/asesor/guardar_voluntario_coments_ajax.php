<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../conexion.php');
	include_once('../conexion2.php');
	$Array_coments_voluntarios = $_POST['Array_coments_voluntarios'];
	$table = $_POST['table'];
	$Empresa_ID = $_POST['Empresa_ID'];
	if ($table = "s1_6") {
		$table = "empresas_info_s1";
	}
	$No_IDs = sizeof($Array_coments_voluntarios);
	$act_alumno = 0;
	$act_asesor = 1;
	for ($i=0; $i < $No_IDs; $i++) {
		$Alumno_ID = substr($Array_coments_voluntarios[$i][0], 7);
		$coments_asesor = $Array_coments_voluntarios[$i][1];
		if (mysqli_fetch_array(mysqli_query($con2, "SELECT Alumno_ID FROM $table WHERE Alumno_ID = ".$Alumno_ID." LIMIT 1"), MYSQLI_ASSOC)) { //ya existe
			$stmt=$con->prepare("UPDATE $table SET coments_asesor=?, act_alumno=?, act_asesor=? WHERE Alumno_ID=?");
			$stmt->bind_param("siii", $coments_asesor, $act_alumno, $act_asesor, $Alumno_ID);
			$stmt->execute();
		} else { //no existe
			if ($coments_asesor != "") {
				$stmt=$con->prepare("INSERT INTO $table (Alumno_ID, Empresa_ID, coments_asesor, act_alumno, act_asesor) VALUES (?, ?, ?, ?, ?)");
				$stmt->bind_param("iisii", $Alumno_ID, $Empresa_ID, $coments_asesor, $act_alumno, $act_asesor);
				$stmt->execute();
			}
		}
	}
}
?>