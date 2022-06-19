<?php
include_once('../funciones.php');
include_once('../conexion.php');
/*
if(isset($_SESSION['lang'])){
	require "../../lang/".$_SESSION["lang"].".php";
}else{
	require "../../lang/ES-MX.php";
}*/

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST["csrf"]) && $_POST["csrf"] == $_SESSION["token"]) {
		$Admin_ID = $_SESSION["Admin_ID"];
		$id_oficina_ja = $_SESSION["id_oficina_ja"];
		$Lenguaje = $_SESSION["oficina_ja_lang"];
		$user = (isset($_POST["user"])) ? sanitizar($_POST["user"]) : null;
		$pass = (isset($_POST["pass"])) ? sanitizar($_POST["pass"]) : null;
		$pass=hash('sha512', $pass);
		$correo = (isset($_POST["correo"])) ? sanitizar($_POST["correo"]) : null;

		$stmt2 = $con->prepare("SELECT * FROM usuarios WHERE user = :user");
		$stmt2->execute(array(':user'=>$user));
		$res = $stmt2->fetch();
		if($res == false){ //no existe usuario
			$stmt=$con->prepare("INSERT INTO usuarios (id_oficina_ja, user, pass, tipo, email, lang, estatus) VALUES (:id_oficina_ja, :user, :pass, :tipo, :email, :lang, :estatus)");
			$stmt->execute(array(':id_oficina_ja'=>$id_oficina_ja, ':user'=>$user, ':pass'=>$pass, ':tipo'=>'volun', ':email'=>$correo, ':lang'=>$Lenguaje, ':estatus'=>'activo'));
			$id_user = $con->lastInsertId();;

			$stmt=$con->prepare("INSERT INTO voluntarios (id_user, Admin_ID, Volunt_email, Volunt_estatus) VALUES (:id_user, :Admin_ID, :Volunt_email, :Volunt_estatus)");
			$stmt->execute(array(':id_user'=>$id_user, ':Admin_ID'=>$Admin_ID, ':Volunt_email'=>$correo, ':Volunt_estatus'=>'activo'));

			if ($stmt->rowCount() > 0) {
				echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/voluntarios.php'>";
				include_once('../../includes/header.php');
				?>
				<div class="container h-100">
					<div class="row align-items-center h-100">
						<div class="col-6 mx-auto">
							<div class="card shadow">
								<div class="card-body">
									<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Datos guardados exitosamente.</h5>
									<p class="card-text">Los datos se guardaron exitosamente. En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
									<div class="text-right mt-5"><a href="../../admin/voluntarios.php" class="btn btn-warning">Regresar al programa</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				include_once('../../includes/footer.php');
			} else {
				echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/voluntarios.php'>";
				include_once('../../includes/header.php');
				?>
				<div class="container h-100">
					<div class="row align-items-center h-100">
						<div class="col-6 mx-auto">
							<div class="card shadow">
								<div class="card-body">
									<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ha ocurrido un error.</h5>
									<p class="card-text">No se han podido almacenar los datos en la plataforma. Si el error persiste por favor avisa al administrador de JA México.</p>
									<div class="text-right mt-5"><a href="../../admin/voluntarios.php" class="btn btn-warning">Regresar</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				include_once('../../includes/footer.php');
			}
		} else { //usuario existente, riesgo de duplicidad
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='10;URL=../../admin/voluntarios.php'>";
			include_once('../../includes/header.php');
			?>
			<div class="container h-100">
				<div class="row align-items-center h-100">
					<div class="col-6 mx-auto">
						<div class="card shadow">
							<div class="card-body">
								<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Usuario(s) duplicado(s).</h5>
								<p class="card-text">Uno o más de los usuarios que deseas ingresar ya tienen un registro en el portal. Modifica el 'Usuario' para ingresarlo. Revisa en el apartado de administración correspondiente para revisarlo.</p>
								<div class="text-right mt-5"><a href="../../admin/voluntarios.php" class="btn btn-warning">Regresar</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			include_once('../../includes/footer.php');
		}

	} else {
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/voluntarios.php'>";
		include_once('../../includes/header.php');
		?>
		<div class="container h-100">
			<div class="row align-items-center h-100">
				<div class="col-6 mx-auto">
					<div class="card shadow">
						<div class="card-body">
							<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ha ocurrido un error.</h5>
							<p class="card-text">No se han podido almacenar los datos en la plataforma. Si el error persiste por favor avisa al administrador de JA México.</p>
							<div class="text-right mt-5"><a href="../../admin/voluntarios.php" class="btn btn-warning">Regresar</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		include_once('../../includes/footer.php');
	}
} else {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/voluntarios.php'>";
	include_once('../../includes/header.php');
	?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-6 mx-auto">
				<div class="card shadow">
					<div class="card-body">
						<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>No puedes acceder a esta sección.</h5>
						<p class="card-text">En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
						<div class="text-right mt-5"><a href="../../admin/voluntarios.php" class="btn btn-warning">Regresar a sección previa</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include_once('../../includes/footer.php');
}
?>