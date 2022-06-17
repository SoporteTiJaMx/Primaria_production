<?php
	include_once('../conexion.php');
	include_once('../conexion2.php');
	include_once('../funciones.php');

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if ($_SESSION["tipo"]=="Volun") {
			$num_int = (isset($_POST["integrantes"])) ? sanitizar($_POST["integrantes"]) : null;
			$Grupo_ID = (isset($_POST["Grupo_id"])) ? sanitizar($_POST["Grupo_id"]) : null;
            $asesor_id = $_SESSION["Asesor_ID"];
			for ($i=0; $i < $num_int ; $i++) {
				$vinculado[] = (isset($_POST["sesion_id_".$i])) ? sanitizar($_POST["sesion_id_".$i]) : null;
				$reseteado[] = (isset($_POST["estatus_".$i])) ? sanitizar($_POST["estatus_".$i]) : null;
                $estatus_actual[] = (isset($_POST["estatus_id_".$i])) ? sanitizar($_POST["estatus_id_".$i]) : null;
			}
			
			if (isset($_POST["csrf2"]) && $_POST["csrf2"] == $_SESSION["token"]){
				$no_afectados=0;
				$afectados=0;
				for ($j=1; $j <=$num_int; $j++) {
                    $sesion_id = $vinculado[$j-1];
					if ($estatus_actual[$j-1] != $reseteado[$j-1]) {
						$query ="UPDATE Control_Acceso_Sesiones SET Activado = ?, Asesor_ID = ? WHERE Sesion_ID = ? AND Grupo_ID = ?";
						//$query ="DELETE FROM alumnos WHERE Alumno_ID = ? AND estatus_actual_ID = ?";
						if($stmt=$con->prepare($query)){
							$stmt->bind_param("iiii", $reseteado[$j-1], $asesor_id, $sesion_id, $Grupo_ID);
							$stmt->execute();
							$stmt->close();
							$afectados++;
						} else {
							echo "Falló la preparación: (" . $stmt->errno . ") " . $stmt->error . "<br>";
							echo "Favor de reportarlo al administrador.";
						}
					}else {
						$no_afectados++;
					}
				}
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../asesor/sesiones_control.php'>";
					include_once('../../includes/header.php');
					echo "<div class='container h-100'>
						<div class='row align-items-center h-100'>
							<div class='col-6 mx-auto'>
								<div class='card shadow'>
									<div class='card-body'>
										<h5 class='card-title mb-5 align-middle'><i class='fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green'></i>Datos guardados exitosamente.</h5>
										<p class='card-text'>Puedes seguir trabajando en el portal. <br>Se Modificó/Modificaron ".$afectados." sesión/sesiones. <br> No se afectaron ".$no_afectados." sesión/sesiones.</p>
										<p class='card-text'>En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
										<div class='text-right mt-5'><a href='../../asesor/sesiones_control.php' class='btn btn-warning'>Ir</a></div>
									</div>
								</div>
							</div>
							</div>
						</div>";
					include_once('../../includes/footer.php');
				
			} else {

				echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../asesor/sesiones_control.php'>";

				include_once('../../includes/header.php');
				?>
				<div class="container h-100">
					<div class="row align-items-center h-100">
						<div class="col-6 mx-auto">
							<div class="card shadow">
								<div class="card-body">
									<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ha ocurrido un error.</h5>
									<p class="card-text">En unos segundos serás redirigido, para que vuelvas a intentarlo. Da click en el botón para hacerlo de inmediato.</p>
									<div class="text-right mt-5"><a href="../../asesor/sesiones_control.php" class="btn btn-warning">Ir</a></div>
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