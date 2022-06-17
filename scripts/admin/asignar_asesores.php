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
			$s_i[0] = 1;
			$s_f[0] = 5;
			$s_i[1] = 6;
			$s_f[1] = 10;
			$s_i[2] = 11;
			$s_f[2] = 15;
			$s_i[3] = 16;
			$s_f[3] = 19;
			$s_i[4] = 20;
			$s_f[4] = 24;
			$s_i[5] = 25;
			$s_f[5] = 29;
			
			if (isset($_POST["csrf2"]) && $_POST["csrf2"] == $_SESSION["token"]){
				$no_afectados=0;
				$afectados=0;
				for ($j=1; $j <=$num_int; $j++) {
					if ($reseteado[$j-1] == 2) {
						
						if($empresa[$j-1] >0){
							$programa_id=0;
							$row = mysqli_fetch_array(mysqli_query($con, "SELECT Proyecto_ID FROM grupos WHERE Grupo_ID=".$empresa[$j-1]));
							$query_pp = "SELECT programa_id FROM proyecto_programa WHERE Proyecto_ID=".$row[0];
							$stmt_pp = $con->prepare($query_pp);
							$stmt_pp ->execute();
							$stmt_pp ->bind_result($programa_id);
							$stmt_pp ->fetch();
							//$stmt_pp ->close();

							 if($programa_id > 0 AND $programa_id == 1){
								$query_ss = "SELECT * FROM Control_Acceso_Sesiones WHERE Sesion_ID = 1 AND Grupo_ID=".$empresa[$j-1];
								if($stmt_ss = $con->prepare($query_ss)){
									$stmt_ss->execute();
									$res_ss=$stmt_ss->fetch();
									if($res_ss == false){
										for($in=$s_i[0]; $in <= $s_f[0]; $in++){
											$grupo_id = $empresa[$j-1];
											$asesor_id = $empresa[$j-1];
											$activado=0;
											$query_p="INSERT INTO Control_Acceso_Sesiones (Sesion_ID, Grupo_ID, Asesor_ID, Activado) VALUES (".$in.", ".$grupo_id.", ".$asesor_id.", ".$activado.")";
											$stmt_control = $con->prepare($query_p);
											$stmt_control->execute();
										}
										//$stmt_control->close();
									}
								}
							}else if($programa_id > 0 AND $programa_id == 2){
								$query_ss = "SELECT * FROM Control_Acceso_Sesiones WHERE Sesion_ID = 6 AND Grupo_ID=".$empresa[$j-1];
								if($stmt_ss = $con->prepare($query_ss)){
									$stmt_ss->execute();
									$res_ss=$stmt_ss->fetch();
									if($res_ss == false){
										for($in=$s_i[1]; $in <= $s_f[1]; $in++){
											$grupo_id = $empresa[$j-1];
											$asesor_id = $empresa[$j-1];
											$activado=0;
											$query_p="INSERT INTO Control_Acceso_Sesiones (Sesion_ID, Grupo_ID, Asesor_ID, Activado) VALUES (".$in.", ".$grupo_id.", ".$asesor_id.", ".$activado.")";
											$stmt_control = $con->prepare($query_p);
											$stmt_control->execute();
										}
										//$stmt_control->close();
									}
								}
							}else if($programa_id > 0 AND $programa_id == 3){
								$query_ss = "SELECT * FROM Control_Acceso_Sesiones WHERE Sesion_ID = 11 AND Grupo_ID=".$empresa[$j-1];
								if($stmt_ss = $con->prepare($query_ss)){
									$stmt_ss->execute();
									$res_ss=$stmt_ss->fetch();
									if($res_ss == false){
										for($in=$s_i[2]; $in <= $s_f[2]; $in++){
											$grupo_id = $empresa[$j-1];
											$asesor_id = $empresa[$j-1];
											$activado=0;
											$query_p="INSERT INTO Control_Acceso_Sesiones (Sesion_ID, Grupo_ID, Asesor_ID, Activado) VALUES (".$in.", ".$grupo_id.", ".$asesor_id.", ".$activado.")";
											$stmt_control = $con->prepare($query_p);
											$stmt_control->execute();
										}
										//$stmt_control->close();
									}
								}
							}else if($programa_id > 0 AND $programa_id == 4){
								$query_ss = "SELECT * FROM Control_Acceso_Sesiones WHERE Sesion_ID = 16 AND Grupo_ID=".$empresa[$j-1];
								if($stmt_ss = $con->prepare($query_ss)){
									$stmt_ss->execute();
									$res_ss=$stmt_ss->fetch();
									if($res_ss == false){
										for($in=$s_i[3]; $in <= $s_f[3]; $in++){
											$grupo_id = $empresa[$j-1];
											$asesor_id = $empresa[$j-1];
											$activado=0;
											$query_p="INSERT INTO Control_Acceso_Sesiones (Sesion_ID, Grupo_ID, Asesor_ID, Activado) VALUES (".$in.", ".$grupo_id.", ".$asesor_id.", ".$activado.")";
											$stmt_control = $con->prepare($query_p);
											$stmt_control->execute();
										}
										//$stmt_control->close();
									}
								}
							}else if($programa_id > 0 AND $programa_id == 5){
								$query_ss = "SELECT * FROM Control_Acceso_Sesiones WHERE Sesion_ID = 20 AND Grupo_ID=".$empresa[$j-1];
								if($stmt_ss = $con->prepare($query_ss)){
									$stmt_ss->execute();
									$res_ss=$stmt_ss->fetch();
									if($res_ss == false){
										for($in=$s_i[4]; $in <= $s_f[4]; $in++){
											$grupo_id = $empresa[$j-1];
											$asesor_id = $empresa[$j-1];
											$activado=0;
											$query_p="INSERT INTO Control_Acceso_Sesiones (Sesion_ID, Grupo_ID, Asesor_ID, Activado) VALUES (".$in.", ".$grupo_id.", ".$asesor_id.", ".$activado.")";
											$stmt_control = $con->prepare($query_p);
											$stmt_control->execute();
										}
										//$stmt_control->close();
									}
								}
							}else if($programa_id > 0 AND $programa_id == 6){
								$query_ss = "SELECT * FROM Control_Acceso_Sesiones WHERE Sesion_ID = 25 AND Grupo_ID=".$empresa[$j-1];
								if($stmt_ss = $con->prepare($query_ss)){
									$stmt_ss->execute();
									$res_ss=$stmt_ss->fetch();
									if($res_ss == false){
										for($in=$s_i[5]; $in <= $s_f[5]; $in++){
											$grupo_id = $empresa[$j-1];
											$asesor_id = $empresa[$j-1];
											$activado=0;
											$query_p="INSERT INTO Control_Acceso_Sesiones (Sesion_ID, Grupo_ID, Asesor_ID, Activado) VALUES (".$in.", ".$grupo_id.", ".$asesor_id.", ".$activado.")";
											$stmt_control = $con->prepare($query_p);
											$stmt_control->execute();
										}
										//$stmt_control->close();
									}
								}
							}
						}
						//echo "Proyecto 1 fuera del if";
						$query ="UPDATE asesores_x_grupo SET Grupo_ID = ? WHERE Asesor_ID = ?";
						//$query ="DELETE FROM alumnos WHERE Alumno_ID = ? AND Empresa_ID = ?";
						if($stmt=$con2->prepare($query)){
							$stmt->bind_param("ii", $empresa[$j-1], $vinculado[$j-1]);
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
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/configuracion.php'>";
					include_once('../../includes/header.php');
					echo "<div class='container h-100'>
						<div class='row align-items-center h-100'>
							<div class='col-6 mx-auto'>
								<div class='card shadow'>
									<div class='card-body'>
										<h5 class='card-title mb-5 align-middle'><i class='fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green'></i>Datos guardados exitosamente.</h5>
										<p class='card-text'>Puedes seguir trabajando en el portal. <br>Se asociaron ".$afectados." asesores a ".$afectados." Grupos. <br> No se afectaron ".$no_afectados." asesores.</p>
										<p class='card-text'>En unos segundos serás redirigido. Da click en el botón para hacerlo de inmediato.</p>
										<div class='text-right mt-5'><a href='../../admin/configuracion.php' class='btn btn-warning'>Ir</a></div>
									</div>
								</div>
							</div>
							</div>
						</div>";
					include_once('../../includes/footer.php');
				
			} else {

				echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=../../admin/configuracion.php'>";

				include_once('../../includes/header.php');
				?>
				<div class="container h-100">
					<div class="row align-items-center h-100">
						<div class="col-6 mx-auto">
							<div class="card shadow">
								<div class="card-body">
									<h5 class="card-title mb-5 align-middle"><i class="fas fa-exclamation-circle fa-2x fa-fw ml-2 mr-3 text-pale-green"></i>Ha ocurrido un error.</h5>
									<p class="card-text">En unos segundos serás redirigido, para que vuelvas a intentarlo. Da click en el botón para hacerlo de inmediato.</p>
									<div class="text-right mt-5"><a href="../../admin/configuracion.php" class="btn btn-warning">Ir</a></div>
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