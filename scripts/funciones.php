<?php

date_default_timezone_set("America/Mexico_City");
//$RAIZ_SITIO = "http://impulsa.org.mx/eye/";
//$RAIZ_SITIO = "http://localhost/dadbox/";
//$RAIZ_SITIO_nohttp = "//localhost/dadbox/";

$RAIZ_SITIO = "https://jamexicoprimaria.org.mx/";
$RAIZ_SITIO_nohttp = "//jamexicoprimaria.org.mx/";


//Función para sanitización de datos en un campo
function sanitizar($dato){
	return strip_tags(trim($dato));
}

//Código para el control de la sesión
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if ($_SESSION["autentificado"] != "SI") {
	header("Location: " . $RAIZ_SITIO . "index.php");
} else {
	$ultimoAcceso = $_SESSION["ultimoAcceso"];
	$ultimaAccion = $_SESSION["ultimaAccion"];
	$ahora = date("Y-n-j H:i:s");
	$tiempo_transcurrido = (strtotime($ahora)-strtotime($ultimaAccion));
	$tiempo_maximo = 6000; //En segundos
	if($tiempo_transcurrido >= $tiempo_maximo) {
		$TiempoOnline = $_SESSION["TiempoOnline"];
		$tiempo_activo = (strtotime($ahora)-strtotime($ultimoAcceso));
		$TiempoOnline += $tiempo_activo;
		//date("i:s", $TiempoOnline);
		include_once('conexion.php');
		$User_ID = $_SESSION['User_ID'];
		$query = "UPDATE usuarios SET TiempoOnline=? WHERE User_ID=?";
		if ($stmt = $con->prepare($query)) {
			$stmt->bind_param("ii", $TiempoOnline,$User_ID);
			$stmt->execute();
			$stmt->close();
		}
		session_destroy();
		header("Location: " . $RAIZ_SITIO . "sesion_expirada.php");
	} else {
	  $_SESSION["ultimaAccion"] = $ahora;
	}
}

//Clase para el hasheo de passwords seguros
class Password {
	public static function hash($password) {
		return password_hash($password, PASSWORD_DEFAULT);
	}
	public static function verify($password, $hash) {
		return password_verify($password, $hash);
	}
}


function Subseccion($Alumno_subseccion){
	$Subseccion = "N / D";
	if($Alumno_subseccion==0){
		$Subseccion = "No ha iniciado";
	} else if($Alumno_subseccion<10){
		$Subseccion = "0.1 Bienvenida y Registro";
	} else if($Alumno_subseccion<20){
		if ($Alumno_subseccion==10) {
			$Subseccion = "1.1 Conviértete en emprendedor";
		} else if ($Alumno_subseccion==11) {
			$Subseccion = "1.2 ¿Qué es Emprender?";
		} else if ($Alumno_subseccion==12) {
			$Subseccion = "1.3 Tipos de Empresas";
		} else if ($Alumno_subseccion==13) {
			$Subseccion = "1.4 Modelo Canvas";
		} else if ($Alumno_subseccion==14) {
			$Subseccion = "1.5 Actividades";
		}
	} else if($Alumno_subseccion<30){
		if ($Alumno_subseccion==21) {
			$Subseccion = "2.1 Design Thinking";
		} else if ($Alumno_subseccion==22) {
			$Subseccion = "2.2 Mapa de Empatía";
		} else if ($Alumno_subseccion==23) {
			$Subseccion = "2.3 Mapa de trayectoria";
		} else if ($Alumno_subseccion==24) {
			$Subseccion = "2.4 Ideación";
		} else if ($Alumno_subseccion==25) {
			$Subseccion = "2.5 Actividades";
		}
	} else if($Alumno_subseccion<40){
	} else if($Alumno_subseccion<50){
	} else if($Alumno_subseccion<60){
	}
	return $Subseccion;
}

?>