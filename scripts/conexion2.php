<?php
/* Host de pruebas

$servidor = 'db5000145735.hosting-data.io';
$usuario = 'dbu104132';
$contrasena = 'JaMex1c0$%#';
$database = 'dbs141016';*/

/* localhost  

$servidor = 'localhost';
$usuario = 'root';
$contrasena = '';
$database = 'eye';*/


/* Server final */

$servidor = 'localhost:3306';
$usuario = 'bd_primaria_jam';
$contrasena = 'T_y4z49g';
$database = 'primaria'; 


    $con2=@mysqli_connect($servidor, $usuario, $contrasena, $database);
    mysqli_set_charset($con2,'utf8');
    if(!$con2){
        die("imposible conectarse: ".mysqli_error($con2));
    }
    if (@mysqli_connect_errno()) {
        die("Conexión fallida: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }


?>