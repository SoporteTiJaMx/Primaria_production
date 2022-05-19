<?php
/* include_once('scripts/funciones.php');
$mi_pass = strip_tags(trim('Ab12345678'));
// Crear la contraseña:
echo "<br>";
echo $hash = Password::hash($mi_pass);
// Comprobar la contraseña introducida
if (Password::verify($mi_pass, $hash)) {
    echo "<br>Contraseña correcta!\n";
} else {
    echo "<br>Contraseña incorrecta!\n";
}
*/


$pass_real="123";
$pass_hash = password_hash($pass_real, PASSWORD_DEFAULT);
/*echo $pass_hash . "<br>";
$hash_real='$2y$10$NyJ1CpJkWuCKVRuJLzKFQ./di.d5SP/Z5lGeITT9VkUvlwWCCYCDa';
echo $hash_real . "<br>";
$hash_real = strip_tags(trim($hash_real));
if (password_verify($pass_real, $hash_real)) {
	echo "Ok";
} else {
	echo "No ok";
}*/


/*
$vars = get_defined_vars();
var_dump($vars);
*/


session_start();
//echo session_name();
foreach($_SESSION as $key =>$valor)
{
echo "Variable de sesión: $key    -   Valor: $valor <br>";
}



/*ini_set('post_max_size', '25M');
ini_set('upload_max_filesize', '25M');


echo ini_get("upload_max_filesize");
echo "<br>";
echo ini_get("post_max_size");*/

?>
