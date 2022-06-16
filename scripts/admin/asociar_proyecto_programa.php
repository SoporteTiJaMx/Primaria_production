<?php
	include_once('../conexion.php');
	include_once('../conexion2.php');
	include_once('../funciones.php');

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if ($_SESSION["tipo"]=="Admin") {
			$num_int = (isset($_POST["integrantes_2"])) ? sanitizar($_POST["integrantes_2"]) : null;
			for ($i=0; $i < $num_int ; $i++) {
				$vinculado[] = (isset($_POST["ases_id_".$i])) ? sanitizar($_POST["ases_id_".$i]) : null;
				$reseteado[] = (isset($_POST["asignar_".$i])) ? sanitizar($_POST["asignar_".$i]) : null;
                $empresa[] = (isset($_POST["empresa_".$i])) ? sanitizar($_POST["empresa_".$i]) : null;
			}
			
			if (isset($_POST["csrf4"]) && $_POST["csrf4"] == $_SESSION["token"]){
				$no_afectados=0;
				$afectados=0;
				for ($j=1; $j <=$num_int; $j++) {
					if ($reseteado[$j-1] == 2) {
						$query ="UPDATE proyecto_programa SET programa_id = ? WHERE Proyecto_ID = ?";
						//$query ="DELETE FROM alumnos WHERE Alumno_ID = ? AND Empresa_ID = ?";
						if($stmt=$con->prepare($query)){
							$stmt->bind_param("ii", $empresa[$j-1], $vinculado[$j-1]);
							$stmt->execute();
							$stmt->close();
							$afectados++;
                            $query2 = "SELECT * FROM ";
						} else {
							echo "Falló la preparación: (" . $stmt->errno . ") " . $stmt->error . "<br>";
							echo "Favor de reportarlo al administrador.";
						}
					}else {
						$no_afectados++;
					}
				}
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/patrocinadores.php'>";
					include_once('../../includes/header.php');
					echo "<div class='container h-100'>
						<div class='row align-items-center h-100'>
							<div class='col-6 mx-auto'>
								<div class='card shadow'>
									<div class='card-body'>
										<h5 class='card-title mb-5 align-middle'><i class='fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green'></i>Datos guardados exitosamente.</h5>
										<p class='card-text'>Puedes seguir trabajando en el portal. <br>Se asociaron ".$afectados." asesores a ".$afectados." empresas. <br> No se afectaron ".$no_afectados." asesores.</p>
										<p class='card-text'>En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
										<div class='text-right mt-5'><a href='../../admin/patrocinadores.php' class='btn btn-warning'>Ir</a></div>
									</div>
								</div>
							</div>
							</div>
						</div>";
					include_once('../../includes/footer.php');
				
			} else {

				echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/patrocinadores.php'>";

				include_once('../../includes/header.php');
				?>
				<div class="container h-100">
					<div class="row align-items-center h-100">
						<div class="col-6 mx-auto">
							<div class="card shadow">
								<div class="card-body">
									<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ha ocurrido un error.</h5>
									<p class="card-text">En unos segundos serás redirigido, para que vuelvas a intentarlo. Da click en el botón para hacerlo de inmediato.</p>
									<div class="text-right mt-5"><a href="../../admin/patrocinadores.php" class="btn btn-warning">Ir</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
				include_once('../../includes/footer.php');
			}
		}
	}
?>