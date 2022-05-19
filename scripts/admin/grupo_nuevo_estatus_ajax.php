<?php
//session_id ("vidasegura");
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

if(isset($_SESSION['lang'])){
	require "../../lang/".$_SESSION["lang"].".php";
}else{
	require "../../lang/ES-MX.php";
}

if(
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
){
	include_once('../conexion.php');

	$Grupo_ID = $_POST['Grupo_ID_nuevo_estatus'];
	$Grupo_estatus = $_POST['nuevo_estatus'];

	if ($Grupo_estatus == 0) {
		$Grupo_estatus ="activo";
	} else if ($Grupo_estatus == 1) {
		$Grupo_estatus ="inactivo";
	}

	$stmt=$con->prepare("UPDATE grupos SET Grupo_estatus=:Grupo_estatus WHERE Grupo_ID=:Grupo_ID");
	$stmt->execute(array(':Grupo_estatus'=>$Grupo_estatus, ':Grupo_ID'=>$Grupo_ID));

} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin.php'>";
	include_once('../../includes/header.php');
	?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i><?php echo $lang["no_access_ttl"]; ?></h5>
						<p class="card-text"><?php echo $lang["no_access_txt"]; ?></p>
						<div class="text-right mt-5"><a href="../../admin.php" class="btn btn-warning"><?php echo $lang["no_access_btn"]; ?></a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include_once('../../includes/footer.php');
}

?>