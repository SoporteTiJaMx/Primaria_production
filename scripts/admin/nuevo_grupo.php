<?php
include_once('../funciones.php');
include_once('../conexion.php');
/* if(isset($_SESSION['lang'])){
	require "../../lang/".$_SESSION["lang"].".php";
}else{
	require "../../lang/ES-MX.php";
} */

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST["csrf"]) && $_POST["csrf"] == $_SESSION["token"]) {
		$Proyecto_ID = $_POST["select_proyectos"];
		$Escuela_ID = $_POST["select_escuela_1"];
		$Grupo_nombre = (isset($_POST["name"])) ? sanitizar($_POST["name"]) : null;
		$Grado = (isset($_POST["grado"])) ? sanitizar($_POST["grado"]) : null;

		$stmt3 = $con->prepare("SELECT * FROM grupos WHERE Grupo_nombre = ? AND Escuela_ID = ? AND Proyecto_ID = ?");
		$stmt3->bind_param("si", $Grupo_nombre, $Escuela_ID, $Proyecto_ID);
		$stmt3->execute();
		$res = $stmt3->fetch();
		if($res == false){ //no existe grupo
			$Grupo_estatus = "activo";
			$stmt=$con->prepare("INSERT INTO grupos (Escuela_ID, Proyecto_ID, Grupo_nombre, Grupo_estatus, Grado) VALUES (?, ?, ?, ?, ?)");
			$stmt->bind_param("iissi", $Escuela_ID, $Proyecto_ID, $Grupo_nombre, $Grupo_estatus, $Grado);

			if ($stmt->execute()) {
				echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/grupos.php'>";
				include_once('../../includes/header.php');
				?>
				<div class="container h-100">
					<div class="row align-items-center h-100">
						<div class="col-6 mx-auto">
							<div class="card shadow">
								<div class="card-body">
									<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Datos guardados exitosamente.</h5>
									<p class="card-text">El grupo se registró exitosamente. En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
									<div class="text-right mt-5"><a href="../../admin/grupos.php" class="btn btn-warning">Ir</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				include_once('../../includes/footer.php');
			}else{
				echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/grupos.php'>";
				include_once('../../includes/header.php');
				?>
				<div class="container h-100">
					<div class="row align-items-center h-100">
						<div class="col-6 mx-auto">
							<div class="card shadow">
								<div class="card-body">
									<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ocurrió un error</h5>
									<p class="card-text">El grupo no fue creado, intenta más tarde</p>
									<div class="text-right mt-5"><a href="../../admin/grupos.php" class="btn btn-warning">Continuar</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				include_once('../../includes/footer.php');
			}
		} else { //grupo existente, riesgo de duplicidad
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='10;URL=../../admin/grupos.php'>";
			include_once('../../includes/header.php');
			?>
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<div class="card shadow">
							<div class="card-body">
								<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Hubo un error</h5>
								<p class="card-text">El nombre de grupo ya está en uso. Modifícalo por favor.</p>
								<div class="text-right mt-5"><a href="../../admin/grupos.php" class="btn btn-warning">Regresar</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			include_once('../../includes/footer.php');
		}

	} else {
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/grupos.php'>";
		include_once('../../includes/header.php');
		?>
		<div class="container h-100">
			<div class="row align-items-center h-100">
				<div class="col-6 mx-auto">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ocurrió un error</h5>
							<p class="card-text">Da clic en "Siguiente" y comunícate con la oficina de Junior Achievement</p>
							<div class="text-right mt-5"><a href="../../admin/grupos.php" class="btn btn-warning">Siguiente</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		include_once('../../includes/footer.php');
	}
} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/grupos.php'>";
	include_once('../../includes/header.php');
	?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ocurrió un error</h5>
						<p class="card-text">No tienes permisos para ingresar.</p>
						<div class="text-right mt-5"><a href="../../admin/grupos.php" class="btn btn-warning">Regresar al inicio</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include_once('../../includes/footer.php');
}
?>